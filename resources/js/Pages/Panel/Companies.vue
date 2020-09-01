<template>
    <div>
        <h1>{{ this.$router.currentRoute.name | formatLabel }}</h1>
        <div class="text-center">
            <v-dialog
                v-model="dialog"
                width="500"
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                        color="red lighten-2"
                        dark
                        v-bind="attrs"
                        v-on="on"
                    >
                        Click Me
                    </v-btn>
                </template>

                <v-card>
                    <v-card-title class="headline grey lighten-2">
                        Privacy Policy
                    </v-card-title>

                    <v-card-text>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </v-card-text>

                    <v-divider></v-divider>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="primary"
                            text
                            @click="dialog = false"
                        >
                            I accept
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            authToken: window.APP.authToken,
            headers: [],
            items: [],
            dialog: false,
            editedItem: {}
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
                    text: data.labels[attribute],
                    value: attribute
                });
                this.items = data.data;
            }
            this.headers.push({ text: 'Actions', value: 'actions', sortable: false });
        })
            .catch((error) => {
                console.log(error);
            });
    },
    methods: {
        detailsItem(item){
            console.log(item);
        },
        editItem(item) {
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },
        deleteItem(item) {

        },
        close() {
            this.dialog = false;
            this.editedItem = {};
        },
        triggerModal() {
            console.log(123);
            this.dialog = f
        }
    },
    computed: {
        formTitle () {
            return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
        },
    },
    watch: {
        dialog (val) {
            val || this.close()
        },
    },
    filters: {
        formatLabel(value) {
            let label = value.replace('panel.', '');

            return label.charAt(0).toUpperCase() + label.slice(1);
        }
    }
}
</script>
