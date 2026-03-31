@extends('Layouts.frontend')

@section('content')
<div class="bg-gray-50 min-h-screen py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="bg-white rounded-[35px] p-8 mb-10 shadow-sm flex flex-col md:flex-row items-center justify-between border border-gray-100">
            <div class="flex items-center space-x-8">
                <div class="relative">
                    <div class="w-20 h-20 bg-brand rounded-3xl flex items-center justify-center text-white shadow-sm rotate-3">
                         <svg class="w-10 h-10 -rotate-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-gray-900 lowercase tracking-tighter">my wishlist.</h1>
                    <p class="text-gray-400 text-[10px] font-black uppercase tracking-[0.2em] mt-2">Saved for later</p>
                </div>
            </div>
            <a href="{{ route('home') }}" class="mt-6 md:mt-0 px-8 py-4 bg-gray-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-brand transition-all shadow-sm active:scale-95 transform">
                <span>Continue Shopping</span>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Sidebar -->
            <div class="lg:col-span-3 sticky top-24">
                <div class="bg-white rounded-[35px] p-5 shadow-sm border border-gray-100">
                    <nav class="space-y-1">
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-4 px-6 py-4 text-gray-400 hover:bg-brand-light hover:text-brand rounded-2xl text-[11px] font-black uppercase tracking-[0.1em] transition-all">
                            <svg class="w-5 h-5 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ route('orders.index') }}" class="flex items-center space-x-4 px-6 py-4 text-gray-400 hover:bg-brand-light hover:text-brand rounded-2xl text-[11px] font-black uppercase tracking-[0.1em] transition-all">
                            <svg class="w-5 h-5 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            <span>My Orders</span>
                        </a>
                        <a href="{{ route('wishlist.index') }}" class="flex items-center space-x-4 px-6 py-4 bg-brand text-white rounded-2xl text-[11px] font-black uppercase tracking-[0.1em] shadow-sm shadow-brand/10 transition-all">
                            <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            <span>Wishlist</span>
                        </a>
                        <a href="{{ route('settings') }}" class="flex items-center space-x-4 px-6 py-4 text-gray-400 hover:bg-brand-light hover:text-brand rounded-2xl text-[11px] font-black uppercase tracking-[0.1em] transition-all">
                            <svg class="w-5 h-5 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Settings</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Content Area -->
            <div class="lg:col-span-9">
                @if($wishlist->isEmpty())
                <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 p-20 text-center">
                    <div class="w-24 h-24 bg-gray-50 rounded-[45px] flex items-center justify-center text-gray-200 mx-auto mb-8">
                         <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-black text-gray-900 lowercase tracking-tighter mb-4">your wishlist is empty.</h3>
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest max-w-xs mx-auto leading-relaxed mb-10">Add items you love to your wishlist and they will appear here.</p>
                    <a href="{{ route('home') }}" class="px-12 py-5 bg-brand text-white rounded-[25px] text-[10px] font-black uppercase tracking-widest hover:bg-brand-strong transition-all shadow-xl shadow-brand/20">Go Shopping</a>
                </div>
                @else
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($wishlist as $item)
                    <div class="bg-white rounded-[40px] border border-gray-100 p-4 shadow-sm group hover:shadow-xl transition-all duration-500">
                        <div class="aspect-square rounded-[30px] overflow-hidden bg-gray-50 relative mb-6">
                            <img src="{{ Str::startsWith($item->product->thumbnail, 'http') ? $item->product->thumbnail : asset('uploads/product/' . $item->product->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            <button @click="toggleWishlist({{ $item->product->id }}); location.reload()" class="absolute top-4 right-4 w-10 h-10 bg-white/90 backdrop-blur rounded-2xl flex items-center justify-center text-red-500 shadow-xl opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                            </button>
                        </div>
                        <div class="px-2 pb-2">
                            <h4 class="font-black text-gray-900 lowercase tracking-tighter text-sm line-clamp-1 mb-1">{{ $item->product->name }}</h4>
                            <p class="text-brand font-black tracking-tighter mb-4">${{ number_format($item->product->price, 2) }}</p>
                            <form action="{{ route('cart.add', $item->product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full py-4 bg-gray-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-brand transition-all">Add to Bag</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
