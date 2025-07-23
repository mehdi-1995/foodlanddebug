import { createRouter, createWebHistory } from 'vue-router';
import Home from './components/Home.vue';
import Cart from './components/Cart.vue';
import Profile from './components/Profile.vue';
import Contact from './components/Contact.vue';
import Faq from './components/Faq.vue';
import Terms from './components/Terms.vue';
import Restaurant from './components/Restaurant.vue';

const routes = [
  { path: '/', component: Home },
  { path: '/cart', component: Cart },
  { path: '/profile', component: Profile },
  { path: '/contact', component: Contact },
  { path: '/faq', component: Faq },
  { path: '/terms', component: Terms },
  { path: '/restaurant/:id', component: Restaurant },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
