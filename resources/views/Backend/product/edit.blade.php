@extends('Layouts.app')

@section('admin')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-heading text-neutral-900 border-b-2 border-brand pb-2">Edit Product</h2>
            <a href="{{ route('products.index') }}"
                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg bg-white font-semibold text-sm text-gray-700 hover:bg-gray-50 transition-all">
                Back to List
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-default p-8 max-w-5xl mx-auto overflow-hidden">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left Column: Name & Category Section -->
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-heading mb-2">Product Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand"
                                placeholder="e.g., Slim Fit Cotton Shirt" required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="category_id" class="block text-sm font-semibold text-heading mb-2">Category</label>
                            <select id="category_id" name="category_id"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand"
                                required>
                                <option value="" disabled>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="price" class="block text-sm font-semibold text-heading mb-2">Price ($)</label>
                                <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01"
                                    class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand"
                                    placeholder="0.00" required>
                                @error('price')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="discount_price" class="block text-sm font-semibold text-heading mb-2">Discount Price ($)</label>
                                <input type="number" id="discount_price" name="discount_price" value="{{ old('discount_price', $product->discount_price) }}" step="0.01"
                                    class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand"
                                    placeholder="Optional">
                                @error('discount_price')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Stock & Images Section -->
                    <div class="space-y-6">
                        <div>
                            <label for="stock_quantity" class="block text-sm font-semibold text-heading mb-2">Stock Quantity</label>
                            <input type="number" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand"
                                placeholder="0" required>
                            @error('stock_quantity')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-semibold text-heading mb-2">Status</label>
                            <select id="status" name="status"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand"
                                required>
                                <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="2" {{ old('status', $product->status) == 2 ? 'selected' : '' }}>Deactive</option>
                            </select>
                        </div>

                        <div>
                            <label for="thumbnail" class="block text-sm font-semibold text-heading mb-2">Change Thumbnail</label>
                            <div class="mb-4">
                                <img src="{{ asset('uploads/product/' . $product->thumbnail) }}" alt="{{ $product->name }}"
                                    class="w-32 h-32 rounded-lg object-cover border border-default shadow-sm ring-1 ring-neutral-secondary-medium">
                                <p class="text-xs text-body-light mt-1 italic">Current thumbnail preview</p>
                            </div>
                            <input type="file" id="thumbnail" name="thumbnail"
                                class="w-full text-sm text-body-light file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-brand-soft file:text-brand hover:file:bg-brand-medium"
                                accept="image/*">
                            @error('thumbnail')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-default flex justify-end space-x-3">
                    <a href="{{ route('products.index') }}" class="px-6 py-2.5 text-sm font-medium text-body hover:bg-neutral-secondary-medium transition-all rounded-lg">Cancel Changes</a>
                    <button type="submit"
                        class="px-10 py-2.5 bg-brand text-white border border-transparent rounded-lg font-semibold text-sm shadow-md hover:bg-brand-strong transition-all">
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
