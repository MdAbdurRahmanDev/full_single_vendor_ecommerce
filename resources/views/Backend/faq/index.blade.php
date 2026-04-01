@extends('Layouts.app')

@section('admin')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-black text-heading">FAQ Management</h1>
        <a href="{{ route('admin.faq.create') }}" class="px-5 py-2.5 bg-brand text-white rounded-lg font-bold text-sm hover:bg-brand-strong transition">Add New FAQ</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-default overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 border-b border-default text-gray-400 uppercase font-black text-[10px] tracking-widest">
                <tr>
                    <th class="px-6 py-4">Order</th>
                    <th class="px-6 py-4">Question</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-default">
                @foreach($faqs as $faq)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-bold">{{ $faq->order_num }}</td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-heading">{{ $faq->question }}</div>
                        <div class="text-xs text-gray-500 truncate max-w-xs">{{ $faq->answer }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $faq->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $faq->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 space-x-3">
                        <a href="{{ route('admin.faq.edit', $faq->id) }}" class="text-blue-600 hover:underline font-bold">Edit</a>
                        <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this FAQ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline font-bold">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
