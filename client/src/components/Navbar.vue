<template>
    <nav>
        <ul class="nav">
            <!-- <li v-if="isLoggedIn">
                <router-link :to="{ name: 'home' }">Home</router-link>
            </li> -->
            <li v-if="!isLoggedIn">
                <router-link :to="{ name: 'login' }">Login</router-link>
            </li>
            <li v-if="!isLoggedIn">
                <router-link :to="{ name: 'register' }">Register</router-link>
            </li>
            <li v-if="isLoggedIn">
                <router-link :to="{ name: 'logout' }">Logout</router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    computed: {
        isLoggedIn() {
            return this.$store.getters.isLoggedIn;
        }
    }
}
</script>