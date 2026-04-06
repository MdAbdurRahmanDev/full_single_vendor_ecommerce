@extends('Layouts.frontend')

@section('meta_title', 'Privacy Policy | ' . ($global_settings['app_name'] ?? 'Ecommerce'))

@section('content')
<div class="bg-white min-h-[60vh] py-16 md:py-24">
    <div class="container mx-auto px-4 max-w-4xl">
        <h1 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tighter mb-8 lowercase">Privacy Policy.</h1>
        
        <div class="prose prose-lg prose-gray max-w-none text-gray-600 space-y-6">
            <p class="font-medium text-lg text-gray-900 flex items-center space-x-2">
                <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Last updated: {{ date('F d, Y') }}</span>
            </p>

            <p>At {{ $global_settings['app_name'] ?? 'our website' }}, accessible from {{ url('/') }}, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by us and how we use it.</p>

            <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">1. Information We Collect</h3>
            <p>We collect information to provide better services to all our users. When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.</p>

            <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">2. How We Use Information</h3>
            <p>We use the information we collect in various ways, including to:</p>
            <ul class="list-disc pl-5 space-y-2">
                <li>Provide, operate, and maintain our website</li>
                <li>Improve, personalize, and expand our website</li>
                <li>Understand and analyze how you use our website</li>
                <li>Develop new products, services, features, and functionality</li>
                <li>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website.</li>
            </ul>

            <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">3. Log Files</h3>
            <p>{{ $global_settings['app_name'] ?? 'Our website' }} follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks.</p>

            <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">4. GDPR Data Protection Rights</h3>
            <p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>
            <ul class="list-disc pl-5 space-y-2">
                <li>The right to access – You have the right to request copies of your personal data.</li>
                <li>The right to rectification – You have the right to request that we correct any information you believe is inaccurate.</li>
                <li>The right to erasure – You have the right to request that we erase your personal data, under certain conditions.</li>
            </ul>

            <p class="mt-8 font-medium">If you have additional questions or require more information about our Privacy Policy, do not hesitate to <a href="{{ route('contact') }}" class="text-brand hover:underline">contact us</a>.</p>
        </div>
    </div>
</div>
@endsection
