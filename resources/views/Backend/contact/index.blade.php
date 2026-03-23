@extends('Layouts.app')

@section('admin')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-black text-heading">Contact Inquiries</h1>
        <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mt-1">Manage customer messages and support tickets.</p>
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
                    <th class="px-6 py-4">Sender</th>
                    <th class="px-6 py-4">Subject</th>
                    <th class="px-6 py-4">Message</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-default">
                @foreach($contacts as $contact)
                <tr class="hover:bg-gray-50 transition {{ !$contact->is_read ? 'bg-brand/5' : '' }}">
                    <td class="px-6 py-4">
                        <div class="font-black text-heading">{{ $contact->name }}</div>
                        <div class="text-[10px] text-gray-500 font-bold">{{ $contact->email }}</div>
                    </td>
                    <td class="px-6 py-4 font-bold text-gray-700">{{ $contact->subject ?? 'No Subject' }}</td>
                    <td class="px-6 py-4">
                        <div class="text-xs text-gray-500 max-w-xs truncate">{{ $contact->message }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $contact->is_read ? 'bg-gray-100 text-gray-500' : 'bg-brand text-white animate-pulse' }}">
                            {{ $contact->is_read ? 'Read' : 'New' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-3">
                        @if(!$contact->is_read)
                            <a href="{{ route('admin.contacts.read', $contact->id) }}" class="text-brand hover:underline font-black text-xs uppercase tracking-widest">Mark Read</a>
                        @endif
                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this message?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline font-black text-xs uppercase tracking-widest">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        @if($contacts->isEmpty())
            <div class="p-20 text-center text-gray-400">
                <p class="font-black text-xl italic opacity-30">Your inbox is empty.</p>
            </div>
        @endif
    </div>
</div>
@endsection
