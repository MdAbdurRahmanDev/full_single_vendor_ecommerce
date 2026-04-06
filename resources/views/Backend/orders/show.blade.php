@extends('Layouts.app')

@section('admin')
<div class="p-6 space-y-8 max-w-4xl">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-heading">Order Details</h2>
            <p class="text-sm text-body-light mt-1">Management of Order #{{ $order->order_number }}</p>
        </div>
        <a href="{{ route('admin.order.index') }}" class="text-xs font-bold text-gray-400 hover:text-brand uppercase tracking-widest flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to list
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
        <!-- Customer Info -->
        <div class="bg-white rounded-2xl shadow-sm border border-default p-8 space-y-6">
            <div class="flex items-center space-x-4 border-b border-default pb-4">
                <div class="w-12 h-12 rounded-xl bg-brand-soft text-brand flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <div>
                   <h3 class="text-xs font-black uppercase tracking-widest text-gray-400">Customer Profile</h3>
                   <p class="text-lg font-bold text-heading">{{ $order->full_name }}</p>
                </div>
            </div>
            
            <div class="space-y-4">
                <div class="flex flex-col">
                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Email Address</span>
                    <span class="font-bold text-gray-900">{{ $order->email ?? 'Not provided' }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Phone Number</span>
                    <span class="font-bold text-gray-900">{{ $order->phone }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Shipping Destination</span>
                    <span class="font-bold text-gray-900 leading-relaxed">{{ $order->address }}, {{ $order->city }} ({{ $order->postal_code }})</span>
                </div>
            </div>
        </div>

        <!-- Management Area -->
        <div class="bg-white rounded-2xl shadow-sm border border-default p-8 space-y-6">
            <h3 class="text-xs font-black uppercase tracking-widest text-gray-400 flex items-center">
               <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
               Update Status
            </h3>
            
            <form action="{{ route('admin.order.status', $order->id) }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Order Stage</label>
                    <select name="order_status" class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 text-sm font-bold text-gray-900 focus:ring-1 focus:ring-brand focus:border-brand outline-none transition uppercase">
                        <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Payment Status</label>
                    <div class="flex items-center space-x-6">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" name="payment_status" value="pending" {{ $order->payment_status == 'pending' ? 'checked' : '' }} class="text-brand focus:ring-brand">
                            <span class="text-xs font-bold uppercase text-gray-500">Unpaid</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" name="payment_status" value="paid" {{ $order->payment_status == 'paid' ? 'checked' : '' }} class="text-green-500 focus:ring-green-500">
                            <span class="text-xs font-bold uppercase text-green-600">Paid In Full</span>
                        </label>
                    </div>
                </div>

                <button type="submit" class="w-full bg-gray-900 text-white py-4 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-brand transition-all shadow-xl active:scale-95 transform">
                    Apply Status Changes
                </button>
            </form>
        </div>
    </div>

    <!-- Product Summary -->
    <div class="bg-white rounded-2xl shadow-sm border border-default p-8">
        <h3 class="text-xs font-black uppercase tracking-widest text-gray-400 mb-8 flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            Review Basket Items
        </h3>
        <div class="space-y-6">
            @foreach($order->items as $item)
            <div class="flex items-center justify-between pb-6 border-b border-default last:border-0 last:pb-0">
                <div class="flex items-center space-x-4">
                    <img src="{{ filter_var($item->product->thumbnail, FILTER_VALIDATE_URL) ? $item->product->thumbnail : asset('uploads/products/'.$item->product->thumbnail) }}" class="w-12 h-12 rounded-lg object-cover shadow-sm bg-gray-100" alt="{{ $item->product->name }}">
                    <div>
                        <p class="text-sm font-black text-gray-900 tracking-tight lowercase">{{ $item->product->name }}</p>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Qty: {{ $item->quantity }} × ৳{{ number_format($item->price, 2) }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm font-black text-gray-900 tracking-tight">৳{{ number_format($item->price * $item->quantity, 2) }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-10 pt-10 border-t border-default space-y-4">
            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-400 font-bold uppercase tracking-widest text-[10px]">Shipping (Fixed Fee)</span>
                <span class="text-gray-900 font-black">৳{{ number_format($order->shipping_cost, 2) }}</span>
            </div>
            <div class="flex justify-between items-center text-xl">
                <span class="text-gray-900 font-black tracking-tight lowercase">Grand total.</span>
                <span class="text-3xl font-black text-brand tracking-tighter">৳{{ number_format($order->total_amount, 2) }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
