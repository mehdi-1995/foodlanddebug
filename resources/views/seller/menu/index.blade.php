<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت منو - {{ $restaurant->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">مدیریت منو - {{ $restaurant->name }}</h1>
            <div class="flex items-center space-x-4">
                <a href="{{ route('seller.dashboard') }}" class="text-blue-600">داشبورد</a>
                <a href="{{ route('seller.menu.create') }}" class="text-blue-600">افزودن آیتم</a>
                <a href="#" class="text-blue-600">خروج</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6">
        <h2 class="text-xl font-semibold mb-4">لیست آیتم‌های منو</h2>
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="bg-white rounded-lg shadow-md p-4">
            @if ($menuItems->isEmpty())
                <p class="text-gray-500">هیچ آیتمی در منو ثبت نشده است.</p>
            @else
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="p-2 text-right">نام</th>
                            <th class="p-2 text-right">دسته‌بندی</th>
                            <th class="p-2 text-right">قیمت</th>
                            <th class="p-2 text-right">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menuItems as $item)
                            <tr class="border-b">
                                <td class="p-2">{{ $item->name }}</td>
                                <td class="p-2">{{ $item->category }}</td>
                                <td class="p-2">{{ number_format($item->price) }} تومان</td>
                                <td class="p-2">
                                    <a href="{{ route('seller.menu.edit', $item) }}" class="text-blue-600">ویرایش</a>
                                    <form action="{{ route('seller.menu.destroy', $item) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600">حذف</button>
                                    </form>
                                </td>
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
