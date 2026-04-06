@extends('Layouts.frontend')

@section('content')
<div class="bg-gray-50 min-h-screen py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Modern Horizontal Header (Subtle Shadow) -->
        <div class="bg-white rounded-[35px] p-8 mb-10 shadow-sm flex flex-col md:flex-row items-center justify-between border border-gray-100">
            <div class="flex items-center space-x-8">
                <div class="relative">
                    <div class="w-20 h-20 bg-gradient-to-br from-brand to-brand-strong rounded-3xl flex items-center justify-center text-white shadow-sm rotate-3">
                        <svg class="w-10 h-10 -rotate-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-gray-900 lowercase tracking-tighter">my orders.</h1>
                    <p class="text-gray-400 text-[10px] font-black uppercase tracking-[0.2em] mt-2">Track your fashion journey</p>
                </div>
            </div>
            <div class="mt-6 md:mt-0">
                <a href="{{ route('home') }}" class="px-8 py-4 bg-gray-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-brand transition-all shadow-sm">
                    <span>Back to shop</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Reuse Sidebar Logic -->
            <div class="lg:col-span-3 sticky top-24">
                <div class="bg-white rounded-[35px] p-5 shadow-sm border border-gray-100">
                    <div class="mb-8 px-4 text-center">
                         <img src="{{ asset('assets/img/avatar_placeholder.png') }}" alt="User Avatar" class="w-24 h-24 mx-auto rounded-3xl shadow-sm border-2 border-white object-cover mb-4">
                         <p class="text-gray-900 font-black text-xs lowercase tracking-tighter">{{ auth()->user()->name }}</p>
                    </div>
                    
                    <nav class="space-y-1">
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-4 px-6 py-4 text-gray-400 hover:bg-gray-50 hover:text-gray-900 rounded-2xl text-[11px] font-black uppercase tracking-[0.1em] transition-all">
                            <svg class="w-5 h-5 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ route('orders.index') }}" class="flex items-center space-x-4 px-6 py-4 bg-brand text-white rounded-2xl text-[11px] font-black uppercase tracking-[0.1em] shadow-sm shadow-brand/10 transition-all">
                            <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            <span>My Orders</span>
                        </a>
                        <a href="{{ route('wishlist.index') }}" class="flex items-center space-x-4 px-6 py-4 {{ request()->is('wishlist*') ? 'bg-brand text-white shadow-sm shadow-brand/10' : 'text-gray-400 hover:bg-gray-50 hover:text-gray-900' }} rounded-2xl text-[11px] font-black uppercase tracking-[0.1em] transition-all">
                            <svg class="w-5 h-5 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            <span>Wishlist</span>
                        </a>
                        <a href="{{ route('settings') }}" class="flex items-center space-x-4 px-6 py-4 text-gray-400 hover:bg-gray-50 hover:text-gray-900 rounded-2xl text-[11px] font-black uppercase tracking-[0.1em] transition-all">
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

            <!-- Orders Table Area -->
            <div class="lg:col-span-9">
                <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-50/50 border-b border-gray-100">
                                    <th class="px-10 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Order ID</th>
                                    <th class="px-10 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Amount</th>
                                    <th class="px-10 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</th>
                                    <th class="px-10 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Date</th>
                                    <th class="px-10 py-6 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($orders as $order)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-10 py-8">
                                        <span class="text-sm font-black text-gray-900 tracking-tighter">#{{ $order->order_number }}</span>
                                    </td>
                                    <td class="px-10 py-8">
                                        <span class="text-sm font-black text-gray-900 tracking-tighter">৳{{ number_format($order->total_amount, 2) }}</span>
                                    </td>
                                    <td class="px-10 py-8">
                                        @php
                                            $statusClasses = [
                                                'pending' => 'bg-amber-50 text-amber-600',
                                                'processing' => 'bg-blue-50 text-blue-600',
                                                'shipped' => 'bg-indigo-50 text-indigo-600',
                                                'delivered' => 'bg-green-50 text-green-600',
                                                'cancelled' => 'bg-red-50 text-red-600',
                                            ];
                                            $class = $statusClasses[strtolower($order->order_status)] ?? 'bg-gray-50 text-gray-600';
                                        @endphp
                                        <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest {{ $class }}">
                                            {{ $order->order_status }}
                                        </span>
                                    </td>
                                    <td class="px-10 py-8">
                                        <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">{{ $order->created_at->format('M d, Y') }}</span>
                                    </td>
                                    <td class="px-10 py-8 text-right">
                                        <a href="{{ route('orders.show', $order->id) }}" class="inline-block px-5 py-2 bg-gray-900 text-white rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-brand transition-all shadow-sm">
                                            View
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-32 text-center">
                                        <div class="inline-block p-10 bg-gray-50 rounded-[40px] mb-6">
                                            <svg class="w-12 h-12 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                        </div>
                                        <h4 class="text-gray-900 font-black text-xl lowercase tracking-tight">No orders found yet.</h4>
                                        <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest mt-4">Start your journey by exploring our shop.</p>
                                        <a href="{{ route('home') }}" class="inline-block mt-8 px-10 py-4 bg-brand text-white rounded-2xl text-[9px] font-black uppercase tracking-widest hover:bg-brand-strong transition-all shadow-md">Go Shopping</a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
