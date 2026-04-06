<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show customer dashboard with real stats
     */
    public function index()
    {
        $user = Auth::user();

        // Total Orders
        $total_orders = Order::where('user_id', $user->id)->count();
        $total_order_amount = Order::where('user_id', $user->id)->sum('total_amount');

        // In-Process Orders (Pending/Processing)
        $in_process_orders = Order::where('user_id', $user->id)
            ->whereIn('order_status', ['pending', 'processing'])
            ->count();
        
        $in_process_amount = Order::where('user_id', $user->id)
            ->whereIn('order_status', ['pending', 'processing'])
            ->sum('total_amount');

        $wallet_balance = 0.00; // Placeholder until wallet feature implemented

        return view('Frontend.dashboard', compact(
            'total_orders', 
            'total_order_amount', 
            'in_process_orders', 
            'in_process_amount', 
            'wallet_balance'
        ));
    }

    /**
     * Show customer orders
     */
    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())->with('items.product')->latest()->get();
        return view('Frontend.orders', compact('orders'));
    }

    /**
     * Show customer settings/profile
     */
    public function settings()
    {
        $user = Auth::user();
        return view('Frontend.settings', compact('user'));
    }

    /**
     * Show single order details
     */
    public function showOrder($id)
    {
        $order = Order::where('user_id', Auth::id())->with('items.product')->findOrFail($id);
        return view('Frontend.order_details', compact('order'));
    }
}
