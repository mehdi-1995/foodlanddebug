import { createRouter, createWebHistory } from 'vue-router';
import Home from './components/Home.vue';
import Cart from './components/Cart.vue';
import Profile from './components/Profile.vue';
import Contact from './components/Contact.vue';
import Faq from './components/Faq.vue';
import Terms from './components/Terms.vue';
import Restaurant from './components/Restaurant.vue';
import CustomerPoints from './components/CustomerPoints.vue';
import SellerDashboard from './components/SellerDashboard.vue';
import CourierDashboard from './components/CourierDashboard.vue';
import PaymentVerify from './components/PaymentVerify.vue';

const routes = [
  { path: '/', component: Home, name: 'home' },
  { path: '/cart', component: Cart, name: 'cart.index', meta: { requiresAuth: true, role: 'customer' } },
  { path: '/profile', component: Profile, name: 'profile', meta: { requiresAuth: true } },
  { path: '/contact', component: Contact, name: 'contact' },
  { path: '/faq', component: Faq, name: 'faq' },
  { path: '/terms', component: Terms, name: 'terms' },
  { path: '/restaurants/:restaurant', component: Restaurant, name: 'restaurants.show' },
  { path: '/customer/points', component: CustomerPoints, name: 'customer.points', meta: { requiresAuth: true, role: 'customer' } },
  { path: '/seller/dashboard', component: SellerDashboard, name: 'seller.dashboard', meta: { requiresAuth: true, role: 'seller' } },
  { path: '/courier/dashboard', component: CourierDashboard, name: 'courier.dashboard', meta: { requiresAuth: true, role: 'courier' } },
  { path: '/payment/verify', component: PaymentVerify, name: 'payment.verify', meta: { requiresAuth: true } },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Navigation Guard برای چک کردن احراز هویت و نقش
router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token');
  const user = JSON.parse(localStorage.getItem('user'));

  if (to.meta.requiresAuth && !token) {
    return next({ name: 'home' }); // ریدایرکت به صفحه اصلی اگه لاگین نکرده
  }

  if (to.meta.role && user?.role !== to.meta.role) {
    return next({ name: 'home' }); // ریدایرکت اگه نقش کاربر مطابقت نداره
  }

  next();
});

export default router;
