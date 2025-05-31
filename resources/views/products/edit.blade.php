@extends('layouts.app')

@section('title', 'Edit Product - SellWave')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Edit Product</h1>
        <p class="text-gray-600 mt-1">Update product information</p>
    </div>

    <div class="card">
        <form action="{{ route('products.update', $product) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Product Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Product Name *
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $product->name) }}"
                           class="form-input @error('name') border-red-500 @enderror"
                           placeholder="Enter product name"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Product Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4" 
                              class="form-textarea @error('description') border-red-500 @enderror"
                              placeholder="Describe your product">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                        Price *
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500">$</span>
                        </div>
                        <input type="number" 
                               id="price" 
                               name="price" 
                               value="{{ old('price', $product->price) }}"
                               step="0.01"
                               min="0"
                               class="form-input pl-7 @error('price') border-red-500 @enderror"
                               placeholder="0.00"
                               required>
                    </div>
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Product Link -->
                <div>
                    <label for="product_link" class="block text-sm font-medium text-gray-700 mb-2">
                        Product Link
                    </label>
                    <input type="url" 
                           id="product_link" 
                           name="product_link" 
                           value="{{ old('product_link', $product->product_link) }}"
                           class="form-input @error('product_link') border-red-500 @enderror"
                           placeholder="https://example.com/product">
                    @error('product_link')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Optional: Link to external product page</p>
                </div>

                <!-- Product Image URL -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        Image URL
                    </label>
                    <input type="url" 
                           id="image" 
                           name="image" 
                           value="{{ old('image', $product->image) }}"
                           class="form-input @error('image') border-red-500 @enderror"
                           placeholder="https://example.com/image.jpg">
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Optional: URL to product image</p>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-between pt-6 mt-6 border-t border-gray-200">
                <a href="{{ route('products.index') }}" class="btn-secondary">
                    Cancel
                </a>
                <button type="submit" class="btn-primary">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 