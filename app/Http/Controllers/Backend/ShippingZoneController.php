<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShippingZone;
use Illuminate\Http\Request;

class ShippingZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shipping_zones = ShippingZone::latest()->paginate(10);
        return view('Backend.shipping.index', compact('shipping_zones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'delivery_time' => 'nullable|string|max:255',
            'cost' => 'required|numeric|min:0',
        ]);

        ShippingZone::create([
            'name' => $request->name,
            'delivery_time' => $request->delivery_time,
            'cost' => $request->cost,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Shipping Zone created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShippingZone $shipping_zone)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'delivery_time' => 'nullable|string|max:255',
            'cost' => 'required|numeric|min:0',
        ]);

        $shipping_zone->update([
            'name' => $request->name,
            'delivery_time' => $request->delivery_time,
            'cost' => $request->cost,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'Shipping Zone updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShippingZone $shipping_zone)
    {
        $shipping_zone->delete();
        return back()->with('success', 'Shipping Zone deleted successfully.');
    }
}
