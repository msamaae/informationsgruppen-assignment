<template>
    <div>
        <h2>Welcome, {{ name }} 🙃</h2>
        <div class="home-wrapper">


            <div class="lists">
                <h3>Todolist</h3>

                <form action="#" @submit.prevent="addTodoList">
                    <div>
                        <label for="name">Create a todolist</label>
                        <input type="text" id="name" class="form-input" required v-model="todoListName">
                    </div>

                    <button>Add todolist</button>

                    <div>
                        <label for="todolists">My todolists</label>
                        <select name="todolists" id="todolists" @change="getTodos($event)">
                            <option value="" disabled selected>Select your todolist</option>
                            <option v-for="(value, key) in todoLists" :key="key" :value="value.id">
                                {{ value.name }}
                            </option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="items">
                <h3>Todo</h3>

                <ul v-for="(value, key) in todos" :key="key">
                    <li>{{ value.description }}</li>
                </ul>
            </div>

        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            todoListName: '',
        }
    },
    computed: {
        name() {
            return this.$store.getters.name;
        },
        todoLists() {
            return this.$store.getters.todoLists;
        },
        todos() {
            return this.$store.getters.todos;
        }
    },
    mounted() {
        this.$store.dispatch('getTodoLists');
    },
    methods: {
        // async getTodoLists() {
        //     try {
        //         await this.$store.dispatch('getTodoLists');
        //     } catch (error) {
        //         console.error(error);
        //     }
        // },
        async addTodoList() {
            try {
                const { status } = await this.$store.dispatch('addTodoList', { name: this.todoListName });

                if (status === 201) {
                    this.todoListName = ''
                }
            } catch (error) {
                console.error(error);
            }
        },
        async getTodos(e) {
            try {
                // const selectedTodoList = e.target.value;
                const res = await this.$store.dispatch('getTodos', { todoListId: e.target.value })
                console.log(res.data);
            } catch (error) {
                console.error(error);
            }
        }
    }
}
</script>

<style scoped>
h2 {
    text-align: center;
    margin-bottom: 2rem;
}

.home-wrapper {
    border: 5px dotted green;
    display: grid;
    grid-template-columns: 30% 70%;
    max-width: 980px;
    margin: auto;
}

.lists {
    border: 2px solid blue;
}

.items {
    border: 2px solid red;
    display: flex;
    justify-content: center;
}
</style>