<template>
    <table class="table table-hovered">
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
</template>

<script>
    export default {
        data() {
            return {
                parking: [],
                refreshRate: 1000
            };
        },
        methods: {
            fetchData() {
                axios
                    .get('https://datatank.stad.gent/4/mobiliteit/bezettingparkingsrealtime.json')
                    .then(response => this.parking = response.data)
                    .finally(() => setTimeout(this.fetchData, this.refreshRate))
            },
        },
        created() {
            this.fetchData();
        }
    }
</script>
