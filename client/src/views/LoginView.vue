<template>
    <div class="login-container">

        <div v-if="errorText">{{ errorText }}</div>

        <form action="#" @submit.prevent="login">
            <h2>Please sign in</h2>

            <div>
                <label for="email">Email</label>
                <input type="email" required autofocus v-model="email">
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" required v-model="password">
            </div>

            <div>
                <button>Sign in</button>
            </div>

        </form>
    </div>
</template>

<script>
export default {
    name: 'Login',
    data() {
        return {
            email: '',
            password: '',
            isLoading: false,
            errorText: '',
        }
    },
    methods: {
        async login() {
            this.isLoading = true;

            try {
                const { status } = await this.$store.dispatch('login', {
                    email: this.email,
                    password: this.password
                })

                if (200 === status) {
                    this.isLoading = false; 
                    this.$router.push({ name: 'home' });
                }   

            } catch (error) {
                console.error(error.response);
                this.isLoading = false;
                this.password = '';
                this.errorText = error.response.data.message;
            }
        }
    }
}
</script>

<style scoped>
.login-container {
    max-width: 300px;
    margin: auto;
}
</style>

