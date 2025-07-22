import '../css/app.css';

// resources/js/app.js
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import axios from 'axios';
import App from './components/App.vue';

window.axios = axios;

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: () => import('./components/Home.vue') },
        { path: '/restaurant/:id', component: () => import('./components/Restaurant.vue') },
        { path: '/cart', component: () => import('./components/Cart.vue') },
        { path: '/checkout', component: () => import('./components/Checkout.vue') },
        { path: '/profile', component: () => import('./components/Profile.vue') },
        { path: '/vendor-dashboard', component: () => import('./components/VendorDashboard.vue') },
        { path: '/courier-dashboard', component: () => import('./components/CourierDashboard.vue') },
    ],
});

const app = createApp(App);
app.use(router);
app.mount('#app');
