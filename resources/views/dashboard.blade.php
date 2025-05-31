@extends('layouts.app')

@section('title', 'Dashboard - SellWave')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
    <p class="text-gray-600 mt-1">Welcome to your Instagram e-commerce platform</p>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Products -->
    <div class="card">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                    📦
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Total Products</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalProducts }}</p>
            </div>
        </div>
    </div>

    <!-- Total Orders -->
    <div class="card">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                    📋
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Total Orders</p>
                <p class="text-2xl font-bold text-gray-900">{{ $totalOrders }}</p>
            </div>
        </div>
    </div>

    <!-- Total Revenue -->
    <div class="card">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                    💰
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Total Revenue</p>
                <p class="text-2xl font-bold text-gray-900">${{ number_format($totalRevenue, 2) }}</p>
            </div>
        </div>
    </div>

    <!-- Monthly Revenue -->
    <div class="card">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                    📅
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">This Month</p>
                <p class="text-2xl font-bold text-gray-900">${{ number_format($monthlyRevenue, 2) }}</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Order Status Breakdown -->
    <div class="card">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Order Status</h3>
            @if($pendingOrders > 0)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                    {{ $pendingOrders }} Pending
                </span>
            @endif
        </div>
        <div class="space-y-3">
            @foreach(['pending' => 'yellow', 'in_progress' => 'blue', 'completed' => 'green', 'cancelled' => 'red'] as $status => $color)
                @php $count = $ordersByStatus[$status] ?? 0 @endphp
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $color }}-100 text-{{ $color }}-800">
                            {{ ucwords(str_replace('_', ' ', $status)) }}
                        </span>
                    </div>
                    <span class="text-sm font-medium text-gray-900">{{ $count }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="card">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Recent Orders</h3>
            <a href="{{ route('orders.index') }}" class="text-sm text-blue-600 hover:text-blue-800">View All</a>
        </div>
        <div class="space-y-3">
            @forelse($recentOrders as $order)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">{{ $order->customer_name }}</p>
                        <p class="text-xs text-gray-500">{{ $order->product->name ?? 'Deleted Product' }}</p>
                        <p class="text-xs text-gray-500">@{{ $order->instagram_handle }}</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $order->status_color }}">
                            {{ ucwords(str_replace('_', ' ', $order->status)) }}
                        </span>
                        <p class="text-sm font-medium text-gray-900 mt-1">{{ $order->formatted_total }}</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-4">No orders yet</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Top Products -->
@if($topProducts->count() > 0)
<div class="mt-8">
    <div class="card">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Top Products</h3>
            <a href="{{ route('products.index') }}" class="text-sm text-blue-600 hover:text-blue-800">View All</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($topProducts as $product)
                <div class="p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">{{ $product->name }}</p>
                            <p class="text-xs text-gray-500">{{ $product->formatted_price }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-gray-900">{{ $product->orders_count }}</p>
                            <p class="text-xs text-gray-500">orders</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Quick Actions -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="card text-center">
        <div class="text-4xl mb-3">📦</div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Manage Products</h3>
        <p class="text-gray-600 mb-4">Add, edit, or remove products from your catalog</p>
        <a href="{{ route('products.create') }}" class="btn-primary">Add New Product</a>
    </div>

    <div class="card text-center">
        <div class="text-4xl mb-3">📱</div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Instagram Orders</h3>
        <p class="text-gray-600 mb-4">Process orders from Instagram direct messages</p>
        <a href="{{ route('orders.create') }}" class="btn-secondary">Create New Order</a>
    </div>
</div>
@endsection 