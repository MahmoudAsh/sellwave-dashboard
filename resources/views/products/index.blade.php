@extends('layouts.app')

@section('title', 'Products - SellWave')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Products</h1>
            <p class="text-gray-600 mt-1">Manage your product catalog</p>
        </div>
        <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-500">{{ $products->total() }} total products</span>
        </div>
    </div>
</div>

@if($products->count() > 0)
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach($products as $product)
            <div class="card hover:shadow-xl transition-shadow duration-200">
                <!-- Product Image -->
                <div class="mb-4">
                    @if($product->image)
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg">
                    @else
                        <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center">
                            <span class="text-gray-400 text-4xl">📦</span>
                        </div>
                    @endif
                </div>

                <!-- Product Header -->
                <div class="mb-3">
                    <h3 class="text-lg font-semibold text-gray-900 truncate">
                        {{ $product->name }}
                    </h3>
                    <p class="text-xl font-bold text-green-600">
                        {{ $product->formatted_price }}
                    </p>
                </div>

                <!-- Product Description -->
                @if($product->description)
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ Str::limit($product->description, 100) }}
                    </p>
                @endif

                <!-- Product Stats -->
                <div class="mb-4 text-sm text-gray-500">
                    <div class="flex items-center justify-between">
                        <span>Total Orders:</span>
                        <span class="font-medium">{{ $product->orders_count }}</span>
                    </div>
                    @if($product->product_link)
                        <div class="mt-2">
                            <a href="{{ $product->product_link }}" target="_blank" 
                               class="text-blue-600 hover:text-blue-800 text-xs truncate block">
                                🔗 Product Link
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Product Actions -->
                <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                    <a href="{{ route('products.show', $product) }}" 
                       class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        View Details
                    </a>
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('products.edit', $product) }}" 
                           class="text-gray-600 hover:text-gray-800 text-sm">
                            ✏️ Edit
                        </a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-800 text-sm delete-product"
                                    title="Delete Product">
                                🗑️ Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @endif

@else
    <!-- Empty State -->
    <div class="text-center py-12">
        <div class="max-w-md mx-auto">
            <div class="text-6xl mb-4">📦</div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No products yet</h3>
            <p class="text-gray-500 mb-6">Start building your product catalog to begin selling on Instagram.</p>
            <a href="{{ route('products.create') }}" class="btn-primary">
                ➕ Add Your First Product
            </a>
        </div>
    </div>
@endif
@endsection 