@extends('Layouts.app')

@section('admin')
    <div class="p-6">
        <div class="max-w-4xl mx-auto space-y-6">
            <h2 class="text-3xl font-bold text-heading">Admin Profile Setting</h2>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Profile Information -->
            <div class="bg-white rounded-xl shadow-sm border border-default p-6">
                <h3 class="text-xl font-semibold text-heading mb-6">Profile Information</h3>
                <form action="{{ route('admin.profile.update') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-body mb-2">Full Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', auth('admin')->user()->name) }}"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand"
                                placeholder="Enter full name">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-body mb-2">Email Address</label>
                            <input type="email" id="email" name="email" value="{{ old('email', auth('admin')->user()->email) }}"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand"
                                placeholder="Enter email address">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-brand hover:bg-brand-strong focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand transition-all">
                            Save Profile
                        </button>
                    </div>
                </form>
            </div>

            <!-- Change Password -->
            <div class="bg-white rounded-xl shadow-sm border border-default p-6">
                <h3 class="text-xl font-semibold text-heading mb-6">Security Settings</h3>
                <form action="{{ route('admin.password.update') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="password" class="block text-sm font-medium text-body mb-2">New Password</label>
                            <input type="password" id="password" name="password"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand"
                                placeholder="Min. 8 characters">
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-body mb-2">Confirm New Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand"
                                placeholder="Repeat new password">
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-brand hover:bg-brand-strong focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand transition-all">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
