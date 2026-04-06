@extends('Layouts.frontend')

@section('meta_title', 'Terms of Service | ' . ($global_settings['app_name'] ?? 'Ecommerce'))

@section('content')
<div class="bg-white min-h-[60vh] py-16 md:py-24">
    <div class="container mx-auto px-4 max-w-4xl">
        <h1 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tighter mb-8 lowercase">Terms of Service.</h1>
        
        <div class="prose prose-lg prose-gray max-w-none text-gray-600 space-y-6">
            <p class="font-medium text-lg text-gray-900 flex items-center space-x-2">
                <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Last updated: {{ date('F d, Y') }}</span>
            </p>

            <p>Welcome to {{ $global_settings['app_name'] ?? 'our store' }}. These terms and conditions outline the rules and regulations for the use of our website, located at {{ url('/') }}.</p>
            <p>By accessing this website we assume you accept these terms and conditions. Do not continue to use {{ $global_settings['app_name'] ?? 'our store' }} if you do not agree to take all of the terms and conditions stated on this page.</p>

            <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">1. Intellectual Property Rights</h3>
            <p>Other than the content you own, under these Terms, {{ $global_settings['app_name'] ?? 'our company' }} and/or its licensors own all the intellectual property rights and materials contained in this Website. You are granted limited license only for purposes of viewing the material contained on this Website.</p>

            <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">2. Restrictions</h3>
            <p>You are specifically restricted from all of the following:</p>
            <ul class="list-disc pl-5 space-y-2">
                <li>Publishing any Website material in any other media</li>
                <li>Selling, sublicensing and/or otherwise commercializing any Website material</li>
                <li>Publicly performing and/or showing any Website material</li>
                <li>Using this Website in any way that is or may be damaging to this Website</li>
                <li>Using this Website in any way that impacts user access to this Website</li>
            </ul>

            <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">3. Products and Pricing</h3>
            <p>All prices and products shown on the website are subject to change without notice. We reserve the right to modify or discontinue any product. We shall not be liable to you or to any third-party for any modification, price change, suspension, or discontinuance of the service.</p>

            <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">4. Governing Law</h3>
            <p>These Terms will be governed by and interpreted in accordance with the laws of the State/Country, and you submit to the non-exclusive jurisdiction of the state and federal courts located in for the resolution of any disputes.</p>
        </div>
    </div>
</div>
@endsection
