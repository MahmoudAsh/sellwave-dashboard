@extends('layouts.app')

@section('title', $product->name . ' - SellWave')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800">← Back to Products</a>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Product Image -->
        <div>
            @if($product->image)
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-96 object-cover rounded-lg shadow-lg">
            @else
                <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center shadow-lg">
                    <span class="text-gray-400 text-6xl">📦</span>
                </div>
            @endif
        </div>

        <!-- Product Details -->
        <div>
            <div class="card">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                
                <div class="mb-6">
                    <span class="text-3xl font-bold text-green-600">{{ $product->formatted_price }}</span>
                </div>

                @if($product->description)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                    </div>
                @endif

                <!-- Product Stats -->
                <div class="grid grid-cols-2 gap-4 mb-6 p-4 bg-gray-50 rounded-lg">
                    <div class="text-center">
                        <p class="text-2xl font-bold text-gray-900">{{ $product->orders->count() }}</p>
                        <p class="text-sm text-gray-500">Total Orders</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-gray-900">${{ number_format($product->total_revenue, 2) }}</p>
                        <p class="text-sm text-gray-500">Revenue</p>
                    </div>
                </div>

                @if($product->product_link)
                    <div class="mb-6">
                        <a href="{{ $product->product_link }}" target="_blank" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-800">
                            🔗 View External Product Link
                        </a>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('products.edit', $product) }}" class="btn-primary">
                        Edit Product
                    </a>
                    <a href="{{ route('orders.create', ['product_id' => $product->id]) }}" class="btn-secondary">
                        Create Order
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Orders -->
    @if($product->orders->count() > 0)
        <div class="mt-12">
            <div class="card">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Orders for this Product</h2>
                    <span class="text-sm text-gray-500">{{ $product->orders->count() }} orders</span>
                </div>

                <div class="space-y-4">
                    @foreach($product->orders as $order)
                        <div class="p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-4">
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $order->customer_name }}</p>
                                            <p class="text-sm text-blue-600">
                                                <a href="{{ $order->instagram_link }}" target="_blank">
                                                    {{ $order->instagram_handle }}
                                                </a>
                                            </p>
                                        </div>
                                        <div>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $order->status_color }}">
                                                {{ ucwords(str_replace('_', ' ', $order->status)) }}
                                            </span>
                                        </div>
                                    </div>
                                    @if($order->message_content)
                                        <p class="text-gray-600 text-sm mt-2">{{ Str::limit($order->message_content, 150) }}</p>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-gray-900">{{ $order->formatted_total }}</p>
                                    <p class="text-sm text-gray-500">Qty: {{ $order->quantity }}</p>
                                    <p class="text-xs text-gray-400">{{ $order->created_at->format('M j, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
@endsection 