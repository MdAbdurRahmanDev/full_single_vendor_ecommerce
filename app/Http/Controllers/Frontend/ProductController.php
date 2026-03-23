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
    public function index()
    {
        $products = Product::where('status', 1)->latest()->paginate(12);
        $categories = Categorie::where('status', 'active')->get();
        return view('Frontend.product.index', compact('products', 'categories'));
    }

    /**
     * Display the specified product (Single Product Page).
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('status', 1)->firstOrFail();
        $related_products = Product::where('category_id', $product->category_id)
                                    ->where('id', '!=', $product->id)
                                    ->where('status', 1)
                                    ->take(4)
                                    ->get();
        return view('Frontend.product.single_product', compact('product', 'related_products'));
    }
}
