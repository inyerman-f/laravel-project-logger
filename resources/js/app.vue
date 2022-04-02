<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">

                <div id="login_nav"><span><router-link to="/login">Login</router-link></span></div>
                <div><span><router-link to="/register">Register</router-link></span></div>
                <div><span><router-link to="/projects">Projects</router-link></span></div>
                <div><span><router-link to="/dashboard">Projects</router-link></span></div>
                <div><span><a href="javascript:void(0)" @click="logout()" class="nav-item nav-link ml-3">Logout {{loggedUser}}</a></span></div>

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
            var link = document.getElementById('login_nav');
            //link.style.display = 'all'; //or
            link.style.visibility = 'visible';
        }
    }
}
</script>
