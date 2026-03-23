@extends('Layouts.frontend')

@section('content')
<div class="bg-gray-50 min-h-screen py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Modern Horizontal Header (Subtle Shadow) -->
        <div class="bg-white rounded-[35px] p-8 mb-10 shadow-sm flex flex-col md:flex-row items-center justify-between border border-gray-100">
            <div class="flex items-center space-x-8">
                <div class="relative">
                    <div class="w-20 h-20 bg-gradient-to-br from-brand to-brand-strong rounded-3xl flex items-center justify-center text-white shadow-sm rotate-3">
                        <svg class="w-10 h-10 -rotate-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-gray-900 lowercase tracking-tighter">account settings.</h1>
                    <p class="text-gray-400 text-[10px] font-black uppercase tracking-[0.2em] mt-2">Manage your fashion identity</p>
                </div>
            </div>
            <div class="mt-6 md:mt-0">
                <a href="{{ route('dashboard') }}" class="px-8 py-4 bg-gray-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-brand transition-all shadow-sm">
                    <span>Back to overview</span>
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
                        <a href="{{ route('orders.index') }}" class="flex items-center space-x-4 px-6 py-4 text-gray-400 hover:bg-gray-50 hover:text-gray-900 rounded-2xl text-[11px] font-black uppercase tracking-[0.1em] transition-all">
                            <svg class="w-5 h-5 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            <span>My Orders</span>
                        </a>
                        <a href="#" class="flex items-center space-x-4 px-6 py-4 text-gray-400 hover:bg-gray-50 hover:text-gray-900 rounded-2xl text-[11px] font-black uppercase tracking-[0.1em] transition-all">
                            <svg class="w-5 h-5 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            <span>Wishlist</span>
                        </a>
                        <a href="{{ route('settings') }}" class="flex items-center space-x-4 px-6 py-4 bg-brand text-white rounded-2xl text-[11px] font-black uppercase tracking-[0.1em] shadow-sm shadow-brand/10 transition-all">
                            <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
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

            <div class="lg:col-span-9 space-y-8">
                <!-- Profile Settings Area -->
                <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-10 py-8 border-b border-gray-100">
                        <h3 class="text-xl font-black text-gray-900 lowercase tracking-tighter">personal info.</h3>
                        <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest mt-1">Update your basic details</p>
                    </div>
                    <form action="#" method="POST" class="p-10 space-y-8">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest pl-4">Full Name</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="w-full px-8 py-5 bg-gray-50 border-0 rounded-[25px] text-sm font-bold text-gray-900 focus:ring-2 focus:ring-brand/20 focus:bg-white transition-all outline-none" placeholder="Enter your name">
                            </div>
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest pl-4">Email Address</label>
                                <input type="email" name="email" value="{{ $user->email }}" class="w-full px-8 py-5 bg-gray-50 border-0 rounded-[25px] text-sm font-bold text-gray-900 focus:ring-2 focus:ring-brand/20 focus:bg-white transition-all outline-none" placeholder="Enter your email">
                            </div>
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest pl-4">Phone Number</label>
                                <input type="text" name="phone" value="{{ $user->phone }}" class="w-full px-8 py-5 bg-gray-50 border-0 rounded-[25px] text-sm font-bold text-gray-900 focus:ring-2 focus:ring-brand/20 focus:bg-white transition-all outline-none" placeholder="Enter your phone">
                            </div>
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest pl-4">Location/Address</label>
                                <input type="text" name="address" value="{{ $user->address }}" class="w-full px-8 py-5 bg-gray-50 border-0 rounded-[25px] text-sm font-bold text-gray-900 focus:ring-2 focus:ring-brand/20 focus:bg-white transition-all outline-none" placeholder="Main Street, Dhaka">
                            </div>
                        </div>
                        <div class="pt-6 border-t border-gray-50 flex justify-end">
                            <button type="submit" class="px-12 py-5 bg-gray-900 text-white rounded-[25px] text-[10px] font-black uppercase tracking-widest hover:bg-brand transition-all shadow-md">
                                Save Profile
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Password Settings Area -->
                <div class="bg-white rounded-[40px] shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-10 py-8 border-b border-gray-100">
                        <h3 class="text-xl font-black text-gray-900 lowercase tracking-tighter">security hub.</h3>
                        <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest mt-1">Keep your account guarded</p>
                    </div>
                    <form action="#" method="POST" class="p-10 space-y-8">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest pl-4">Current Password</label>
                                <input type="password" name="current_password" class="w-full px-8 py-5 bg-gray-50 border-0 rounded-[25px] text-sm font-bold text-gray-900 focus:ring-2 focus:ring-brand/20 focus:bg-white transition-all outline-none" placeholder="Current Secret Key">
                            </div>
                            <div class="space-y-4">
                                <!-- Spacer for layout -->
                            </div>
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest pl-4">New Password</label>
                                <input type="password" name="password" class="w-full px-8 py-5 bg-gray-50 border-0 rounded-[25px] text-sm font-bold text-gray-900 focus:ring-2 focus:ring-brand/20 focus:bg-white transition-all outline-none" placeholder="New Secret Key">
                            </div>
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest pl-4">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="w-full px-8 py-5 bg-gray-50 border-0 rounded-[25px] text-sm font-bold text-gray-900 focus:ring-2 focus:ring-brand/20 focus:bg-white transition-all outline-none" placeholder="Match New Secret Key">
                            </div>
                        </div>
                        <div class="pt-6 border-t border-gray-50 flex justify-end">
                            <button type="submit" class="px-12 py-5 bg-brand text-white rounded-[25px] text-[10px] font-black uppercase tracking-widest hover:bg-brand-strong transition-all shadow-md">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
