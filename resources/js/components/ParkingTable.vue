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

//Todo:
Axios -> calls, data ophalen: ok
Kijken naar nuttige data: ok
table, elke rij is parkeergarage (naam, capacity = kolommen): ok
x aantal seconden opnieuw laden: ok
responsive
spinner icoontje tijdens het laden draait het, anders nite draaien. Zie favicons of glypicons

 500px of kleiner width -> table width = 100%
 500px of groter -> table width = 500px

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
