<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div id="login_nav"><span><router-link to="/login">Login</router-link></span></div>
                <div id="register_nav"><span><router-link to="/register">Register</router-link></span></div>
                <div id="projects_nav"><span><router-link to="/projects">Projects</router-link></span></div>
                <div  id="dashboard_nav"><span><router-link to="/dashboard">Dashboard</router-link></span></div>
                <div id="logout_nav_link"><span><a href="javascript:void(0)" @click="logout()" class="nav-item nav-link ml-3">Logout</a></span></div>
            </div>
        </nav>
        <router-view> </router-view>
    </div>
</template>

<script>
import Auth from './Auth.js';

export default {

    data() {
        return {
            loggedUser : this.auth.user,
        };
    },
    mounted() {
        console.log(this.auth.user);
    },
    methods: {
        logout() {
            this.axios.post('/api/logout')
                .then(({data}) => {
                    Auth.logout(); //reset local storage
                    this.$router.push('/login');
                })
                .catch((error) => {
                    console.log(error);
                });
/*
            let login_nav = document.getElementById('login_nav');
            let register_nav = document.getElementById('register_nav');
            let projects_nav = document.getElementById('projects_nav');
            let dashboard_nav = document.getElementById('dashboard_nav');
            let logout_nav = document.getElementById('logout_nav_link');

            login_nav.style.visibility = 'show';
            register_nav.style.visibility = 'show';
            projects_nav.style.visibility = 'hidden';
            dashboard_nav.style.visibility = 'hidden';
            logout_nav.style.visibility = 'hidden';
*/
        }
    }
}
</script>
