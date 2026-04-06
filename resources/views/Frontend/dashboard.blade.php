@extends('Layouts.frontend')

@section('content')
<div class="bg-gray-50 min-h-screen py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Modern Horizontal Header (Orange Branding) -->
        <div class="bg-white rounded-[35px] p-8 mb-10 shadow-sm flex flex-col md:flex-row items-center justify-between border border-gray-100">
            <div class="flex items-center space-x-8">
                <div class="relative">
                    <div class="w-20 h-20 bg-gradient-to-br from-brand to-brand-strong rounded-3xl flex items-center justify-center text-white shadow-sm rotate-3">
                        <svg class="w-10 h-10 -rotate-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 border-4 border-white rounded-full"></div>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-gray-900 lowercase tracking-tighter">hello, {{ explode(' ', auth()->user()->name)[0] }}.</h1>
                    <p class="text-gray-400 text-[10px] font-black uppercase tracking-[0.2em] mt-2">Personalised Shopping Hub</p>
                </div>
            </div>
            <div class="mt-6 md:mt-0 flex items-center space-x-6">
                <div class="text-right hidden sm:block">
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Account Balance</p>
                    <h3 class="text-xl font-black text-gray-900 tracking-tighter">৳{{ number_format($wallet_balance, 2) }}</h3>
                </div>
                <a href="{{ route('home') }}" class="px-8 py-4 bg-gray-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-brand hover:scale-105 transition-all shadow-sm active:scale-95 transform">
                    <span>Explore Brands</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left Sidebar Navigation (Orange Accents) -->
            <div class="lg:col-span-3 sticky top-24">
                <div class="bg-white rounded-[35px] p-5 shadow-sm border border-gray-100">
                    <div class="mb-8 px-4 text-center">
                         <img src="{{ asset('assets/img/avatar_placeholder.png') }}" alt="User Avatar" class="w-24 h-24 mx-auto rounded-3xl shadow-sm border-2 border-white object-cover mb-4">
                         <p class="text-gray-900 font-black text-xs lowercase tracking-tighter">{{ auth()->user()->name }}</p>
                    </div>
                    
                    <nav class="space-y-1">
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-4 px-6 py-4 bg-brand text-white rounded-2xl text-[11px] font-black uppercase tracking-[0.1em] shadow-sm shadow-brand/10 transition-all">
                            <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ route('orders.index') }}" class="flex items-center space-x-4 px-6 py-4 text-gray-400 hover:bg-brand-light hover:text-brand rounded-2xl text-[11px] font-black uppercase tracking-[0.1em] transition-all">
                            <svg class="w-5 h-5 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            <span>My Orders</span>
                        </a>
                        <a href="{{ route('wishlist.index') }}" class="flex items-center space-x-4 px-6 py-4 {{ request()->is('wishlist*') ? 'bg-brand text-white shadow-sm shadow-brand/10' : 'text-gray-400 hover:bg-brand-light hover:text-brand' }} rounded-2xl text-[11px] font-black uppercase tracking-[0.1em] transition-all">
                            <svg class="w-5 h-5 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            <span>Wishlist</span>
                        </a>
                        <a href="{{ route('settings') }}" class="flex items-center space-x-4 px-6 py-4 text-gray-400 hover:bg-brand-light hover:text-brand rounded-2xl text-[11px] font-black uppercase tracking-[0.1em] transition-all">
                            <svg class="w-5 h-5 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Settings</span>
                        </a>
                        <div class="h-px bg-gray-100 my-4 mx-4"></div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center space-x-4 px-6 py-4 text-red-500 hover:bg-red-50 rounded-2xl text-[11px] font-black uppercase tracking-[0.1em] transition-all">
                                <svg class="w-5 h-5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </nav>
                </div>
            </div>

            <!-- Right Area: Content Feed (Orange Highlighted) -->
            <div class="lg:col-span-9 space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Stat Card 1 -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            </div>
                            <div>
                                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Orders</h3>
                            </div>
                        </div>
                        <div class="mt-2">
                            <p class="text-3xl font-black text-gray-900">{{ sprintf('%02d', $total_orders) }}</p>
                        </div>
                    </div>

                    <!-- Stat Card 2 -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Spend</h3>
                            </div>
                        </div>
                        <div class="mt-2">
                            <p class="text-3xl font-black text-gray-900">৳{{ number_format($total_order_amount, 2) }}</p>
                        </div>
                    </div>

                    <!-- Stat Card 3 -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </div>
                            <div>
                                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">In Process</h3>
                            </div>
                        </div>
                        <div class="mt-2">
                            <p class="text-3xl font-black text-gray-900">{{ sprintf('%02d', $in_process_orders) }}</p>
                        </div>
                    </div>

                    <!-- Stat Card 4 -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            </div>
                            <div>
                                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Processing ৳</h3>
                            </div>
                        </div>
                        <div class="mt-2">
                            <p class="text-3xl font-black text-gray-900">৳{{ number_format($in_process_amount, 2) }}</p>
                        </div>
                    </div>

                    <!-- Stat Card 5 -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md hover:-translate-y-1">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                            </div>
                            <div>
                                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Wallet Balance</h3>
                            </div>
                        </div>
                        <div class="mt-2">
                            <p class="text-3xl font-black text-gray-900">৳{{ number_format($wallet_balance, 2) }}</p>
                        </div>
                    </div>

                    <a href="{{ route('shop.index') }}" class="bg-brand p-6 rounded-2xl border-0 hover:shadow-lg transition-all duration-300 flex flex-col justify-center relative overflow-hidden group">
                         <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition"></div>
                         <div class="relative z-10">
                            <div class="w-12 h-12 bg-white/20 text-white rounded-xl flex items-center justify-center shrink-0 mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">Explore Store</h3>
                            <p class="text-sm text-brand-light font-medium flex items-center">Browse all products <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg></p>
                         </div>
                    </a>
                </div>

                <!-- Recent Activity Feed (Orange Accents) -->
                <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-10 py-8 border-b border-gray-100 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-black text-gray-900 lowercase tracking-tighter">Timeline Activities.</h3>
                            <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mt-1">Journey map of your account</p>
                        </div>
                    </div>
                    <div class="p-24 text-center">
                        <div class="relative inline-block mb-10">
                            <div class="absolute inset-0 bg-brand/10 blur-3xl rounded-full"></div>
                            <div class="relative w-24 h-24 bg-brand-light rounded-[45px] flex items-center justify-center text-brand border-2 border-white shadow-sm">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            </div>
                        </div>
                        <h4 class="text-gray-900 font-black text-xl lowercase tracking-tight">Your wardrobe is awaiting its first box.</h4>
                        <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest mt-6 max-w-sm mx-auto leading-relaxed">Experience our latest collection and start your timeline right here.</p>
                        <a href="{{ route('home') }}" class="inline-block mt-12 px-12 py-5 bg-brand text-white rounded-[25px] text-[10px] font-black uppercase tracking-widest hover:bg-brand-strong transition-all shadow-sm active:scale-95 transform">Shop Collection</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
