<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش آیتم منو - {{ $restaurant->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">ویرایش آیتم منو - {{ $restaurant->name }}</h1>
            <div class="flex items-center space-x-4">
                <a href="{{ route('seller.menu.index') }}" class="text-blue-600">بازگشت به لیست</a>
                <a href="#" class="text-blue-600">خروج</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-md p-4">
            <h2 class="text-xl font-semibold mb-4">ویرایش آیتم</h2>
            <form action="{{ route('seller.menu.update', $menuItem) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">نام</label>
                    <input type="text" name="name" id="name" class="w-full p-2 border rounded-lg" value="{{ $menuItem->name }}">
                    @error('name') <p class="text-red-600">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700">توضیحات</label>
                    <textarea name="description" id="description" class="w-full p-2 border rounded-lg">{{ $menuItem->description }}</textarea>
                    @error('description') <p class="text-red-600">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-gray-700">قیمت (تومان)</label>
                    <input type="number" name="price" id="price" class="w-full p-2 border rounded-lg" value="{{ $menuItem->price }}">
                    @error('price') <p class="text-red-600">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label for="category" class="block text-gray-700">دسته‌بندی</label>
                    <input type="text" name="category" id="category" class="w-full p-2 border rounded-lg" value="{{ $menuItem->category }}">
                    @error('category') <p class="text-red-600">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-gray-700">لینک تصویر</label>
                    <input type="url" name="image" id="image" class="w-full p-2 border rounded-lg" value="{{ $menuItem->image }}">
                    @error('image') <p class="text-red-600">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">به‌روزرسانی</button>
            </form>
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
