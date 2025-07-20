<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>باشگاه مشتریان - فودلند</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">باشگاه مشتریان</h1>
            <div class="flex items-center space-x-4">
                <a href="{{ route('home') }}" class="text-blue-600">خانه</a>
                <a href="#" class="text-blue-600">خروج</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6">
        <h2 class="text-xl font-semibold mb-4">امتیازات شما</h2>
        <div class="bg-white rounded-lg shadow-md p-4">
            @if ($points->isEmpty())
            <p class="text-gray-500">هیچ امتیازی ثبت نشده است.</p>
            @else
            <p class="text-lg font-semibold">مجموع امتیازات: {{ $points->sum('points') }}</p>
            <table class="w-full mt-4">
                <thead>
                    <tr class="border-b">
                        <th class="p-2 text-right">منبع</th>
                        <th class="p-2 text-right">امتیاز</th>
                        <th class="p-2 text-right">تاریخ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($points as $point)
                    <tr class="border-b">
                        <td class="p-2">{{ $point->source }}</td>
                        <td class="p-2">{{ $point->points }}</td>
                        <td class="p-2">{{ $point->created_at->format('Y-m-d') }}</td>
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