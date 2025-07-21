# Foodland - A Laravel Food Ordering Platform

A Laravel 11-based food ordering platform similar to Snappfood, featuring customer, seller, courier, and loyalty program sections.

## Features
- **Customer Section:** Browse restaurants, view menus, manage cart, place orders, track delivery, and earn loyalty points.
- **Seller Section:** Manage restaurant menus and orders via a dashboard.
- **Courier Section:** Manage delivery orders via a dashboard.
- **Loyalty Program:** Earn points and redeem rewards based on orders and activities.
- **Queue Management:** Order notifications handled via Laravel Horizon.

## Tech Stack
- **Backend:** Laravel 11, MySQL, Redis (for caching and queues)
- **Frontend:** Blade, Tailwind CSS, Vue.js (for cart component)
- **API:** Laravel Sanctum for authentication
- **Debugging:** Laravel Telescope
- **Queue:** Laravel Horizon
- **Testing:** PHPUnit

## Setup Instructions
1. Clone the repository: `git clone <repository-url>`
2. Install dependencies: `composer install && npm install`
3. Copy `.env.example` to `.env` and configure database and Redis.
4. Run migrations: `php artisan migrate`
5. Seed database: `php artisan db:seed`
6. Install Horizon: `php artisan horizon:install`
7. Start development server: `php artisan serve`
8. Run Vite: `npm run dev`
9. Run Horizon: `php artisan horizon`

## API Endpoints
- `GET /api/restaurants`: List all restaurants.
- `GET /api/restaurants/{id}`: Show a specific restaurant.
- `GET /api/cart`: List cart items.
- `POST /api/cart`: Add item to cart.
- `DELETE /api/cart/{id}`: Remove item from cart.
- `POST /api/orders`: Create an order.
- `GET /api/loyalty-points`: List loyalty points.
- `POST /api/loyalty-points`: Add loyalty points.

## Running Tests
- Run `php artisan test` to execute unit and feature tests.

## License
MIT License
