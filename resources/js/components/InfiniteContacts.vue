<template>
    <div><br>
        <input type="text" placeholder="Enter first or last name" v-model="searchQuery"> <br><br>

        <div>
            <table>
                <thead>
                <tr>
                    <th>First name</th>
                    <th>Last name</th>
                </tr>
                </thead>

                <tbody>
                <tr v-for="contact in filteredContacts" style="height: 75px">
                    <td v-text="contact.first_name"></td>
                    <td v-text="contact.last_name"></td>
                </tr>
                </tbody>
            </table>
        </div>

        <infinite-loading spinner="circles" @infinite="infiniteHandler" v-if="contacts.length">
            <div slot="no-more"></div>
        </infinite-loading>

    </div>
</template>

<script>
        import InfiniteLoading from 'vue-infinite-loading';

    export default {
        data() {
            return {
                count: 50,
                contacts: [],
                end: 50,
                searchQuery: ""
            };
        },
        computed: {
            filteredContacts: function () {
                return this.contacts
                    .filter(contact => contact.first_name.match(this.searchQuery) || contact.last_name.match(this.searchQuery))
                    .slice(0, this.end);
            }
        },
        watch: {
            searchQuery: function () {
                this.end = this.count;
            },
        },
        components: {
            InfiniteLoading
        },
        methods: {
            infiniteHandler($state) {
                if (this.filteredContacts.length < this.contacts.length) {
                    this.end += 10;
                    $state.loaded();
                } else {
                    $state.complete();
                }
            },
        },
        created() { // make an ajax request to our server and render the response, the endpoint I want to hit is /contacts
            axios.get('/contactsdata').then(response => this.contacts = response.data);
            // vue resource -> this.$http does a similar thing
        }
    }
</script>
