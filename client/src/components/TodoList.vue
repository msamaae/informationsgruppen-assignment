<template>
    <div class="todolist-container">
        <h3>Todolist</h3>

        <div>
            <input type="text" id="name" class="todolist-input" placeholder="Add a todolist" v-model="newTodoList"
                @keyup.enter="addTodoList">
        </div>

        <div class="success-text" v-if="successText">{{ successText }}</div>

        <p>My todolists</p>
        <div class="select-todolist">
            <select name="todolists" @change="getTodos($event)" v-model="selectedTodoList">
                <option value="0" disabled selected>Select your todolist</option>
                <option v-for="(value, key) in todoLists" :key="key" :value="value.id">
                    {{ value.name }}
                </option>
            </select>
            <div class="delete-todolist" v-if="selectedTodoList !== 0 ">
                <button @click="deleteTodoList">&times;</button>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: 'TodoList',
    data() {
        return {
            newTodoList: '',
            successText: '',
        }
    },
    computed: {
        todoLists() {
            return this.$store.getters.todoLists;
        },
        selectedTodoList: {
            get() {
                 return this.$store.getters.selectedTodoList;
            },
            set() {
                return this.$store.commit('SELECTED_TODOLIST', 0)
            }
        }
    },
    mounted() {
        this.$store.dispatch('getTodoLists');
    },
    methods: {
        async addTodoList() {
            if (this.newTodoList.trim().length == 0) return;

            try {
                const { status } = await this.$store.dispatch('addTodoList', { name: this.newTodoList });

                if (status === 201) {
                    this.newTodoList = ''
                }
            } catch (error) {
                console.error(error);
                this.newTodoList = ''

            }
        },
        async deleteTodoList() {
            try {
                if (this.selectedTodoList !== 0 ) {
                    const res = await this.$store.dispatch('deleteTodoList', { todoListId: this.selectedTodoList })

                    if (res.status === 200) {
                        this.successText = 'Todolist removed successfully!';
                        this.$store.dispatch('selectedTodoList', 0);
                    }
                }
            } catch (error) {
                console.error(error);
            } finally {
                setTimeout(() => {
                    this.successText = ''
                }, 2000);
            }
        },
        async getTodos(e) {
            try {
                this.$store.dispatch('selectedTodoList', e.target.value);
                await this.$store.dispatch('getTodos', { todoListId: this.selectedTodoList })
            } catch (error) {
                console.error(error);
            }
        }
    }
}
</script>

<style scoped lang="scss">
h3 {
    margin-bottom: 12px;
}

.todolist-input {
    width: 100%;
    padding: 10px 18px;
    font-size: 18px;
    margin-bottom: 16px;

    &:focus {
        outline: 0;
    }
}

.success-text {
    font-size: 14px;
    color: #60d394;
    font-weight: bold;
}

.select-todolist {
    display: flex;

    & select {
        padding: 8px 4px;
        margin-right: 6px;
    }
}

.delete-todolist button {
    font-size: 1em;
    padding: 4px 12px;
    margin-right: 4px;
    background-color: #fff;
    appearance: none;
    border: 1px solid #ef233c;

    &:hover {
        background-color: #ef233c;
        cursor: pointer;
    }

    &:focus {
        outline: none;
    }
}
</style>