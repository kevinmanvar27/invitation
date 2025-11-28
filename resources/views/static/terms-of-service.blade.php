@extends('layouts.home')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-16 animate-fade-in">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 animate-slide-down">Terms of Service</h1>
        <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto rounded-full animate-scale-in"></div>
        <p class="mt-6 text-xl text-gray-600 animate-slide-up delay-150">
            Last updated: {{ date('F d, Y') }}
        </p>
    </div>
    
    <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100 animate-fade-in delay-300">
        <div class="prose prose-blue max-w-none">
            <p class="text-gray-600 text-lg mb-8">
                Welcome to Uvinvite ("uvinvite.com"). These terms and conditions outline the rules and regulations 
                for the use of Uvinvite's Website, located at uvinvite.com.
            </p>
            
            <div class="border-l-4 border-blue-500 pl-6 py-2 mb-10 bg-blue-50 rounded-r-lg animate-fade-in delay-500">
                <p class="text-gray-700 italic">
                    "By accessing this website we assume you accept these terms and conditions. Do not continue to use 
                    Uvinvite if you do not agree to take all of the terms and conditions stated on this page."
                </p>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up">1. Intellectual Property Rights</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-150">
                Unless otherwise stated, Uvinvite and/or its licensors own the intellectual property rights for 
                all material on Uvinvite. All intellectual property rights are reserved. You may access this from 
                Uvinvite for your own personal use subjected to restrictions set in these terms and conditions.
            </p>
            
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 rounded-r-lg mb-8 animate-fade-in delay-300">
                <h3 class="font-bold text-gray-900 mb-2 flex items-center">
                    <svg class="w-5 h-5 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    Important Notice
                </h3>
                <p class="text-gray-600">
                    You must not republish material from Uvinvite, sell, rent or sub-license material from Uvinvite, 
                    reproduce, duplicate or copy material from Uvinvite, or redistribute content from Uvinvite.
                </p>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up delay-450">2. User Responsibilities</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-600">
                As a user of Uvinvite, you agree to the following responsibilities:
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="flex items-start p-5 bg-gray-50 rounded-xl transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-750">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-4 mt-1">
                        <span class="font-bold text-sm">1</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-2">Accurate Information</h3>
                        <p class="text-gray-600">
                            You must provide accurate and complete registration information
                        </p>
                    </div>
                </div>
                <div class="flex items-start p-5 bg-gray-50 rounded-xl transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-900">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-4 mt-1">
                        <span class="font-bold text-sm">2</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-2">Account Security</h3>
                        <p class="text-gray-600">
                            You are responsible for maintaining the confidentiality of your account and password
                        </p>
                    </div>
                </div>
                <div class="flex items-start p-5 bg-gray-50 rounded-xl transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-1050">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-4 mt-1">
                        <span class="font-bold text-sm">3</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-2">Authorized Use</h3>
                        <p class="text-gray-600">
                            You are responsible for all activities that occur under your account
                        </p>
                    </div>
                </div>
                <div class="flex items-start p-5 bg-gray-50 rounded-xl transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-1200">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-4 mt-1">
                        <span class="font-bold text-sm">4</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-2">Legal Compliance</h3>
                        <p class="text-gray-600">
                            You must not use the service for any illegal or unauthorized purpose
                        </p>
                    </div>
                </div>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up delay-1350">3. Content</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-1500">
                You retain all rights to any content you submit, post or display on or through Uvinvite. By 
                submitting, posting or displaying content on or through Uvinvite, you grant us a worldwide, 
                non-exclusive, royalty-free license to use, copy, reproduce, process, adapt, modify, publish, 
                transmit, display and distribute such content in any and all media or distribution methods.
            </p>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up delay-1650">4. Subscription and Payments</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-1800">
                Some features of Uvinvite require payment of fees. You agree to pay all fees associated with your 
                account as they become due. All fees are exclusive of all taxes, levies, or duties imposed by taxing 
                authorities, and you shall be responsible for payment of all such taxes, levies, or duties.
            </p>
            
            <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded-r-lg mb-8 animate-fade-in delay-1950">
                <h3 class="font-bold text-gray-900 mb-2 flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Payment Terms
                </h3>
                <p class="text-gray-600">
                    All payments are processed securely through our payment partners. We offer a 30-day money-back 
                    guarantee on all subscription plans. Cancellations must be made at least 24 hours before the 
                    next billing cycle to avoid being charged.
                </p>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up delay-2100">5. Termination</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-2250">
                We may terminate or suspend your account immediately, without prior notice or liability, for any 
                reason whatsoever, including without limitation if you breach the Terms.
            </p>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up delay-2400">6. Limitation of Liability</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-2550">
                In no event shall Uvinvite, nor its directors, employees, partners, agents, suppliers, or affiliates, 
                be liable for any indirect, incidental, special, consequential or punitive damages, including without 
                limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from your 
                access to or use of or inability to access or use the service.
            </p>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up delay-2700">7. Changes to Terms</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-2850">
                We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a 
                revision is material we will try to provide at least 30 days' notice prior to any new terms taking 
                effect. What constitutes a material change will be determined at our sole discretion.
            </p>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up delay-3000">8. Governing Law</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-3150">
                These Terms shall be governed and construed in accordance with the laws of India, without regard to 
                its conflict of law provisions.
            </p>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up delay-3300">9. Contact Information</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-3450">
                If you have any questions about these Terms, please contact us at:
            </p>
            <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-6 animate-fade-in delay-3600">
                <ul class="space-y-3 text-gray-600">
                    <li class="flex items-center transform transition-all duration-300 hover:text-blue-600">
                        <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span>Email: <a href="mailto:info@uvinvite.com" class="text-blue-600 hover:underline">info@uvinvite.com</a></span>
                    </li>
                    <li class="flex items-center transform transition-all duration-300 hover:text-blue-600">
                        <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Address: Mavdi chowk, Rajkot, Gujarat, India</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="mt-12 text-center animate-fade-in delay-3750">
        <a href="{{ route('contact') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transform transition-all duration-300 hover:scale-105">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
            </svg>
            Contact us for more information
        </a>
    </div>
</div>
@endsection