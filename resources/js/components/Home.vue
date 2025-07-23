<template>
  <div class="bg-gray-100 min-h-screen">
    <!-- هدر -->
    <header class="bg-white shadow-md p-4">
      <div class="container mx-auto flex justify-between items-center">
        <div class="text-2xl font-bold text-pink-600">فودلند</div>
        <div class="search-bar flex items-center w-1/2">
          <input type="text" v-model="searchQuery" placeholder="جستجوی رستوران، غذا یا محله..." class="w-full bg-transparent outline-none" @input="handleSearchInput" />
          <i class="fas fa-search text-gray-500"></i>
        </div>
        <div class="flex items-center space-x-4">
          <div class="cart-icon">
            <router-link to="/cart"><i class="fas fa-shopping-cart text-2xl text-gray-700"></i></router-link>
            <span class="badge" id="cartCount">{{ cartCount }}</span>
          </div>
          <button v-if="!user" @click="openLoginModal" class="bg-pink-600 text-white px-4 py-2 rounded-full">ورود</button>
          <button v-if="!user" @click="openRegisterModal" class="bg-blue-600 text-white px-4 py-2 rounded-full">ثبت‌نام</button>
          <router-link v-else to="/profile" class="bg-pink-600 text-white px-4 py-2 rounded-full">پروفایل</router-link>
          <form v-if="user" method="POST" @submit.prevent="logout">
            <input type="hidden" name="_token" :value="csrfToken">
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-full">خروج</button>
          </form>
        </div>
      </div>
    </header>

    <!-- مودال ورود -->
    <div v-if="showLoginModal" class="modal">
      <div class="modal-content">
        <h2 class="text-xl font-bold mb-4">ورود</h2>
        <form @submit.prevent="login">
          <input type="hidden" name="_token" :value="csrfToken">
          <input v-model="email" type="email" placeholder="ایمیل" class="w-full p-2 mb-4 border rounded" :class="{ 'border-red-500': errors.email }" />
          <p v-if="errors.email" class="text-red-500 text-xs mt-1">{{ errors.email }}</p>
          <input v-model="password" type="password" placeholder="رمز عبور" class="w-full p-2 mb-4 border rounded" :class="{ 'border-red-500': errors.password }" />
          <p v-if="errors.password" class="text-red-500 text-xs mt-1">{{ errors.password }}</p>
          <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded-full w-full">ورود</button>
        </form>
        <button @click="openRegisterModal" class="mt-4 text-pink-600 hover:underline">ثبت‌نام</button>
        <button @click="closeLoginModal" class="mt-6 text-gray-600">بستن</button>
      </div>
    </div>

    <!-- مودال ثبت‌نام -->
    <div v-if="showRegisterModal" class="modal">
      <div class="modal-content">
        <h2 class="text-xl font-bold mb-4">ثبت‌نام</h2>
        <form @submit.prevent="register">
          <input type="hidden" name="_token" :value="csrfToken">
          <input v-model="name" placeholder="نام" class="w-full p-2 mb-4 border rounded" :class="{ 'border-red-500': errors.name }" />
          <p v-if="errors.name" class="text-red-500 text-xs mt-1">{{ errors.name }}</p>
          <input v-model="email" type="email" placeholder="ایمیل" class="w-full p-2 mb-4 border rounded" :class="{ 'border-red-500': errors.email }" />
          <p v-if="errors.email" class="text-red-500 text-xs mt-1">{{ errors.email }}</p>
          <input v-model="phone" placeholder="شماره موبایل" class="w-full p-2 mb-4 border rounded" :class="{ 'border-red-500': errors.phone }" />
          <p v-if="errors.phone" class="text-red-500 text-xs mt-1">{{ errors.phone }}</p>
          <input v-model="password" type="password" placeholder="رمز عبور" class="w-full p-2 mb-4 border rounded" :class="{ 'border-red-500': errors.password }" />
          <p v-if="errors.password" class="text-red-500 text-xs mt-1">{{ errors.password }}</p>
          <input v-model="password_confirmation" type="password" placeholder="تکرار رمز عبور" class="w-full p-2 mb-4 border rounded" :class="{ 'border-red-500': errors.password_confirmation }" />
          <p v-if="errors.password_confirmation" class="text-red-500 text-xs mt-1">{{ errors.password_confirmation }}</p>
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-full w-full">ثبت‌نام</button>
        </form>
        <button @click="openLoginModal" class="mt-4 text-pink-600 hover:underline">ورود</button>
        <button @click="showRegisterModal = false" class="mt-4 text-gray-600">بستن</button>
      </div>
    </div>

    <!-- دسته‌بندی‌ها -->
    <section class="container mx-auto my-6">
      <div class="flex space-x-4 space-x-reverse overflow-x-auto">
        <button class="category-filter px-4 py-2 bg-pink-600 text-white rounded-full" :class="{ 'bg-pink-600 text-white': activeCategory === 'all', 'bg-gray-200 text-gray-700': activeCategory !== 'all' }" @click="filterCategory('all')">همه</button>
        <button class="category-filter px-4 py-2 rounded-full" :class="{ 'bg-pink-600 text-white': activeCategory === 'restaurant', 'bg-gray-200 text-gray-700': activeCategory !== 'restaurant' }" @click="filterCategory('restaurant')">رستوران‌ها</button>
        <button class="category-filter px-4 py-2 rounded-full" :class="{ 'bg-pink-600 text-white': activeCategory === 'cafe', 'bg-gray-200 text-gray-700': activeCategory !== 'cafe' }" @click="filterCategory('cafe')">کافه</button>
        <button class="category-filter px-4 py-2 rounded-full" :class="{ 'bg-pink-600 text-white': activeCategory === 'bakery', 'bg-gray-200 text-gray-700': activeCategory !== 'bakery' }" @click="filterCategory('bakery')">شیرینی‌فروشی</button>
        <button class="category-filter px-4 py-2 rounded-full" :class="{ 'bg-pink-600 text-white': activeCategory === 'supermarket', 'bg-gray-200 text-gray-700': activeCategory !== 'supermarket' }" @click="filterCategory('supermarket')">سوپرمارکت</button>
      </div>
    </section>

    <!-- لیست رستوران‌ها -->
    <section class="container mx-auto my-6">
      <h2 class="text-2xl font-bold mb-4">رستوران‌های نزدیک شما</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="restaurantList">
        <div v-for="restaurant in filteredRestaurants" :key="restaurant.id" class="restaurant-card bg-white p-4 rounded shadow-md">
          <h3 class="text-lg font-bold">{{ restaurant.name }}</h3>
          <p>{{ restaurant.description }}</p>
          <router-link :to="'/restaurant/' + restaurant.id" class="text-pink-600 hover:underline">مشاهده منو</router-link>
        </div>
      </div>
    </section>

    <!-- فوتر -->
    <footer class="bg-gray-800 text-white p-6">
      <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div>
            <h3 class="text-lg font-bold">درباره ما</h3>
            <p class="mt-2">وب‌سایت سفارش آنلاین غذا با هدف ارائه بهترین خدمات.</p>
          </div>
          <div>
            <h3 class="text-lg font-bold">لینک‌های مفید</h3>
            <ul class="mt-2">
              <li><router-link to="/contact" class="hover:underline">تماس با ما</router-link></li>
              <li><router-link to="/faq" class="hover:underline">سوالات متداول</router-link></li>
              <li><router-link to="/terms" class="hover:underline">قوانین و مقررات</router-link></li>
            </ul>
          </div>
          <div>
            <h3 class="text-lg font-bold">تماس با ما</h3>
            <p class="mt-2">ایمیل: support@example.com</p>
            <p>تلفن: 021-12345678</p>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
