@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="text-center">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Wedding Invitations</h1>
        <p class="text-lg text-gray-600 mb-12">Create beautiful digital wedding invitations that your guests will love</p>
    </div>
    
    <div class="bg-white rounded-lg shadow-lg p-8 mb-12">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-6 md:mb-0">
                <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" alt="Wedding Invitation" class="rounded-lg mx-auto">
            </div>
            <div class="md:w-1/2 md:pl-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Why Digital Wedding Invitations?</h2>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-gray-700">Eco-friendly and sustainable</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-gray-700">Instant delivery to all your guests</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-gray-700">Easy RSVP tracking and management</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-gray-700">Cost-effective compared to traditional paper invitations</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-gray-700">Fully customizable to match your wedding theme</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="text-center mb-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Popular Wedding Invitation Templates</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16 mx-auto mb-4"></div>
                <h3 class="text-lg font-medium text-gray-900">Classic Elegance</h3>
                <p class="mt-2 text-gray-600">Timeless designs with sophisticated typography and color schemes.</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16 mx-auto mb-4"></div>
                <h3 class="text-lg font-medium text-gray-900">Modern Minimal</h3>
                <p class="mt-2 text-gray-600">Clean lines and contemporary designs for the modern couple.</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16 mx-auto mb-4"></div>
                <h3 class="text-lg font-medium text-gray-900">Rustic Charm</h3>
                <p class="mt-2 text-gray-600">Warm, earthy tones and natural elements for outdoor weddings.</p>
            </div>
        </div>
        
        <div class="mt-8">
            <a href="{{ route('templates.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Browse All Templates
            </a>
        </div>
    </div>
    
    <div class="bg-blue-50 rounded-lg p-8">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">How It Works</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-8">
                <div>
                    <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3">1</div>
                    <h3 class="text-lg font-medium text-gray-900">Choose Template</h3>
                </div>
                <div>
                    <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3">2</div>
                    <h3 class="text-lg font-medium text-gray-900">Customize</h3>
                </div>
                <div>
                    <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3">3</div>
                    <h3 class="text-lg font-medium text-gray-900">Send</h3>
                </div>
                <div>
                    <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3">4</div>
                    <h3 class="text-lg font-medium text-gray-900">Track RSVPs</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection