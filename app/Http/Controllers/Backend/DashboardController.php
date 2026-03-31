<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Product;

use App\Models\Order;

class DashboardController extends Controller
{
    /**
     * Admin Dashboard
     */
    public function index()
    {
        // Category stats
        $totalCategories = Categorie::count();
        $activeCategories = Categorie::where('status', 'active')->count();
        $inactiveCategories = Categorie::where('status', 'inactive')->count();

        // Product stats
        $totalProducts = Product::count();
        $activeProducts = Product::where('status', 1)->count();
        $inactiveProducts = Product::where('status', 2)->count();

        // Order & Revenue Stats
        $totalOrders = Order::count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_amount');
        $pendingOrders = Order::where('order_status', 'pending')->count();
        $processingOrders = Order::where('order_status', 'processing')->count();
        $shippedOrders = Order::where('order_status', 'shipped')->count();

        return view('Backend.dashboard', compact(
            'totalCategories', 'activeCategories', 'inactiveCategories',
            'totalProducts', 'activeProducts', 'inactiveProducts',
            'totalOrders', 'totalRevenue', 'pendingOrders', 'processingOrders', 'shippedOrders'
        ));
    }
}
