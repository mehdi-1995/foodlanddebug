# Vue.js and Horizon Explanation

## Vue.js
- **Purpose:** Used for building interactive UI components like cart and order tracking.
- **Implementation:** Created `Cart.vue` and `CourierOrderTracker.vue` components, integrated with Laravel APIs using axios.
- **Tips for Expansion:**
  - Create new Vue components for additional features (e.g., menu item selection).
  - Use Vue Router for SPA navigation.
  - Debug with browser DevTools and console.log.

## Laravel Horizon
- **Purpose:** Manages queue jobs for asynchronous tasks like order notifications.
- **Implementation:** Used `NotifyOrderStatus` job to handle order status updates, monitored via `/horizon`.
- **Tips for Expansion:**
  - Add new jobs for complex notifications (e.g., email, SMS).
  - Use `php artisan horizon:work` for development.
  - Monitor jobs in `/horizon` dashboard.

**Git Commit Message:**
```
Added documentation for Vue.js and Horizon usage
```