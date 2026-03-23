@extends('Layouts.frontend')

@section('content')
    <!-- Header Section -->
    <div class="bg-white border-b border-gray-100 py-16 md:py-24">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-6xl font-black text-gray-900 mb-6 leading-tight">Get in touch with us.</h1>
            <p class="text-gray-500 text-lg max-w-xl mx-auto leading-relaxed italic">Have a question or feedback? We'd love to hear from you. Fill out the form below or use our official contacts.</p>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="container mx-auto px-4 pb-32">
        <div class="flex flex-col lg:flex-row gap-16 max-w-7xl mx-auto -mt-10 lg:-mt-16 bg-white rounded-[3rem] shadow-2xl overflow-hidden border border-gray-100 relative z-30">
            
            <!-- Left: Contact Details -->
            <div class="w-full lg:w-[400px] bg-gray-900 p-12 text-white flex flex-col justify-between">
                <div class="space-y-12">
                     <h3 class="text-3xl font-black tracking-tighter">Contact Information</h3>
                     
                     <div class="space-y-10 font-bold">
                         <div class="flex items-start space-x-6">
                             <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center shrink-0">
                                 <svg class="w-6 h-6 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                             </div>
                             <div>
                                 <p class="text-[10px] text-gray-400 uppercase tracking-widest mb-1 leading-none">Phone Number</p>
                                 <p class="text-lg">{{ $global_settings['phone'] ?? '01700 000 000' }}</p>
                             </div>
                         </div>

                         <div class="flex items-start space-x-6">
                             <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center shrink-0">
                                 <svg class="w-6 h-6 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 012 2H3a2 2 0 012-2z"/></svg>
                             </div>
                             <div>
                                 <p class="text-[10px] text-gray-400 uppercase tracking-widest mb-1 leading-none">Email Address</p>
                                 <p class="text-lg">{{ $global_settings['email'] ?? 'support@example.com' }}</p>
                             </div>
                         </div>

                         <div class="flex items-start space-x-6">
                             <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center shrink-0">
                                 <svg class="w-6 h-6 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                             </div>
                             <div>
                                 <p class="text-[10px] text-gray-400 uppercase tracking-widest mb-1 leading-none">Store Location</p>
                                 <p class="text-lg leading-relaxed">{{ $global_settings['address'] ?? 'Dhaka, Bangladesh' }}</p>
                             </div>
                         </div>
                     </div>
                </div>

                <div class="flex items-center space-x-6">
                    <a href="{{ $global_settings['facebook'] ?? '#' }}" class="w-10 h-10 border border-white/20 rounded-xl flex items-center justify-center hover:bg-white hover:text-gray-900 transition"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="{{ $global_settings['twitter'] ?? '#' }}" class="w-10 h-10 border border-white/20 rounded-xl flex items-center justify-center hover:bg-white hover:text-gray-900 transition"><i class="fa-brands fa-twitter"></i></a>
                    <a href="{{ $global_settings['instagram'] ?? '#' }}" class="w-10 h-10 border border-white/20 rounded-xl flex items-center justify-center hover:bg-white hover:text-gray-900 transition"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>

            <!-- Right: Contact Form -->
            <div class="flex-1 p-12 lg:p-20">
                <h3 class="text-3xl font-black text-gray-900 mb-10">Send a Message</h3>
                <form action="#" method="POST" class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                             <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.25em]">Your Name</label>
                             <input type="text" placeholder="John Doe" class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-6 py-4 text-sm font-bold focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand">
                        </div>
                        <div class="space-y-2">
                             <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.25em]">Email Address</label>
                             <input type="email" placeholder="john@example.com" class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-6 py-4 text-sm font-bold focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand">
                        </div>
                    </div>
                    <div class="space-y-2">
                         <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.25em]">Subject</label>
                         <input type="text" placeholder="I have a question about my order" class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-6 py-4 text-sm font-bold focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand">
                    </div>
                    <div class="space-y-2">
                         <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.25em]">Message Content</label>
                         <textarea rows="5" placeholder="Tell us more about your request..." class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-6 py-4 text-sm font-bold focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand"></textarea>
                    </div>
                    
                    <button class="px-12 py-5 bg-brand text-white rounded-2xl font-black text-sm hover:scale-105 transition transform shadow-xl shadow-brand/20 active:scale-95">
                        Submit Message
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
