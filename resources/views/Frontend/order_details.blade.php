@extends('Layouts.frontend')

@section('content')
<div class="bg-gray-50 min-h-screen py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Modern Horizontal Header (Subtle Shadow) -->
        <div class="bg-white rounded-[20px] p-8 mb-8 shadow-sm flex flex-col md:flex-row items-center justify-between border border-gray-100">
            <div class="flex items-center space-x-6">
                <div class="relative">
                    <div class="w-16 h-16 bg-brand/10 text-brand rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </div>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Order #{{ $order->order_number }}</h1>
                    <p class="text-gray-500 text-sm mt-1">Placed on {{ $order->created_at->format('M d, Y - h:i A') }}</p>
                </div>
            </div>
            <div class="mt-6 md:mt-0">
                <a href="{{ route('orders.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl text-sm hover:bg-gray-200 transition-all">
                    &larr; Back to Orders
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            <!-- Left Area: Order Items & Pricing -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Items list -->
                <div class="bg-white rounded-[20px] shadow-sm border border-gray-100 overflow-hidden p-6 space-y-6">
                    <h2 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-4">Items Ordered</h2>
                    
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                        <div class="flex items-center space-x-4 border border-gray-50 rounded-xl p-4 hover:shadow-sm transition bg-gray-50/50">
                            <div class="w-20 h-20 bg-white rounded-lg border border-gray-100 flex-shrink-0 flex items-center justify-center overflow-hidden">
                                <img src="{{ Str::startsWith($item->product->image1, 'http') ? $item->product->image1 : asset('uploads/product/'.$item->product->image1) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <a href="{{ route('product.show', $item->product->slug) }}" class="font-bold text-gray-900 hover:text-brand line-clamp-1">{{ $item->product->name }}</a>
                                <p class="text-xs text-gray-500 mt-1">Quantity: <span class="font-bold">{{ $item->quantity }}</span></p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900">৳{{ number_format($item->price, 2) }}</p>
                                <p class="text-xs text-gray-400 mt-1 line-through">৳{{ number_format($item->product->discount_price > 0 ? $item->product->regular_price : 0, 2) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Summary -->
                <div class="bg-white rounded-[20px] shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-4 mb-4">Payment Summary</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center text-gray-600">
                            <span>Subtotal</span>
                            <span class="font-bold text-gray-900">৳{{ number_format($order->total_amount - $order->shipping_cost, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center text-gray-600 border-b border-gray-100 pb-4">
                            <span>Shipping Cost</span>
                            <span class="font-bold text-brand">+ ৳{{ number_format($order->shipping_cost, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center text-xl font-black text-gray-900 pt-2">
                            <span>Total</span>
                            <span>৳{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Area: Info cards -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Status Card -->
                <div class="bg-white rounded-[20px] shadow-sm border border-gray-100 p-6">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Order Status</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-bold text-gray-700">Payment</span>
                            @php
                                $pmtClass = [
                                    'pending' => 'bg-amber-50 text-amber-600',
                                    'completed' => 'bg-green-50 text-green-600',
                                    'failed' => 'bg-red-50 text-red-600',
                                ][$order->payment_status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $pmtClass }}">
                                {{ $order->payment_status }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-bold text-gray-700">Fulfillment</span>
                            @php
                                $ordClass = [
                                    'pending' => 'bg-amber-50 text-amber-600',
                                    'processing' => 'bg-blue-50 text-blue-600',
                                    'shipped' => 'bg-indigo-50 text-indigo-600',
                                    'delivered' => 'bg-green-50 text-green-600',
                                    'cancelled' => 'bg-red-50 text-red-600',
                                ][$order->order_status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $ordClass }}">
                                {{ $order->order_status }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Delivery Address -->
                <div class="bg-white rounded-[20px] shadow-sm border border-gray-100 p-6">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Shipping Info</h3>
                    <div class="space-y-2 text-sm text-gray-600">
                        <p><span class="font-bold text-gray-900">Name:</span> {{ $order->full_name }}</p>
                        <p><span class="font-bold text-gray-900">Phone:</span> {{ $order->phone }}</p>
                        <p class="pt-2">
                            <span class="block font-bold text-gray-900 mb-1">Address:</span>
                            {{ $order->address }}<br>
                            {{ $order->city }} {{ $order->postal_code ? " - " . $order->postal_code : "" }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
