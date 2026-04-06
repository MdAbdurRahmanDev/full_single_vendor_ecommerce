<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('meta_title', $global_settings['meta_title'] ?? ($global_settings['app_name'] ?? 'Ecommerce'))</title>
    <meta name="description" content="@yield('meta_description', $global_settings['meta_description'] ?? '')">
    <meta name="keywords" content="@yield('meta_keywords', $global_settings['meta_keywords'] ?? '')">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph (Facebook / LinkedIn) -->
    <meta property="og:title" content="@yield('meta_title', $global_settings['meta_title'] ?? ($global_settings['app_name'] ?? 'Ecommerce'))">
    <meta property="og:description" content="@yield('meta_description', $global_settings['meta_description'] ?? '')">
    <meta property="og:image" content="@yield('meta_image', isset($global_settings['logo']) ? asset('uploads/settings/' . $global_settings['logo']) : '')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="@yield('meta_type', 'website')">
    <meta property="og:site_name" content="{{ $global_settings['app_name'] ?? 'Ecommerce' }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('meta_title', $global_settings['meta_title'] ?? ($global_settings['app_name'] ?? 'Ecommerce'))">
    <meta name="twitter:description" content="@yield('meta_description', $global_settings['meta_description'] ?? '')">
    <meta name="twitter:image" content="@yield('meta_image', isset($global_settings['logo']) ? asset('uploads/settings/' . $global_settings['logo']) : '')">

    <!-- Canonical URL -->
    <link rel="canonical" href="@yield('canonical_url', url()->current())">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('build/assets/app-Css23kEQ.css') }}">
    <script src="{{ asset('build/assets/app-BbcFlrf5.js') }}"></script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900">


    <!-- Main Header -->
    <header x-data="{ mobileMenu: false }" class="bg-white sticky top-0 z-[100] shadow-sm border-b border-gray-100">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between gap-4 md:gap-8">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="shrink-0">
                @if (isset($global_settings['logo']))
                    <img src="{{ asset('uploads/settings/' . $global_settings['logo']) }}" alt="Logo"
                        class="h-8 md:h-10">
                @else
                    <span
                        class="text-2xl font-bold text-gray-900 tracking-tight">{{ $global_settings['app_name'] ?? 'BeliBeli' }}</span>
                @endif
            </a>


            <!-- Icons -->
            <div class="flex items-center space-x-5 text-gray-700">
                <a href="{{ route('cart.index') }}"
                    class="relative p-1 hover:text-brand transition group flex items-center space-x-2">
                    <div class="relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span
                            class="absolute -top-1 -right-1 bg-brand text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">{{ count((array) session('cart')) }}</span>
                    </div>
                </a>
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="p-1 hover:text-brand transition hidden md:flex items-center space-x-1.5 group"
                        title="Dashboard">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-sm font-semibold">Dashboard</span>
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="p-1 hover:text-brand transition hidden md:flex items-center space-x-1.5 group"
                        title="Login / Register">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-sm font-semibold">Login/Register</span>
                    </a>
                @endauth
                <!-- Mobile Menu Button -->
                <button @click="mobileMenu = true" class="md:hidden p-1 hover:text-brand transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Search (Tablet/Mobile) -->
        <form action="{{ route('shop.index') }}" method="GET" class="md:hidden px-4 pb-4">
            <div class="relative flex">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product..."
                    class="w-full bg-gray-100 border-none rounded-lg px-4 py-2 text-sm focus:ring-1 focus:ring-brand">
                <button type="submit" class="absolute right-3 top-2 text-gray-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </form>

        <!-- Mobile Offcanvas Menu (Alpine.js) -->
        <div x-show="mobileMenu" style="display: none;" class="fixed inset-0 z-[105] md:hidden"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            <!-- Backdrop -->
            <div class="absolute inset-0 bg-gray-900/40 backdrop-blur-sm" @click="mobileMenu = false"></div>

            <!-- Menu Content -->
            <div class="absolute right-0 top-0 bottom-0 w-80 bg-white shadow-2xl flex flex-col" x-show="mobileMenu"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">

                <div class="p-8 border-b border-gray-50 flex items-center justify-between bg-brand text-white">
                    <span class="text-xl font-black lowercase tracking-tighter">Explore menu.</span>
                    <button @click="mobileMenu = false" class="p-2 hover:bg-white/10 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto p-8 pb-32 space-y-10">
                    <!-- Main Nav -->
                    <div class="space-y-4">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest pl-1">Primary
                            Navigation</p>
                        <nav class="flex flex-col space-y-2">
                            <a href="{{ route('home') }}"
                                class="px-5 py-4 bg-gray-50 text-gray-900 rounded-2xl text-xs font-black uppercase tracking-widest flex items-center justify-between group decoration-0">
                                <span>Home</span>
                                <svg class="w-4 h-4 text-brand transform group-hover:translate-x-1 transition"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                            <a href="{{ route('shop.index') }}"
                                class="px-5 py-4 hover:bg-gray-50 text-gray-900 rounded-2xl text-xs font-black uppercase tracking-widest flex items-center justify-between group decoration-0">
                                <span>Shop Gallery</span>
                                <svg class="w-4 h-4 text-gray-200 transform group-hover:translate-x-1 group-hover:text-brand transition"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                            <a href="#" @click.prevent="$dispatch('open-calorie-modal'); mobileMenu = false"
                                class="px-5 py-4 hover:bg-gray-50 text-gray-900 rounded-2xl text-xs font-black uppercase tracking-widest flex items-center justify-between group decoration-0">
                                <span>Calorie Calculator</span>
                                <svg class="w-4 h-4 text-gray-200 transform group-hover:translate-x-1 group-hover:text-brand transition"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </nav>
                    </div>

                    <!-- Category List -->
                    <div class="space-y-4">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest pl-1">Boutique
                            Categories</p>
                        <nav class="flex flex-col space-y-1">
                            @foreach ($global_categories ?? [] as $category)
                                <a href="{{ route('shop.index', ['category' => $category->slug ?? '']) }}"
                                    class="px-5 py-4 hover:bg-gray-50 text-gray-900 rounded-2xl text-[10px] font-black uppercase tracking-widest flex items-center justify-between group decoration-0">
                                    <span>{{ $category->name ?? 'Category' }}</span>
                                    <span
                                        class="text-gray-200 text-[10px] group-hover:text-brand transition">{{ $category->products_count ?? 0 }}
                                        items</span>
                                </a>
                            @endforeach
                        </nav>
                    </div>

                    <!-- User Account -->
                    @auth
                        <div class="pt-10 border-t border-gray-50 space-y-6">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-12 h-12 bg-brand text-white rounded-2xl flex items-center justify-center font-black">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-xs font-black text-gray-900 tracking-tight">{{ auth()->user()->name }}
                                    </p>
                                    <a href="{{ route('dashboard') }}"
                                        class="text-[10px] font-bold text-gray-400 uppercase tracking-widest hover:text-brand">Manage
                                        Account</a>
                                </div>
                            </div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full py-4 bg-gray-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl">Secure
                                    Logout</button>
                            </form>
                        </div>
                    @else
                        <div class="pt-10 border-t border-gray-50 grid grid-cols-2 gap-4">
                            <a href="{{ route('login') }}"
                                class="py-4 bg-gray-900 text-white text-center rounded-2xl text-[9px] font-black uppercase tracking-widest">Sign
                                In</a>
                            <a href="{{ route('register') }}"
                                class="py-4 bg-brand text-white text-center rounded-2xl text-[9px] font-black uppercase tracking-widest">Join
                                Us</a>
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
    <footer class="bg-white border-t border-gray-200 pb-8 mt-20">
        <div class="container mx-auto px-4">

            <!-- Bottom Footer -->
            <div
                class="border-t border-gray-100 pt-8 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 text-xs text-gray-400">
                <p>&copy; {{ date('Y') }} {{ $global_settings['app_name'] ?? 'BeliBeli' }}. All rights reserved.
                </p>
                <div class="flex items-center space-x-6">
                    <a href="#" class="hover:text-brand transition">Privacy Policy</a>
                    <a href="#" class="hover:text-brand transition">Terms of Service</a>
                    <a href="#" class="hover:text-brand transition">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- App-Style Bottom Mobile Navigation -->
    <div x-data="{}"
        class="md:hidden fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-md border-t border-gray-100 px-6 py-3 z-[100] shadow-[0_-4px_10px_rgba(0,0,0,0.03)] flex items-center justify-between">
        <!-- Home Link -->
        <a href="{{ route('home') }}"
            class="flex flex-col items-center space-y-1 {{ request()->routeIs('home') ? 'text-brand' : 'text-gray-400 hover:text-brand' }} transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="text-[9px] font-black uppercase tracking-widest">Home</span>
        </a>

        <!-- Shop/Store Link -->
        <a href="{{ route('shop.index') }}"
            class="flex flex-col items-center space-y-1 {{ request()->is('shop*') ? 'text-brand' : 'text-gray-400 hover:text-brand' }} transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
            <span class="text-[9px] font-black uppercase tracking-widest">Store</span>
        </a>

        <!-- Cart Link (Floating Highlight) -->
        <a href="{{ route('cart.index') }}"
            class="relative -mt-8 bg-brand w-14 h-14 rounded-full flex items-center justify-center text-white shadow-lg shadow-brand/30 border-4 border-white transition-transform active:scale-90">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span
                class="absolute -top-1 -right-1 bg-gray-900 border-2 border-white text-white text-[9px] font-black w-5 h-5 rounded-full flex items-center justify-center">{{ count((array) session('cart')) }}</span>
        </a>

        <!-- Calorie Calculator Link -->
        <a href="#" @click.prevent="$dispatch('open-calorie-modal')"
            class="flex flex-col items-center space-y-1 text-gray-400 hover:text-brand transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
            </svg>
            <span class="text-[9px] font-black uppercase tracking-widest">Calorie</span>
        </a>

        <!-- Account Link -->
        <a href="{{ route('dashboard') }}"
            class="flex flex-col items-center space-y-1 {{ request()->is('dashboard*') || request()->is('settings*') || request()->is('orders*') ? 'text-brand' : 'text-gray-400 hover:text-brand' }} transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="text-[9px] font-black uppercase tracking-widest">Account</span>
        </a>
    </div>

    <!-- Global Notifications Hub (Alpine.js) -->
    <div x-data="{
        messages: [],
        add(msg, type = 'success') {
            const id = Date.now();
            this.messages.push({ id, text: msg, type });
            setTimeout(() => {
                this.messages = this.messages.filter(m => m.id !== id);
            }, 4000);
        }
    }" @notify.window="add($event.detail.message, $event.detail.type)"
        class="fixed bottom-24 right-4 md:right-8 z-[250] space-y-4">

        <template x-for="message in messages" :key="message.id">
            <div x-show="true" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-y-20 opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="translate-y-0 opacity-100" x-transition:leave-end="translate-y-20 opacity-0"
                class="bg-gray-900 border-l-4 border-brand text-white px-8 py-5 rounded-[25px] shadow-2xl flex items-center space-x-6 min-w-[300px]">
                <div class="w-10 h-10 bg-brand rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-brand mb-1"
                        x-text="message.type === 'success' ? 'Success Journey' : 'Alert'"></p>
                    <p class="text-xs font-bold text-white lowercase tracking-tight" x-text="message.text"></p>
                </div>
            </div>
        </template>

        {{-- Session Success Template --}}
        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition:enter="..." ...
                class="bg-gray-900 border-l-4 border-brand text-white px-8 py-5 rounded-[25px] shadow-2xl flex items-center space-x-6">
                <div class="w-10 h-10 bg-brand rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-brand mb-1">Success Journey</p>
                    <p class="text-xs font-bold text-white lowercase tracking-tight">{{ session('success') }}</p>
                </div>
            </div>
        @endif
        @if (session('error'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition:enter="..." ...
                class="bg-red-600 border-l-4 border-red-800 text-white px-8 py-5 rounded-[25px] shadow-2xl flex items-center space-x-6">
                <div class="w-10 h-10 bg-red-800 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-white/50 mb-1">Error Occurred</p>
                    <p class="text-xs font-bold text-white lowercase tracking-tight">{{ session('error') }}</p>
                </div>
            </div>
        @endif
    </div>

    <script>
        function toggleWishlist(productId) {
            fetch('/wishlist/toggle/' + productId, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(async response => {
                    const data = await response.json();
                    if (response.status === 401) {
                        window.location.href = '/login';
                        return;
                    }

                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: {
                            message: data.message,
                            type: 'success'
                        }
                    }));
                })
                .catch(error => {
                    console.error('Wishlist Error:', error);
                });
        }
    </script>

    @include('Frontend.partials.calorie_calculator')

</body>

</html>
