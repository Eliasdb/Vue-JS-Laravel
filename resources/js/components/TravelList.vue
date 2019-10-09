<template>
    <div class="container center bg-white shadow">
        <h2>Travel calculator</h2>
        <div class="row justify-content-start">
            <div class="col-4" >
                <form @submit.prevent="addItem">
                    <label for="date">Date</label>
                    <input type="text" placeholder="Date" id="date" class="form-control" v-model="date" required>
                    <label for="destination">Destination</label>
                    <input type="text" placeholder="Travel destination" id="destination" class="form-control" v-model="destination" required>
                    <input type="submit" value="Add" class="btn btn-dark">
                </form>
                <form @submit.prevent="saveLocation">
                    <label for="location">Current location</label>
                    <input type="text" placeholder="Current location" id="location" class="form-control" v-model="location" required>
                    <input type="submit" value="Save" class="btn btn-dark">
                </form>
            </div>

            <div class="col-4">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Destination</th>
                            <th colspan="2">Distance(km)</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr v-for="x in items">
                            <td v-text="x.date"></td>
                            <td v-text="x.destination"></td>
                            <td v-text="x.distance"></td>
                            <td>
                                <button @click="deleteItem()"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            // If the local storage of the array items isn't an array anymore for some reason, make it one again.
            // Why? To make sure it always saves in an array.
            let items = JSON.parse(localStorage.getItem('travel-items') || '[]')

            if(!Array.isArray(items)){
                items = []
            }
            // If the location isn't a string, make it into one.
            // Why? When someone inputs not a string, it's going to make it into one, so it doesn't break.
            let location = JSON.parse(localStorage.getItem('current-location') || '')

            if(typeof location !== 'string'){
                location = ''
            }

            return {
                date: '',
                destination: '',
                items, // = items: items
                location,
                color: {color: '#f8f9fa'}
            };
        },
        methods: {
            // Returns a promise(.get), once that is resolved, .then execute the code.
            // Why? We want the data first.
            async calculateDistance(from, to) {
                return axios.get(`https://nl.afstand.org/route.json?stops=${from}|${to}`)
                    .then(response => response.data.distance)
            },

            // Wait until the distance has been calculated before executing other code.
            // Why? Because you have to wait for the data to be calculated.
            async addItem() {
                if (this.items.push({
                    date: this.date,
                    destination: this.destination,
                    distance: await this.calculateDistance(this.location, this.destination)
                })) {
                    this.date = '';
                    this.destination = ''
                }
            },
            deleteItem(item) {
                this.items.splice(
                    this.items.indexOf(item), 1
                );
            },
            // Store location input in local storage and go through each element of the items array,
            // waiting until the calculation has ended.
            // Why? We need the data from the calculation first.
            saveLocation() {
                localStorage.setItem('current-location', JSON.stringify(this.location));

                this.items
                    .forEach(async item => {
                        item.distance = await this.calculateDistance(this.location, item.destination)
                    })
            }
        },
        watch: {
            items() {
                localStorage.setItem('travel-items', JSON.stringify(this.items));
            },
        },
    }
</script>


<style scoped>
    @import url('https://fonts.googleapis.com/css?family=Volkhov&display=swap');

    .form-control, .btn {
        width: 200px;
        margin: 10px;
    }
    label {
        font-weight: bold;
        font-family: 'Volkhov', serif;

    }
    h2 {
        text-align: center;
        font-family: 'Volkhov', serif;
        margin-top: 12px;
        font-weight: bold;
        padding: 5px;

    }
    .container {
        margin-top: 240px;
    }

    button {
        border: none;
        background: none;
    }

</style>
