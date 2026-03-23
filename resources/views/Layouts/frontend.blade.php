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
                <a href="#" class="hover:text-brand transition">Help</a>
                <a href="#" class="hover:text-brand transition">About Us</a>
                <a href="#" class="hover:text-brand transition">Track Order</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="font-semibold text-brand">My Account</a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-brand transition">Sign In</a>
                    <span class="text-gray-300">/</span>
                    <a href="#" class="hover:text-brand transition">Register</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="bg-white sticky top-0 z-50 shadow-sm border-b border-gray-100">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between gap-4 md:gap-8">
            <!-- Logo -->
            <a href="/" class="shrink-0">
                @if(isset($global_settings['logo']))
                    <img src="{{ asset('uploads/settings/' . $global_settings['logo']) }}" alt="Logo" class="h-8 md:h-10">
                @else
                    <span class="text-2xl font-bold text-gray-900 tracking-tight">{{ $global_settings['app_name'] ?? 'BeliBeli' }}</span>
                @endif
            </a>

            <!-- Search Bar (Desktop) -->
            <div class="hidden md:flex flex-1 max-w-2xl relative items-center">
                <div x-data="{ open: false }" class="relative shrink-0">
                    <button @click="open = !open" class="flex items-center px-4 py-2 bg-gray-50 border border-gray-200 rounded-l-lg text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none">
                        All Category
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-xl z-50 overflow-hidden">
                        @foreach($global_categories ?? [] as $category)
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>
                <input type="text" placeholder="Search product or brand here..."
                    class="flex-1 bg-gray-50 border-y border-r md:border-r-0 border-gray-200 px-4 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand">
                <button class="bg-brand text-white px-6 py-2 rounded-r-lg hover:bg-brand-strong transition-all flex items-center">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <span class="hidden lg:inline">Search</span>
                </button>
            </div>

            <!-- Icons -->
            <div class="flex items-center space-x-5 text-gray-700">
                <a href="#" class="relative p-1 hover:text-brand transition group">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    <span class="absolute -top-1 -right-1 bg-brand text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">0</span>
                </a>
                <a href="#" class="p-1 hover:text-brand transition hidden md:block">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                </a>
                <!-- Mobile Menu Button -->
                <button class="md:hidden p-1 hover:text-brand transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>

        <!-- Mobile Search (Tablet/Mobile) -->
        <div class="md:hidden px-4 pb-4">
            <div class="relative flex">
                <input type="text" placeholder="Search product..."
                    class="w-full bg-gray-100 border-none rounded-lg px-4 py-2 text-sm focus:ring-1 focus:ring-brand">
                <button class="absolute right-3 top-2 text-gray-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
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

</body>

</html>
