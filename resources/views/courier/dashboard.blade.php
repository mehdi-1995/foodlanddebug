<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل پیک - فودلند</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">پنل پیک - {{ $courier->user->name }}</h1>
            <div class="flex items-center space-x-4">
                <a href="{{ route('courier.dashboard') }}" class="text-blue-600">داشبورد</a>
                <a href="#" class="text-blue-600">خروج</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6">
        <h2 class="text-xl font-semibold mb-4">سفارش‌های تحویلی</h2>
        <div class="bg-white rounded-lg shadow-md p-4 mb-6">
            @if ($orders->isEmpty())
                <p class="text-gray-500">هیچ سفارشی یافت نشد.</p>
            @else
                <div id="app">
                    <courier-order-tracker></courier-order-tracker>
                </div>
            @endif
        </div>
        <div class="bg-white rounded-lg shadow-md p-4">
            <div id="app">
                <courier-map></courier-map>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto px-4 text-center">
            <p>تمامی حقوق برای فودلند محفوظ است © ۱۴۰۴</p>
        </div>
    </footer>
</body>
</html>
