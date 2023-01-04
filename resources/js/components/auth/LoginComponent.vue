<template>
    <div>
        <h1>Login</h1>
        <p>{{errors}}</p>
        <div>
            <label for="email">Email</label>
            <input type="email" v-model="user.email">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" v-model="user.password">
        </div>
        <button @click="login">Login</button>
    </div>
</template>

<script>
    import Auth from '../../auth.js';
    
    export default {
        data() {
            return {
                user: {
                    email: '',
                    password: '',
                },
                errors : ''
            };
        },
        methods: {
            login() {
                this.errors = "";
                axios.post('/api/login', this.user)
                    .then(({data}) => {
                        Auth.login(data.data.token, data.data.user); 
                        this.$router.push('/dashboard');
                    })
                    .catch((error) => {
                        this.errors = error.response.data.message;
                    });
            }
        },

    }
</script>