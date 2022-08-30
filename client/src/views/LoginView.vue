<template>
    <div class="form-container">

        <div class="form-control form-text error" v-if="errorText">{{ errorText }}</div>

        <form action="#" @submit.prevent="login">
            <h2 class="form-control">Sign in</h2>

            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-input" required autofocus v-model="email">
            </div>

            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-input" required v-model="password">
            </div>

            <button class="form-btn">Sign in</button>

        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: 'gg@p123.com',
            password: 'qwewq',
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


