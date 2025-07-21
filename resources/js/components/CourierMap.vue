<template>
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold mb-4">نقشه سفارش‌ها</h2>
        <div id="map"></div>
    </div>
</template>

<script>
import L from 'leaflet';
import axios from 'axios';

export default {
    data() {
        return {
            orders: [],
            map: null,
        };
    },
    mounted() {
        this.initMap();
        this.fetchOrders();
    },
    methods: {
        initMap() {
            this.map = L.map('map').setView([35.6892, 51.3890], 13); // Default to Tehran
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(this.map);
        },
        async fetchOrders() {
            try {
                const response = await axios.get('/api/courier-orders', {
                    headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
                });
                this.orders = response.data;
                this.addMarkers();
            } catch (error) {
                console.error('Error fetching orders:', error);
            }
        },
        addMarkers() {
            this.orders.forEach(order => {
                if (order.address.latitude && order.address.longitude) {
                    L.marker([order.address.latitude, order.address.longitude])
                        .addTo(this.map)
                        .bindPopup(`سفارش #${order.id} - ${order.restaurant.name}`)
                        .openPopup();
                }
            });
        },
    },
};
</script>
