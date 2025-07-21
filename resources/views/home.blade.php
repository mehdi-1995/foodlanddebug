<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فودلند - سفارش غذا</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">فودلند</h1>
            <div class="flex items-center space-x-4">
                <input type="text" placeholder="جستجوی رستوران..." class="p-2 border rounded-lg">
                <a href="#" class="text-blue-600">سبد خرید</a>
                <a href="#" class="text-blue-600">پروفایل</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800">خروج</button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Restaurant List -->
            <div class="md:col-span-3">
                <h2 class="text-xl font-semibold mb-4">رستوران‌های نزدیک شما</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($restaurants as $restaurant)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <img src="{{ $restaurant->logo }}" alt="{{ $restaurant->name }}"
                                class="w-full h-40 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold">{{ $restaurant->name }}</h3>
                                <p class="text-gray-600 text-sm">{{ $restaurant->address }}</p>
                                <div class="flex items-center mt-2">
                                    <span
                                        class="text-yellow-500">{{ str_repeat('★', round($restaurant->rating)) }}</span>
                                    <span
                                        class="text-gray-500 text-sm mr-2">({{ number_format($restaurant->rating, 1) }})</span>
                                </div>
                                <a href="{{ route('restaurants.show', $restaurant->id) }}"
                                    class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded-lg">مشاهده منو</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Cart Component -->
            <div class="md:col-span-1">
                <div id="app">
                    <cart></cart>
                </div>
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
