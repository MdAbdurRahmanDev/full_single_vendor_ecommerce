<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    /**
     * Display a listing of the sliders.
     */
    public function index()
    {
        $sliders = Slider::orderBy('order_num', 'asc')->get();
        return view('Backend.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new slider.
     */
    public function create()
    {
        return view('Backend.sliders.create');
    }

    /**
     * Store a newly created slider in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'badge_text' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'btn_link' => 'nullable|string|max:1000',
            'order_num' => 'nullable|integer',
            'status' => 'required|boolean',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/sliders'), $imageName);
        }

        Slider::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'badge_text' => $request->badge_text,
            'image' => $imageName,
            'btn_link' => $request->btn_link,
            'order_num' => $request->order_num ?? 0,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider created successfully.');
    }

    /**
     * Show the form for editing the specified slider.
     */
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('Backend.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified slider in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'badge_text' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'btn_link' => 'nullable|string|max:1000',
            'order_num' => 'nullable|integer',
            'status' => 'required|boolean',
        ]);

        $slider = Slider::findOrFail($id);
        $imageName = $slider->image;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($imageName && File::exists(public_path('uploads/sliders/' . $imageName))) {
                File::delete(public_path('uploads/sliders/' . $imageName));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/sliders'), $imageName);
        }

        $slider->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'badge_text' => $request->badge_text,
            'image' => $imageName,
            'btn_link' => $request->btn_link,
            'order_num' => $request->order_num ?? 0,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully.');
    }

    /**
     * Remove the specified slider from storage.
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        if ($slider->image && File::exists(public_path('uploads/sliders/' . $slider->image))) {
            File::delete(public_path('uploads/sliders/' . $slider->image));
        }

        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider deleted successfully.');
    }
}
