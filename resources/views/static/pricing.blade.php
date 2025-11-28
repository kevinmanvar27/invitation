@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="text-center">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Pricing Plans</h1>
        <p class="text-lg text-gray-600 mb-12">Choose the perfect plan for your wedding invitation needs</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Basic Plan -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-8">
                <h3 class="text-2xl font-bold text-gray-900 text-center">Basic</h3>
                <div class="mt-4 text-center">
                    <span class="text-4xl font-extrabold text-gray-900">₹0</span>
                    <span class="text-gray-600">/ forever</span>
                </div>
                <p class="mt-4 text-gray-600 text-center">Perfect for couples on a budget</p>
                <ul class="mt-6 space-y-4">
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-gray-700">5 Digital Invitations</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-gray-700">Basic Templates</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-gray-700">RSVP Management</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-gray-700">Email Support</span>
                    </li>
                </ul>
                <div class="mt-8">
                    <a href="{{ route('register') }}" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Premium Plan -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-blue-500 relative">
            <div class="absolute top-0 right-0 bg-blue-500 text-white px-4 py-1 rounded-bl-lg">
                <span class="text-sm font-medium">Most Popular</span>
            </div>
            <div class="px-6 py-8">
                <h3 class="text-2xl font-bold text-gray-900 text-center">Premium</h3>
                <div class="mt-4 text-center">
                    <span class="text-4xl font-extrabold text-gray-900">₹999</span>
                    <span class="text-gray-600">/ one-time</span>
                </div>
                <p class="mt-4 text-gray-600 text-center">Perfect for most weddings</p>
                <ul class="mt-6 space-y-4">
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-gray-700">Unlimited Digital Invitations</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-gray-700">All Premium Templates</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-gray-700">Advanced RSVP Features</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-gray-700">Custom Branding</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-gray-700">Priority Support</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-gray-700">Guest List Management</span>
                    </li>
                </ul>
                <div class="mt-8">
                    <a href="{{ route('register') }}" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Enterprise Plan -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-8">
                <h3 class="text-2xl font-bold text-gray-900 text-center">Enterprise</h3>
                <div class="mt-4 text-center">
                    <span class="text-4xl font-extrabold text-gray-900">₹2999</span>
                    <span class="text-gray-600">/ one-time</span>
                </div>
                <p class="mt-4 text-gray-600 text-center">Perfect for large weddings</p>
                <ul class="mt-6 space-y-4">
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-gray-700">Everything in Premium</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-gray-700">Custom Design Services</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-gray-700">Print Services Included</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-gray-700">Dedicated Account Manager</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-gray-700">24/7 Premium Support</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-gray-700">Event Coordination Services</span>
                    </li>
                </ul>
                <div class="mt-8">
                    <a href="{{ route('contact') }}" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-16 bg-gray-50 rounded-lg p-8">
        <h2 class="text-2xl font-bold text-gray-900 text-center mb-8">Frequently Asked Questions</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h3 class="text-lg font-medium text-gray-900">Can I upgrade my plan later?</h3>
                <p class="mt-2 text-gray-600">Yes, you can upgrade your plan at any time. You'll only pay the difference between your current plan and the new plan.</p>
            </div>
            <div>
                <h3 class="text-lg font-medium text-gray-900">Do you offer refunds?</h3>
                <p class="mt-2 text-gray-600">We offer a 30-day money-back guarantee on all our plans. If you're not satisfied, contact us for a full refund.</p>
            </div>
            <div>
                <h3 class="text-lg font-medium text-gray-900">Are there any hidden fees?</h3>
                <p class="mt-2 text-gray-600">No, our pricing is transparent. The price you see is the price you pay. Taxes may apply depending on your location.</p>
            </div>
            <div>
                <h3 class="text-lg font-medium text-gray-900">Can I customize my invitations?</h3>
                <p class="mt-2 text-gray-600">Absolutely! All our plans include customization options. Premium and Enterprise plans offer advanced customization features.</p>
            </div>
        </div>
    </div>
</div>
@endsection