<template>
  <div class="container mx-auto my-6">
    <h2 class="text-2xl font-bold mb-4">سبد خرید</h2>
    <div v-if="error" class="text-red-600 mb-4">{{ error }}</div>
    <div v-else>
      <p>تعداد آیتم‌ها در سبد خرید: {{ cartCount }}</p>
      <ul>
        <li v-for="item in cartItems" :key="item.id">
          {{ item.menu_item.name }} - تعداد: {{ item.quantity }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Cart',
  data() {
    return {
      cartItems: [],
      cartCount: 0,
      error: null,
    };
  },
  methods: {
    async fetchCart() {
      try {
        const response = await fetch('/api/cart', {
          credentials: 'include',
          headers: {
            'Accept': 'application/json',
          },
        });
        if (response.status === 401) {
          this.error = 'شما وارد نشده‌اید. لطفاً وارد شوید.';
          this.cartItems = [];
          this.cartCount = 0;
          return;
        }
        if (!response.ok) {
          this.error = 'خطا در دریافت سبد خرید.';
          return;
        }
        const data = await response.json();
        this.cartItems = data;
        this.cartCount = data.length;
        this.error = null;
      } catch (err) {
        this.error = 'خطا در ارتباط با سرور.';
      }
    },
  },
  mounted() {
    this.fetchCart();
  },
};
</script>
