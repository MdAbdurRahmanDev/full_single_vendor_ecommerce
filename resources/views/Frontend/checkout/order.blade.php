@extends('Layouts.frontend')

@section('content')
    <!-- Breadcrumbs -->
    <div class="bg-white border-b border-gray-100 py-4 mb-10">
        <div class="container mx-auto px-4">
            <nav class="flex text-sm text-gray-500 space-x-2">
                <a href="/" class="hover:text-brand transition">Home</a>
                <span class="text-gray-300">/</span>
                <a href="{{ route('shop.index') }}" class="hover:text-brand transition">Shop</a>
                <span class="text-gray-300">/</span>
                <span class="text-gray-900 font-semibold">Checkout</span>
            </nav>
        </div>
    </div>

    <div class="container mx-auto px-4 pb-20">
        <form action="{{ route('order.store') }}" method="POST" id="checkout-form" x-data="{ method: 'cod' }">
            @csrf
            <input type="hidden" name="payment_method" :value="method">
            
            <div class="flex flex-col lg:flex-row gap-12 max-w-7xl mx-auto">
                
                <!-- Left: Checkout Form -->
                <div class="flex-1 space-y-10">
                    <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
                        <h2 class="text-2xl font-black text-gray-900 mb-8 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-brand text-white text-sm flex items-center justify-center mr-3">1</span>
                            Billing & Shipping Information
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700">Full Name</label>
                                <input type="text" name="full_name" required value="{{ auth()->user()->name ?? '' }}" placeholder="MD Abdur Rahman" class="w-full px-5 py-3 rounded-2xl border border-gray-200 focus:ring-1 focus:ring-brand focus:border-brand bg-gray-50/50">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700">Phone Number</label>
                                <input type="tel" name="phone" required placeholder="01700 000 000" class="w-full px-5 py-3 rounded-2xl border border-gray-200 focus:ring-1 focus:ring-brand focus:border-brand bg-gray-50/50">
                            </div>
                            <div class="space-y-2 md:col-span-2">
                                <label class="text-sm font-bold text-gray-700">Shipping Address</label>
                                <textarea name="address" required rows="3" placeholder="House No, Road, Area, Dhaka" class="w-full px-5 py-3 rounded-2xl border border-gray-200 focus:ring-1 focus:ring-brand focus:border-brand bg-gray-50/50"></textarea>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700">City</label>
                                <select name="city" required class="w-full px-5 py-3 rounded-2xl border border-gray-200 focus:ring-1 focus:ring-brand focus:border-brand bg-gray-50/50">
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Chittagong">Chittagong</option>
                                    <option value="Sylhet">Sylhet</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700">Postal Code</label>
                                <input type="text" name="postal_code" placeholder="1212" class="w-full px-5 py-3 rounded-2xl border border-gray-200 focus:ring-1 focus:ring-brand focus:border-brand bg-gray-50/50">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl border border-gray-100 p-8 shadow-sm">
                        <h2 class="text-2xl font-black text-gray-900 mb-8 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-gray-900 text-white text-sm flex items-center justify-center mr-3">2</span>
                            Payment Method
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <button type="button" @click="method = 'cod'" :class="method === 'cod' ? 'border-brand bg-brand/5' : 'border-gray-100'" 
                                class="flex flex-col items-center justify-center p-6 border-2 rounded-2xl transition hover:border-brand/50 group">
                                <svg class="w-8 h-8 mb-3 text-gray-400 group-hover:text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                <span class="font-bold text-sm text-gray-900">Cash on Delivery</span>
                            </button>
                            <button type="button" @click="method = 'bkash'" :class="method === 'bkash' ? 'border-[#E2136E] bg-[#E2136E]/5' : 'border-gray-100'" 
                                class="flex flex-col items-center justify-center p-6 border-2 rounded-2xl transition hover:border-[#E2136E]/50 group">
                                <span class="font-black text-2xl text-[#E2136E] mb-3">bKash</span>
                                <span class="font-bold text-sm text-gray-900">Online Payment</span>
                            </button>
                            <button type="button" @click="method = 'card'" :class="method === 'card' ? 'border-indigo-600 bg-indigo-600/5' : 'border-gray-100'" 
                                class="flex flex-col items-center justify-center p-6 border-2 rounded-2xl transition hover:border-indigo-600/50 group">
                                <svg class="w-8 h-8 mb-3 text-gray-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                <span class="font-bold text-sm text-gray-900">Credit / Debit Card</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right: Order Summary -->
                <aside class="w-full lg:w-[400px] space-y-6">
                    <div class="bg-gray-900 rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden">
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
                        <h3 class="text-xl font-black mb-8 relative">Order Summary</h3>
                        
                        <div class="space-y-4 mb-8">
                            @foreach($cart as $id => $item)
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 rounded-2xl bg-white/10 shrink-0 overflow-hidden">
                                    <img src="{{ Str::startsWith($item['image'], 'http') ? $item['image'] : asset('uploads/product/' . $item['image']) }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-xs font-bold line-clamp-1 truncate">{{ $item['name'] }}</h4>
                                    <p class="text-[10px] text-gray-400">Qty: {{ $item['quantity'] }}</p>
                                </div>
                                <span class="text-sm font-black">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="space-y-4 pt-6 border-t border-white/10">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400 font-medium">Subtotal</span>
                                <span class="font-black">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400 font-medium">Shipping</span>
                                <span class="font-black text-green-400">+ ${{ number_format($shipping, 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center text-xl pt-4">
                                <span class="font-black">Total</span>
                                <span class="font-black text-brand">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-brand text-white py-4 rounded-2xl font-black text-sm mt-8 shadow-xl hover:scale-[1.02] transition transform active:scale-95 shadow-brand/20">
                            Complete Order Now
                        </button>
                    </div>

                    <div class="bg-white rounded-3xl border border-gray-100 p-6 shadow-sm">
                        <div class="flex space-x-2">
                            <input type="text" placeholder="Coupon Code" class="flex-1 bg-gray-50 border border-gray-100 rounded-xl px-4 py-2 text-sm focus:ring-0">
                            <button type="button" class="px-6 py-2 bg-gray-100 text-gray-900 rounded-xl text-xs font-bold hover:bg-gray-200 transition">Apply</button>
                        </div>
                    </div>

                    <div class="px-6 text-center text-xs text-gray-400 leading-relaxed font-medium">
                        By completing your purchase you agree to our <a href="#" class="underline">Terms of Service</a> and <a href="#" class="underline">Privacy Policy</a>.
                    </div>
                </aside>

            </div>
        </form>
    </div>
@endsection
