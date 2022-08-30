<template>
    <div class="form-container">
        <div class="form-control" v-if="errorText">
            <div class="form-text error" v-for="(value, key) in errorText" :key="key">
                {{ value[0] }}
            </div>
        </div>

        <div class="form-control form-text success" v-if="successText">{{ successText }}</div>

        <form action="#" @submit.prevent="register">
            <h2 class="form-control">Sign up</h2>

            <div class="form-control">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-input" required autofocus v-model="name">
            </div>

            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-input" required v-model="email">
            </div>

            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-input" required v-model="password">
            </div>

            <button class="form-btn">Sign up</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            // password_confirmation: '',
            errorText: '',
            successText: ''
        }
    },
    methods: {
        async register() {
            try {
                const { status } = await this.$store.dispatch('register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password
                });

                if (201 === status) {
                    this.successText = 'Registered successfully!'

                    this.name = '';
                    this.email = '';
                    this.password = '';

                    setTimeout(() => {
                        this.$router.push({ name: 'login' });
                    }, 2000);
                }
            } catch (error) {
                console.error(error);
                this.errorText = Object.values(error.response.data.errors)
            }
        }
    }
}
</script>