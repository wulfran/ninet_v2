<template>
    <div>
        <h1>Users</h1>
        <div class="">
            <v-data-table
                :headers="headers"
                :items="users"
            />
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                authToken: window.APP.authToken,
                headers: [],
                users: []
            }
        },
        created() {
            this.$axios.get('/api/panel/users', {
                headers: {
                    Authorization: 'Bearer ' + this.authToken,
                }
            })
                .then(({data}) => {
                    data.columns.forEach(column => {
                        this.headers.push({
                            text: column,
                            value: column
                        });
                    });
                    this.users = data.users;
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
</script>
