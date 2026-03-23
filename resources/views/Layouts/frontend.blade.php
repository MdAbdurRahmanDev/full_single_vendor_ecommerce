<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $global_settings['meta_title'] ?? 'Ecommerce' }}</title>
    <meta name="description" content="{{ $global_settings['meta_description'] ?? '' }}">
    <meta name="keywords" content="{{ $global_settings['meta_keywords'] ?? '' }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gray-50 text-gray-900">

    <!-- Top Bar -->
    <div class="hidden md:block bg-gray-100 border-b border-gray-200">
        <div class="container mx-auto px-4 py-2 flex justify-between items-center text-xs text-gray-600">
            <div class="flex items-center space-x-4">
                <a href="#" class="hover:text-brand transition">Download App</a>
                <span class="text-gray-300">|</span>
                <span class="flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    {{ $global_settings['phone'] ?? '+880 1700 000 000' }}
                </span>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('help') }}" class="hover:text-brand transition">Help</a>
                <a href="{{ route('contact') }}" class="hover:text-brand transition">Contact Us</a>
                @auth
                    <a href="#" class="font-semibold text-brand">{{ auth()->user()->name }}</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-brand transition">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-brand transition">Sign In</a>
                    <span class="text-gray-300">/</span>
                    <a href="{{ route('register') }}" class="hover:text-brand transition">Register</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header x-data="{ mobileMenu: false }" class="bg-white sticky top-0 z-[100] shadow-sm border-b border-gray-100">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between gap-4 md:gap-8">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="shrink-0">
                @if(isset($global_settings['logo']))
                    <img src="{{ asset('uploads/settings/' . $global_settings['logo']) }}" alt="Logo" class="h-8 md:h-10">
                @else
                    <span class="text-2xl font-bold text-gray-900 tracking-tight">{{ $global_settings['app_name'] ?? 'BeliBeli' }}</span>
                @endif
            </a>

            <!-- Nav Links (Desktop) -->
            <div class="hidden lg:flex items-center space-x-8 text-sm font-bold text-gray-700">
                <a href="{{ route('home') }}" class="hover:text-brand transition {{ request()->routeIs('home') ? 'text-brand underline decoration-2 underline-offset-8' : '' }}">Home</a>
                <a href="{{ route('shop.index') }}" class="hover:text-brand transition {{ request()->is('shop*') ? 'text-brand underline decoration-2 underline-offset-8' : '' }}">Shop</a>
                <a href="#" class="hover:text-brand transition">New Arrival</a>
            </div>

            <!-- Search Bar (Desktop) -->
            <form action="{{ route('shop.index') }}" method="GET" class="hidden md:flex flex-1 max-w-2xl relative items-center">
                <div x-data="{ open: false, selectedCategory: 'All Category', selectedSlug: '' }" class="relative shrink-0">
                    <button type="button" @click="open = !open" class="flex items-center px-4 py-2 bg-gray-50 border border-gray-200 rounded-l-lg text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none">
                        <span x-text="selectedCategory"></span>
                        <svg class="w-4 h-4 ml-2 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <input type="hidden" name="category" x-model="selectedSlug">
                    <div x-show="open" @click.away="open = false" x-transition.opacity class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-xl z-50 overflow-hidden">
                        <a href="#" @click.prevent="selectedCategory = 'All Category'; selectedSlug = ''; open = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand hover:text-white transition">All Category</a>
                        @foreach($global_categories ?? [] as $category)
                            <a href="#" @click.prevent="selectedCategory = '{{ $category->name }}'; selectedSlug = '{{ $category->slug }}'; open = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-brand hover:text-white transition">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product or brand here..."
                    class="flex-1 bg-gray-50 border-y border-r md:border-r-0 border-gray-200 px-4 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand">
                <button type="submit" class="bg-brand text-white px-6 py-2 rounded-r-lg hover:bg-brand-strong transition-all flex items-center">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <span class="hidden lg:inline uppercase font-black text-xs tracking-widest">Search</span>
                </button>
            </form>

            <!-- Icons -->
            <div class="flex items-center space-x-5 text-gray-700">
                <a href="{{ route('cart.index') }}" class="relative p-1 hover:text-brand transition group flex items-center space-x-2">
                    <div class="relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        <span class="absolute -top-1 -right-1 bg-brand text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">{{ count((array) session('cart')) }}</span>
                    </div>
                </a>
                <a href="{{ route('dashboard') }}" class="p-1 hover:text-brand transition hidden md:block" title="My Account">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </a>
                <!-- Mobile Menu Button -->
                <button @click="mobileMenu = true" class="md:hidden p-1 hover:text-brand transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>

        <!-- Mobile Search (Tablet/Mobile) -->
        <form action="{{ route('shop.index') }}" method="GET" class="md:hidden px-4 pb-4">
            <div class="relative flex">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product..."
                    class="w-full bg-gray-100 border-none rounded-lg px-4 py-2 text-sm focus:ring-1 focus:ring-brand">
                <button type="submit" class="absolute right-3 top-2 text-gray-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
            </div>
        </form>

        <!-- Mobile Offcanvas Menu (Alpine.js) -->
        <div x-show="mobileMenu" 
             style="display: none;"
             class="fixed inset-0 z-[105] md:hidden" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <!-- Backdrop -->
            <div class="absolute inset-0 bg-gray-900/40 backdrop-blur-sm" @click="mobileMenu = false"></div>
            
            <!-- Menu Content -->
            <div class="absolute right-0 top-0 bottom-0 w-80 bg-white shadow-2xl flex flex-col"
                 x-show="mobileMenu"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full">
                
                <div class="p-8 border-b border-gray-50 flex items-center justify-between bg-brand text-white">
                    <span class="text-xl font-black lowercase tracking-tighter">Explore menu.</span>
                    <button @click="mobileMenu = false" class="p-2 hover:bg-white/10 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto p-8 pb-32 space-y-10">
                    <!-- Main Nav -->
                    <div class="space-y-4">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest pl-1">Primary Navigation</p>
                        <nav class="flex flex-col space-y-2">
                            <a href="{{ route('home') }}" class="px-5 py-4 bg-gray-50 text-gray-900 rounded-2xl text-xs font-black uppercase tracking-widest flex items-center justify-between group decoration-0">
                                <span>Home</span>
                                <svg class="w-4 h-4 text-brand transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                            <a href="{{ route('shop.index') }}" class="px-5 py-4 hover:bg-gray-50 text-gray-900 rounded-2xl text-xs font-black uppercase tracking-widest flex items-center justify-between group decoration-0">
                                <span>Shop Gallery</span>
                                <svg class="w-4 h-4 text-gray-200 transform group-hover:translate-x-1 group-hover:text-brand transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </nav>
                    </div>

                    <!-- Category List -->
                    <div class="space-y-4">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest pl-1">Boutique Categories</p>
                        <nav class="flex flex-col space-y-1">
                            @foreach($global_categories ?? [] as $category)
                            <a href="{{ route('shop.index', ['category' => $category->slug]) }}" class="px-5 py-3 hover:text-brand text-gray-900 text-sm font-bold transition flex items-center space-x-3">
                                <div class="w-1.5 h-1.5 bg-brand/20 rounded-full group-hover:bg-brand"></div>
                                <span>{{ $category->name }}</span>
                            </a>
                            @endforeach
                        </nav>
                    </div>

                    <!-- User Account -->
                    @auth
                    <div class="pt-10 border-t border-gray-50 space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-brand text-white rounded-2xl flex items-center justify-center font-black">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-xs font-black text-gray-900 tracking-tight">{{ auth()->user()->name }}</p>
                                <a href="{{ route('dashboard') }}" class="text-[10px] font-bold text-gray-400 uppercase tracking-widest hover:text-brand">Manage Account</a>
                            </div>
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full py-4 bg-gray-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl">Secure Logout</button>
                        </form>
                    </div>
                    @else
                    <div class="pt-10 border-t border-gray-50 grid grid-cols-2 gap-4">
                        <a href="{{ route('login') }}" class="py-4 bg-gray-900 text-white text-center rounded-2xl text-[9px] font-black uppercase tracking-widest">Sign In</a>
                        <a href="{{ route('register') }}" class="py-4 bg-brand text-white text-center rounded-2xl text-[9px] font-black uppercase tracking-widest">Join Us</a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 pt-16 pb-8 mt-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- Branding -->
                <div class="space-y-6">
                    <a href="/" class="text-2xl font-bold tracking-tight">{{ $global_settings['app_name'] ?? 'BeliBeli' }}</a>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        {{ $global_settings['meta_description'] ?? 'Your one-stop destination for premium fashion and quality lifestyle products.' }}
                    </p>
                    <div class="flex space-x-4">
                        @if(isset($global_settings['facebook_url'])) <a href="{{ $global_settings['facebook_url'] }}" class="text-gray-400 hover:text-brand transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.77,7.46H14.5v-1.9c0-.9.6-1.1,1-1.1h3V.5h-4.33C10.24.5,9.5,3.44,9.5,5.32v2.14h-3v4.38h3v11.66h5V11.84h4.05Z"/></svg></a> @endif
                        @if(isset($global_settings['twitter_url'])) <a href="{{ $global_settings['twitter_url'] }}" class="text-gray-400 hover:text-brand transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.954 4.569c-.885.392-1.83.656-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.555-2.005.959-3.127 1.184-.896-.959-2.173-1.559-3.591-1.559-2.717 0-4.92 2.203-4.92 4.917 0 .39.045.765.127 1.124C7.691 8.094 4.066 6.13 1.54 3.161c-.427.732-.672 1.583-.672 2.492 0 1.701.869 3.203 2.189 4.084-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-.39 0-.779-.023-1.17-.067 2.189 1.394 4.768 2.209 7.557 2.209 9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63.961-.689 1.8-1.56 2.46-2.548l-.047-.02z"/></svg></a> @endif
                        @if(isset($global_settings['instagram_url'])) <a href="{{ $global_settings['instagram_url'] }}" class="text-gray-400 hover:text-brand transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069z"/></svg></a> @endif
                    </div>
                </div>

                <!-- Column 2 -->
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider mb-6">Shopping</h4>
                    <ul class="space-y-4 text-sm text-gray-500">
                        <li><a href="#" class="hover:text-brand transition">New Arrivals</a></li>
                        <li><a href="#" class="hover:text-brand transition">Popular Sales</a></li>
                        <li><a href="#" class="hover:text-brand transition">Discount Collection</a></li>
                        <li><a href="#" class="hover:text-brand transition">Official Store</a></li>
                    </ul>
                </div>

                <!-- Column 3 -->
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider mb-6">Customer Service</h4>
                    <ul class="space-y-4 text-sm text-gray-500">
                        <li><a href="#" class="hover:text-brand transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-brand transition">Return & Exchanges</a></li>
                        <li><a href="#" class="hover:text-brand transition">Shipping & Delivery</a></li>
                        <li><a href="#" class="hover:text-brand transition">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Column 4 -->
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider mb-6">Contact Us</h4>
                    <ul class="space-y-4 text-sm text-gray-500">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-3 mt-0.5 text-brand shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>{{ $global_settings['address'] ?? 'Dhaka, Bangladesh' }}</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-3 mt-0.5 text-brand shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>{{ $global_settings['contact_email'] ?? 'support@belibeli.com' }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="border-t border-gray-100 pt-8 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 text-xs text-gray-400">
                <p>&copy; {{ date('Y') }} {{ $global_settings['app_name'] ?? 'BeliBeli' }}. All rights reserved.</p>
                <div class="flex items-center space-x-6">
                    <a href="#" class="hover:text-brand transition">Privacy Policy</a>
                    <a href="#" class="hover:text-brand transition">Terms of Service</a>
                    <a href="#" class="hover:text-brand transition">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- App-Style Bottom Mobile Navigation -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-md border-t border-gray-100 px-6 py-3 z-[100] shadow-[0_-4px_10px_rgba(0,0,0,0.03)] flex items-center justify-between">
        <!-- Home Link -->
        <a href="{{ route('home') }}" class="flex flex-col items-center space-y-1 {{ request()->routeIs('home') ? 'text-brand' : 'text-gray-400 hover:text-brand' }} transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            <span class="text-[9px] font-black uppercase tracking-widest">Home</span>
        </a>

        <!-- Shop/Store Link -->
        <a href="{{ route('shop.index') }}" class="flex flex-col items-center space-y-1 {{ request()->is('shop*') ? 'text-brand' : 'text-gray-400 hover:text-brand' }} transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            <span class="text-[9px] font-black uppercase tracking-widest">Store</span>
        </a>

        <!-- Cart Link (Floating Highlight) -->
        <a href="{{ route('cart.index') }}" class="relative -mt-8 bg-brand w-14 h-14 rounded-full flex items-center justify-center text-white shadow-lg shadow-brand/30 border-4 border-white transition-transform active:scale-90">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            <span class="absolute -top-1 -right-1 bg-gray-900 border-2 border-white text-white text-[9px] font-black w-5 h-5 rounded-full flex items-center justify-center">{{ count((array) session('cart')) }}</span>
        </a>

        <!-- Wishlist Link -->
        <a href="#" class="flex flex-col items-center space-y-1 text-gray-400 hover:text-brand transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            <span class="text-[9px] font-black uppercase tracking-widest">Saved</span>
        </a>

        <!-- Account Link -->
        <a href="{{ route('dashboard') }}" class="flex flex-col items-center space-y-1 {{ request()->is('dashboard*') || request()->is('settings*') || request()->is('orders*') ? 'text-brand' : 'text-gray-400 hover:text-brand' }} transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            <span class="text-[9px] font-black uppercase tracking-widest">Account</span>
        </a>
    </div>

    <!-- Notifications Hub (Orange Toast) -->
    @if(session('success'))
    <div x-data="{ show: true }" 
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-y-20 opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-y-0 opacity-100"
         x-transition:leave-end="translate-y-20 opacity-0"
         class="fixed bottom-24 right-4 md:right-8 z-[200]">
        <div class="bg-gray-900 border-l-4 border-brand text-white px-8 py-5 rounded-[25px] shadow-2xl flex items-center space-x-6">
            <div class="w-10 h-10 bg-brand rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-brand mb-1">Success Journey</p>
                <p class="text-xs font-bold text-white lowercase tracking-tight">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

</body>

</html>
