<template>
    <div>
        <h1>{{ this.$router.currentRoute.name | formatLabel }}</h1>
        <div class="">
            <v-data-table
                :headers="headers"
                :items="items"
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
            items: [],
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
        })
            .catch((error) => {
                console.log(error);
            });
    },
    filters: {
        formatLabel(value) {
            // let label = value.charAt(0).toUpperCase() + value.slice(1);
            let label = value.replace('panel.', '');

            return label.charAt(0).toUpperCase() + label.slice(1);
        }
    }
}
</script>
