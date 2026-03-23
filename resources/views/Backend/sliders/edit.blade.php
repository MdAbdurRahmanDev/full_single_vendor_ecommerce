@extends('Layouts.admin')

@section('content')
<div class="p-6 max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Slider</h1>
        <p class="text-sm text-gray-500 mt-1">Update the homepage banner slide</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Slide Image</label>
                <div class="mb-3">
                    <img src="{{ asset('uploads/sliders/' . $slider->image) }}" class="h-32 w-auto rounded-xl border border-gray-100 object-cover">
                    <p class="text-xs text-gray-400 mt-1">Current image — upload a new one to replace it</p>
                </div>
                <input type="file" name="image" accept="image/*"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Badge Text <span class="text-gray-400 font-normal">(optional)</span></label>
                <input type="text" name="badge_text" value="{{ old('badge_text', $slider->badge_text) }}" placeholder="e.g. #Big Fashion Sale"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $slider->title) }}" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Subtitle <span class="text-gray-400 font-normal">(optional)</span></label>
                <input type="text" name="subtitle" value="{{ old('subtitle', $slider->subtitle) }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Button Link <span class="text-gray-400 font-normal">(optional)</span></label>
                <input type="text" name="btn_link" value="{{ old('btn_link', $slider->btn_link) }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Display Order</label>
                    <input type="number" name="order_num" value="{{ old('order_num', $slider->order_num) }}" min="0"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                        <option value="1" {{ $slider->status ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$slider->status ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center space-x-3 pt-2">
                <button type="submit" class="bg-orange-500 text-white px-6 py-3 rounded-xl font-semibold text-sm hover:bg-orange-600 transition">
                    Update Slider
                </button>
                <a href="{{ route('admin.sliders.index') }}" class="px-6 py-3 border border-gray-200 text-gray-600 rounded-xl font-semibold text-sm hover:bg-gray-50 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
