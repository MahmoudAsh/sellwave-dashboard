@extends('layouts.app')

@section('title', 'Orders - SellWave')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Instagram Orders</h1>
            <p class="text-gray-600 mt-1">Manage orders from your Instagram customers</p>
        </div>
        <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-500">{{ $orders->total() }} total orders</span>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="card mb-6">
    <form method="GET" action="{{ route('orders.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Search -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="Customer name or @handle"
                   class="form-input text-sm">
        </div>

        <!-- Status Filter -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" class="form-input text-sm">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <!-- Product Filter -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Product</label>
            <select name="product_id" class="form-input text-sm">
                <option value="">All Products</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Actions -->
        <div class="flex items-end space-x-2">
            <button type="submit" class="btn-primary text-sm">Filter</button>
            <a href="{{ route('orders.index') }}" class="btn-secondary text-sm">Clear</a>
        </div>
    </form>
</div>

@if($orders->count() > 0)
    <div class="space-y-4">
        @foreach($orders as $order)
            <div class="card hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-start justify-between">
                    <!-- Order Info -->
                    <div class="flex-1">
                        <div class="flex items-center space-x-4 mb-3">
                            <!-- Customer Info -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $order->customer_name }}</h3>
                                <a href="{{ $order->instagram_link }}" target="_blank" 
                                   class="text-sm text-blue-600 hover:text-blue-800 flex items-center">
                                    📱 {{ $order->instagram_handle }}
                                </a>
                            </div>
                            
                            <!-- Status Badge -->
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $order->status_color }}">
                                {{ ucwords(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </div>

                        <!-- Product Info -->
                        <div class="mb-3 p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $order->product->name ?? 'Deleted Product' }}</p>
                                    <p class="text-sm text-gray-600">
                                        Quantity: {{ $order->quantity }} × {{ $order->product->formatted_price ?? '$' . number_format($order->price, 2) }}
                                    </p>
                                </div>
                                @if($order->product && $order->product->image)
                                    <img src="{{ $order->product->image }}" alt="{{ $order->product->name }}" 
                                         class="w-16 h-16 object-cover rounded-lg">
                                @endif
                            </div>
                        </div>

                        <!-- Message Content -->
                        @if($order->message_content)
                            <div class="mb-3">
                                <p class="text-sm text-gray-700 italic bg-blue-50 p-3 rounded-lg border-l-4 border-blue-400">
                                    "{{ $order->message_content }}"
                                </p>
                            </div>
                        @endif

                        <!-- Order Meta -->
                        <div class="flex items-center text-sm text-gray-500 space-x-4">
                            <span>📅 {{ $order->created_at->format('M j, Y \a\t g:i A') }}</span>
                            <span>🕒 {{ $order->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    <!-- Order Actions & Total -->
                    <div class="text-right">
                        <div class="mb-4">
                            <p class="text-2xl font-bold text-gray-900">{{ $order->formatted_total }}</p>
                            <p class="text-sm text-gray-500">Total Amount</p>
                        </div>

                        <div class="space-y-2">
                            <a href="{{ route('orders.show', $order) }}" 
                               class="block w-full text-center btn-primary text-sm">
                                View Details
                            </a>
                            <div class="flex space-x-2">
                                <a href="{{ route('orders.edit', $order) }}" 
                                   class="flex-1 text-center btn-secondary text-sm">
                                    Edit
                                </a>
                                <form action="{{ route('orders.destroy', $order) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-full btn-danger text-sm delete-order"
                                            title="Delete Order">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($orders->hasPages())
        <div class="mt-8">
            {{ $orders->appends(request()->query())->links() }}
        </div>
    @endif

@else
    <!-- Empty State -->
    <div class="text-center py-12">
        <div class="max-w-md mx-auto">
            <div class="text-6xl mb-4">📱</div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No orders found</h3>
            @if(request()->hasAny(['search', 'status', 'product_id']))
                <p class="text-gray-500 mb-6">No orders match your current filters. Try adjusting your search criteria.</p>
                <a href="{{ route('orders.index') }}" class="btn-secondary mr-2">Clear Filters</a>
            @else
                <p class="text-gray-500 mb-6">Start receiving orders from your Instagram customers.</p>
            @endif
            <a href="{{ route('orders.create') }}" class="btn-primary">
                ➕ Create New Order
            </a>
        </div>
    </div>
@endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete confirmation for orders
    const deleteButtons = document.querySelectorAll('.delete-order');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this order? This action cannot be undone.')) {
                e.preventDefault();
            }
        });
    });
});
</script>
@endpush 