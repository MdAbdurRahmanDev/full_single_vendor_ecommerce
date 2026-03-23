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
        
        <!-- Main Form Wrapper -->
        <form action="{{ route('shop.index') }}" method="GET" id="shop-filter-form">
            {{-- Keep existing Search and Category if they exist in hidden fields if we submit from Price button --}}
            @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
            @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif

            <div class="flex flex-col lg:flex-row gap-8">

                <!-- Sidebar (Desktop Filters) -->
                <aside :class="filter_open ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
                    class="fixed p-4 inset-y-0 left-0 z-[60] w-72 bg-white p-8 lg:p-0 shadow-2xl lg:shadow-none lg:static lg:block transition-transform duration-300 ease-in-out border-r lg:border-none border-gray-100">
                    
                    <div class="flex items-center justify-between mb-8 lg:hidden">
                        <h3 class="text-xl font-black text-gray-900 uppercase">Filters</h3>
                        <button type="button" @click="filter_open = false" class="p-2 text-gray-400 hover:text-brand">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-10 lg:sticky lg:top-24 p-4">
                        
                        <!-- Categories Area -->
                        <div class="space-y-6">
                            <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest border-b border-gray-100 pb-3">Categories</h3>
                            <div class="space-y-4 pr-4">
                                <!-- Reset Category -->
                                <a href="{{ route('shop.index') }}" class="flex items-center justify-between group decoration-0">
                                    <span class="text-xs font-black {{ !request('category') ? 'text-brand' : 'text-gray-400' }} group-hover:text-brand transition uppercase tracking-widest leading-loose">All Products</span>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-1 h-1 {{ !request('category') ? 'bg-brand' : 'bg-gray-50' }} rounded-full group-hover:bg-brand transition"></div>
                                        <span class="text-[9px] font-black {{ !request('category') ? 'text-brand' : 'text-gray-300' }} group-hover:text-brand transition">{{ $all_products_count }}</span>
                                    </div>
                                </a>

                                @foreach ($categories as $category)
                                    @php $isActive = request('category') == $category->slug; @endphp
                                    <a href="{{ route('shop.index', ['category' => $category->slug]) }}" class="flex items-center justify-between group decoration-0">
                                        <span class="text-xs font-black {{ $isActive ? 'text-brand' : 'text-gray-400' }} group-hover:text-brand transition uppercase tracking-widest leading-loose">{{ $category->name }}</span>
                                        <div class="flex items-center space-x-2">
                                            <div class="w-1 h-1 {{ $isActive ? 'bg-brand' : 'bg-gray-100' }} rounded-full group-hover:bg-brand transition"></div>
                                            <span class="text-[9px] font-black {{ $isActive ? 'text-brand' : 'text-gray-300' }} group-hover:text-brand transition">{{ $category->products_count }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Clear All -->
                        @if(request()->anyFilled(['category', 'max_price', 'sort', 'search']))
                        <div class="pt-4">
                            <a href="{{ route('shop.index') }}" class="flex items-center justify-center space-x-2 text-[8px] font-black text-red-400 uppercase tracking-widest hover:text-red-600 transition">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                <span>Clear All Filters</span>
                            </a>
                        </div>
                        @endif

                    </div>
                </aside>

                <!-- Backdrop (Mobile only) -->
                <div x-show="filter_open" @click="filter_open = false" x-transition.opacity
                    class="fixed inset-0 z-50 bg-gray-900/40 backdrop-blur-sm lg:hidden"></div>

                <!-- Main Product Area (Right) -->
                <div class="flex-1 space-y-6 md:space-y-8">

                    <!-- Stats & Sorting Bar -->
                    <div class="flex items-center justify-between bg-white rounded-2xl border border-gray-100 p-3 md:p-4 shadow-sm gap-2">
                        <div class="flex items-center space-x-2 md:space-x-4">
                            <!-- Mobile Filter Button -->
                            <button type="button" @click="filter_open = true"
                                class="lg:hidden flex items-center space-x-2 px-3 py-2 bg-gray-900 text-white rounded-xl text-[10px] font-black hover:bg-brand transition transform active:scale-95 shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                </svg>
                                <span>Filters</span>
                            </button>
                            <span class="text-[9px] md:text-xs text-gray-400 font-bold uppercase tracking-wider shrink-0 leading-tight">
                                <span class="text-gray-900">{{ $products->total() }}</span> <span class="hidden sm:inline">Products Found</span><span class="sm:hidden text-gray-900">Items</span>
                            </span>
                        </div>

                        <div class="flex items-center space-x-1 md:space-x-2 shrink-0">
                            <span class="hidden md:inline text-[10px] font-black text-gray-400 uppercase tracking-widest">Sort:</span>
                            <select name="sort" onchange="document.getElementById('shop-filter-form').submit()"
                                class="bg-gray-50 border-none rounded-xl text-[10px] font-black text-gray-900 focus:ring-1 focus:ring-brand py-2 pl-3 pr-7 max-w-[100px] md:max-w-none cursor-pointer">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest Arrivals</option>
                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            </select>
                        </div>
                    </div>

                    <!-- Product Grid -->
                    @if($products->count() > 0)
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-8">
                        @foreach ($products as $product)
                            <div class="bg-white rounded-[10px] md:rounded-[2rem] border border-gray-100 overflow-hidden group hover:shadow-2xl transition-all duration-500 flex flex-col h-full">
                                <div class="relative overflow-hidden aspect-[4/5] bg-gray-50">
                                    <a href="{{ route('product.show', $product->slug) }}" class="block h-full">
                                        <img src="{{ Str::startsWith($product->thumbnail, 'http') ? $product->thumbnail : asset('uploads/product/' . $product->thumbnail) }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                                    </a>
                                    <!-- Badges -->
                                    @if ($product->discount_price)
                                        <div class="absolute top-2 left-2 md:top-4 md:left-4 bg-brand text-white text-[8px] md:text-[10px] font-black px-2 md:px-3 py-1 rounded-full uppercase tracking-widest shadow-lg shadow-brand/20">Sale</div>
                                    @endif

                                    <button type="button" class="absolute top-2 right-2 md:top-4 md:right-4 w-7 h-7 md:w-10 md:h-10 bg-white/90 backdrop-blur-md rounded-lg md:rounded-2xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-4 group-hover:translate-x-0 text-gray-400 hover:text-red-500 shadow-xl">
                                        <svg class="w-3.5 h-3.5 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="p-3 md:p-6 flex flex-col justify-between flex-1">
                                    <div class="space-y-0.5 md:space-y-1">
                                        <p class="text-[8px] md:text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">{{ $product->category->name }}</p>
                                        <h3 class="text-xs md:text-base font-bold text-gray-900 group-hover:text-brand transition line-clamp-1">
                                            <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                                        </h3>
                                    </div>
                                    <div class="flex flex-col md:flex-row md:items-center justify-between mt-3 md:mt-4 gap-1">
                                        <div class="flex items-center space-x-2">
                                            <span class="text-base md:text-xl font-black text-gray-900">${{ $product->discount_price ?? $product->price }}</span>
                                            @if ($product->discount_price)
                                                <span class="text-[10px] md:text-xs text-gray-400 line-through font-bold">${{ $product->price }}</span>
                                            @endif
                                        </div>
                                        <div class="flex items-center text-[8px] md:text-[10px] font-black text-yellow-500">
                                            <svg class="w-3 h-3 md:w-3.5 md:h-3.5 fill-current" viewBox="0 0 24 24">
                                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                            </svg>
                                            <span class="ml-1 text-gray-400 uppercase tracking-widest leading-none">4.8</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @else
                    <!-- No Results -->
                    <div class="py-20 text-center bg-white rounded-[40px] border border-gray-100">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-200">
                             <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="text-xl font-black text-gray-900 lowercase tracking-tighter mb-2">no products found.</h3>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Try adjusting your filters or search term</p>
                    </div>
                    @endif

                    <!-- Pagination -->
                    @if($products->hasPages())
                    <div class="pt-10 flex justify-center">
                        {{ $products->links() }}
                    </div>
                    @endif
                </div>

            </div>
        </form>
    </div>
@endsection
