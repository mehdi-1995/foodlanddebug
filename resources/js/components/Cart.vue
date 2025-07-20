<template>
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold mb-4">سبد خرید</h2>
        <div v-if="cartItems.length === 0" class="text-gray-500">
            سبد خرید شما خالی است.
        </div>
        <div v-else>
            <div
                v-for="item in cartItems"
                :key="item.id"
                class="flex justify-between items-center mb-2"
            >
                <div>
                    <p class="font-medium">{{ item.menu_item.name }}</p>
                    <p class="text-gray-600">
                        {{ item.quantity }} x {{ item.price }} تومان
                    </p>
                </div>
                <button @click="removeItem(item.id)" class="text-red-600">
                    حذف
                </button>
            </div>
            <p class="font-semibold mt-4">مجموع: {{ totalPrice }} تومان</p>
            <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg">
                ثبت سفارش
            </button>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            cartItems: [],
        };
    },
    computed: {
        totalPrice() {
            return this.cartItems.reduce(
                (total, item) => total + item.price * item.quantity,
                0
            );
        },
    },
    mounted() {
        this.fetchCartItems();
    },
    methods: {
        async fetchCartItems() {
            try {
                const response = await axios.get("/api/cart", {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "token"
                        )}`,
                    },
                });
                this.cartItems = response.data;
            } catch (error) {
                console.error("Error fetching cart items:", error);
            }
        },
        async removeItem(itemId) {
            try {
                await axios.delete(`/api/cart/${itemId}`, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "token"
                        )}`,
                    },
                });
                this.cartItems = this.cartItems.filter(
                    (item) => item.id !== itemId
                );
            } catch (error) {
                console.error("Error removing item:", error);
            }
        },
    },
};
</script>
