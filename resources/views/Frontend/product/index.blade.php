@extends('Layouts.frontend')

@section('content')
    <!-- Breadcrumbs -->
    <div class="bg-white border-b border-gray-100 py-4">
        <div class="container mx-auto px-4 text-xs md:text-sm font-medium text-gray-400">
            <nav class="flex items-center space-x-2">
                <a href="/" class="hover:text-brand transition">Home</a>
                <span class="text-gray-200">/</span>
                <span class="text-gray-900 font-bold">Shop</span>
            </nav>
        </div>
    </div>

    <div x-data="{ filter_open: false }" class="container mx-auto px-4 py-8 md:py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Sidebar (Desktop Filters) / Off-canvas (Mobile Filters) -->
            <aside 
                :class="filter_open ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
                class="fixed inset-y-0 left-0 z-[60] w-72 bg-white p-8 lg:p-0 shadow-2xl lg:shadow-none lg:static lg:block transition-transform duration-300 ease-in-out border-r lg:border-none border-gray-100"
            >
                <div class="flex items-center justify-between mb-8 lg:hidden">
                    <h3 class="text-xl font-black text-gray-900 uppercase">Filters</h3>
                    <button @click="filter_open = false" class="p-2 text-gray-400 hover:text-brand">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="space-y-10 lg:sticky lg:top-24">
                    <!-- Categories Card -->
                    <div class="space-y-6">
                        <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest border-b border-gray-100 pb-3">Categories</h3>
                        <div class="space-y-4">
                            @foreach($categories as $category)
                                <a href="#" class="flex items-center justify-between group">
                                    <span class="text-sm font-medium text-gray-500 group-hover:text-brand transition">{{ $category->name }}</span>
                                    <span class="text-[10px] font-bold text-gray-400 bg-gray-50 px-2.5 py-1 rounded-full group-hover:bg-brand-soft group-hover:text-brand transition">24</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Range Card -->
                    <div class="space-y-6">
                        <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest border-b border-gray-100 pb-3">Price Range</h3>
                        <div class="space-y-5">
                            <input type="range" class="w-full h-1.5 bg-gray-100 rounded-full appearance-none accent-brand cursor-pointer" min="0" max="1000">
                            <div class="flex items-center justify-between text-xs font-bold text-gray-600">
                                <span class="bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-100">$0.00</span>
                                <span class="bg-gray-50 px-3 py-1.5 rounded-lg border border-gray-100">$1000.00</span>
                            </div>
                            <button class="w-full py-3 bg-gray-900 text-white rounded-xl text-xs font-black hover:bg-brand hover:scale-[1.02] transition transform active:scale-95 shadow-xl shadow-gray-100">Filter Now</button>
                        </div>
                    </div>

                    <!-- New Arrivals -->
                    <div class="space-y-6 hidden lg:block">
                         <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest border-b border-gray-100 pb-3">New Arrivals</h3>
                         <div class="space-y-5">
                            @foreach($products->take(3) as $product)
                                <div class="flex items-center space-x-4 group cursor-pointer">
                                    <div class="w-14 h-14 rounded-xl overflow-hidden bg-gray-50 border border-gray-100 shrink-0">
                                        <img src="{{ Str::startsWith($product->thumbnail, 'http') ? $product->thumbnail : asset('uploads/product/' . $product->thumbnail) }}" 
                                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="text-xs font-bold text-gray-900 truncate group-hover:text-brand transition">{{ $product->name }}</h4>
                                        <span class="text-sm font-black text-brand">${{ $product->price }}</span>
                                    </div>
                                </div>
                            @endforeach
                         </div>
                    </div>
                </div>
            </aside>

            <!-- Backdrop (Mobile only) -->
            <div x-show="filter_open" @click="filter_open = false" x-transition.opacity class="fixed inset-0 z-50 bg-gray-900/40 backdrop-blur-sm lg:hidden"></div>

            <!-- Main Product Area (Right) -->
            <div class="flex-1 space-y-6 md:space-y-8">
                
                <!-- Mobile Filter Trigger / Stats Bar -->
                <div class="flex items-center justify-between bg-white rounded-2xl border border-gray-100 p-3 md:p-4 shadow-sm gap-2">
                    <div class="flex items-center space-x-2 md:space-x-4">
                        <!-- Mobile Filter Button -->
                        <button @click="filter_open = true" class="lg:hidden flex items-center space-x-2 px-3 py-2 bg-gray-900 text-white rounded-xl text-[10px] font-black hover:bg-brand transition transform active:scale-95 shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                            <span>Filters</span>
                        </button>
                        <span class="text-[9px] md:text-xs text-gray-400 font-bold uppercase tracking-wider shrink-0 leading-tight">
                            <span class="text-gray-900">{{ $products->total() }}</span> <span class="hidden sm:inline">Products</span><span class="sm:hidden text-gray-900">Items</span>
                        </span>
                    </div>

                    <div class="flex items-center space-x-1 md:space-x-2 shrink-0">
                        <span class="hidden md:inline text-[10px] font-black text-gray-400 uppercase tracking-widest">Sort:</span>
                        <select class="bg-gray-50 border-none rounded-xl text-[10px] font-black text-gray-900 focus:ring-1 focus:ring-brand py-2 pl-3 pr-7 max-w-[100px] md:max-w-none">
                            <option>Latest</option>
                            <option>Price: Low</option>
                            <option>Price: High</option>
                        </select>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-8">
                    @foreach($products as $product)
                        <div class="bg-white rounded-[10px] md:rounded-[2rem] border border-gray-100 overflow-hidden group hover:shadow-2xl transition-all duration-500 flex flex-col h-full">
                            <div class="relative overflow-hidden aspect-[4/5] bg-gray-50">
                                <a href="{{ route('product.show', $product->slug) }}" class="block h-full">
                                    <img src="{{ Str::startsWith($product->thumbnail, 'http') ? $product->thumbnail : asset('uploads/product/' . $product->thumbnail) }}" 
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                </a>
                                <!-- Badges -->
                                @if($product->discount_price)
                                <div class="absolute top-2 left-2 md:top-4 md:left-4 bg-brand text-white text-[8px] md:text-[10px] font-black px-2 md:px-3 py-1 rounded-full uppercase tracking-widest shadow-lg shadow-brand/20">Sale</div>
                                @endif
                                
                                <button class="absolute top-2 right-2 md:top-4 md:right-4 w-7 h-7 md:w-10 md:h-10 bg-white/90 backdrop-blur-md rounded-lg md:rounded-2xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-4 group-hover:translate-x-0 text-gray-400 hover:text-red-500 shadow-xl">
                                    <svg class="w-3.5 h-3.5 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                </button>
                                
                                <div class="absolute bottom-2 left-2 right-2 translate-y-16 group-hover:translate-y-0 transition-transform duration-500 hidden md:block">
                                    <button class="w-full bg-gray-900 text-white py-3 rounded-xl md:rounded-2xl font-black text-xs shadow-xl transform active:scale-95 flex items-center justify-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                        <span>Quick Add</span>
                                    </button>
                                </div>
                            </div>
                            <div class="p-3 md:p-6 flex flex-col justify-between flex-1">
                                <div class="space-y-0.5 md:space-y-1">
                                    <p class="text-[8px] md:text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">{{ $product->category->name }}</p>
                                    <h3 class="text-xs md:text-base font-bold text-gray-900 group-hover:text-brand transition line-clamp-1"><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h3>
                                </div>
                                <div class="flex flex-col md:flex-row md:items-center justify-between mt-3 md:mt-4 gap-1">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-base md:text-xl font-black text-gray-900">${{ $product->discount_price ?? $product->price }}</span>
                                        @if($product->discount_price)
                                        <span class="text-[10px] md:text-xs text-gray-400 line-through font-bold">${{ $product->price }}</span>
                                        @endif
                                    </div>
                                    <div class="flex items-center text-[8px] md:text-[10px] font-black text-yellow-500">
                                        <svg class="w-3 h-3 md:w-3.5 md:h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                        <span class="ml-1 text-gray-400 uppercase tracking-widest leading-none">4.8</span>
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
