@extends('Layouts.frontend')

@section('content')
    <!-- Header Section -->
    <div class="bg-gray-900 py-20 px-4 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-brand/10 rounded-full blur-3xl -mr-20 -mt-20"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-500/5 rounded-full blur-3xl -ml-20 -mb-20"></div>
        
        <div class="container mx-auto text-center relative z-10">
            <h1 class="text-4xl md:text-6xl font-black text-white mb-6">How can we help?</h1>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto mb-10 leading-relaxed">Search our knowledge base or browse frequently asked questions below.</p>
            
            <div class="max-w-2xl mx-auto relative">
                <input type="text" placeholder="Search for topics, e.g. 'Shipping' or 'Returns'" 
                    class="w-full bg-white/10 border border-white/20 rounded-2xl px-6 py-4 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-brand backdrop-blur-md transition">
                <button class="absolute right-3 top-3 bg-brand text-white px-6 py-2 rounded-xl text-sm font-black hover:bg-brand-strong transition">Search</button>
            </div>
        </div>
    </div>

    <!-- Quick Help Cards -->
    <div class="container mx-auto px-4 -mt-12 mb-24 grid grid-cols-1 md:grid-cols-3 gap-8 relative z-20">
        <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-xl hover:-translate-y-2 transition duration-500">
            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            <h3 class="text-xl font-black text-gray-900 mb-3">Order Tracking</h3>
            <p class="text-sm text-gray-500 mb-6 leading-relaxed">Instantly track the status of your current orders and delivery progress.</p>
            <a href="#" class="text-brand font-bold text-sm hover:underline flex items-center">Track Now <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></a>
        </div>
        <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-xl hover:-translate-y-2 transition duration-500">
            <div class="w-14 h-14 bg-brand-soft text-brand rounded-2xl flex items-center justify-center mb-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
            </div>
            <h3 class="text-xl font-black text-gray-900 mb-3">Return & Refund</h3>
            <p class="text-sm text-gray-500 mb-6 leading-relaxed">Easy 7-day return policy. Start a return or check your refund status.</p>
            <a href="#" class="text-brand font-bold text-sm hover:underline flex items-center">Start Return <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></a>
        </div>
        <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-xl hover:-translate-y-2 transition duration-500">
            <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <h3 class="text-xl font-black text-gray-900 mb-3">Payment Info</h3>
            <p class="text-sm text-gray-500 mb-6 leading-relaxed">Browse payment methods, EMI options, and secure transaction details.</p>
            <a href="#" class="text-brand font-bold text-sm hover:underline flex items-center">View Details <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></a>
        </div>
    </div>

    <!-- FAQs -->
    <div class="container mx-auto px-4 pb-24 max-w-4xl">
        <h2 class="text-3xl font-black text-gray-900 mb-12 text-center">Frequently Asked Questions</h2>
        <div x-data="{ active: 1 }" class="space-y-4">
            <!-- FAQ 1 -->
            <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden">
                <button @click="active = active === 1 ? null : 1" class="w-full px-8 py-6 text-left flex items-center justify-between hover:bg-gray-50 transition">
                    <span class="font-bold text-gray-900">How long does shipping normally take?</span>
                    <svg class="w-5 h-5 transition-transform" :class="active === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="active === 1" class="px-8 pb-8 text-sm text-gray-500 leading-relaxed">
                    Standard shipping usually takes 3-5 business days within metropolitan areas and 5-10 days for remote locations. You can check the estimated delivery date on your order tracking page.
                </div>
            </div>
            <!-- FAQ 2 -->
            <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden">
                <button @click="active = active === 2 ? null : 2" class="w-full px-8 py-6 text-left flex items-center justify-between hover:bg-gray-50 transition">
                    <span class="font-bold text-gray-900">What is the return policy for electronics?</span>
                    <svg class="w-5 h-5 transition-transform" :class="active === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="active === 2" class="px-8 pb-8 text-sm text-gray-500 leading-relaxed">
                    Electronics can be returned within 7 days of delivery only if they are in their original, unopened packaging. If the product is defective, please record a video while unboxing to facilitate a faster refund/replacement.
                </div>
            </div>
             <!-- FAQ 3 -->
             <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden">
                <button @click="active = active === 3 ? null : 3" class="w-full px-8 py-6 text-left flex items-center justify-between hover:bg-gray-50 transition">
                    <span class="font-bold text-gray-900">Do you offer Cash on Delivery (COD)?</span>
                    <svg class="w-5 h-5 transition-transform" :class="active === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="active === 3" class="px-8 pb-8 text-sm text-gray-500 leading-relaxed">
                    Yes, we offer Cash on Delivery across all major cities. A small confirmation fee might be required for high-value orders to verify the transaction.
                </div>
            </div>
        </div>

        <!-- Contact Trigger -->
        <div class="mt-20 bg-brand p-12 rounded-[3rem] text-center text-white relative overflow-hidden group">
            <div class="absolute inset-0 bg-gray-900 opacity-0 group-hover:opacity-10 transition duration-700"></div>
            <h3 class="text-3xl font-black mb-4 relative z-10">Still have questions?</h3>
            <p class="text-white/80 mb-10 max-w-md mx-auto relative z-10">Our dedicated support team is here to help you 24/7 with any issues you might have.</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 relative z-10">
                <a href="{{ route('contact') }}" class="w-full sm:w-auto px-10 py-4 bg-white text-gray-900 rounded-full font-black text-sm hover:scale-105 transition transform shadow-xl">Contact Support</a>
                <a href="tel:{{ $global_settings['phone'] ?? '01700000000' }}" class="w-full sm:w-auto px-10 py-4 bg-gray-900 text-white rounded-full font-black text-sm hover:scale-105 transition transform shadow-xl">Call Us Now</a>
            </div>
        </div>
    </div>
@endsection
