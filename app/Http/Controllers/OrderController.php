<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('product');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by product
        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        // Search by customer name or Instagram handle
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('instagram_handle', 'like', "%{$search}%");
            });
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(15);
        $products = Product::orderBy('name')->get();

        return view('orders.index', compact('orders', 'products'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('orders.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'instagram_handle' => 'required|string|max:255',
            'message_content' => 'nullable|string',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:pending,in_progress,completed,cancelled'
        ]);

        // Get product price and set it in the order
        $product = Product::findOrFail($validated['product_id']);
        $validated['price'] = $product->price;

        Order::create($validated);

        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully!');
    }

    public function show(Order $order)
    {
        $order->load('product');
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $products = Product::orderBy('name')->get();
        return view('orders.edit', compact('order', 'products'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'instagram_handle' => 'required|string|max:255',
            'message_content' => 'nullable|string',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:pending,in_progress,completed,cancelled'
        ]);

        // Update price if product changed
        if ($order->product_id != $validated['product_id']) {
            $product = Product::findOrFail($validated['product_id']);
            $validated['price'] = $product->price;
        }

        $order->update($validated);

        return redirect()->route('orders.index')
            ->with('success', 'Order updated successfully!');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully!');
    }
} 