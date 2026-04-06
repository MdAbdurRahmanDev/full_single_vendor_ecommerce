@extends('Layouts.app')

@section('admin')
<div class="p-6 space-y-8">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-heading">Orders Management</h2>
            <p class="text-sm text-body-light mt-1">Manage and track all store transactions</p>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-default overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-default">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-heading uppercase tracking-wider">Order Info</th>
                    <th class="px-6 py-4 text-xs font-bold text-heading uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-4 text-xs font-bold text-heading uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-4 text-xs font-bold text-heading uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-xs font-bold text-heading uppercase tracking-wider">Date</th>
                    <th class="px-6 py-4 text-xs font-bold text-heading uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-default">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-heading">#{{ $order->order_number }}</span>
                            <span class="text-[10px] text-body-light uppercase tracking-widest">{{ $order->payment_method }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-heading">{{ $order->full_name }}</span>
                            <span class="text-xs text-body-light">{{ $order->phone }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm font-bold text-heading">৳{{ number_format($order->total_amount, 2) }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col space-y-1">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider w-fit
                                {{ $order->order_status == 'pending' ? 'bg-orange-50 text-orange-600' : '' }}
                                {{ $order->order_status == 'processing' ? 'bg-blue-50 text-blue-600' : '' }}
                                {{ $order->order_status == 'shipped' ? 'bg-indigo-50 text-indigo-600' : '' }}
                                {{ $order->order_status == 'delivered' ? 'bg-green-50 text-green-600' : '' }}
                                {{ $order->order_status == 'cancelled' ? 'bg-red-50 text-red-600' : '' }}
                            ">
                                {{ $order->order_status }}
                            </span>
                            <span class="text-[10px] font-bold uppercase {{ $order->payment_status == 'paid' ? 'text-green-500' : 'text-gray-400' }}">
                                {{ $order->payment_status }}
                            </span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-body">
                        {{ $order->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <button type="button" @click="window.location.href='{{ route('admin.order.show', $order->id) }}'" class="text-blue-600 hover:text-blue-800 font-bold text-xs uppercase">View</button>
                        <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600 hover:text-red-800 font-bold text-xs uppercase">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-20 text-center text-body-light">No orders found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="px-6 py-4 border-t border-default">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
