@extends('Layouts.app')

@section('admin')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-heading text-neutral-900">Add New Category</h2>
            <a href="{{ route('categories.index') }}"
                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg bg-white font-semibold text-sm text-gray-700 hover:bg-gray-50 transition-all">
                Back to List
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-default p-6 max-w-4xl mx-auto">
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-body mb-2">Category Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand"
                            placeholder="Enter category name" required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-body mb-2">Status</label>
                        <select id="status" name="status"
                            class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand"
                            required>
                            <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-1 md:col-span-2">
                        <label for="image" class="block text-sm font-medium text-body mb-2">Category Image</label>
                        <input type="file" id="image" name="image"
                            class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand"
                            accept="image/*">
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-brand hover:bg-brand-strong focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand transition-all">
                        Create Category
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
