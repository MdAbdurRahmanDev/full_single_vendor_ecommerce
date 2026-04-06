<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->order_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none; }
            body { background: white; }
            .print-padding { padding: 0 !important; }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="max-w-4xl mx-auto my-10 bg-white p-10 rounded-2xl shadow-sm print-padding print:shadow-none print:my-0">
        <!-- Header -->
        <div class="flex justify-between items-start border-b border-gray-100 pb-10 mb-10">
            <div>
                @if(isset($global_settings['logo']))
                    <img src="{{ asset('uploads/settings/' . $global_settings['logo']) }}" class="h-10 mb-4" alt="Logo">
                @else
                    <h1 class="text-3xl font-black text-gray-900 tracking-tighter">{{ $global_settings['app_name'] ?? 'BeliBeli' }}</h1>
                @endif
                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">{{ $global_settings['address'] ?? 'Official Store' }}</p>
                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">{{ $global_settings['phone'] ?? '+880 123 456789' }}</p>
            </div>
            <div class="text-right">
                <h2 class="text-4xl font-black text-gray-900 tracking-tighter uppercase mb-2">Invoice</h2>
                <p class="text-sm font-bold text-gray-900 tracking-tight">Order #{{ $order->order_number }}</p>
                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">Date: {{ $order->created_at->format('M d, Y') }}</p>
            </div>
        </div>

        <!-- Billing Info -->
        <div class="grid grid-cols-2 gap-10 mb-16">
            <div>
                <h3 class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] mb-4">Customer Details</h3>
                <p class="text-lg font-black text-gray-900 tracking-tight">{{ $order->full_name }}</p>
                <p class="text-sm font-medium text-gray-500 leading-relaxed max-w-[250px] mt-2">
                    {{ $order->address }}, {{ $order->city }}<br>
                    {{ $order->postal_code }}
                </p>
                <p class="text-sm font-bold text-gray-900 mt-3">{{ $order->phone }}</p>
                <p class="text-sm text-gray-500">{{ $order->email }}</p>
            </div>
            <div class="text-right">
                <h3 class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em] mb-4">Payment Information</h3>
                <p class="text-sm font-bold text-gray-900 uppercase tracking-tight">{{ $order->payment_method }}</p>
                <span class="inline-block mt-2 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest {{ $order->payment_status == 'paid' ? 'bg-green-50 text-green-600' : 'bg-orange-50 text-orange-600' }}">
                    {{ $order->payment_status }}
                </span>
            </div>
        </div>

        <!-- Table -->
        <div class="mb-16">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b-2 border-gray-900">
                        <th class="py-4 text-[10px] font-black text-gray-900 uppercase tracking-widest">Item Description</th>
                        <th class="py-4 text-center text-[10px] font-black text-gray-900 uppercase tracking-widest">Price</th>
                        <th class="py-4 text-center text-[10px] font-black text-gray-900 uppercase tracking-widest">Qty</th>
                        <th class="py-4 text-right text-[10px] font-black text-gray-900 uppercase tracking-widest">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($order->items as $item)
                    <tr>
                        <td class="py-6">
                            <p class="text-sm font-black text-gray-900 tracking-tight lowercase">{{ $item->product->name }}</p>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $item->product->category->name ?? 'Product' }}</p>
                        </td>
                        <td class="py-6 text-center text-sm font-bold text-gray-900 tracking-tight">৳{{ number_format($item->price, 2) }}</td>
                        <td class="py-6 text-center text-sm font-bold text-gray-900 tracking-tight">{{ $item->quantity }}</td>
                        <td class="py-6 text-right text-sm font-black text-gray-900 tracking-tight">৳{{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Totals -->
        <div class="flex justify-end pt-10 border-t-2 border-gray-900">
            <div class="w-64 space-y-4">
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-400 font-bold uppercase tracking-widest text-[10px]">Subtotal</span>
                    <span class="text-gray-900 font-black tracking-tight">৳{{ number_format($order->total_amount - $order->shipping_cost, 2) }}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-400 font-bold uppercase tracking-widest text-[10px]">Shipping</span>
                    <span class="text-gray-900 font-black tracking-tight">৳{{ number_format($order->shipping_cost, 2) }}</span>
                </div>
                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                    <span class="text-lg font-black text-gray-900 tracking-tighter lowercase">Amount Paid.</span>
                    <span class="text-2xl font-black text-brand tracking-tighter">৳{{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-20 pt-10 border-t border-gray-50 text-center">
            <p class="text-[10px] font-black text-gray-300 uppercase tracking-[0.3em]">Thank you for shopping with us</p>
        </div>
    </div>

    <!-- Actions -->
    <div class="fixed bottom-10 right-10 flex space-x-4 no-print">
        <button onclick="window.print()" class="bg-gray-900 text-white px-8 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-2xl hover:bg-brand transition-all active:scale-95 flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2-2H7a2 2 0 00-2 2v4"/></svg>
            Print Invoice
        </button>
        <button onclick="window.close()" class="bg-white text-gray-900 border border-gray-100 px-8 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-2xl hover:bg-gray-50 transition-all active:scale-95">
            Close Window
        </button>
    </div>
</body>
</html>
