<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display wishlist.
     */
    public function index()
    {
        $wishlist = Wishlist::where('user_id', auth()->id())->with('product')->get();
        return view('Frontend.profile.wishlist', compact('wishlist'));
    }

    /**
     * Add to wishlist.
     */
    public function toggle(Request $request, $id)
    {
        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'Please login to add to wishlist'], 401);
        }

        $wishlist = Wishlist::where('user_id', auth()->id())->where('product_id', $id)->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['success' => true, 'status' => 'removed', 'message' => 'Product removed from wishlist']);
        } else {
            Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $id
            ]);
            return response()->json(['success' => true, 'status' => 'added', 'message' => 'Product added to wishlist']);
        }
    }
}
