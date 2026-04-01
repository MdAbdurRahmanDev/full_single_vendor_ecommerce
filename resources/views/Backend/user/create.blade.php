@extends('Layouts.app')

@section('admin')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-heading">Add New User</h2>
            <a href="{{ route('admin.users.index') }}"
                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg bg-white font-semibold text-sm text-gray-700 hover:bg-gray-50 transition-all">
                Back to List
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-default p-8 max-w-2xl mx-auto">
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="name" class="block text-sm font-semibold text-heading mb-2">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand"
                        placeholder="e.g. John Doe" required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-heading mb-2">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand"
                        placeholder="e.g. john@example.com" required>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-semibold text-heading mb-2">Password</label>
                        <input type="password" id="password" name="password"
                            class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand"
                            placeholder="Min. 8 characters" required>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-heading mb-2">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand"
                            placeholder="Confirm password" required>
                    </div>
                </div>

                <div class="pt-6 border-t border-default">
                    <button type="submit"
                        class="w-full px-10 py-3 bg-brand text-white border border-transparent rounded-lg font-semibold text-sm shadow-md hover:bg-brand-strong transition-all">
                        Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
