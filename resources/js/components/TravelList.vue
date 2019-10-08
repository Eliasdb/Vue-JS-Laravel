<template>
    <div>

        <form @submit.prevent="addItem" style="margin-left: 5px">
            <br>
            <input type="text" placeholder="Date" style="width: 200px" v-model="date">
            <br><br>
            <input type="text" placeholder="Travel destination" style="width: 200px" v-model="destination">
            <br><br>
            <input type="submit" value="Add" class="btn btn-primary" style="width:200px">
            <br><br>
        </form>
        <hr>

        <form @submit.prevent="addLocation" style="margin-left: 5px">
            <br>
            <input type="text" placeholder="Current location" style="width: 200px" v-model="location">
            <br><br>
            <input type="submit" value="Save" class="btn btn-primary" style="width: 200px">
            <br><br>
        </form>
        <hr>


        <div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Destination</th>
                    <th colspan="2">Distance</th>

                </tr>
                </thead>

                <tbody>
                <tr v-for="x in items">
                    <td v-text="x.date"></td>
                    <td v-text="x.destination"></td>
                    <td></td>
                    <td>
                        <button @click="deleteItem()" style="border: none; background: none"><i class="fas fa-calendar-times"></i></button>
                        <button @click="showDistance()" style="border: none; background: none"><i class="fas fa-calculator"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>



    export default {
        data() {
            let items = JSON.parse(localStorage.getItem('travel-items') || '[]')

            if(!Array.isArray(items)){
                items = []
            }
            let locations = JSON.parse(localStorage.getItem('current-location') || '[]')

            if(!Array.isArray(items)){
                locations = []
            }

            return {
                date: '',
                destination: '',
                items, // = items: items
                location: '',
                locations,
                distance: []
            };
        },
        methods: {
            addItem() {
                if (this.items.push({
                    date: this.date,
                    destination: this.destination,
                })) {
                    this.date = '';
                    this.destination = ''
                }
            },
            deleteItem() {
                this.items.splice(
                    this.items.indexOf(), 1
                );
            },
            addLocation() {
                if (this.locations.push({
                    location: this.location
                })) {
                    this.location = ''
                }
            },
            showDistance() {

            }
        },
        watch: {
            items() {
                localStorage.setItem('travel-items', JSON.stringify(this.items));
            },
            locations() {
                localStorage.setItem('current-location', JSON.stringify(this.locations));
            }
        },

        created() {
            axios
                .get('https://nl.afstand.org/route.json?stops=x|y')
                .then(response => {
                    this.distance = response.data;
                })
        }
    }
</script>


<style scoped>
</style>
