@extends('Layouts.app')

@section('admin')
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Hero Sliders</h1>
            <p class="text-sm text-gray-500 mt-1">Manage the homepage banner sliders</p>
        </div>
        <a href="{{ route('admin.sliders.create') }}" class="inline-flex items-center space-x-2 bg-orange-500 text-white px-5 py-2.5 rounded-xl font-semibold text-sm hover:bg-orange-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Add New Slider</span>
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-6 py-4 font-semibold text-gray-600">#</th>
                    <th class="text-left px-6 py-4 font-semibold text-gray-600">Image</th>
                    <th class="text-left px-6 py-4 font-semibold text-gray-600">Title</th>
                    <th class="text-left px-6 py-4 font-semibold text-gray-600">Order</th>
                    <th class="text-left px-6 py-4 font-semibold text-gray-600">Status</th>
                    <th class="text-right px-6 py-4 font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($sliders as $slider)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-gray-400 font-mono">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4">
                        <img src="{{ asset('uploads/sliders/' . $slider->image) }}" class="w-20 h-12 object-cover rounded-lg border border-gray-100">
                    </td>
                    <td class="px-6 py-4">
                        <p class="font-semibold text-gray-800">{{ $slider->title }}</p>
                        @if($slider->subtitle)
                            <p class="text-xs text-gray-400 mt-0.5">{{ Str::limit($slider->subtitle, 40) }}</p>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-500">{{ $slider->order_num }}</td>
                    <td class="px-6 py-4">
                        @if($slider->status)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-700">Active</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-500">Inactive</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-xs font-semibold hover:bg-blue-100 transition">Edit</a>
                            <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" onsubmit="return confirm('Delete this slider?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 rounded-lg text-xs font-semibold hover:bg-red-100 transition">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-16 text-center text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="font-semibold">No sliders yet</p>
                        <p class="text-sm mt-1">Click "Add New Slider" to get started</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
