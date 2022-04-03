<template>
        <div class="container" >
            <form @submit.prevent="login()">
                <h1>Hi Please login :)</h1>
                <div id="user_email_input">
                    <label for="email">Email</label>
                    <input id="email" type="email" v-model="user.email">
                </div>
                <div id="password_input">
                    <label for="password">Password</label>
                    <input id="password" v-on:keyup.enter="login()"  type="password" v-model="user.password">
                </div>
                <button type="submit" class="btn btn-primary" >Login</button>
            </form>
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
    created() {

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
            this.toggleAfterLogin();
        },
        toggleAfterLogin(){
            let login_nav = document
                .getElementById('login_nav');
            let register_nav = document
                .getElementById('register_nav');
            let projects_nav = document
                .getElementById('projects_nav');
            let dashboard_nav = document
                .getElementById('dashboard_nav');
            let logout_nav = document.
            getElementById('logout_nav_link');
            let home_content = document
                .getElementById('home_content');
            logout_nav.style.display= 'unset';
            login_nav.style.display = 'none';
            register_nav.style.display = 'none';
            projects_nav.style.display = 'unset';
            dashboard_nav.style.display = 'unset';
            home_content.style.display = 'none';
        }
    }
}
</script>
