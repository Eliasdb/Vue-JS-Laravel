<template>
    <div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>Available capacity</th>
            <th>Total capacity</th>
            <th>Last update</th>
        </tr>
        </thead>

        <tbody>
        <tr v-for="data in parking">
            <td v-text="data.description"></td>
            <td v-text="data.parkingStatus.availableCapacity"></td>
            <td v-text="data.totalCapacity"></td>
            <td v-text="data.parkingStatus.lastModifiedDate"></td>
        </tr>
        </tbody>
    </table>

        <i v-if="spinner" class="fas fa-spinner fa-spin"></i>

    </div>

</template>
<style scoped>
    /* screen is 500px or less */
    @media screen and (max-width: 500px) {
        .table {
            width: 100%;
        }
    }
    /* screen is 500px or wider */
    @media screen and (min-width: 500px) {
        .table {
            border: 1px solid black;
            margin: auto;
            width: 500px;
        }
    }

</style>
<script>
    export default {
        data() {
            return {
                parking: [],
                refreshRate: 2000,
                spinner: true
            };
        },
        methods: {
            fetchData() {
                this.spinner = true;
                 axios
                    .get('https://datatank.stad.gent/4/mobiliteit/bezettingparkingsrealtime.json')
                       .then(response => {
                        this.parking = response.data;
                    })
                    .finally(() => {
                        setTimeout(this.fetchData, this.refreshRate);
                        this.spinner = false;
                    });
            },
        },
        created() {
            this.fetchData();
        }
    }
</script>
