<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products (Shop Page).
     */
    public function index(Request $request)
    {
        // Reset page if new filter applied
        if ($request->anyFilled(['search', 'category', 'max_price', 'sort']) && !$request->has('page')) {
            // Keep it at page 1
        }

        $query = Product::where('status', 1);

        // Search by name or category
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhereHas('category', function($catQuery) use ($searchTerm) {
                      $catQuery->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }

        // Filter by category slug if provided
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Price Filtering
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();
        
        $all_products_count = Product::where('status', 1)->count();
        
        // Dynamic Category Counts
        $categories = Categorie::where('status', 'active')
            ->withCount(['products' => function($q) {
                $q->where('status', 1);
            }])
            ->get();
        
        return view('Frontend.product.index', compact('products', 'categories', 'all_products_count'));
    }

    /**
     * Display the specified product (Single Product Page).
     */
    public function show($slug)
    {
        $product = Product::with('category')->where('slug', $slug)->where('status', 1)->firstOrFail();
        $related_products = Product::where('category_id', $product->category_id)
                                    ->where('id', '!=', $product->id)
                                    ->where('status', 1)
                                    ->take(4)
                                    ->get();
        return view('Frontend.product.single_product', compact('product', 'related_products'));
    }
}
