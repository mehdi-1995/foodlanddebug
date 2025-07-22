<template>
  <div class="bg-gray-100">
    <!-- هدر -->
    <header class="bg-white shadow-md p-4">
      <!-- مشابه هدر Home.vue -->
    </header>

    <!-- جزئیات رستوران -->
    <section class="container mx-auto my-6">
      <div class="bg-white rounded-lg shadow-md p-6">
        <img :src="restaurant.image" alt="رستوران" class="w-full h-48 object-cover rounded-lg">
        <h2 class="text-2xl font-bold mt-4">{{ restaurant.name }}</h2>
        <p class="text-gray-600">{{ restaurant.category }}</p>
        <div class="flex items-center mt-2">
          <i class="fas fa-star text-yellow-400"></i>
          <span class="ml-1">{{ restaurant.rating }} ({{ restaurant.reviews }} نظر)</span>
        </div>
        <p class="text-gray-500 mt-2">هزینه ارسال: {{ restaurant.delivery_cost.toLocaleString() }} تومان</p>
        <p class="text-gray-500 mt-2">زمان تحویل: {{ restaurant.delivery_time }}</p>
        <div id="map" class="h-64 mt-4"></div>
      </div>
    </section>
    <!-- بقیه بخش‌ها (منو، نظرات) -->
  </div>
</template>

<script>
import axios from 'axios';
import L from 'leaflet';

export default {
  data() {
    return {
      restaurant: {},
    };
  },
  async created() {
    await this.fetchRestaurant();
    this.initMap();
  },
  methods: {
    async fetchRestaurant() {
      const id = this.$route.params.id;
      const response = await axios.get(`/api/restaurants/${id}`);
      this.restaurant = response.data;
    },
    initMap() {
      const map = L.map('map').setView([this.restaurant.latitude || 35.6892, this.restaurant.longitude || 51.3890], 13);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
      }).addTo(map);
      L.marker([this.restaurant.latitude || 35.6892, this.restaurant.longitude || 51.3890]).addTo(map)
        .bindPopup(this.restaurant.name)
        .openPopup();
    },
  },
};
</script>

<style>
@import 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
</style>
