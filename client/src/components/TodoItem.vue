<template>
    <div class="todo-item">
        <div class="todo-item-left">
            <input type="checkbox" v-model="completed" @change="completeTodo(todoItem)" />
            <div class="todo-item-label" :class="{ completed }">
                {{ todoItem.description }}
            </div>
        </div>
        <div class="remove-todo-item" v-on:click="deleteTodo(todoItem)">
            &times;
        </div>
    </div>
</template>

<script>
export default {
    name: 'TodoItem',
    props: {
        todoItem: {
            required: true,
            type: Object
        }
    },
    computed: {
        completed: {
            get() {
                if (this.todoItem.completed == 0) {
                    return this.todoItem.completed = false;
                } else {
                    return this.todoItem.completed = true;
                }
            },
            set(newValue) {
                return this.todoItem.completed = newValue;
            }
        },
    },
    methods: {
        async completeTodo(todo) {
            await this.$store.dispatch('completeTodo', {
                todoId: todo.id,
                completed: todo.completed
            })
        },
        async deleteTodo(todo) {
            await this.$store.dispatch('deleteTodo', {
                todoId: todo.id
            })
        }
    }
}
</script>

<style scoped lang="scss">
.todo-item {
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    animation-duration: 0.3s;
}

.todo-item-left {
    display: flex;
    align-items: center;
}

.todo-item-label {
    padding: 10px;
    border: 1px solid white;
    margin-left: 12px;
}

.completed {
    text-decoration: line-through;
    color: grey;
}

.remove-todo-item {
    cursor: pointer;
    margin-left: 14px;

    &:hover {
        color: black;
    }
}
</style>