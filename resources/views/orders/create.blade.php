@extends('layouts.app')

@section('title', 'Create Order - SellWave')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Create New Order</h1>
        <p class="text-gray-600 mt-1">Add an order from Instagram customer</p>
    </div>

    <div class="card">
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            
            <div class="space-y-6">
                <!-- Customer Information -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Customer Information</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Customer Name *
                            </label>
                            <input type="text" 
                                   id="customer_name" 
                                   name="customer_name" 
                                   value="{{ old('customer_name') }}"
                                   class="form-input @error('customer_name') border-red-500 @enderror"
                                   placeholder="John Doe"
                                   required>
                            @error('customer_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="instagram_handle" class="block text-sm font-medium text-gray-700 mb-2">
                                Instagram Handle *
                            </label>
                            <input type="text" 
                                   id="instagram_handle" 
                                   name="instagram_handle" 
                                   value="{{ old('instagram_handle') }}"
                                   class="form-input @error('instagram_handle') border-red-500 @enderror"
                                   placeholder="@johndoe"
                                   required>
                            @error('instagram_handle')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Product Selection -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Product Details</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="product_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Product *
                            </label>
                            <select id="product_id" 
                                    name="product_id" 
                                    class="form-input @error('product_id') border-red-500 @enderror"
                                    required>
                                <option value="">Select a product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" 
                                            data-price="{{ $product->price }}"
                                            {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }} - {{ $product->formatted_price }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">
                                Quantity *
                            </label>
                            <input type="number" 
                                   id="quantity" 
                                   name="quantity" 
                                   value="{{ old('quantity', 1) }}"
                                   min="1"
                                   class="form-input @error('quantity') border-red-500 @enderror"
                                   required>
                            @error('quantity')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Order Details -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Order Details</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                Status *
                            </label>
                            <select id="status" 
                                    name="status" 
                                    class="form-input @error('status') border-red-500 @enderror"
                                    required>
                                <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="message_content" class="block text-sm font-medium text-gray-700 mb-2">
                                Customer Message
                            </label>
                            <textarea id="message_content" 
                                      name="message_content" 
                                      rows="4" 
                                      class="form-textarea @error('message_content') border-red-500 @enderror"
                                      placeholder="Customer's Instagram message...">{{ old('message_content') }}</textarea>
                            @error('message_content')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Copy the customer's Instagram message here</p>
                        </div>
                    </div>
                </div>

                <!-- Order Total Preview -->
                <div id="order-total" class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-medium text-gray-900">Order Total:</span>
                        <span id="total-amount" class="text-2xl font-bold text-green-600">$0.00</span>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-between pt-6 mt-6 border-t border-gray-200">
                <a href="{{ route('orders.index') }}" class="btn-secondary">
                    Cancel
                </a>
                <button type="submit" class="btn-primary">
                    Create Order
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const productSelect = document.getElementById('product_id');
    const quantityInput = document.getElementById('quantity');
    const totalAmount = document.getElementById('total-amount');

    function updateTotal() {
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const price = parseFloat(selectedOption.dataset.price) || 0;
        const quantity = parseInt(quantityInput.value) || 1;
        const total = price * quantity;
        
        totalAmount.textContent = '$' + total.toFixed(2);
    }

    productSelect.addEventListener('change', updateTotal);
    quantityInput.addEventListener('input', updateTotal);
    
    // Initial calculation
    updateTotal();
});
</script>
@endsection 