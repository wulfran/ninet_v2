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
                        <div class="mx-1 cursor-pointer" @click="details">
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
    </div>
</template>

<script>
export default {
    data() {
        return {
            authToken: window.APP.authToken,
            headers: [],
            companies: [],
            dialog: false,
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
    },
    methods: {
        deleteRow(row) {
            console.log(row);
        },
        details() {
            
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
