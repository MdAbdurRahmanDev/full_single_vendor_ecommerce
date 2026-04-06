@extends('Layouts.frontend')

@section('meta_title', 'Cookie Policy | ' . ($global_settings['app_name'] ?? 'Ecommerce'))

@section('content')
<div class="bg-white min-h-[60vh] py-16 md:py-24">
    <div class="container mx-auto px-4 max-w-4xl">
        <h1 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tighter mb-8 lowercase">Cookie Policy.</h1>
        
        <div class="prose prose-lg prose-gray max-w-none text-gray-600 space-y-6">
            <p class="font-medium text-lg text-gray-900 flex items-center space-x-2">
                <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Last updated: {{ date('F d, Y') }}</span>
            </p>

            <p>This Cookie policy explains what cookies are and how we use them on the {{ $global_settings['app_name'] ?? 'website' }}. You should read this policy so you can understand what type of cookies we use, or the information we collect using cookies and how that information is used.</p>

            <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">1. What Are Cookies?</h3>
            <p>Cookies are small files which are stored on a user's computer. They are designed to hold a modest amount of data specific to a particular client and website, and can be accessed either by the web server or the client computer. This allows the server to deliver a page tailored to a particular user.</p>

            <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">2. How We Use Cookies</h3>
            <p>We use cookies for the following purposes:</p>
            <ul class="list-disc pl-5 space-y-2">
                <li><strong>Authentication:</strong> We use cookies to identify you when you visit our website and as you navigate our website.</li>
                <li><strong>Status:</strong> We use cookies to help us to determine if you are logged into our website.</li>
                <li><strong>Shopping Cart:</strong> To maintain the state of your shopping cart as you browse our store.</li>
                <li><strong>Security:</strong> We use cookies as an element of the security measures used to protect user accounts, including preventing fraudulent use of login credentials, and to protect our website and services generally.</li>
            </ul>

            <h3 class="text-xl font-bold text-gray-900 mt-8 mb-4">3. Managing Cookies</h3>
            <p>Most browsers allow you to refuse to accept cookies and to delete cookies. The methods for doing so vary from browser to browser, and from version to version. You can however obtain up-to-date information about blocking and deleting cookies via the settings of your preferred internet browser.</p>
        </div>
    </div>
</div>
@endsection
