@extends('Layouts.frontend')

@section('content')
<div class="min-h-[85vh] flex flex-col md:flex-row bg-white overflow-hidden">
    <!-- Left Side: Register Form -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-8 md:p-16">
        <div class="max-w-md w-full">
            <div class="mb-10 text-center md:text-left">
                <h1 class="text-3xl font-black text-gray-900 lowercase tracking-tighter">Become a <span class="text-brand">Member.</span></h1>
                <p class="text-gray-400 font-bold text-sm mt-3">Join our community for exclusive deals and updates.</p>
            </div>

            <form action="{{ route('register.post') }}" method="POST" class="space-y-6">
                @csrf
                
                @if($errors->any())
                    <div class="bg-red-50 text-red-600 p-4 rounded-2xl text-xs font-black border border-red-100 animate-shake">
                        @foreach($errors->all() as $error)
                            <p class="mb-1">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="space-y-2 group">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4 group-focus-within:text-brand transition">Your Name</label>
                    <div class="relative">
                        <span class="absolute left-6 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </span>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Abey Khan" class="w-full bg-gray-50 border border-gray-100 rounded-2xl pl-14 pr-6 py-4 text-sm font-bold focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand transition focus:bg-white shadow-sm">
                    </div>
                </div>

                <div class="space-y-2 group">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4 group-focus-within:text-brand transition">Email or Phone Number</label>
                    <div class="relative">
                        <span class="absolute left-6 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                        </span>
                        <input type="text" name="email_or_phone" value="{{ old('email_or_phone') }}" required placeholder="email@example.com or 017..." class="w-full bg-gray-50 border border-gray-100 rounded-2xl pl-14 pr-6 py-4 text-sm font-bold focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand transition focus:bg-white shadow-sm">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2 group">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4 group-focus-within:text-brand transition">Password</label>
                        <input type="password" name="password" required placeholder="••••••••" class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-6 py-4 text-sm font-bold focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand transition focus:bg-white shadow-sm">
                    </div>
                    <div class="space-y-2 group">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4 group-focus-within:text-brand transition">Confirm</label>
                        <input type="password" name="password_confirmation" required placeholder="••••••••" class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-6 py-4 text-sm font-bold focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand transition focus:bg-white shadow-sm">
                    </div>
                </div>

                <button type="submit" class="w-full bg-brand text-white rounded-2xl py-5 font-black text-sm hover:scale-105 transition shadow-2xl shadow-brand/20 active:scale-95 transform duration-200 flex items-center justify-center space-x-2">
                    <span>Create Free Account</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                </button>
            </form>

            <div class="mt-8 pt-8 border-t border-gray-100 text-center md:text-left">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Already with us? <a href="{{ route('login') }}" class="text-brand hover:underline">Sign In Instead</a></p>
            </div>
            
        </div>
    </div>

    <!-- Right Side: Immersive Image -->
    <div class="hidden md:block md:w-1/2 relative">
        <img src="{{ asset('assets/img/register_bg.png') }}" alt="Register Fashion Banner" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gray-900/10"></div>
        
        <!-- Feature Points -->
        <div class="absolute top-20 right-12 text-right">
            <div class="space-y-4">
                <div class="bg-white/80 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/40 shadow-xl self-end flex items-center space-x-3">
                    <span class="text-gray-900 font-bold text-xs uppercase tracking-widest leading-none">Flash Deals Access</span>
                    <svg class="w-4 h-4 text-brand" fill="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <div class="bg-white/80 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/40 shadow-xl self-end flex items-center space-x-3">
                    <span class="text-gray-900 font-bold text-xs uppercase tracking-widest leading-none">Vip Member Pricing</span>
                    <svg class="w-4 h-4 text-brand" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
