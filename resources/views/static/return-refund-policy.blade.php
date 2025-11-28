@extends('layouts.home')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-16 animate-fade-in">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 animate-slide-down">Return & Refund Policy</h1>
        <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto rounded-full animate-scale-in"></div>
        <p class="mt-6 text-xl text-gray-600 animate-slide-up delay-150">
            Last updated: {{ date('F d, Y') }}
        </p>
    </div>
    
    <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100 animate-fade-in delay-300">
        <div class="prose prose-blue max-w-none">
            <p class="text-gray-600 text-lg mb-8">
                At Uvinvite, we want you to be completely satisfied with your purchase. We understand that sometimes 
                things don't work out as planned, and we're here to help. This Return & Refund Policy explains your 
                rights regarding returns and refunds for our digital products and services.
            </p>
            
            <div class="border-l-4 border-blue-500 pl-6 py-2 mb-10 bg-blue-50 rounded-r-lg animate-fade-in delay-500">
                <p class="text-gray-700 italic">
                    "Our goal is your complete satisfaction. If you're not happy with your purchase, please contact us 
                    and we'll do our best to make it right."
                </p>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up">1. Digital Products</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-150">
                Our digital wedding invitations are delivered electronically and are therefore non-refundable once 
                the download process has begun or the invitation has been shared. Since digital products are 
                non-tangible, they cannot be returned or exchanged.
            </p>
            
            <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-r-lg mb-8 animate-fade-in delay-300">
                <h3 class="font-bold text-gray-900 mb-2 flex items-center">
                    <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    Important Notice
                </h3>
                <p class="text-gray-600">
                    Please review your digital invitation carefully before sharing or downloading. We recommend 
                    previewing your invitation thoroughly before finalizing your order.
                </p>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up delay-450">2. Print Services</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-600">
                For printed invitations and related products, we offer the following return and refund policy:
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-green-50 rounded-xl p-6 border border-green-100 transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-750">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-3 text-center">Quality Issues</h3>
                    <p class="text-gray-600 text-sm text-center">
                        If your printed invitations arrive damaged or with printing defects, please contact us within 7 days of delivery with photos of the issue.
                    </p>
                </div>
                <div class="bg-blue-50 rounded-xl p-6 border border-blue-100 transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-900">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-3 text-center">Order Errors</h3>
                    <p class="text-gray-600 text-sm text-center">
                        If we made an error in your order (incorrect text, wrong design, etc.), please contact us immediately.
                    </p>
                </div>
                <div class="bg-yellow-50 rounded-xl p-6 border border-yellow-100 transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-1050">
                    <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-3 text-center">Change of Mind</h3>
                    <p class="text-gray-600 text-sm text-center">
                        Unfortunately, we cannot offer refunds for printed items simply because you've changed your mind.
                    </p>
                </div>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up delay-1200">3. Subscription Services</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-1350">
                For our subscription services:
            </p>
            <ul class="list-disc pl-8 text-gray-600 mb-8 space-y-3 animate-fade-in delay-1500">
                <li class="pl-2 transform transition-all duration-300 hover:text-blue-600">You may cancel your subscription at any time through your account settings</li>
                <li class="pl-2 transform transition-all duration-300 hover:text-blue-600">Upon cancellation, you will retain access to your subscription benefits until the end of your current billing period</li>
                <li class="pl-2 transform transition-all duration-300 hover:text-blue-600">No refunds will be provided for unused portions of your subscription period</li>
                <li class="pl-2 transform transition-all duration-300 hover:text-blue-600">If you believe you were billed in error, please contact us immediately</li>
            </ul>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up delay-1650">4. How to Request a Refund</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-1800">
                To request a refund, please contact us at:
            </p>
            <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-6 mb-6 animate-fade-in delay-1950">
                <ul class="space-y-3 text-gray-600">
                    <li class="flex items-center transform transition-all duration-300 hover:text-blue-600">
                        <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span>Email: <a href="mailto:info@uvinvite.com" class="text-blue-600 hover:underline">info@uvinvite.com</a></span>
                    </li>
                    <li class="flex items-center transform transition-all duration-300 hover:text-blue-600">
                        <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                        </svg>
                        <span>Subject line: "Refund Request"</span>
                    </li>
                </ul>
            </div>
            <p class="text-gray-600 mb-6 animate-fade-in delay-2100">
                Please include the following information in your request:
            </p>
            <ul class="list-disc pl-8 text-gray-600 mb-8 space-y-3 animate-fade-in delay-2250">
                <li class="pl-2 transform transition-all duration-300 hover:text-blue-600">Your order number or account details</li>
                <li class="pl-2 transform transition-all duration-300 hover:text-blue-600">Date of purchase</li>
                <li class="pl-2 transform transition-all duration-300 hover:text-blue-600">Reason for refund request</li>
                <li class="pl-2 transform transition-all duration-300 hover:text-blue-600">Any supporting documentation (photos of damaged items, etc.)</li>
            </ul>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up delay-2400">5. Refund Process</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-2550">
                Once we receive and review your refund request:
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="flex items-start p-5 bg-gray-50 rounded-xl transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-2700">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-4 mt-1">
                        <span class="font-bold text-sm">1</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-2">Review</h3>
                        <p class="text-gray-600">
                            We will respond within 3-5 business days
                        </p>
                    </div>
                </div>
                <div class="flex items-start p-5 bg-gray-50 rounded-xl transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-2850">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-4 mt-1">
                        <span class="font-bold text-sm">2</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-2">Processing</h3>
                        <p class="text-gray-600">
                            If approved, refunds will be processed within 10-14 business days
                        </p>
                    </div>
                </div>
                <div class="flex items-start p-5 bg-gray-50 rounded-xl transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-3000">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-4 mt-1">
                        <span class="font-bold text-sm">3</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-2">Payment</h3>
                        <p class="text-gray-600">
                            Refunds will be issued to the original payment method
                        </p>
                    </div>
                </div>
                <div class="flex items-start p-5 bg-gray-50 rounded-xl transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-3150">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-4 mt-1">
                        <span class="font-bold text-sm">4</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 mb-2">Confirmation</h3>
                        <p class="text-gray-600">
                            You will receive a confirmation email once the refund has been processed
                        </p>
                    </div>
                </div>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up delay-3300">6. Non-Refundable Items</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-3450">
                The following items are non-refundable:
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                <div class="flex items-center p-4 bg-gray-50 rounded-lg transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-3600">
                    <div class="flex-shrink-0 w-6 h-6 bg-red-100 text-red-600 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <p class="text-gray-600">Digital downloads (templates, invitations, etc.)</p>
                </div>
                <div class="flex items-center p-4 bg-gray-50 rounded-lg transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-3750">
                    <div class="flex-shrink-0 w-6 h-6 bg-red-100 text-red-600 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <p class="text-gray-600">Custom design services (once work has begun)</p>
                </div>
                <div class="flex items-center p-4 bg-gray-50 rounded-lg transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-3900">
                    <div class="flex-shrink-0 w-6 h-6 bg-red-100 text-red-600 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <p class="text-gray-600">Shipping fees</p>
                </div>
                <div class="flex items-center p-4 bg-gray-50 rounded-lg transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-4050">
                    <div class="flex-shrink-0 w-6 h-6 bg-red-100 text-red-600 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <p class="text-gray-600">Processing fees</p>
                </div>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up delay-4200">7. Contact Information</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-4350">
                If you have any questions about our Return & Refund Policy, please contact us:
            </p>
            <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-6 animate-fade-in delay-4500">
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
                    <li class="flex items-center transform transition-all duration-300 hover:text-blue-600">
                        <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span>Phone: <a href="tel:+919876543210" class="text-blue-600 hover:underline">+91 9876543210</a></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="mt-12 text-center animate-fade-in delay-4650">
        <a href="{{ route('contact') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transform transition-all duration-300 hover:scale-105">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
            </svg>
            Contact us for more information
        </a>
    </div>
</div>
@endsection