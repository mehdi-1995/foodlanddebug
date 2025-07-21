<template>
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold mb-4">ردیابی سفارش‌ها</h2>
        <div v-if="orders.length === 0" class="text-gray-500">
            هیچ سفارشی یافت نشد.
        </div>
        <div v-else>
            <div v-for="order in orders" :key="order.id" class="mb-4 border-b pb-4">
                <p class="font-medium">سفارش شماره {{ order.id }}</p>
                <p class="text-gray-600">رستوران: {{ order.restaurant.name }}</p>
                <p class="text-gray-600">آدرس: {{ order.address.address }}</p>
                <p class="text-gray-600">وضعیت: {{ order.status }}</p>
                <select v-model="order.status" @change="updateStatus(order)" class="mt-2 p-2 border rounded-lg">
                    <option value="preparing">در حال آماده‌سازی</option>
                    <option value="shipped">در حال ارسال</option>
                    <option value="delivered">تحویل‌شده</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            orders: [],
        };
    },
    mounted() {
        this.fetchOrders();
    },
    methods: {
        async fetchOrders() {
            try {
                const response = await axios.get('/api/courier-orders', {
                    headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
                });
                this.orders = response.data;
            } catch (error) {
                console.error('Error fetching orders:', error);
            }
        },
        async updateStatus(order) {
            try {
                await axios.put(`/api/courier-orders/${order.id}`, { status: order.status }, {
                    headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
                });
            } catch (error) {
                console.error('Error updating status:', error);
            }
        },
    },
};
</script>
