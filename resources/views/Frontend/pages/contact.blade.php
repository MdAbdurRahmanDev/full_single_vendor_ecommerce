@extends('Layouts.frontend')

@section('content')
    <!-- Header Section -->
    <div class="bg-gray-50 border-b border-gray-100 py-20 md:py-32 relative overflow-hidden">
        <div class="container mx-auto px-4">
            @if(session('success'))
                <div class="max-w-7xl mx-auto mb-8 bg-green-500 text-white p-4 rounded-2xl text-center font-black shadow-lg animate-bounce">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="max-w-7xl mx-auto mb-8 bg-red-500 text-white p-4 rounded-2xl text-center font-black shadow-lg">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="absolute inset-0 bg-blue-50/30 blur-3xl rounded-full scale-150 -z-10 mt-20"></div>
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-7xl font-black text-gray-900 mb-8 leading-[1.1] tracking-tight">Got questions? <br/><span class="text-brand">We’ve got answers.</span></h1>
            <p class="text-gray-500 text-lg md:text-xl font-medium max-w-xl mx-auto leading-relaxed">Reach out to our expert team for any professional support or business inquiries.</p>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="container mx-auto px-4 pb-40">
        <div class="flex flex-col lg:flex-row gap-0 max-w-7xl mx-auto -mt-16 lg:-mt-24 bg-white rounded-[3.5rem] shadow-2xl overflow-hidden border border-gray-100 relative z-30 ring-1 ring-gray-100">
            
            <!-- Left: Contact Details (Modern Sidebar) -->
            <div class="w-full lg:w-[440px] bg-gray-900 p-12 md:p-16 text-white flex flex-col justify-between relative">
                <div class="absolute top-0 right-0 w-32 h-32 bg-brand/10 rounded-full blur-3xl"></div>
                
                <div class="space-y-16 relative z-10">
                     <div class="space-y-4">
                        <h3 class="text-3xl font-black tracking-tight leading-none">Contact Info</h3>
                        <p class="text-gray-400 text-sm font-bold opacity-80">Our support team responds within 2 hours.</p>
                     </div>
                     
                     <div class="space-y-10">
                         <!-- Phone -->
                         <div class="flex items-center group cursor-pointer transition">
                             <div class="w-14 h-14 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center shrink-0 group-hover:bg-brand group-hover:border-brand transition duration-500">
                                 <svg class="w-6 h-6 text-brand group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                             </div>
                             <div class="ml-6 flex flex-col">
                                 <span class="text-[10px] text-gray-500 uppercase font-black tracking-widest mb-1.5 leading-none">Phone</span>
                                 <span class="text-xl font-bold group-hover:text-brand transition">{{ $global_settings['phone'] ?? '01700 000 000' }}</span>
                             </div>
                         </div>

                         <!-- Email -->
                         <div class="flex items-center group cursor-pointer transition">
                             <div class="w-14 h-14 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center shrink-0 group-hover:bg-brand group-hover:border-brand transition duration-500">
                                 <svg class="w-6 h-6 text-brand group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"/></svg>
                             </div>
                             <div class="ml-6 flex flex-col">
                                 <span class="text-[10px] text-gray-500 uppercase font-black tracking-widest mb-1.5 leading-none">Email</span>
                                 <span class="text-xl font-bold truncate group-hover:text-brand transition">{{ $global_settings['contact_email'] ?? 'support@shariif.com' }}</span>
                             </div>
                         </div>

                         <!-- Address -->
                         <div class="flex items-start group transition">
                             <div class="w-14 h-14 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center shrink-0 group-hover:bg-brand group-hover:border-brand transition duration-500 mt-1">
                                 <svg class="w-6 h-6 text-brand group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                             </div>
                             <div class="ml-6 flex flex-col">
                                 <span class="text-[10px] text-gray-500 uppercase font-black tracking-widest mb-1.5 leading-none">Address</span>
                                 <span class="text-base font-bold text-gray-200 leading-relaxed">{{ $global_settings['address'] ?? 'Dhaka, Bangladesh' }}</span>
                             </div>
                         </div>
                     </div>
                </div>

                <!-- Footer of sidebar: Socials + Hours -->
                <div class="space-y-10 pt-16 border-t border-white/5">
                    <div class="flex items-center space-x-6">
                        <a href="{{ $global_settings['facebook_url'] ?? '#' }}" class="w-12 h-12 border border-white/10 rounded-2xl flex items-center justify-center hover:bg-brand hover:border-brand transition group"><i class="fa-brands fa-facebook-f text-gray-500 group-hover:text-white"></i></a>
                        <a href="{{ $global_settings['instagram_url'] ?? '#' }}" class="w-12 h-12 border border-white/10 rounded-2xl flex items-center justify-center hover:bg-brand hover:border-brand transition group"><i class="fa-brands fa-instagram text-gray-500 group-hover:text-white"></i></a>
                    </div>
                    <div class="flex items-center space-x-3 text-xs font-black text-gray-500 tracking-widest uppercase">
                        <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                        <span>Open: {{ $global_settings['contact_hours'] ?? 'Mon - Sat: 9 AM - 8 PM' }}</span>
                    </div>
                </div>
            </div>

            <!-- Right: Professional Contact Form -->
            <div class="flex-1 p-10 md:p-20 lg:p-24 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-gray-50 rounded-full"></div>
                
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-10 relative z-10">
                    @csrf
                    <div class="space-y-4">
                        <h3 class="text-3xl font-black text-gray-900 leading-none">Send a Message</h3>
                        <p class="text-gray-400 font-bold text-sm leading-none">Required fields are marked with (*)</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                        <div class="group space-y-3">
                             <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] group-focus-within:text-brand transition">Full Name *</label>
                             <input type="text" name="name" required placeholder="MD Abdur Rahman" class="w-full bg-gray-50 border border-gray-100 rounded-[1.25rem] px-8 py-5 text-sm font-bold focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand transition-all focus:bg-white focus:shadow-xl focus:shadow-brand/5">
                        </div>
                        <div class="group space-y-3">
                             <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] group-focus-within:text-brand transition">Email Address *</label>
                             <input type="email" name="email" required placeholder="support@domain.com" class="w-full bg-gray-50 border border-gray-100 rounded-[1.25rem] px-8 py-5 text-sm font-bold focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand transition-all focus:bg-white focus:shadow-xl focus:shadow-brand/5">
                        </div>
                    </div>

                    <div class="group space-y-3">
                         <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] group-focus-within:text-brand transition">Subject of inquiry</label>
                         <input type="text" name="subject" placeholder="I have a question about my order #12345" class="w-full bg-gray-50 border border-gray-100 rounded-[1.25rem] px-8 py-5 text-sm font-bold focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand transition-all focus:bg-white focus:shadow-xl focus:shadow-brand/5">
                    </div>

                    <div class="group space-y-3">
                         <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] group-focus-within:text-brand transition">Message Details *</label>
                         <textarea rows="6" name="message" required placeholder="Write your message here..." class="w-full bg-gray-50 border border-gray-100 rounded-[1.25rem] px-8 py-5 text-sm font-bold focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand transition-all focus:bg-white focus:shadow-xl focus:shadow-brand/5"></textarea>
                    </div>
                    
                    <button type="submit" class="w-full md:w-auto px-16 py-6 bg-brand text-white rounded-full font-black text-sm hover:scale-105 transition transform shadow-2xl shadow-brand/30 active:scale-95 flex items-center justify-center space-x-2">
                        <span>Send Message</span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-20 text-center text-gray-400 text-xs font-bold uppercase tracking-widest flex items-center justify-center space-x-8">
            <div class="flex items-center space-x-2"><div class="w-1.5 h-1.5 rounded-full bg-brand"></div><span>Secure Servers</span></div>
            <div class="flex items-center space-x-2"><div class="w-1.5 h-1.5 rounded-full bg-brand"></div><span>Data Encrypted</span></div>
            <div class="flex items-center space-x-2"><div class="w-1.5 h-1.5 rounded-full bg-brand"></div><span>24/7 Support</span></div>
        </div>
    </div>
@endsection
