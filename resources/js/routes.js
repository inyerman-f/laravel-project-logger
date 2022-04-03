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
import EditProject from "./components/EditProject";


const routes = [
    {
        path: '/',
        redirect: '/login'
    },
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
        path: '/projects/add',
        component: AddProject ,
        name: "Add Project",
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
        path: '/projects/:id/edit',
        component: EditProject ,
        name: "Edit Project",
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
