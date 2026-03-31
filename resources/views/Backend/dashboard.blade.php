@extends('Layouts.app')

@section('admin')
    <div class="p-6 space-y-8">
        <h2 class="text-3xl font-bold text-heading">Dashboard Overview</h2>

        <!-- Sales & Order Statistics -->
        <div>
            <h3 class="text-lg font-semibold text-body-light mb-4 uppercase tracking-wider flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Performance Snapshot
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Total Revenue Card -->
                <div class="bg-gray-900 rounded-2xl shadow-xl p-6 border-b-4 border-brand">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-brand/10 text-brand flex items-center justify-center">
                            <span class="text-xl font-bold">$</span>
                        </div>
                        <span class="text-[10px] font-black text-brand uppercase tracking-widest">Total Revenue</span>
                    </div>
                    <div class="flex flex-col">
                        <h3 class="text-3xl font-black text-white tracking-tighter">${{ number_format($totalRevenue, 2) }}</h3>
                        <p class="text-gray-400 text-xs mt-1 font-medium">Accumulated Earnings</p>
                    </div>
                </div>

                <!-- Total Orders Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-default p-6 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                        </div>
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Orders</span>
                    </div>
                    <div class="flex flex-col">
                        <h3 class="text-3xl font-black text-heading tracking-tighter">{{ $totalOrders }}</h3>
                        <p class="text-xs text-body-light mt-1 font-medium">Lifetime Activity</p>
                    </div>
                </div>

                <!-- Pending Orders Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-default p-6 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center">
                             <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <span class="text-[10px] font-black text-orange-600 uppercase tracking-widest">Pending</span>
                    </div>
                    <div class="flex flex-col">
                        <h3 class="text-3xl font-black text-heading tracking-tighter">{{ $pendingOrders }}</h3>
                        <p class="text-xs text-body-light mt-1 font-medium">Awaiting Action</p>
                    </div>
                </div>

                <!-- Processing Orders Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-default p-6 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                        <span class="text-[10px] font-black text-indigo-600 uppercase tracking-widest">Active Process</span>
                    </div>
                    <div class="flex flex-col">
                        <h3 class="text-3xl font-black text-heading tracking-tighter">{{ $processingOrders }}</h3>
                        <p class="text-xs text-body-light mt-1 font-medium">In Warehouse</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category Statistics -->
        <div>
            <h3 class="text-lg font-semibold text-body-light mb-4 uppercase tracking-wider flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-brand" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                Category Metrics
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Categories Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-default p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-brand-soft text-brand flex items-center justify-center">
                            <span class="text-xl font-bold">∑</span>
                        </div>
                        <span class="text-xs font-bold text-body-light uppercase">All Categories</span>
                    </div>
                    <div class="flex flex-col">
                        <h3 class="text-3xl font-bold text-heading">{{ $totalCategories }}</h3>
                        <p class="text-sm text-body-light mt-1">Total count defined</p>
                    </div>
                </div>

                <!-- Active Categories Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-default p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-green-50 text-green-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-green-600 uppercase">Active</span>
                    </div>
                    <div class="flex flex-col">
                        <h3 class="text-3xl font-bold text-heading text-green-700">{{ $activeCategories }}</h3>
                        <p class="text-sm text-body-light mt-1">Ready for products</p>
                    </div>
                </div>

                <!-- Inactive Categories Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-default p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-orange-600 uppercase">Inactive</span>
                    </div>
                    <div class="flex flex-col">
                        <h3 class="text-3xl font-bold text-heading text-orange-700">{{ $inactiveCategories }}</h3>
                        <p class="text-sm text-body-light mt-1">Currently hidden</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Statistics -->
        <div>
            <h3 class="text-lg font-semibold text-body-light mb-4 uppercase tracking-wider flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                Inventory Metrics
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Products Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-default p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Total Inventory</span>
                    </div>
                    <div class="flex flex-col">
                        <h3 class="text-3xl font-bold text-heading">{{ $totalProducts }}</h3>
                        <p class="text-sm text-body-light mt-1">Unique items listed</p>
                    </div>
                </div>

                <!-- Active Products Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-default p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider">Live Storefront</span>
                    </div>
                    <div class="flex flex-col">
                        <h3 class="text-3xl font-bold text-heading text-indigo-700">{{ $activeProducts }}</h3>
                        <p class="text-sm text-body-light mt-1">Customer facing products</p>
                    </div>
                </div>

                <!-- Inactive Products Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-default p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-slate-50 text-slate-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-slate-600 uppercase tracking-wider">Hidden Stock</span>
                    </div>
                    <div class="flex flex-col">
                        <h3 class="text-3xl font-bold text-heading text-slate-700">{{ $inactiveProducts }}</h3>
                        <p class="text-sm text-body-light mt-1">Offline for maintenance</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
