<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total counts
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        
        // Revenue calculations
        $totalRevenue = Order::where('status', 'completed')
            ->sum(\DB::raw('quantity * price'));
        
        $monthlyRevenue = Order::where('status', 'completed')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum(\DB::raw('quantity * price'));
        
        // Order status breakdown
        $ordersByStatus = Order::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
        
        // Recent orders
        $recentOrders = Order::with('product')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        // Top products by orders
        $topProducts = Product::withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->take(5)
            ->get();
        
        // Pending orders count
        $pendingOrders = Order::where('status', 'pending')->count();

        return view('dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalRevenue',
            'monthlyRevenue',
            'ordersByStatus',
            'recentOrders',
            'topProducts',
            'pendingOrders'
        ));
    }
} 