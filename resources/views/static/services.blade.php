@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="text-center">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Our Services</h1>
        <p class="text-lg text-gray-600 mb-12">Professional wedding invitation solutions tailored to your special day</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="text-blue-600 mb-4">
                <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Digital Invitations</h3>
            <p class="text-gray-600">Beautiful digital wedding invitations that can be easily shared via email, social media, or messaging apps.</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="text-blue-600 mb-4">
                <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">RSVP Management</h3>
            <p class="text-gray-600">Track guest responses, manage guest lists, and send automated reminders to ensure you get accurate headcounts.</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="text-blue-600 mb-4">
                <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Print Services</h3>
            <p class="text-gray-600">Professional printing services for those who want physical invitations with the same beautiful designs.</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="text-blue-600 mb-4">
                <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Custom Designs</h3>
            <p class="text-gray-600">Work with our designers to create a completely custom invitation that matches your wedding theme perfectly.</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="text-blue-600 mb-4">
                <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Wedding Websites</h3>
            <p class="text-gray-600">Create a beautiful wedding website to share your story, photos, registry information, and more with your guests.</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="text-blue-600 mb-4">
                <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Event Coordination</h3>
            <p class="text-gray-600">Full-service event coordination to help plan and execute your perfect wedding day from start to finish.</p>
        </div>
    </div>
    
    <div class="mt-16 text-center">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Why Choose Us?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Easy to Use</h3>
                <p class="text-gray-600">Our intuitive platform makes creating beautiful invitations simple, even for non-designers.</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Fully Customizable</h3>
                <p class="text-gray-600">Personalize every aspect of your invitation to match your unique style and wedding theme.</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">24/7 Support</h3>
                <p class="text-gray-600">Our dedicated support team is always ready to help you with any questions or issues.</p>
            </div>
        </div>
    </div>
</div>
@endsection