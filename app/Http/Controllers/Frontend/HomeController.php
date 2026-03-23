<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Categorie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard (Frontend).
     */
    public function index()
    {
        // For simulation, we take latest products as "Flash Sale"
        $flash_sale_products = Product::where('status', 1)->latest()->take(6)->get();
        
        // Latest products as "Todays For You"
        $latest_products = Product::where('status', 1)->latest()->take(12)->get();
        
        // All active categories
        $categories = Categorie::where('status', 'active')->get();

        return view('Frontend.home', compact('flash_sale_products', 'latest_products', 'categories'));
    }
}
