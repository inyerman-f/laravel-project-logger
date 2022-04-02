<template>
        <div class="container">
            <section>
                <h1>Login</h1>
                <div>
                    <label for="email">Email</label>
                    <input type="email" v-model="user.email">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input v-on:keyup.enter="login()"  type="password" v-model="user.password">
                </div>
                <button @click="login">Login</button>
            </section>
        </div>
</template>

<script>
import Auth from '../Auth.js';


export default {

    data() {
        return {
            user: {
                email: '',
                password: '',
            }
        };
    },

    methods: {
        login() {
            this.axios.post('/api/login', this.user)
                .then(({data}) => {
                    Auth.login(data.access_token,data.user); //set local storage
                    //this.$router.;
                    this.$router.push('/dashboard');

                })
                .catch((error) => {
                    console.log(error);
                    this.$router.go();
                });
            var link = document.getElementById('login_nav');
            //link.style.display = 'none'; //or
            link.style.visibility = 'hidden';
        }
    }
}
</script>
