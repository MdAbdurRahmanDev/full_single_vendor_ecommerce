@extends('Layouts.frontend')

@section('content')
<div class="bg-white min-h-screen">
    <!-- Breadcrumbs -->
    <div class="bg-gray-50 border-b border-gray-100 py-4">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest text-gray-400">
                <a href="{{ route('home') }}" class="hover:text-brand transition">Home</a>
                <span>/</span>
                <a href="{{ route('shop.index', ['category' => $product->category->slug]) }}" class="hover:text-brand transition">{{ $product->category->name }}</a>
                <span>/</span>
                <span class="text-gray-900">{{ $product->name }}</span>
            </nav>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12 md:py-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20">
            
            <!-- Product Image Gallery -->
            <div class="lg:col-span-7 space-y-6">
                <!-- Main Image -->
                <div class="bg-gray-50 rounded-[40px] overflow-hidden group relative aspect-[4/5] shadow-sm border border-gray-100">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute top-6 left-6">
                        <span class="bg-brand text-white text-[10px] font-black uppercase tracking-widest px-5 py-2 rounded-full shadow-lg shadow-brand/20">New Arrival</span>
                    </div>
                </div>

                <!-- Thumbnails (Static Placeholder for now) -->
                <div class="grid grid-cols-4 gap-4">
                    <div class="aspect-square bg-gray-50 rounded-2xl overflow-hidden border-2 border-brand shadow-sm cursor-pointer">
                        <img src="{{ asset($product->image) }}" class="w-full h-full object-cover opacity-80">
                    </div>
                    @for($i=0; $i<3; $i++)
                    <div class="aspect-square bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 shadow-sm cursor-pointer hover:border-brand/40 transition">
                         <div class="w-full h-full flex items-center justify-center text-gray-200">
                             <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                         </div>
                    </div>
                    @endfor
                </div>
            </div>

            <!-- Product Purchase Details -->
            <div class="lg:col-span-5 flex flex-col justify-center">
                <div class="mb-10">
                    <div class="flex items-center space-x-3 mb-4">
                        <span class="text-[10px] font-black text-brand uppercase tracking-[0.2em]">{{ $product->category->name }}</span>
                        <div class="h-1 w-1 bg-gray-200 rounded-full"></div>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">In Stock</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-black text-gray-900 lowercase tracking-tighter mb-6 leading-tight max-w-sm">{{ $product->name }}</h1>
                    
                    <div class="flex items-baseline space-x-4 mb-8">
                        <span class="text-5xl font-black text-gray-900 tracking-tighter">${{ number_format($product->price, 2) }}</span>
                        @if(isset($product->old_price))
                        <span class="text-2xl font-bold text-gray-300 line-through tracking-tight">${{ number_format($product->old_price, 2) }}</span>
                        @endif
                    </div>

                    <p class="text-gray-500 text-sm leading-relaxed max-w-sm mb-10 font-medium">
                        {{ $product->short_description ?? 'This premium piece is crafted for comfort and style. A timeless addition to your professional or casual wardrobe, ensuring you lead with confidence.' }}
                    </p>
                </div>

                <!-- Product Form -->
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="space-y-10">
                    @csrf
                    <!-- Variations (Static Placeholders) -->
                    <div class="flex space-x-12">
                         <div class="space-y-4">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block">Size (EU)</label>
                            <div class="flex space-x-3">
                                @foreach(['S', 'M', 'L', 'XL'] as $size)
                                <button type="button" class="w-12 h-12 rounded-xl border {{ $size == 'M' ? 'border-brand text-brand bg-brand-light' : 'border-gray-100 text-gray-400 bg-gray-50' }} text-[11px] font-black uppercase transition-all hover:border-brand/40">{{ $size }}</button>
                                @endforeach
                            </div>
                         </div>
                    </div>

                    <!-- Quantity & Add to Cart -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-6">
                            <div class="flex items-center bg-gray-50 border border-gray-100 rounded-2xl px-4 py-2">
                                <button type="button" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-brand transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg></button>
                                <input type="number" name="quantity" value="1" min="1" class="w-12 text-center bg-transparent border-none text-sm font-black text-gray-900 outline-none focus:ring-0">
                                <button type="button" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-brand transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg></button>
                            </div>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Max 10 Items</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">
                            <button type="submit" class="bg-brand text-white py-5 rounded-[25px] text-[10px] font-black uppercase tracking-widest hover:bg-brand-strong transition-all shadow-xl shadow-brand/30 active:scale-95 transform">
                                Add to Cart
                            </button>
                            <button type="button" @click="toggleWishlist({{ $product->id }})" class="bg-gray-100 text-gray-900 w-16 h-16 rounded-[25px] flex items-center justify-center hover:bg-red-50 hover:text-red-500 transition-all active:scale-90 transform group">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Trust Badges -->
                <div class="mt-16 pt-10 border-t border-gray-50 grid grid-cols-2 gap-8">
                    <div class="flex items-center space-x-4">
                        <div class="shrink-0 w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-[10px] font-black text-gray-900 uppercase tracking-widest">Fast Delivery</h4>
                            <p class="text-[10px] text-gray-400 font-bold uppercase mt-1">Within 24-48 Hours</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="shrink-0 w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <div>
                            <h4 class="text-[10px] font-black text-gray-900 uppercase tracking-widest">Pure Quality</h4>
                            <p class="text-[10px] text-gray-400 font-bold uppercase mt-1">100% Genuine Brands</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Extra Info Tabs -->
        <div class="mt-24 pt-20 border-t border-gray-100">
            <div class="flex space-x-12 mb-12 border-b border-gray-50 overflow-x-auto pb-4">
                <button class="text-xs font-black uppercase tracking-widest text-brand border-b-2 border-brand pb-4">Description</button>
                <button class="text-xs font-black uppercase tracking-widest text-gray-300 hover:text-gray-900 pb-4 transition">Specifications</button>
                <button class="text-xs font-black uppercase tracking-widest text-gray-300 hover:text-gray-900 pb-4 transition">Reviews (14)</button>
            </div>
            
            <div class="max-w-4xl">
                <p class="text-gray-600 text-sm leading-loose font-medium mb-8">
                    {!! nl2br(e($product->description)) !!}
                </p>
                <p class="text-gray-600 text-sm leading-loose font-medium">
                    Experience the perfect blend of modern innovation and classic design with the {{ $product->name }}. Our artisans spent months perfecting the silhouette, ensuring that every stitch serves a purpose. The fabric is ethically sourced and treated with our signature finish for durability and a premium hand-feel.
                </p>
            </div>
        </div>

        <!-- Related Products Area -->
        @if($related_products->count() > 0)
        <div class="mt-32">
            <div class="flex items-center justify-between mb-16">
                 <div>
                    <h2 class="text-3xl font-black text-gray-900 lowercase tracking-tighter mb-2">curated for you.</h2>
                    <p class="text-gray-400 text-[10px] font-black uppercase tracking-[0.2em]">Based on your current selection</p>
                 </div>
                 <a href="{{ route('shop.index') }}" class="px-8 py-3 bg-gray-50 hover:bg-gray-100 text-gray-900 rounded-2xl text-[9px] font-black uppercase tracking-widest transition">View All</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($related_products as $rel_product)
                <a href="{{ route('product.show', $rel_product->slug) }}" class="group space-y-4">
                    <div class="aspect-[4/5] bg-gray-50 rounded-[35px] overflow-hidden relative border border-gray-100 shadow-sm transition group-hover:shadow-xl">
                        <img src="{{ asset($rel_product->image) }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    </div>
                    <div>
                        <h4 class="text-sm font-black text-gray-900 lowercase tracking-tight">{{ $rel_product->name }}</h4>
                        <span class="text-sm font-bold text-brand tracking-tighter">${{ number_format($rel_product->price, 2) }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>
@endsection
