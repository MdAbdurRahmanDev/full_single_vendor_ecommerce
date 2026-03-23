@extends('Layouts.frontend')

@section('content')
    <div class="container mx-auto px-4 py-24 text-center max-w-2x1 mx-auto">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 text-green-600 rounded-full mb-8 animate-bounce">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
        </div>
        
        <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-6 leading-tight">Order Placed Successfully!</h1>
        <p class="text-lg text-gray-500 mb-12 max-w-lg mx-auto leading-relaxed">Thank you for your purchase. We've received your order and are processing it right now. You'll receive a confirmation email shortly.</p>
        
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('shop.index') }}" class="w-full sm:w-auto px-10 py-4 bg-gray-900 text-white rounded-full font-black text-sm hover:bg-gray-800 transition shadow-xl shadow-gray-200">Continue Shopping</a>
            <a href="#" class="w-full sm:w-auto px-10 py-4 bg-white border-2 border-gray-900 text-gray-900 rounded-full font-black text-sm hover:bg-gray-900 hover:text-white transition shadow-xl shadow-gray-200">Track My Order</a>
        </div>
        
        <div class="mt-16 pt-16 border-t border-gray-100 max-w-md mx-auto">
            <p class="text-[10px] uppercase font-black text-gray-400 tracking-[0.2em] mb-4">You might also like</p>
            <div class="flex items-center justify-center -space-x-4">
                <div class="w-12 h-12 rounded-full border-4 border-white bg-gray-100 overflow-hidden"><img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=100" class="h-full object-cover"></div>
                <div class="w-12 h-12 rounded-full border-4 border-white bg-gray-100 overflow-hidden"><img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=100" class="h-full object-cover"></div>
                <div class="w-12 h-12 rounded-full border-4 border-white bg-gray-100 overflow-hidden"><img src="https://images.unsplash.com/photo-1523170335258-f5ed11844a49?q=80&w=100" class="h-full object-cover"></div>
                <div class="w-12 h-12 rounded-full border-4 border-white bg-gray-200 flex items-center justify-center text-[10px] font-bold">+24</div>
            </div>
        </div>
    </div>
@endsection
