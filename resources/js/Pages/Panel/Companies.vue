<template>
    <div class="p-4">
        <h1>{{ this.$router.currentRoute.name | formatLabel }}</h1>
        <div class="">
            <vue-good-table
                :columns="headers"
                :rows="companies"
                :pagination-options="{
                    enabled: true,
                    mode: 'records',
                    perPage: 10,
                    position: 'bottom',
                    perPageDropdown: [25, 50, 100],
                    dropdownAllowAll: true,
                    allLabel: 'All',
                }"
            >
                <template slot="table-actions">
                    <button class="btn btn-info btn-md m-1">Add</button>
                </template>
                <template slot="table-row" slot-scope="props" v-if="props.column.field === 'actions'">
                    <div class="d-flex items-center justify-content-center">
                        <div class="mx-1 cursor-pointer" @click="details(props.row)" data-toggle="modal"
                             data-target="#detailsModal">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="eye w-20 h-20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd"
                                      d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="mx-1 cursor-pointer" @click="deleteRow">
                            <svg viewBox="0 0 20 20" fill="currentColor" class="trash w-20 h-20">
                                <path fill-rule="evenodd"
                                      d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </template>
            </vue-good-table>
        </div>
        <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ modalTitle }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 border-bottom px-2">
                                <p class="font-weight-bold">Company data</p>
                            </div>
                        </div>
                        <div class="row py-2 my-2">
                            <div class="col-12 form-group">
                                <label for="company-name">Company name</label>
                                <input id="company-name" class="form-control" type="text" v-model="company.name">
                            </div>
                            <div class="col-12 form-group">
                                <label for="tax-number">Tax number</label>
                                <input id="tax-number" class="form-control" type="text" v-model="company.tax_number">
                            </div>
                            <div class="col-12 form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" rows="4" class="form-control"
                                          v-model="company.description">
                                </textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 border-bottom px-2">
                                <p class="font-weight-bold">Address</p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-10 form-group">
                                <label for="street">Street</label>
                                <input type="text" class="form-control" id="street" v-model="address.street">
                            </div>
                            <div class="col-2 form-group">
                                <label for="street_number">Street number</label>
                                <input type="text" class="form-control" id="street_number" v-model="address.street_number">
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-4">
                                <label for="post_code">Post code</label>
                                <input type="text" class="form-control" id="post_code" v-model="address.post_code">
                            </div>
                            <div class="col-8">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" v-model="address.city">
                            </div>
                        </div>
                        <div class="row my-2" style="z-index: 200">
                            <div class="col-12 form-group">
                                <vue-select :options="countries"
                                            :reduce="name => name.id"
                                            label="name"
                                            v-model="address.country_id"
                                            :clearable="false"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" ref="closeModal">Close</button>
                        <button type="button" class="btn btn-primary" @click="saveData">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VueSelect from 'vue-select';
import Modal from "../../components/Modal";

export default {
    components: {
        VueSelect,
        Modal,
    },
    data() {
        return {
            showModal: false,
            authToken: window.APP.authToken,
            headers: [],
            companies: [],
            countries: [],
            dialog: false,
            company: {
                id: 0,
                name: null,
                description: null,
                tax_number: null,
            },
            address: {
                id: 0,
                street: null,
                street_number: null,
                post_code: null,
                city: null,
                country_id: null,
            }
        }
    },
    created() {
        this.$axios.get('/api' + this.$route.path, {
            headers: {
                Authorization: 'Bearer ' + this.authToken,
            }
        }).then(({data}) => {
            for (let attribute in data.labels) {
                this.headers.push({
                    label: data.labels[attribute],
                    field: attribute
                });
            }
            this.companies = data.data;

            this.headers.push({label: 'Actions', field: 'actions', sortable: false});
        })
            .catch((error) => {
                console.log(error);
            });

        this.$axios.get('/api/panel/countries',{
            headers: {
                Authorization: 'Bearer ' + this.authToken,
            }
        }).then(({data}) => {
            this.countries = data.countries;
        });
    },
    methods: {
        deleteRow(row) {
            console.log(this.address);
        },
        details(row) {
            this.address = row.address;
            this.company = row;
        },
        saveData() {
            this.$axios.patch('/api/panel/companies/' + this.company.id, {
                id: this.company.id,
                company: this.company,
                address: this.address,
            }, {
                headers: {
                    Authorization: 'Bearer ' + this.authToken,
                },
                _method: 'patch'
            },).then((response) => {
                this.$refs.closeModal.click();
            }).catch((err)=>{
                console.log(err);
            });
        },
    },
    computed: {
        modalTitle: function () {
            return (this.company.id === 0 ? 'Create' : 'Edit') + ' company';
        }
    },
    filters: {
        formatLabel(value) {
            let label = value.replace('panel.', '');

            return label.charAt(0).toUpperCase() + label.slice(1);
        }
    }
}
</script>
