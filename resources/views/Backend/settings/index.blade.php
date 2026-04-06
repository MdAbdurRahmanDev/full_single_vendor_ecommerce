@extends('Layouts.app')

@section('admin')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-heading">System Settings</h2>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <!-- General Settings Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-default p-6 space-y-6">
                    <div class="flex items-center space-x-3 mb-2">
                        <div class="p-2 bg-brand-soft rounded-lg text-brand">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-heading">General Settings</h3>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-body mb-2">App Name</label>
                            <input type="text" name="app_name" value="{{ $settings['app_name'] ?? '' }}"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-body mb-2">Logo</label>
                            @if(isset($settings['logo']))
                                <img src="{{ asset('uploads/settings/' . $settings['logo']) }}" class="h-12 mb-4 rounded border border-default">
                            @endif
                            <input type="file" name="logo" class="w-full text-sm text-body-light file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-brand-soft file:text-brand hover:file:bg-brand-medium">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-body mb-2">Favicon</label>
                            @if(isset($settings['favicon']))
                                <img src="{{ asset('uploads/settings/' . $settings['favicon']) }}" class="h-8 mb-4 rounded border border-default">
                            @endif
                            <input type="file" name="favicon" class="w-full text-sm text-body-light file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-brand-soft file:text-brand hover:file:bg-brand-medium">
                        </div>
                    </div>
                </div>

                <!-- SEO Settings Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-default p-6 space-y-6">
                    <div class="flex items-center space-x-3 mb-2">
                        <div class="p-2 bg-green-50 rounded-lg text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-heading">SEO Global Settings</h3>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-body mb-2">Meta Title</label>
                            <input type="text" name="meta_title" value="{{ $settings['meta_title'] ?? '' }}"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-body mb-2">Meta Keywords</label>
                            <input type="text" name="meta_keywords" value="{{ $settings['meta_keywords'] ?? '' }}"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand" placeholder="comma separated">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-body mb-2">Meta Description</label>
                            <textarea name="meta_description" rows="3"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand">{{ $settings['meta_description'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Home Page SEO Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-default p-6 space-y-6">
                    <div class="flex items-center space-x-3 mb-2">
                        <div class="p-2 bg-indigo-50 rounded-lg text-indigo-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-heading">Home Page SEO</h3>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-body mb-2">Home Meta Title</label>
                            <input type="text" name="home_meta_title" value="{{ $settings['home_meta_title'] ?? '' }}"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-body mb-2">Home Meta Keywords</label>
                            <input type="text" name="home_meta_keywords" value="{{ $settings['home_meta_keywords'] ?? '' }}"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand" placeholder="comma separated">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-body mb-2">Home Meta Description</label>
                            <textarea name="home_meta_description" rows="3"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand">{{ $settings['home_meta_description'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Shop Page SEO Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-default p-6 space-y-6">
                    <div class="flex items-center space-x-3 mb-2">
                        <div class="p-2 bg-purple-50 rounded-lg text-purple-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-heading">Shop Page SEO</h3>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-body mb-2">Shop Meta Title</label>
                            <input type="text" name="shop_meta_title" value="{{ $settings['shop_meta_title'] ?? '' }}"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-body mb-2">Shop Meta Keywords</label>
                            <input type="text" name="shop_meta_keywords" value="{{ $settings['shop_meta_keywords'] ?? '' }}"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand" placeholder="comma separated">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-body mb-2">Shop Meta Description</label>
                            <textarea name="shop_meta_description" rows="3"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand">{{ $settings['shop_meta_description'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Login Page SEO Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-default p-6 space-y-6">
                    <div class="flex items-center space-x-3 mb-2">
                        <div class="p-2 bg-pink-50 rounded-lg text-pink-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-heading">Login & Register SEO</h3>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-body mb-2">Auth Meta Title</label>
                            <input type="text" name="auth_meta_title" value="{{ $settings['auth_meta_title'] ?? '' }}"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-body mb-2">Auth Meta Keywords</label>
                            <input type="text" name="auth_meta_keywords" value="{{ $settings['auth_meta_keywords'] ?? '' }}"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand" placeholder="comma separated">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-body mb-2">Auth Meta Description</label>
                            <textarea name="auth_meta_description" rows="3"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand">{{ $settings['auth_meta_description'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Contact & Social Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-default p-6 space-y-6">
                    <div class="flex items-center space-x-3 mb-2">
                        <div class="p-2 bg-orange-50 rounded-lg text-orange-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-heading">Contact & Support</h3>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-body mb-2">Contact Email</label>
                            <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-body mb-2">Phone Number</label>
                            <input type="text" name="phone" value="{{ $settings['phone'] ?? '' }}"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-body mb-2">Physical Address</label>
                            <input type="text" name="address" value="{{ $settings['address'] ?? '' }}"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand">
                        </div>
                    </div>
                </div>

                <!-- Social Links Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-default p-6 space-y-6">
                    <div class="flex items-center space-x-3 mb-2">
                        <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-heading">Social Media</h3>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-body mb-2">Facebook URL</label>
                            <input type="url" name="facebook_url" value="{{ $settings['facebook_url'] ?? '' }}"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-body mb-2">Twitter URL</label>
                            <input type="url" name="twitter_url" value="{{ $settings['twitter_url'] ?? '' }}"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-body mb-2">Instagram URL</label>
                            <input type="url" name="instagram_url" value="{{ $settings['instagram_url'] ?? '' }}"
                                class="w-full rounded-lg border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm focus:border-brand focus:ring-brand">
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-8">
                <button type="submit"
                    class="inline-flex items-center px-10 py-3 border border-transparent text-sm font-medium rounded-xl shadow-lg text-white bg-brand hover:bg-brand-strong focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand transition-all transform hover:scale-105">
                    Save All Changes
                </button>
            </div>
        </form>
    </div>
@endsection
