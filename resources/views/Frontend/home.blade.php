@extends('Layouts.frontend')

@section('content')
    <!-- Hero Slider -->
    @if($sliders->count() > 0)
    <div x-data="{ activeSlide: 0, total: {{ $sliders->count() }}, autoplay: null }" 
         x-init="autoplay = setInterval(() => { activeSlide = (activeSlide + 1) % total }, 5000)"
         class="container mx-auto px-4 mt-6">
        <div class="relative h-[300px] md:h-[480px] rounded-3xl overflow-hidden shadow-sm">

            @foreach($sliders as $i => $slide)
            <!-- Slide {{ $i + 1 }} -->
            <div x-show="activeSlide === {{ $i }}"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 bg-[#F5F5F7] flex items-center px-12 md:px-24">
                <div class="max-w-lg z-10 space-y-4">
                    @if($slide->badge_text)
                        <span class="text-brand font-bold text-lg">{{ $slide->badge_text }}</span>
                    @endif
                    <h1 class="text-4xl md:text-6xl font-black text-gray-900 leading-tight">{!! $slide->title !!}</h1>
                    @if($slide->subtitle)
                        <p class="text-gray-500 font-medium">{{ $slide->subtitle }}</p>
                    @endif
                    @if($slide->btn_link)
                        <a href="{{ $slide->btn_link }}" class="inline-block bg-gray-900 text-white px-8 py-3 rounded-full font-bold hover:bg-brand transition transform hover:scale-105">Shop Now</a>
                    @endif
                </div>
                <div class="absolute right-0 bottom-0 top-0 h-full w-1/2 hidden md:block">
                    <img src="{{ asset('uploads/sliders/' . $slide->image) }}" class="h-full w-full object-cover">
                </div>
            </div>
            @endforeach

            <!-- Dots -->
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-2">
                @foreach($sliders as $i => $slide)
                    <button @click="activeSlide = {{ $i }}; clearInterval(autoplay); autoplay = setInterval(() => { activeSlide = (activeSlide + 1) % total }, 5000)"
                        :class="activeSlide === {{ $i }} ? 'w-8 bg-brand' : 'w-2 bg-gray-300'"
                        class="h-2 rounded-full transition-all duration-300"></button>
                @endforeach
            </div>

            <!-- Arrows -->
            <button @click="activeSlide = (activeSlide - 1 + total) % total" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/80 backdrop-blur rounded-full flex items-center justify-center text-gray-700 hover:bg-white shadow transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button @click="activeSlide = (activeSlide + 1) % total" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/80 backdrop-blur rounded-full flex items-center justify-center text-gray-700 hover:bg-white shadow transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </div>
    @else
    {{-- Fallback static slider if no DB sliders added yet --}}
    <div x-data="{ activeSlide: 1, slides: [1, 2] }" class="container mx-auto px-4 mt-6">
        <div class="relative h-[300px] md:h-[480px] rounded-3xl overflow-hidden shadow-sm">
            <!-- Slide 1 -->
            <div x-show="activeSlide === 1" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" class="absolute inset-0 bg-[#F5F5F7] flex items-center px-12 md:px-24">
                <div class="max-w-lg z-10 space-y-4">
                    <span class="text-brand font-bold text-lg">#Big Fashion Sale</span>
                    <h1 class="text-4xl md:text-6xl font-black text-gray-900 leading-tight">Limited Time Offer! Up to <span class="text-brand">50% OFF!</span></h1>
                    <p class="text-gray-500 font-medium">Redefine Your Everyday Style with our new collection.</p>
                    <a href="/shop" class="inline-block bg-gray-900 text-white px-8 py-3 rounded-full font-bold hover:bg-gray-800 transition transform hover:scale-105">Shop Now</a>
                </div>
                <div class="absolute right-0 bottom-0 top-0 h-full w-1/2 hidden md:block">
                    <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=1000&auto=format&fit=crop" class="h-full w-full object-cover">
                </div>
            </div>
            <!-- Slide 2 -->
            <div x-show="activeSlide === 2" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" class="absolute inset-0 bg-blue-50 flex items-center px-12 md:px-24">
                <div class="max-w-lg z-10 space-y-4">
                    <span class="text-blue-600 font-bold text-lg">#Gadget Festival</span>
                    <h1 class="text-4xl md:text-6xl font-black text-gray-900 leading-tight">Smart Tech for a <span class="text-blue-600">Smarter Life</span></h1>
                    <p class="text-gray-500 font-medium">Explore the latest electronics and gadgets now.</p>
                    <a href="/shop" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-full font-bold hover:bg-blue-700 transition transform hover:scale-105">View Gadgets</a>
                </div>
                <div class="absolute right-0 bottom-0 top-0 h-full w-1/2 hidden md:block">
                    <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1000&auto=format&fit=crop" class="h-full w-full object-cover">
                </div>
            </div>
            <!-- Dots -->
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-2">
                <button @click="activeSlide = 1" :class="activeSlide === 1 ? 'w-8 bg-brand' : 'w-2 bg-gray-300'" class="h-2 rounded-full transition-all duration-300"></button>
                <button @click="activeSlide = 2" :class="activeSlide === 2 ? 'w-8 bg-brand' : 'w-2 bg-gray-300'" class="h-2 rounded-full transition-all duration-300"></button>
            </div>
        </div>
    </div>
    @endif

    <!-- Quick Category Links -->
    <div class="container mx-auto px-4 mt-12 mb-16 overflow-x-auto no-scrollbar">
        <div class="flex md:grid md:grid-cols-5 lg:grid-cols-9 lg:justify-center gap-6 md:gap-8 items-center min-w-max md:min-w-0">
            @foreach($categories as $category)
                <a href="{{ route('shop.index', ['category' => $category->slug]) }}" class="group flex flex-col items-center space-y-3 transition transform hover:-translate-y-1">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-full bg-white shadow-sm border border-gray-100 flex items-center justify-center p-4 group-hover:border-brand transition">
                        @if($category->image)
                            <img src="{{ Str::startsWith($category->image, 'http') ? $category->image : asset('uploads/category/' . $category->image) }}" class="w-full grayscale group-hover:grayscale-0 transition duration-300">
                        @else
                            <svg class="w-10 h-10 text-gray-400 group-hover:text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        @endif
                    </div>
                    <span class="text-xs md:text-sm font-semibold text-gray-700 group-hover:text-brand transition whitespace-nowrap">{{ $category->name }}</span>
                </a>
            @endforeach
            <!-- All Category Link -->
             <a href="{{ route('shop.index') }}" class="group flex flex-col items-center space-y-3 transition transform hover:-translate-y-1">
                <div class="w-16 h-16 md:w-20 md:h-20 rounded-full bg-white shadow-sm border border-gray-100 flex items-center justify-center p-4 group-hover:border-brand transition">
                    <div class="grid grid-cols-2 gap-1 px-1">
                        <div class="w-2 h-2 rounded-sm bg-gray-300 group-hover:bg-brand"></div>
                        <div class="w-2 h-2 rounded-sm bg-gray-300 group-hover:bg-brand"></div>
                        <div class="w-2 h-2 rounded-sm bg-gray-300 group-hover:bg-brand"></div>
                        <div class="w-2 h-2 rounded-sm bg-gray-300 group-hover:bg-brand"></div>
                    </div>
                </div>
                <span class="text-xs md:text-sm font-semibold text-gray-700 group-hover:text-brand transition">All Category</span>
            </a>
        </div>
    </div>

    <!-- Flash Sale -->
    <section class="container mx-auto px-4 mt-16">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center space-x-6">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 rounded-full bg-gray-900 flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M13,10V2L5,14H11V22L19,10H13Z"/></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Flash Sale</h2>
                </div>
                <!-- Countdown -->
                <div class="hidden md:flex items-center space-x-2" x-data="{ h: 0, m: 17, s: 56 }">
                    <div class="bg-brand text-white text-sm font-bold w-8 h-8 rounded-lg flex items-center justify-center" x-text="h.toString().padStart(2, '0')"></div>
                    <span class="text-brand font-bold text-lg">:</span>
                    <div class="bg-brand text-white text-sm font-bold w-8 h-8 rounded-lg flex items-center justify-center" x-text="m.toString().padStart(2, '0')"></div>
                    <span class="text-brand font-bold text-lg">:</span>
                    <div class="bg-brand text-white text-sm font-bold w-8 h-8 rounded-lg flex items-center justify-center" x-text="s.toString().padStart(2, '0')"></div>
                </div>
            </div>
            <div class="flex space-x-2">
                <button class="w-10 h-10 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:text-brand transition"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></button>
                <button class="w-10 h-10 rounded-lg bg-gray-900 text-white flex items-center justify-center hover:bg-gray-800 transition"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></button>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            @foreach($flash_sale_products as $product)
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-xl transition-all group flex flex-col h-full">
                    <div class="relative overflow-hidden aspect-square">
                        <a href="{{ route('product.show', $product->slug) }}" class="block w-full h-full">
                            <img src="{{ Str::startsWith($product->thumbnail, 'http') ? $product->thumbnail : asset('uploads/product/' . $product->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </a>
                        <button class="absolute top-3 right-3 w-8 h-8 bg-white/80 backdrop-blur rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity transform translate-y-2 group-hover:translate-y-0 text-gray-500 hover:text-red-500 shadow-lg" title="Add to Wishlist">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </button>
                    </div>
                    <div class="p-4 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 line-clamp-1 group-hover:text-brand transition mb-2">
                                <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                            </h3>
                            <div class="flex items-center space-x-2">
                                <span class="text-lg font-black text-gray-900">${{ $product->price }}</span>
                                @if($product->discount_price)
                                    <span class="text-xs text-gray-400 line-through">${{ $product->discount_price }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex justify-between text-[10px] text-gray-400 font-bold mb-1">
                                <span>9/10 Sale</span>
                            </div>
                            <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="w-[90%] h-full bg-brand"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Todays For You! Tabs -->
    <section x-data="{ currentTab: 'Best Seller' }" class="container mx-auto px-4 mt-20">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Todays For You!</h2>
            <div class="flex flex-wrap items-center gap-2">
                @foreach(['Best Seller', 'Keep Stylish', 'Special Discount', 'Official Store', 'Coveted Product'] as $tab)
                    <button @click="currentTab = '{{ $tab }}'" 
                        :class="currentTab === '{{ $tab }}' ? 'bg-gray-900 text-white shadow-xl scale-105' : 'bg-white text-gray-600 border border-gray-100 hover:border-brand'"
                        class="px-5 py-2 rounded-xl text-xs font-bold transition-all duration-300">
                        {{ $tab }}
                    </button>
                @endforeach
                <button @click="$dispatch('open-calorie-modal')" class="px-5 py-2 rounded-xl text-xs font-bold bg-brand text-white shadow-lg shadow-brand/20 hover:scale-105 transition-all">
                    Calorie Calculator
                </button>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
            @foreach($latest_products as $product)
                <div x-show="currentTab" x-transition:enter="transition ease-out duration-300 delay-[{{ $loop->index * 50 }}ms]" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                    class="bg-white rounded-3xl border border-gray-100 overflow-hidden group hover:shadow-2xl transition-all duration-500">
                    <div class="relative overflow-hidden aspect-square">
                         <a href="{{ route('product.show', $product->slug) }}" class="block w-full h-full">
                            <img src="{{ Str::startsWith($product->thumbnail, 'http') ? $product->thumbnail : asset('uploads/product/' . $product->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                         </a>
                         <button @click="toggleWishlist({{ $product->id }})" class="absolute top-4 right-4 w-10 h-10 bg-white/90 backdrop-blur rounded-2xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-4 group-hover:translate-x-0 text-gray-500 hover:text-red-500 shadow-xl" title="Add to Wishlist">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                         </button>
                        <div class="absolute bottom-4 left-4 right-4 translate-y-12 group-hover:translate-y-0 transition-transform duration-500">
                             <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-gray-900 text-white py-3 rounded-2xl font-bold text-sm shadow-xl hover:bg-brand transition transform active:scale-95 flex items-center justify-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                    <span>Add to Cart</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-base font-bold text-gray-900 line-clamp-1">
                                <a href="{{ route('product.show', $product->slug) }}" class="hover:text-brand transition">{{ $product->name }}</a>
                            </h3>
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
        
        <div class="mt-16 text-center">
            <button class="px-10 py-4 bg-white border-2 border-gray-900 text-gray-900 rounded-full font-black text-sm hover:bg-gray-900 hover:text-white transition-all transform hover:scale-105">View All Products</button>
        </div>
    </section>

    <!-- Features Section -->
    <section class="container mx-auto px-4 mt-24 mb-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 border-t border-gray-100 pt-16">
            <div class="flex space-x-5">
                <div class="shrink-0 w-14 h-14 bg-gray-50 rounded-2xl flex items-center justify-center text-brand">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 mb-2">High Quality Guarantee</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">All products go through a strict quality control process before they reach your doorstep.</p>
                </div>
            </div>
            <div class="flex space-x-5">
                <div class="shrink-0 w-14 h-14 bg-gray-50 rounded-2xl flex items-center justify-center text-brand">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 mb-2">24/7 Fast Delivery</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">We provide fast and reliable shipping options to ensure your orders arrive on time, every time.</p>
                </div>
            </div>
            <div class="flex space-x-5">
                <div class="shrink-0 w-14 h-14 bg-gray-50 rounded-2xl flex items-center justify-center text-brand">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 mb-2">Secure Payment Options</h4>
                    <p class="text-sm text-gray-500 leading-relaxed">Your transaction security is our priority. We use industry-standard encryption for all payments.</p>
                </div>
            </div>
        </div>
    </section>

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
@endsection
