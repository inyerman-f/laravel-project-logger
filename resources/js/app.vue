<template>
    <section id="main_content">
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <button @click="toggleNavbar" class="navbar-toggler" type="button" data-toggle="collapse"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="navbar-item" id="login_nav">
                        <div>
                        <router-link @click="toggleNavbar"  class="nav-item nav-link ml-3" to="/login">Login</router-link>
                        </div>
                    </li>
                    <li class="navbar-item" id="register_nav">
                        <div>
                        <router-link @click="toggleNavbar"  class="nav-item nav-link ml-3" to="/register">Register</router-link>
                        </div>
                    </li>
                    <li class="navbar-item" id="projects_nav">
                        <div>
                        <router-link  class="nav-item nav-link ml-3" to="/projects">Projects</router-link>
                        </div>
                    </li>
                    <li class="navbar-item" id="dashboard_nav">
                        <div>
                        <router-link class="nav-item nav-link ml-3" to="/dashboard">Dashboard</router-link>
                        </div>
                    </li>
                    <li class="navbar-item" id="logout_nav_link">
                        <div>
                        <span @click="logout()" class="nav-item nav-link ml-3">Logout</span>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <router-view> </router-view>
        <footer>
            this is a footer.
        </footer>
    </section>
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
            this.hideAfterLogout()

        },
        hideAfterLogout(){
            let login_nav = document
                .getElementById('login_nav');
            let register_nav = document
                .getElementById('register_nav');
            let projects_nav = document
                .getElementById('projects_nav');
            let dashboard_nav = document
                .getElementById('dashboard_nav');
            let logout_nav = document
                .getElementById('logout_nav_link');
            let home_content = document
                .getElementById('home_content');
            login_nav.style.display = 'unset';
            register_nav.style.display = 'unset';
            projects_nav.style.display = 'none';
            dashboard_nav.style.display = 'none';
            logout_nav.style.display = 'none';
            home_content.style.display = 'unset';
        },
        toggleNavbar(){
            let navbar = document.getElementById('navbarNavDropdown');
            if(navbar.style.display == 'none'){
                navbar.style.display = 'unset';
            }else {
                navbar.style.display = 'none';
            }

        }
    }
}
</script>
