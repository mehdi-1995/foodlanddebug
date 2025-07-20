<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل فروشنده - فودلند</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">پنل فروشنده - {{ $restaurant->name }}</h1>
            <div class="flex items-center space-x-4">
                <a href="{{ route('seller.dashboard') }}" class="text-blue-600">داشبورد</a>
                <a href="#" class="text-blue-600">خروج</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6">
        <h2 class="text-xl font-semibold mb-4">سفارش‌های اخیر</h2>
        <div class="bg-white rounded-lg shadow-md p-4">
            @if ($orders->isEmpty())
                <p class="text-gray-500">هیچ سفارشی یافت نشد.</p>
            @else
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="p-2 text-right">شماره سفارش</th>
                            <th class="p-2 text-right">مشتری</th>
                            <th class="p-2 text-right">مبلغ</th>
                            <th class="p-2 text-right">وضعیت</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="border-b">
                                <td class="p-2">{{ $order->id }}</td>
                                <td class="p-2">{{ $order->user->name }}</td>
                                <td class="p-2">{{ number_format($order->total_price) }} تومان</td>
                                <td class="p-2">{{ $order->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
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