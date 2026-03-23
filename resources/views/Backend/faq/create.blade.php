@extends('Layouts.app')

@section('admin')
<div class="p-6 max-w-4xl">
    <div class="mb-6 flex items-center space-x-4">
        <a href="{{ route('faq.index') }}" class="w-10 h-10 border border-default rounded-xl flex items-center justify-center text-gray-500 hover:bg-gray-50 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-2xl font-black text-heading">Add New FAQ</h1>
    </div>

    @if($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-200 text-red-700 rounded-lg">
            <ul>@foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-default p-10">
        <form action="{{ route('faq.store') }}" method="POST" class="space-y-8">
            @csrf
            <div class="space-y-2">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Question *</label>
                <input type="text" name="question" required placeholder="e.g. How to track my order?" value="{{ old('question') }}"
                    class="w-full bg-gray-50 border border-default rounded-xl px-6 py-3.5 text-sm font-bold focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand">
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Answer *</label>
                <textarea name="answer" rows="6" required placeholder="Provide a detailed answer here..."
                    class="w-full bg-gray-50 border border-default rounded-xl px-6 py-3.5 text-sm font-bold focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand">{{ old('answer') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Order Number</label>
                    <input type="number" name="order_num" placeholder="0" value="{{ old('order_num', 0) }}"
                        class="w-full bg-gray-50 border border-default rounded-xl px-6 py-3.5 text-sm font-bold focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</label>
                    <select name="status" class="w-full bg-gray-50 border border-default rounded-xl px-6 py-3.5 text-sm font-bold focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="px-10 py-3.5 bg-brand text-white rounded-xl font-black text-sm hover:scale-105 transition transform shadow-xl shadow-brand/20 active:scale-95">
                    Save FAQ
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
