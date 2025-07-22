<template>
  <div class="bg-gray-100">
    <!-- هدر -->
    <header class="bg-white shadow-md p-4">
      <div class="container mx-auto flex justify-between items-center">
        <div class="text-2xl font-bold text-pink-600">لوگوی وب‌سایت</div>
        <div class="search-bar flex items-center w-1/2">
          <input v-model="searchQuery" @input="searchRestaurants" placeholder="جستجوی رستوران، غذا یا محله..." class="w-full bg-transparent outline-none" />
          <i class="fas fa-search text-gray-500"></i>
        </div>
        <div class="flex items-center space-x-4">
          <div class="cart-icon">
            <router-link to="/cart"><i class="fas fa-shopping-cart text-2xl text-gray-700"></i></router-link>
            <span class="badge">{{ cart.length }}</span>
          </div>
          <button v-if="!user" @click="showLoginModal" class="bg-pink-600 text-white px-4 py-2 rounded-full">ورود / ثبت‌نام</button>
          <router-link v-else to="/profile" class="bg-pink-600 text-white px-4 py-2 rounded-full">پروفایل</router-link>
        </div>
      </div>
    </header>

    <!-- مودال ورود/ثبت‌نام -->
    <div v-if="showModal" class="modal" style="display: flex;">
      <div class="modal-content">
        <h2 class="text-xl font-bold mb-4">ورود / ثبت‌نام</h2>
        <form @submit.prevent="login">
          <input v-model="phone" placeholder="شماره موبایل" class="w-full p-2 mb-4 border rounded" />
          <input v-model="password" type="password" placeholder="رمز عبور" class="w-full p-2 mb-4 border rounded" />
          <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded-full w-full">ورود</button>
        </form>
        <button @click="showModal = false" class="mt-4 text-gray-600">بستن</button>
      </div>
    </div>

    <!-- دسته‌بندی‌ها -->
    <section class="container mx-auto my-6">
      <div class="flex space-x-4 overflow-x-auto">
        <button v-for="category in categories" :key="category.value" @click="filterRestaurants(category.value)" :class="{'bg-pink-600 text-white': activeCategory === category.value, 'bg-gray-200 text-gray-700': activeCategory !== category.value}" class="category-filter px-4 py-2 rounded-full">
          {{ category.label }}
        </button>
      </div>
    </section>

    <!-- لیست رستوران‌ها -->
    <section class="container mx-auto my-6">
      <h2 class="text-2xl font-bold mb-4">رستوران‌های نزدیک شما</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div v-for="restaurant in filteredRestaurants" :key="restaurant.id" class="restaurant-card bg-white rounded-lg shadow-md p-4">
          <img :src="restaurant.image" :alt="restaurant.name" class="w-full h-40 object-cover rounded-lg" />
          <h3 class="text-lg font-bold mt-2">{{ restaurant.name }}</h3>
          <p class="text-gray-600">{{ restaurant.category }}</p>
          <div class="flex items-center mt-2">
            <i class="fas fa-star text-yellow-400"></i>
            <span class="ml-1">{{ restaurant.rating }} ({{ restaurant.reviews }} نظر)</span>
          </div>
          <p class="text-gray-500 mt-2">هزینه ارسال: {{ restaurant.delivery_cost.toLocaleString() }} تومان</p>
          <router-link :to="`/restaurant/${restaurant.id}`" class="mt-4 block bg-pink-600 text-white px-4 py-2 rounded-full text-center">مشاهده منو</router-link>
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
              <li><a href="#" class="hover:underline">تماس با ما</a></li>
              <li><a href="#" class="hover:underline">سوالات متداول</a></li>
              <li><a href="#" class="hover:underline">قوانین و مقررات</a></li>
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

export default {
  data() {
    return {
      restaurants: [],
      filteredRestaurants: [],
      searchQuery: '',
      activeCategory: 'all',
      cart: [],
      user: null,
      showModal: false,
      phone: '',
      password: '',
      categories: [
        { label: 'همه', value: 'all' },
        { label: 'رستوران‌ها', value: 'restaurant' },
        { label: 'کافه', value: 'cafe' },
        { label: 'شیرینی‌فروشی', value: 'bakery' },
        { label: 'سوپرمارکت', value: 'supermarket' },
      ],
    };
  },
  async created() {
    await this.fetchRestaurants();
    this.filteredRestaurants = this.restaurants;
    this.cart = JSON.parse(localStorage.getItem('cart')) || [];
    this.user = JSON.parse(localStorage.getItem('user')) || null;
  },
  methods: {
    async fetchRestaurants() {
      try {
        const response = await axios.get('/api/restaurants');
        this.restaurants = response.data;
        this.filteredRestaurants = this.restaurants;
      } catch (error) {
        console.error('Error fetching restaurants:', error);
      }
    },
    filterRestaurants(category) {
      this.activeCategory = category;
      this.filteredRestaurants = category === 'all' ? this.restaurants : this.restaurants.filter(r => r.type === category);
    },
    searchRestaurants() {
      const query = this.searchQuery.toLowerCase();
      this.filteredRestaurants = this.restaurants.filter(r =>
        r.name.toLowerCase().includes(query) ||
        r.category.toLowerCase().includes(query)
      );
    },
    showLoginModal() {
      this.showModal = true;
    },
    async login() {
      try {
        const response = await axios.post('/api/login', {
          phone: this.phone,
          password: this.password,
        });
        this.user = response.data.user;
        localStorage.setItem('user', JSON.stringify(this.user));
        this.showModal = false;
        alert('ورود با موفقیت انجام شد!');
      } catch (error) {
        alert('خطا در ورود: ' + error.response.data.message);
      }
    },
  },
};
</script>
