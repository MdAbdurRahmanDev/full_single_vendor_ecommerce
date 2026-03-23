<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Display the checkout page.
     */
    public function checkout()
    {
        // For simulation, we assume some items in "cart".
        // In real app, this would come from Session/Database.
        $cart_items = Product::where('status', 1)->take(2)->get();
        $subtotal = $cart_items->sum('price');
        $shipping = 10.00;
        $total = $subtotal + $shipping;

        return view('Frontend.checkout.order', compact('cart_items', 'subtotal', 'shipping', 'total'));
    }

    /**
     * Process order (Placeholder).
     */
    public function store(Request $request)
    {
        // Logic to save order...
        return redirect()->route('payment.success')->with('success', 'Order placed successfully.');
    }

    /**
     * Success page.
     */
    public function success()
    {
        return view('Frontend.checkout.payment_success');
    }
}
