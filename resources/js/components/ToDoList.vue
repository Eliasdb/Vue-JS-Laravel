<template>
    <div style="text-align: center; position: relative; margin-top: 120px width: 300px;">
        <div style="display: inline-block; box-shadow: 5px solid black; padding: 10px; position absolute; margin: 0;">
            <h2>TO DO</h2>

            <form @submit.prevent="addTodo">
                <br>
                <input type="text" placeholder="Title" v-model="title" class="form-control" style="width: 200px">
                <br>
                <input type="text" placeholder="Message" v-model="message" class="form-control" style="width: 200px">
                <br>
                <input type="submit" value="Add" class="btn btn-primary" style="width:100px">
            </form>
            <br>

            <table class="table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th colspan="2">Message</th>
                </tr>
                </thead>

                <tbody>
                <tr v-for="todo in todos">
                    <td v-text="todo.title"></td>
                    <td v-text="todo.message"></td>
                    <td>
                        <button @click="deleteTodo(todo)" style="border: none"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                <tr v-if="todos.length === 0"> <!-- ! todos.length -->
                    <td colspan="3"><i>Geen todos.</i></td>
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
                message: '',
                title: '',
                todos: JSON.parse(localStorage.getItem('todo-storage') || '[]') // getting info from
            };
        },

        methods: {
            addTodo() {
                if (this.todos.push({
                    title: this.title,
                    message: this.message
                })) {
                    this.message = '';
                    this.title = ''
                }
            },

            deleteTodo(todo) {
                this.todos.splice(
                    this.todos.indexOf(todo), 1
                );
            }
        },

        watch: {
            todos() {
                localStorage.setItem('todo-storage', JSON.stringify(this.todos)); // setting in local storage when the array changes
            }
        }

    }
</script>


