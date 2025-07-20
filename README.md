# Foodland - A Laravel Food Ordering Platform

A Laravel 11-based food ordering platform similar to Snappfood, featuring customer, seller, courier, and loyalty program sections.

## Features
- **Customer Section:** Browse restaurants, view menus, place orders, and track delivery.
- **Seller Section:** Manage restaurant menus and orders.
- **Courier Section:** Handle order deliveries.
- **Loyalty Program:** Earn points and redeem rewards.

## Tech Stack
- **Backend:** Laravel 11, MySQL, Redis (for caching)
- **Frontend:** Blade, Tailwind CSS, Vue.js (for complex components)
- **API:** Laravel Sanctum for authentication
- **Debugging:** Laravel Telescope
- **Testing:** PHPUnit

## Setup Instructions
1. Clone the repository: `git clone <repository-url>`
2. Install dependencies: `composer install && npm install`
3. Copy `.env.example` to `.env` and configure database and Redis.
4. Run migrations: `php artisan migrate`
5. Seed database: `php artisan db:seed`
6. Start development server: `php artisan serve`
7. Run Vite: `npm run dev`

## API Endpoints
- `GET /api/restaurants`: List all restaurants.
- `GET /api/restaurants/{id}`: Show a specific restaurant.

## Running Tests
- Run `php artisan test` to execute unit tests.

## License
MIT License