@extends('Layouts.app')

@section('admin')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-heading">Products</h2>
            <a href="{{ route('products.create') }}"
                class="inline-flex items-center px-4 py-2 bg-brand text-white border border-transparent rounded-lg font-semibold text-sm hover:bg-brand-strong transition-all">
                Add New Product
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-default overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-neutral-secondary-medium text-body uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-6 py-4">Thumbnail</th>
                            <th class="px-6 py-4">Product Name</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Price</th>
                            <th class="px-6 py-4">Stock</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-default">
                        @forelse ($products as $product)
                            <tr class="hover:bg-neutral-secondary-soft transition-colors">
                                <td class="px-6 py-4">
                                    <img src="{{ asset('uploads/product/' . $product->thumbnail) }}" alt="{{ $product->name }}"
                                        class="w-12 h-12 rounded-lg object-cover">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-heading">{{ $product->name }}</div>
                                    <div class="text-xs text-body-light">{{ $product->slug }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-body">{{ $product->category->name ?? 'Uncategorized' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-heading">${{ number_format($product->price, 2) }}</div>
                                    @if($product->discount_price)
                                        <div class="text-xs text-red-500 line-through">${{ number_format($product->discount_price, 2) }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm {{ $product->stock_quantity > 10 ? 'text-body' : 'text-orange-500 font-bold' }}">
                                        {{ $product->stock_quantity }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->status == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $product->status == 1 ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="text-blue-600 hover:text-blue-900 font-medium text-sm">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        class="inline-block" onsubmit="return confirm('Delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-medium text-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-body italic text-sm">No products found. Start by adding one!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
