<template>
    <div>
        <button :class="{ active: filter === 'all' }" @click="changeFilter('all')">All</button>
        <button :class="{ active: filter === 'active' }" @click="changeFilter('active')">Active</button>
        <button :class="{ active: filter === 'completed' }" @click="changeFilter('completed')">Completed</button>
    </div>
</template>

<script>
export default {
    name: 'TodoFilter',
    computed: {
        filter() {
            return this.$store.state.filter
        }
    },
    methods: {
        changeFilter(filter) {
            this.$store.dispatch('changeFilter', filter)
        }
    }
}
</script>

<style scoped lang="scss">
button {
    font-size: 14px;
    padding: 4px 12px;
    margin-right: 4px;
    background-color: white;
    appearance: none;
    border: 1px solid #60d394;

    &:hover {
        background-color: #60d394;
        cursor: pointer;
    }

    &:focus {
        outline: none;
    }
}

.active {
    background: #60d394;
}
</style>