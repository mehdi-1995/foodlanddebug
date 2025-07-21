<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $restaurant->name }} - فودلند</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">{{ $restaurant->name }}</h1>
            <div class="flex items-center space-x-4">
                <form action="{{ route('restaurants.show', $restaurant->id) }}" method="GET" class="flex items-center">
                    <select name="category" class="p-2 border rounded-lg">
                        <option value="">همه دسته‌بندی‌ها</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="mr-2 bg-blue-600 text-white px-4 py-2 rounded-lg">فیلتر</button>
                </form>
                <a href="{{ route('home') }}" class="text-blue-600">بازگشت</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-md p-4 mb-6">
            <h2 class="text-xl font-semibold">{{ $restaurant->name }}</h2>
            <p class="text-gray-600">{{ $restaurant->address }}</p>
            <p class="text-gray-600">دسته‌بندی: {{ $restaurant->category }}</p>
            <div class="flex items-center mt-2">
                <span class="text-yellow-500">{{ str_repeat('★', round($restaurant->rating)) }}</span>
                <span class="text-gray-500 text-sm mr-2">({{ number_format($restaurant->rating, 1) }})</span>
            </div>
        </div>

        <h2 class="text-xl font-semibold mb-4">منو</h2>
        @if ($menuItems->isEmpty())
            <p class="text-gray-500">هیچ آیتمی در منو یافت نشد.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($menuItems as $menuItem)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="{{ $menuItem->image }}" alt="{{ $menuItem->name }}" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ $menuItem->name }}</h3>
                            <p class="text-gray-600 text-sm">{{ $menuItem->description }}</p>
                            <p class="text-gray-600 text-sm">دسته‌بندی: {{ $menuItem->category }}</p>
                            <p class="text-gray-600 font-semibold mt-2">{{ number_format($menuItem->price) }} تومان</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto px-4 text-center">
            <p>تمامی حقوق برای فودلند محفوظ است © ۱۴۰۴</p>
        </div>
    </footer>
</body>
</html>
