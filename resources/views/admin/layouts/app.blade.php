<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/x-icon" />
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>
<body class="min-h-screen bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    @include('admin.layouts.topbar')
    <div class="main-content flex flex-1 min-h-screen">
        @include('admin.layouts.navbar')
        <div class="ml-80 min-h-[calc(100vh-4rem)] w-full p-4 overflow-auto mt-16">
            @yield('content')
        </div>
    </div>
    @stack('scripts')
</body>
</html>