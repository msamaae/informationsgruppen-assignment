<template>
    <div>
        <h2>Welcome, {{ name }} 🙃</h2> 
        <div class="home-wrapper">
            <div class="todolist">
                <TodoList />
            </div>

            <div class="todo" v-if="selectedTodoList !== 0">
                <Todo :selected-todo-list="selectedTodoList" />
            </div>

        </div>

    </div>
</template>

<script>
import Todo from '@/components/Todo.vue';
import TodoList from '@/components/TodoList.vue';

export default {
    components: {
        Todo,
        TodoList
    },
    computed: {
        name() {
            return this.$store.getters.name;
        },
        selectedTodoList() {
            return this.$store.getters.selectedTodoList;
        },


    },
}
</script>

<style scoped>
h2 {
    text-align: center;
    margin-bottom: 2rem;
}

.home-wrapper {
    /* border: 5px dotted green; */
    display: grid;
    grid-template-columns: 40% 60%;
    max-width: 880px;
    margin: auto;
}

.todolist {
    /* border: 2px solid blue; */
    padding: 0 1.5rem;
}

.todo {
    /* border: 2px solid red; */
    padding: 0 1.5rem;
    /* display: flex; */
    /* justify-content: center; */
}
</style>