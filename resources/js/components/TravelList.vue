<template>
    <div>

            <form @submit.prevent="addItem">
                <br>
                <input type="date" style="width: 200px" v-model="date">
                <br><br>
                <input type="text" placeholder="Location" style="width: 200px" v-model="location">
                <br><br>
                <input type="submit" value="Add" class="btn btn-primary" style="width:200px">
                <br><br>
            </form>

    <div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Date</th>
                <th>Location</th>
                <th>Distance</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="x in items">
                <td v-text="x.date"></td>
                <td v-text="x.location"></td>
                <td></td>
                <td>
                    <button @click="deleteItem(item)" style="border: none; background: none"><i class="fas fa-calendar-times"></i></button>
                    <button style="border: none; background: none"><i class="fas fa-calculator"></i></button>

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
            return {
                date: '',
                location: '',
                items: JSON.parse(localStorage.getItem('travel-items') || '[]')
            };
        },
        methods: {
            addItem() {
                if (this.items.push({
                    date: this.date,
                    location: this.location
                })) {
                    this.date = '';
                    this.location = ''
                }
            },
            deleteItem(item) {
                this.items.splice(
                    this.items.indexOf(item), 1
                );
            }
        },
        watch: {
            items() {
                localStorage.setItem('travel-items', JSON.stringify(this.items));
            }
        }
    }
</script>


<style scoped>

</style>