import axios from 'axios';
import { route } from 'ziggy-js';

export default {
  data() {
    return {
      user: null,
      showLoginModal: false,
      showRegisterModal: false,
      email: '',
      phone: '',
      name: '',
      password: '',
      password_confirmation: '',
      csrfToken: null,
      searchQuery: '',
      cartCount: 0,
      activeCategory: 'all',
      restaurants: [],
      errors: {},
    };
  },
  computed: {
    filteredRestaurants() {
      if (this.activeCategory === 'all') return this.restaurants;
      return this.restaurants.filter(restaurant => restaurant.category === this.activeCategory);
    },
  },
  created() {
    // گرفتن CSRF token با تأخیر
    setTimeout(() => {
      const metaTag = document.querySelector('meta[name="csrf-token"]');
      this.csrfToken = metaTag ? metaTag.content : '';
      if (!this.csrfToken) {
        console.error('CSRF token not found. Ensure <meta name="csrf-token"> exists in Blade template.');
      } else {
        console.log('CSRF token loaded:', this.csrfToken);
      }
    }, 100);

    // گرفتن اطلاعات کاربر
    this.checkUser();

    // گرفتن لیست رستوران‌ها
    this.fetchRestaurants();

    // گرفتن تعداد آیتم‌های سبد خرید
    this.fetchCartCount();
  },
  methods: {
    openLoginModal() {
      this.showLoginModal = true;
      this.showRegisterModal = false;
    },
    openRegisterModal() {
      this.showRegisterModal = true;
      this.showLoginModal = false;
    },
    closeLoginModal() {
      this.showLoginModal = false;
    },
    async checkUser() {
      const token = localStorage.getItem('token');
      if (token) {
        try {
          const response = await axios.get('/api/user', {
            headers: { 'Authorization': `Bearer ${token}` },
          });
          this.user = response.data.user;
          localStorage.setItem('user', JSON.stringify(this.user));
        } catch (error) {
          console.log('User not logged in');
          localStorage.removeItem('token');
          localStorage.removeItem('user');
          this.user = null;
        }
      } else {
        this.user = null;
      }
    },
    async login() {
      if (!this.csrfToken) {
        alert('خطا: توکن CSRF پیدا نشد. لطفاً صفحه را رفرش کنید.');
        return;
      }
      try {
        this.errors = {};
        const response = await axios.post(route('login'), {
          email: this.email,
          password: this.password,
          _token: this.csrfToken,
        });
        this.user = response.data.user;
        localStorage.setItem('user', JSON.stringify(this.user));
        localStorage.setItem('token', response.data.token);
        axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
        this.showLoginModal = false;
        alert('ورود با موفقیت انجام شد!');
        await this.fetchCartCount(); // به‌روزرسانی سبد خرید بعد از لاگین
        this.$router.push(route('home'));
      } catch (error) {
        console.error('Login error:', error);
        if (error.response?.data?.errors) {
          this.errors = error.response.data.errors;
        } else {
          alert('خطا در ورود: ' + (error.response?.data?.message || 'خطای سرور'));
        }
      }
    },
    async register() {
      if (!this.csrfToken) {
        alert('خطا: توکن CSRF پیدا نشد. لطفاً صفحه را رفرش کنید.');
        return;
      }
      try {
        this.errors = {};
        const response = await axios.post(route('register'), {
          name: this.name,
          email: this.email,
          phone: this.phone,
          password: this.password,
          password_confirmation: this.password_confirmation,
          _token: this.csrfToken,
        });
        this.user = response.data.user;
        localStorage.setItem('user', JSON.stringify(this.user));
        localStorage.setItem('token', response.data.token);
        axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
        this.showRegisterModal = false;
        alert('ثبت‌نام با موفقیت انجام شد!');
        await this.fetchCartCount(); // به‌روزرسانی سبد خرید بعد از ثبت‌نام
        this.$router.push(route('home'));
      } catch (error) {
        console.error('Register error:', error);
        if (error.response?.data?.errors) {
          this.errors = error.response.data.errors;
        } else {
          alert('خطا در ثبت‌نام: ' + (error.response?.data?.message || 'خطای سرور'));
        }
      }
    },
    async logout() {
      if (!this.csrfToken) {
        alert('خطا: توکن CSRF پیدا نشد. لطفاً صفحه را رفرش کنید.');
        return;
      }
      try {
        await axios.post(route('logout'), { _token: this.csrfToken }, {
          headers: { 'Authorization': `Bearer ${localStorage.getItem('token')}` },
        });
        this.user = null;
        localStorage.removeItem('user');
        localStorage.removeItem('token');
        axios.defaults.headers.common['Authorization'] = '';
        alert('خروج با موفقیت انجام شد!');
        this.cartCount = 0; // ریست کردن تعداد آیتم‌های سبد خرید
        this.$router.push(route('home'));
      } catch (error) {
        console.error('Logout error:', error);
        alert('خطا در خروج: ' + (error.response?.data?.message || 'خطای سرور'));
      }
    },
    async fetchRestaurants() {
      try {
        const response = await axios.get('/api/restaurants');
        this.restaurants = response.data;
      } catch (error) {
        console.error('Error fetching restaurants:', error);
        this.restaurants = [];
      }
    },
    async fetchCartCount() {
      const token = localStorage.getItem('token');
      if (this.user && token) {
        try {
          const response = await axios.get('/api/cart', {
            headers: { 'Authorization': `Bearer ${token}` },
          });
          this.cartCount = response.data.items.length;
        } catch (error) {
          console.error('Error fetching cart count:', error);
          this.cartCount = 0;
        }
      } else {
        this.cartCount = 0;
      }
    },
    filterCategory(category) {
      this.activeCategory = category;
    },
    handleSearchInput(event) {
      this.searchQuery = event.target.value || '';
    },
  },
};
</script>

<style scoped>
.modal {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}
.modal-content {
  background: white;
  padding: 20px;
  border-radius: 8px;
  width: 400px;
  max-width: 90%;
}
.search-bar {
  background-color: #f8f8f8;
  border-radius: 25px;
  padding: 10px 20px;
}
.cart-icon {
  position: relative;
}
.cart-icon .badge {
  position: absolute;
  top: -10px;
  right: -10px;
  background-color: #ff2e63;
  color: white;
  border-radius: 50%;
  padding: 5px 10px;
  font-size: 12px;
}
.restaurant-card:hover {
  transform: translateY(-5px);
  transition: transform 0.3s ease;
}
</style>
