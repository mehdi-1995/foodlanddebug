<template>
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold mb-4">نقشه سفارش‌ها</h2>
        <div id="map"></div>
    </div>
</template>

<script>
import L from "leaflet";
import "leaflet-routing-machine";
import axios from "axios";

export default {
    data() {
        return {
            orders: [],
            map: null,
            routingControl: null,
        };
    },
    mounted() {
        this.initMap();
        this.fetchOrders();
    },
    methods: {
        initMap() {
            this.map = L.map("map").setView([35.6892, 51.389], 13); // Default to Tehran
            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution:
                    '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }).addTo(this.map);
        },
        async fetchOrders() {
            try {
                const response = await axios.get("/api/courier-orders", {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "token"
                        )}`,
                    },
                });
                this.orders = response.data;
                this.addMarkersAndRoutes();
            } catch (error) {
                console.error("Error fetching orders:", error);
            }
        },
        addMarkersAndRoutes() {
            this.orders.forEach((order) => {
                if (order.address.latitude && order.address.longitude) {
                    const marker = L.marker([
                        order.address.latitude,
                        order.address.longitude,
                    ])
                        .addTo(this.map)
                        .bindPopup(
                            `سفارش #${order.id} - ${order.restaurant.name}`
                        );

                    // Add route from restaurant to order address
                    if (
                        order.restaurant.latitude &&
                        order.restaurant.longitude
                    ) {
                        this.routingControl = L.Routing.control({
                            waypoints: [
                                L.latLng(
                                    order.restaurant.latitude,
                                    order.restaurant.longitude
                                ),
                                L.latLng(
                                    order.address.latitude,
                                    order.address.longitude
                                ),
                            ],
                            routeWhileDragging: true,
                            show: false,
                            lineOptions: {
                                styles: [{ color: "#007bff", weight: 4 }],
                            },
                        }).addTo(this.map);
                    }
                }
            });
        },
    },
};
</script>
