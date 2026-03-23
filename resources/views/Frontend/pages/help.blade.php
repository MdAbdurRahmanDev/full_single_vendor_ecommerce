@extends('Layouts.frontend')

@section('content')
    <!-- Header Section -->
    <div class="bg-gray-900 py-20 px-4 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-brand/10 rounded-full blur-3xl -mr-20 -mt-20"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-500/5 rounded-full blur-3xl -ml-20 -mb-20"></div>
        
        <div class="container mx-auto text-center relative z-10">
            <h1 class="text-4xl md:text-6xl font-black text-white mb-6">{{ $global_settings['help_title'] ?? 'How can we help?' }}</h1>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto mb-10 leading-relaxed">{{ $global_settings['help_sub_title'] ?? 'Browse categories or search our FAQ knowledge base.' }}</p>
            
            <form action="{{ route('shop.index') }}" method="GET" class="max-w-2xl mx-auto relative group">
                <input type="text" name="search" placeholder="Search for topics, e.g. 'Shipping' or 'Returns'" 
                    class="w-full bg-white/10 border border-white/20 rounded-2xl px-6 py-4 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-brand backdrop-blur-md transition group-hover:border-white/40">
                <button type="submit" class="absolute right-3 top-3 bg-brand text-white px-6 py-2 rounded-xl text-sm font-black hover:bg-brand-strong transition shadow-lg">Search</button>
            </form>
        </div>
    </div>

    <!-- Quick Help Cards -->
    <div class="container mx-auto px-4 -mt-12 mb-24 grid grid-cols-1 md:grid-cols-3 gap-8 relative z-20">
        <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-xl hover:-translate-y-2 transition duration-500">
            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            <h3 class="text-xl font-black text-gray-900 mb-3">Order Tracking</h3>
            <p class="text-sm text-gray-500 mb-6 leading-relaxed">Instantly track the status of your current orders and delivery progress with our live tracking tool.</p>
            <a href="#" class="text-brand font-bold text-sm hover:underline flex items-center">Track Now <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></a>
        </div>
        <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-xl hover:-translate-y-2 transition duration-500">
            <div class="w-14 h-14 bg-brand-soft text-brand rounded-2xl flex items-center justify-center mb-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
            </div>
            <h3 class="text-xl font-black text-gray-900 mb-3">Return & Refund</h3>
            <p class="text-sm text-gray-500 mb-6 leading-relaxed">Easy 7-day return policy for all fashion items. Start your digital return process here.</p>
            <a href="#" class="text-brand font-bold text-sm hover:underline flex items-center">Start Return <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></a>
        </div>
        <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-xl hover:-translate-y-2 transition duration-500">
            <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <h3 class="text-xl font-black text-gray-900 mb-3">Secure Payments</h3>
            <p class="text-sm text-gray-500 mb-6 leading-relaxed">View all bKash, Card, and Online EMI options clearly explained for your convenience.</p>
            <a href="#" class="text-brand font-bold text-sm hover:underline flex items-center">View Details <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></a>
        </div>
    </div>

    <!-- FAQs -->
    <div class="container mx-auto px-4 pb-24 max-w-4xl">
        <h2 class="text-3xl font-black text-gray-900 mb-12 text-center">Frequently Asked Questions</h2>
        <div x-data="{ active: 1 }" class="space-y-4">
            @forelse($faqs as $faq)
            <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition">
                <button @click="active = active === {{ $loop->iteration }} ? null : {{ $loop->iteration }}" class="w-full px-8 py-6 text-left flex items-center justify-between hover:bg-gray-50/50 transition duration-300">
                    <span class="font-bold text-gray-900 text-base md:text-lg">{{ $faq->question }}</span>
                    <svg class="w-5 h-5 transition-transform duration-300 text-gray-400" :class="active === {{ $loop->iteration }} ? 'rotate-180 text-brand' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="active === {{ $loop->iteration }}" x-collapse class="px-8 pb-8 text-sm md:text-base text-gray-500 leading-relaxed font-medium">
                    {{ $faq->answer }}
                </div>
            </div>
            @empty
                <p class="text-center text-gray-400 py-10 font-bold italic">No FAQs available at the moment.</p>
            @endforelse
        </div>

        <!-- Contact Trigger -->
        <div class="mt-20 bg-brand p-12 rounded-[3.5rem] text-center text-white relative overflow-hidden group shadow-2xl shadow-brand/20">
            <div class="absolute inset-x-0 bottom-0 h-1 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition duration-1000 origin-left"></div>
            <h3 class="text-3xl md:text-4xl font-black mb-4 relative z-10">Still have questions?</h3>
            <p class="text-white/80 mb-10 max-w-md mx-auto relative z-10 font-bold">Our support team is live 24/7. Call or message us directly for instant resolutions.</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-5 relative z-10">
                <a href="{{ route('contact') }}" class="w-full sm:w-auto px-12 py-5 bg-white text-gray-900 rounded-full font-black text-sm hover:scale-105 transition transform shadow-xl active:scale-95">Send a Ticket</a>
                <a href="tel:{{ $global_settings['phone'] ?? '01700000000' }}" class="w-full sm:w-auto px-12 py-5 bg-gray-900 text-white rounded-full font-black text-sm hover:scale-105 transition transform shadow-xl active:scale-95 flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    Call Now
                </a>
            </div>
        </div>
    </div>
@endsection
