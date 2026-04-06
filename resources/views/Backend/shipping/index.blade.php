@extends('Layouts.app')

@section('admin')
<div class="p-6 space-y-8">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-heading">Shipping Zones</h2>
            <p class="text-sm text-body-light mt-1">Manage delivery areas, costs, and availability</p>
        </div>
        <button data-modal-target="addZoneModal" data-modal-toggle="addZoneModal" class="bg-brand text-white px-6 py-2.5 rounded-xl text-sm font-bold uppercase tracking-widest hover:bg-brand-strong transition shadow-lg shadow-brand/30">
            + New Zone
        </button>
    </div>

    @if($errors->any())
    <div class="bg-red-50 text-red-600 p-4 rounded-xl">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-default overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-default">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-heading uppercase tracking-wider">Zone Name</th>
                    <th class="px-6 py-4 text-xs font-bold text-heading uppercase tracking-wider">Delivery Time</th>
                    <th class="px-6 py-4 text-xs font-bold text-heading uppercase tracking-wider">Cost</th>
                    <th class="px-6 py-4 text-xs font-bold text-heading uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-xs font-bold text-heading uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-default">
                @forelse($shipping_zones as $zone)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-sm font-bold text-heading">{{ $zone->name }}</td>
                    <td class="px-6 py-4 text-sm text-body">{{ $zone->delivery_time ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-sm font-black text-brand">৳{{ number_format($zone->cost, 2) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $zone->is_active ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                            {{ $zone->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <button type="button" data-modal-target="editZoneModal-{{ $zone->id }}" data-modal-toggle="editZoneModal-{{ $zone->id }}" class="text-blue-600 hover:text-blue-800 font-bold text-xs uppercase">Edit</button>
                        <form action="{{ route('admin.shipping_zones.destroy', $zone->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this shipping zone?')" class="text-red-600 hover:text-red-800 font-bold text-xs uppercase">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div id="editZoneModal-{{ $zone->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-2xl shadow-xl">
                            <div class="flex items-center justify-between p-4 md:p-5 border-b border-default rounded-t">
                                <h3 class="text-lg font-bold text-heading">Edit Shipping Zone</h3>
                                <button type="button" class="text-body-light bg-transparent hover:bg-gray-100 hover:text-heading rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="editZoneModal-{{ $zone->id }}">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                                </button>
                            </div>
                            <form action="{{ route('admin.shipping_zones.update', $zone->id) }}" method="POST" class="p-4 md:p-5">
                                @csrf
                                @method('PUT')
                                <div class="space-y-4 mb-4">
                                    <div>
                                        <label class="block mb-2 text-xs font-bold text-heading uppercase tracking-wider">Zone Name</label>
                                        <input type="text" name="name" value="{{ $zone->name }}" required class="bg-gray-50 border border-default text-heading text-sm rounded-xl focus:ring-brand focus:border-brand block w-full p-2.5">
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-xs font-bold text-heading uppercase tracking-wider">Delivery Time (e.g., 2-3 Days)</label>
                                        <input type="text" name="delivery_time" value="{{ $zone->delivery_time }}" class="bg-gray-50 border border-default text-heading text-sm rounded-xl focus:ring-brand focus:border-brand block w-full p-2.5">
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-xs font-bold text-heading uppercase tracking-wider">Cost (৳)</label>
                                        <input type="number" step="0.01" name="cost" value="{{ $zone->cost }}" required class="bg-gray-50 border border-default text-heading text-sm rounded-xl focus:ring-brand focus:border-brand block w-full p-2.5">
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" name="is_active" id="active-{{ $zone->id }}" {{ $zone->is_active ? 'checked' : '' }} class="w-4 h-4 text-brand bg-gray-50 border-default rounded focus:ring-brand">
                                        <label for="active-{{ $zone->id }}" class="ms-2 text-sm font-medium text-heading">Zone is Active</label>
                                    </div>
                                </div>
                                <button type="submit" class="w-full text-white bg-brand hover:bg-brand-strong focus:ring-4 focus:outline-none focus:ring-brand/50 font-bold rounded-xl text-sm px-5 py-2.5 text-center uppercase tracking-widest">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-20 text-center text-body-light">No shipping zones found. Click "+ New Zone" to create one.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Create Modal -->
    <div id="addZoneModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-2xl shadow-xl">
                <div class="flex items-center justify-between p-4 md:p-5 border-b border-default rounded-t">
                    <h3 class="text-lg font-bold text-heading">Add New Shipping Zone</h3>
                    <button type="button" class="text-body-light bg-transparent hover:bg-gray-100 hover:text-heading rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="addZoneModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                    </button>
                </div>
                <form action="{{ route('admin.shipping_zones.store') }}" method="POST" class="p-4 md:p-5">
                    @csrf
                    <div class="space-y-4 mb-4">
                        <div>
                            <label class="block mb-2 text-xs font-bold text-heading uppercase tracking-wider">Zone Name</label>
                            <input type="text" name="name" required placeholder="e.g. Inside Dhaka" class="bg-gray-50 border border-default text-heading text-sm rounded-xl focus:ring-brand focus:border-brand block w-full p-2.5">
                        </div>
                        <div>
                            <label class="block mb-2 text-xs font-bold text-heading uppercase tracking-wider">Delivery Time</label>
                            <input type="text" name="delivery_time" placeholder="e.g. 24-48 Hours" class="bg-gray-50 border border-default text-heading text-sm rounded-xl focus:ring-brand focus:border-brand block w-full p-2.5">
                        </div>
                        <div>
                            <label class="block mb-2 text-xs font-bold text-heading uppercase tracking-wider">Cost (৳)</label>
                            <input type="number" step="0.01" name="cost" required placeholder="60.00" class="bg-gray-50 border border-default text-heading text-sm rounded-xl focus:ring-brand focus:border-brand block w-full p-2.5">
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="active-new" checked class="w-4 h-4 text-brand bg-gray-50 border-default rounded focus:ring-brand">
                            <label for="active-new" class="ms-2 text-sm font-medium text-heading">Zone is Active</label>
                        </div>
                    </div>
                    <button type="submit" class="w-full text-white bg-brand hover:bg-brand-strong focus:ring-4 focus:outline-none focus:ring-brand/50 font-bold rounded-xl text-sm px-5 py-2.5 text-center uppercase tracking-widest">Create Zone</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
