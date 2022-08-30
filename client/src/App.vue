<template>
    <div id="app">
        <Navbar />

        <router-view></router-view>
    </div>
</template>

<script>
import Navbar from '@/components/Navbar.vue'
export default {
    components: {
        Navbar
    }
}
</script>

<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

#app {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    color: #2c3e50;
    font-size: 24px;
    height: 100vh;
}

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