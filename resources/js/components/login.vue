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
    name:'Login',
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
                    this.$router.push('/login');
                });
/*
            let login_nav = document.getElementById('login_nav');
            let register_nav = document.getElementById('register_nav');
            let projects_nav = document.getElementById('projects_nav');
            let dashboard_nav = document.getElementById('dashboard_nav');
            let logout_nav = document.getElementById('logout_nav_link');
            logout_nav.style.visibility= 'show';
            login_nav.style.visibility = 'hidden';
            register_nav.style.visibility = 'hidden';
            projects_nav.style.visibility = 'show';
            dashboard_nav.style.visibility = 'show';*/
        }
    }
}
</script>
