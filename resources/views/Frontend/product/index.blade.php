@extends('Layouts.frontend')

@section('content')
    <!-- Breadcrumbs -->
    <div class="bg-white border-b border-gray-100 py-4">
        <div class="container mx-auto px-4">
            <nav class="flex text-sm text-gray-500 space-x-2">
                <a href="/" class="hover:text-brand transition">Home</a>
                <span class="text-gray-300">/</span>
                <span class="text-gray-900 font-semibold">Shop</span>
            </nav>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Sidebar (Left) -->
            <aside class="w-full lg:w-1/4 space-y-8">
                <!-- Categories Card -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Categories</h3>
                    <div class="space-y-3">
                        @foreach($categories as $category)
                            <a href="#" class="flex items-center justify-between group">
                                <div class="flex items-center space-x-3">
                                    <div class="w-2 h-2 rounded-full border border-gray-200 group-hover:border-brand transition"></div>
                                    <span class="text-sm text-gray-600 group-hover:text-brand transition">{{ $category->name }}</span>
                                </div>
                                <span class="text-xs text-gray-400 bg-gray-50 px-2 py-1 rounded">24</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Price Range Card -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Price Range</h3>
                    <div class="space-y-4">
                        <input type="range" class="w-full accent-brand" min="0" max="1000">
                        <div class="flex items-center justify-between text-sm text-gray-600">
                            <span>$0.00</span>
                            <span>$1000.00</span>
                        </div>
                        <button class="w-full py-2 bg-gray-900 text-white rounded-xl text-xs font-bold hover:bg-gray-800 transition">Filter</button>
                    </div>
                </div>

                <!-- Popular Card -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                     <h3 class="text-lg font-bold text-gray-900 mb-6">New Arrivals</h3>
                     <div class="space-y-6">
                        @foreach($products->take(3) as $product)
                            <div class="flex items-center space-x-4">
                                <img src="{{ Str::startsWith($product->thumbnail, 'http') ? $product->thumbnail : asset('uploads/product/' . $product->thumbnail) }}" 
                                    class="w-16 h-16 rounded-lg object-cover bg-gray-50 border border-gray-100">
                                <div>
                                    <h4 class="text-xs font-bold text-gray-900 line-clamp-1 truncate">{{ $product->name }}</h4>
                                    <span class="text-sm font-black text-brand">${{ $product->price }}</span>
                                </div>
                            </div>
                        @endforeach
                     </div>
                </div>
            </aside>

            <!-- Main Product Grid (Right) -->
            <div class="flex-1 space-y-8">
                <!-- Sorting & View Options -->
                <div class="flex flex-col md:flex-row justify-between items-center bg-white rounded-2xl border border-gray-100 p-4 shadow-sm gap-4">
                    <span class="text-sm text-gray-500 font-medium">Showing <span class="text-gray-900 font-bold">1-{{ $products->count() }}</span> of 48 products</span>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-1">
                             <span class="text-sm text-gray-400">Sort by:</span>
                             <select class="bg-transparent border-none text-sm font-bold text-gray-900 focus:ring-0">
                                 <option>Latest</option>
                                 <option>Price: Low to High</option>
                                 <option>Price: High to Low</option>
                             </select>
                        </div>
                    </div>
                </div>

                <!-- Grid -->
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    @foreach($products as $product)
                        <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden group hover:shadow-2xl transition-all duration-500">
                            <div class="relative overflow-hidden aspect-square">
                                <a href="{{ route('product.show', $product->slug) }}">
                                    <img src="{{ Str::startsWith($product->thumbnail, 'http') ? $product->thumbnail : asset('uploads/product/' . $product->thumbnail) }}" 
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                </a>
                                <button class="absolute top-4 right-4 w-10 h-10 bg-white/90 backdrop-blur rounded-2xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-4 group-hover:translate-x-0 text-gray-500 hover:text-red-500 shadow-xl">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                </button>
                                <div class="absolute bottom-4 left-4 right-4 translate-y-12 group-hover:translate-y-0 transition-transform duration-500">
                                    <button class="w-full bg-gray-900 text-white py-3 rounded-2xl font-bold text-sm shadow-xl hover:bg-brand transition transform active:scale-95 flex items-center justify-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                        <span>Add to Cart</span>
                                    </button>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-base font-bold text-gray-900 truncate"><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h3>
                                </div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">{{ $product->category->name }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-xl font-black text-gray-900">${{ $product->price }}</span>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                        <span class="text-xs font-bold text-gray-400 ml-1">4.8</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pt-10 flex justify-center">
                    {{ $products->links() }}
                </div>
            </div>

        </div>
    </div>
@endsection
