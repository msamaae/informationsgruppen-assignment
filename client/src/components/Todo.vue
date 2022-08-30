<template>
    <div class="todo-container">
        <h3>Todo</h3>

        <div>
            <input type="text" class="todo-input" placeholder="What needs to be done" v-model="newTodo"
                @keyup.enter="addTodo">
        </div>

        <div v-for="(value, key) in todosFiltered" :key="key">
            <TodoItem :todo-item="value" />
        </div>

        <div class="extra-container">
            <div></div>
            <TodoItemsRemaining />
        </div>

        <div class="extra-container">
            <TodoFilter />
        </div>
    </div>
</template>

<script>
import TodoItem from './TodoItem.vue';
import TodoItemsRemaining from './TodoItemsRemaining.vue';
import TodoFilter from './TodoFilter.vue';

export default {
    name: 'Todo',
    components: {
        TodoItem,
        TodoItemsRemaining,
        TodoFilter
    },
    props: {
        selectedTodoList: {
            required: true,
            type: Number | String
        }
    },
    data() {
        return {
            newTodo: '',
        }
    },
    computed: {
        todosFiltered() {
            return this.$store.getters.todosFiltered;
        },
        anyRemaning() {
            return this.$store.getters.anyRemaning;
        }
    },
    methods: {
        addTodo() {
            if (this.newTodo.trim().length == 0) return;

            this.$store.dispatch('addTodo', {
                todoListId: this.selectedTodoList,
                description: this.newTodo,
            })

            this.newTodo = '';
        },
    }
}
</script>

<style scoped lang="scss">
h3 {
    margin-bottom: 12px;
}

@media screen and (max-width: 768px) {
    h3 {
        margin-top: 2.5rem;
    }
}

.todo-input {
    width: 100%;
    padding: 10px 18px;
    font-size: 18px;
    margin-bottom: 16px;

    &:focus {
        outline: 0;
    }
}

.extra-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 16px;
    border-top: 1px solid lightgrey;
    padding-top: 14px;
    margin-bottom: 14px;
}
</style>