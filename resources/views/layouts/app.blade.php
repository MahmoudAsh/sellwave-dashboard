<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SellWave - Instagram E-commerce Platform')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-900">
                        🌊 SellWave
                    </a>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="{{ route('dashboard') }}" 
                       class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-blue-600 bg-blue-50' : '' }}">
                        📊 Dashboard
                    </a>
                    <a href="{{ route('products.index') }}" 
                       class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('products.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                        📦 Products
                    </a>
                    <a href="{{ route('orders.index') }}" 
                       class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('orders.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                        📋 Orders
                    </a>
                    <a href="{{ route('tasks.index') }}" 
                       class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('tasks.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                        ✅ Tasks
                    </a>
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('products.create') }}" 
                           class="btn-primary text-sm">
                            ➕ Add Product
                        </a>
                        <a href="{{ route('orders.create') }}" 
                           class="btn-secondary text-sm">
                            📝 New Order
                        </a>
                        <a href="{{ route('tasks.create') }}" 
                           class="btn-secondary text-sm">
                            ✅ New Task
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Flash Messages -->
        @if(session('success'))
            <div id="success-message" class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg transition-opacity duration-300">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <!-- Page Content -->
        <div class="px-4 sm:px-0">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-500 text-sm">
                © 2024 SellWave - Instagram E-commerce Platform. Built with Laravel & Tailwind CSS.
            </p>
        </div>
    </footer>
</body>
</html> 