@extends('Layouts.frontend')

@section('content')
<div class="bg-gray-50 min-h-screen py-10 md:py-20 flex flex-col items-center">
    <div class="container mx-auto px-4 max-w-7xl">
        
        <!-- Cart Header -->
        <div class="mb-16 text-center">
            <h1 class="text-4xl md:text-5xl font-black text-gray-900 lowercase tracking-tighter mb-4">your shopping bag.</h1>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Review your selection before checkout</p>
        </div>

        @if(count($cart) > 0)
        <!-- Main Layout Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            
            <!-- Items Area (Left) -->
            <div class="lg:col-span-8 space-y-6">
                @foreach($cart as $id => $details)
                <div class="bg-white rounded-[40px] p-6 md:p-10 shadow-sm border border-gray-100 flex flex-col md:flex-row items-center gap-8 md:gap-12 transition-all hover:shadow-md group relative">
                    <!-- Product Image -->
                    <div class="shrink-0 w-32 h-32 md:w-40 md:h-40 bg-gray-50 rounded-[35px] overflow-hidden border border-gray-100">
                        <img src="{{ asset($details['image']) }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>

                    <!-- Details -->
                    <div class="flex-1 w-full text-center md:text-left">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-xl md:text-2xl font-black text-gray-900 lowercase tracking-tight">{{ $details['name'] }}</h3>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Premium Collection</p>
                            </div>
                            
                            <!-- Remove Item -->
                            <form action="{{ route('cart.remove') }}" method="POST" class="absolute top-6 right-6 md:static">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit" class="p-2 text-gray-200 hover:text-red-500 transition-all transform hover:rotate-12">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>

                        <div class="flex flex-col md:flex-row items-center justify-between gap-6 mt-8 pt-6 border-t border-gray-50">
                            <div class="flex items-center space-x-4">
                                <div class="bg-gray-50 border border-gray-100 rounded-2xl px-6 py-2 flex items-center space-x-4">
                                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Quantity</span>
                                    <span class="text-lg font-black text-gray-900">{{ $details['quantity'] }}</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="text-2xl md:text-3xl font-black text-gray-900 tracking-tighter">৳{{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
                <div class="pt-10 flex justify-center md:justify-start">
                    <a href="{{ route('shop.index') }}" class="group inline-flex items-center space-x-3 text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-brand transition-all">
                        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        <span>Continue Selection</span>
                    </a>
                </div>
            </div>

            <!-- Summary Area (Right) -->
            <div class="lg:col-span-4 h-fit">
                <div class="bg-gray-100 rounded-[50px] p-8 md:p-12 shadow-sm border border-gray-100">
                    <h2 class="text-3xl font-black text-gray-900 lowercase tracking-tighter mb-10">order summary.</h2>
                    
                    <div class="space-y-6 mb-12 pb-10 border-b border-gray-200">
                        <div class="flex items-center justify-between text-gray-500">
                            <span class="text-[10px] font-black uppercase tracking-widest">Initial Subtotal</span>
                            <span class="text-xl font-black text-gray-900 tracking-tighter">৳{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between text-gray-500">
                             <span class="text-[10px] font-black uppercase tracking-widest">Delivery Gate</span>
                             <span class="text-[10px] font-black text-brand uppercase tracking-widest bg-brand/5 px-3 py-1 rounded-full">Calculated Later</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mb-12">
                         <span class="text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Total Due</span>
                         <span class="text-5xl font-black text-brand tracking-tighter">৳{{ number_format($subtotal, 2) }}</span>
                    </div>

                    <a href="{{ route('checkout') }}" class="block w-full text-center py-7 bg-brand hover:bg-brand-strong text-white rounded-[30px] text-[10px] font-black uppercase tracking-widest shadow-2xl shadow-brand/30 transition-all transform active:scale-95">
                        Proceed to Checkout
                    </a>
                    
                    <!-- Trust Assets -->
                    <div class="mt-12 flex items-center justify-center space-x-8 opacity-40 grayscale">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" class="h-4">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" class="h-6">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" class="h-4">
                    </div>
                </div>
            </div>

        </div>
        @else
        <!-- Empty State (Refined) -->
        <div class="max-w-3xl mx-auto text-center py-24 bg-white rounded-[60px] shadow-sm border border-gray-100 px-10">
            <div class="w-32 h-32 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-10 text-gray-200">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
            <h2 class="text-4xl font-black text-gray-900 lowercase tracking-tighter mb-4">the bag is empty.</h2>
            <p class="text-gray-400 text-sm font-medium mb-12 max-w-sm mx-auto leading-relaxed">Discover our new premium arrivals and find the perfect piece for your unique collection.</p>
            <a href="{{ route('shop.index') }}" class="px-16 py-6 bg-brand text-white rounded-[30px] text-[10px] font-black uppercase tracking-widest shadow-2xl shadow-brand/40 hover:bg-brand-strong transition-all transform active:scale-95 inline-block">
                Start Exploring
            </a>
        </div>
        @endif

    </div>
</div>
@endsection
