import './bootstrap';
import { createApp } from 'vue';
import Cart from './components/Cart.vue';
import CourierOrderTracker from './components/CourierOrderTracker.vue';

const app = createApp({});
app.component('cart', Cart);
app.component('courier-order-tracker', CourierOrderTracker);
app.mount('#app');
