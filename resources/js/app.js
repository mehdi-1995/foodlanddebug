import './bootstrap';
import { createApp } from 'vue';
import Cart from './components/Cart.vue';

const app = createApp({});
app.component('cart', Cart);
app.mount('#app');