<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white rounded shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input id="email" type="email" name="email" required autofocus class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700">Password</label>
                <input id="password" type="password" name="password" required class="w-full px-3 py-2 border rounded">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
