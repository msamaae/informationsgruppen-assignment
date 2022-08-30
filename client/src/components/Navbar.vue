<template>
    <nav>
        <ul class="nav">
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
    name: 'Navbar',
    computed: {
        isLoggedIn() {
            return this.$store.getters.isLoggedIn;
        }
    }
}
</script>

<style>
.nav {
    display: flex;
    list-style: none;
    padding: 15px 0;
    margin: 0;
    justify-content: flex-end;
    background: #60d394;
    margin-bottom: 24px;
}

.nav a {
    color: #132a13;
    border-bottom: 1px;
    padding: 0 25px;
    font-size: 14px;
    font-weight: 600;
    letter-spacing: .1rem;
    text-decoration: none;
    text-transform: uppercase;
}
</style>