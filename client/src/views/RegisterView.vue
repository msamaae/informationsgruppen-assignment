<template>
    <div class="form-container">
        <div v-if="errorText">
            <div v-for="(value, key) in errorText" :key="key">
                {{ value[0] }}
            </div>
        </div>

        <div v-if="successText">{{ successText }}</div>

        <form action="#" @submit.prevent="register">
            <h2>Sign up</h2>

            <div>
                <label for="name">Name</label>
                <input type="text" required autofocus v-model="name">
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" required v-model="email">
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" required v-model="password">
            </div>

            <!-- <div>
                <label for="password_confirmation">Password Confirmation</label>
                <input type="password_confirmation" required v-model="password_confirmation">
            </div> -->

            <div>
                <button>Sign up</button>
            </div>

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