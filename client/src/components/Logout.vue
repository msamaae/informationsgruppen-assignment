<template></template>

<script>
export default {
    name: 'Logout',
    created() {
        this.$store.dispatch('logout')
            .then(response => {
                this.$router.push({ name: 'login' })
            });
    }
}
</script>