
import Auth from './auth.js';
import { createRouter, createWebHistory } from "vue-router";

import Login from './components/auth/LoginComponent.vue';
import Register from './components/auth/RegisterComponent.vue';
import Dashboard from './components/DashboardComponent.vue';

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
    }
];

 const router = createRouter({
    history: createWebHistory(),
    routes});

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