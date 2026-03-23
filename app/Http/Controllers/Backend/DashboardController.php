<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Product;

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

        return view('Backend.dashboard', compact(
            'totalCategories', 'activeCategories', 'inactiveCategories',
            'totalProducts', 'activeProducts', 'inactiveProducts'
        ));
    }
}
