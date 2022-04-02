import Vue from 'vue';
import Auth from './Auth.js';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Login from './components/login.vue';
import Register from './components/register.vue';
import Dashboard from './components/dashboard.vue';
import Projects from "./components/projects";
import AddProject from "./components/AddProject";
import Tasks from "./components/tasks";


const routes = [
    {
        path: '/login',
        component: Login,
        name: "Login"
    },
    {
        path: '/register',
        component: Register,
        name: "Register"
    },
    {
        path: '/dashboard',
        component: Dashboard,
        name: "Dashboard",
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/projects',
        component: Projects,
        name: "Projects",
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/projects/:id/tasks',
        component: Tasks,
        name: "Tasks",
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/AddProject',
        component: AddProject ,
        name: "Add Project",
        meta: {
            requiresAuth: true
        }
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth) ) {
        if (Auth.check()) {
            next();
            return;
        } else {
            router.push('/login');
        }
    } else {
        next();
    }
});

export default router;
