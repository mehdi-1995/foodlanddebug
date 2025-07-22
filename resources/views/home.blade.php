<!-- resources/views/home.blade.php -->
@extends('layouts.app')
@section('content')
<!-- هدر -->
<header class="bg-white shadow-md p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-2xl font-bold text-pink-600">لوگوی وب‌سایت</div>
        <div class="search-bar flex items-center w-1/2">
            <input type="text" id="searchInput" placeholder="جستجوی رستوران، غذا یا محله..." class="w-full bg-transparent outline-none">
            <i class="fas fa-search text-gray-500"></i>
        </div>
        <div class="flex items-center space-x-4">
            <div class="cart-icon">
                <a href="{{ url('/cart') }}"><i class="fas fa-shopping-cart text-2xl text-gray-700"></i></a>
                <span class="badge" id="cartCount">0</span>
            </div>
            <button id="loginBtn" class="bg-pink-600 text-white px-4 py-2 rounded-full">ورود / ثبت‌نام</button>
        </div>
    </div>
</header>

<!-- مودال ورود/ثبت‌نام -->
<div id="loginModal" class="modal">
    <div class="modal-content">
        <h2 class="text-xl font-bold mb-4">ورود / ثبت‌نام</h2>
        <form id="loginForm">
            <input type="text" id="phone" placeholder="شماره موبایل" class="w-full p-2 mb-4 border rounded">
            <input type="password" id="password" placeholder="رمز عبور" class="w-full p-2 mb-4 border rounded">
            <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded-full w-full">ورود</button>
        </form>
        <button id="closeModal" class="mt-4 text-gray-600">بستن</button>
    </div>
</div>

<!-- دسته‌بندی‌ها -->
<section class="container mx-auto my-6">
    <div class="flex space-x-4 overflow-x-auto">
        <button class="category-filter px-4 py-2 bg-pink-600 text-white rounded-full" data-category="all">همه</button>
        <button class="category-filter px-4 py-2 bg-gray-200 text-gray-700 rounded-full" data-category="restaurant">رستوران‌ها</button>
        <button class="category-filter px-4 py-2 bg-gray-200 text-gray-700 rounded-full" data-category="cafe">کافه</button>
        <button class="category-filter px-4 py-2 bg-gray-200 text-gray-700 rounded-full" data-category="bakery">شیرینی‌فروشی</button>
        <button class="category-filter px-4 py-2 bg-gray-200 text-gray-700 rounded-full" data-category="supermarket">سوپرمارکت</button>
    </div>
</section>

<!-- لیست رستوران‌ها -->
<section class="container mx-auto my-6">
    <h2 class="text-2xl font-bold mb-4">رستوران‌های نزدیک شما</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="restaurantList">
        <!-- رستوران‌ها به صورت دینامیک اضافه می‌شوند -->
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
@endsection
