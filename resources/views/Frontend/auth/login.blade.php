@extends('Layouts.frontend')

@section('content')
<div class="min-h-[85vh] flex flex-col md:flex-row bg-white overflow-hidden">
    <!-- Left Side: Login Form -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-8 md:p-16">
        <div class="max-w-md w-full">
            <div class="mb-10 text-center md:text-left">
                <h1 class="text-3xl font-black text-gray-900 lowercase tracking-tighter">Sign In to <span class="text-brand">Brandao.</span></h1>
                <p class="text-gray-400 font-bold text-sm mt-3">Welcome back! Access your orders and wishlist.</p>
            </div>

            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf
                
                @if($errors->any())
                    <div class="bg-red-50 text-red-600 p-4 rounded-2xl text-xs font-black border border-red-100 animate-shake">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="space-y-2 group">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4 group-focus-within:text-brand transition">Email or Phone Number</label>
                    <div class="relative">
                        <span class="absolute left-6 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                        </span>
                        <input type="text" name="login_id" value="{{ old('login_id') }}" required placeholder="email@example.com or 017..." class="w-full bg-gray-50 border border-gray-100 rounded-2xl pl-14 pr-6 py-4 text-sm font-bold focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand transition focus:bg-white shadow-sm">
                    </div>
                </div>

                <div class="space-y-2 group">
                    <div class="flex justify-between items-center ml-4">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest group-focus-within:text-brand transition">Password</label>
                        <a href="#" class="text-[10px] font-black text-brand uppercase tracking-widest hover:underline">Forgot?</a>
                    </div>
                    <div class="relative">
                        <span class="absolute left-6 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </span>
                        <input type="password" name="password" required placeholder="••••••••" class="w-full bg-gray-50 border border-gray-100 rounded-2xl pl-14 pr-6 py-4 text-sm font-bold focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand transition focus:bg-white shadow-sm">
                    </div>
                </div>

                <button type="submit" class="w-full bg-gray-900 text-white rounded-2xl py-5 font-black text-sm hover:bg-brand transition shadow-xl shadow-gray-200 active:scale-95 transform duration-200 flex items-center justify-center space-x-2">
                    <span>Enter Brandao</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                </button>
            </form>

            <div class="mt-8 pt-8 border-t border-gray-100 text-center md:text-left">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">New here? <a href="{{ route('register') }}" class="text-brand hover:underline">Create an account</a></p>
            </div>
            
            <div class="mt-10 grid grid-cols-2 gap-4">
                <button class="flex items-center justify-center space-x-3 bg-white border border-gray-100 py-3.5 rounded-2xl text-[10px] font-black text-gray-600 hover:shadow-lg transition active:scale-95">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-4 h-4" alt="Google">
                    <span class="uppercase tracking-widest">Google</span>
                </button>
                <button class="flex items-center justify-center space-x-3 bg-white border border-gray-100 py-3.5 rounded-2xl text-[10px] font-black text-gray-600 hover:shadow-lg transition active:scale-95">
                    <img src="https://www.svgrepo.com/show/448234/facebook.svg" class="w-4 h-4" alt="Facebook">
                    <span class="uppercase tracking-widest">Facebook</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Right Side: Immersive Image -->
    <div class="hidden md:block md:w-1/2 relative">
        <img src="{{ asset('assets/img/login_bg.png') }}" alt="Fashion Banner" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-l from-transparent to-white/10"></div>
        
        <!-- Overlay Quote -->
        <div class="absolute bottom-20 left-12 max-w-sm">
            <div class="bg-black/80 backdrop-blur-md p-8 rounded-3xl border border-white/20">
                <p class="text-white text-xl font-black italic lowercase leading-tight">"Fashion is part of the daily air and it changes all the time, with all the events."</p>
                <div class="mt-6 flex items-center space-x-3">
                    <div class="w-10 h-1 bg-brand rounded-full"></div>
                    <span class="text-white font-black text-xs uppercase tracking-[0.2em]">Bill Cunningham</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
