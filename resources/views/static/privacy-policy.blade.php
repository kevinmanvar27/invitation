@extends('layouts.home')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-16 animate-fade-in">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 animate-slide-down">Privacy Policy</h1>
        <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto rounded-full animate-scale-in"></div>
        <p class="mt-6 text-xl text-gray-600 animate-slide-up delay-150">
            Last updated: {{ date('F d, Y') }}
        </p>
    </div>
    
    <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100 animate-fade-in delay-300">
        <div class="prose prose-blue max-w-none">
            <p class="text-gray-600 text-lg mb-8">
                At Uvinvite ("uvinvite.com"), we respect your privacy and are committed to protecting your personal data. 
                This privacy policy will inform you about how we look after your personal data when you visit our website 
                and tell you about your privacy rights and how the law protects you.
            </p>
            
            <div class="border-l-4 border-blue-500 pl-6 py-2 mb-10 bg-blue-50 rounded-r-lg animate-fade-in delay-500">
                <p class="text-gray-700 italic">
                    "Your privacy is important to us. We only collect information necessary to provide you with our services."
                </p>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up">1. Important Information and Who We Are</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-150">
                Uvinvite is a wedding invitation creation platform owned and operated by Utsav Patel. 
                We are committed to ensuring that your privacy is protected. Should we ask you to provide certain 
                information by which you can be identified when using this website, then you can be assured that 
                it will only be used in accordance with this privacy statement.
            </p>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up delay-300">2. The Data We Collect About You</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-450">
                We may collect, use, store and transfer different kinds of personal data about you which we have 
                grouped together as follows:
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-gray-50 rounded-xl p-6 transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-600">
                    <h3 class="font-bold text-gray-900 mb-3 flex items-center">
                        <span class="w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-3 text-sm">1</span>
                        Identity Data
                    </h3>
                    <p class="text-gray-600">
                        First name, last name, username or similar identifier
                    </p>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-750">
                    <h3 class="font-bold text-gray-900 mb-3 flex items-center">
                        <span class="w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-3 text-sm">2</span>
                        Contact Data
                    </h3>
                    <p class="text-gray-600">
                        Billing address, delivery address, email address and telephone numbers
                    </p>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-900">
                    <h3 class="font-bold text-gray-900 mb-3 flex items-center">
                        <span class="w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-3 text-sm">3</span>
                        Financial Data
                    </h3>
                    <p class="text-gray-600">
                        Bank account and payment card details
                    </p>
                </div>
                <div class="bg-gray-50 rounded-xl p-6 transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-1050">
                    <h3 class="font-bold text-gray-900 mb-3 flex items-center">
                        <span class="w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-3 text-sm">4</span>
                        Transaction Data
                    </h3>
                    <p class="text-gray-600">
                        Details about payments to and from you and other details of products and services you have purchased from us
                    </p>
                </div>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up delay-1200">3. How We Use Your Personal Data</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-1350">
                We will only use your personal data when the law allows us to. Most commonly, we will use your 
                personal data in the following circumstances:
            </p>
            <ul class="list-disc pl-8 text-gray-600 mb-6 space-y-3 animate-fade-in delay-1500">
                <li class="pl-2 transform transition-all duration-300 hover:text-blue-600">Where we need to perform the contract we are about to enter into or have entered into with you</li>
                <li class="pl-2 transform transition-all duration-300 hover:text-blue-600">Where we need to comply with a legal or regulatory obligation</li>
                <li class="pl-2 transform transition-all duration-300 hover:text-blue-600">Where it is necessary for our legitimate interests (or those of a third party) and your interests 
                    and fundamental rights do not override those interests</li>
            </ul>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up delay-1650">4. Cookies</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-1800">
                Our website uses cookies to distinguish you from other users of our website. This helps us to provide 
                you with a good experience when you browse our website and also allows us to improve our site.
            </p>
            
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 rounded-r-lg mb-6 animate-fade-in delay-1950">
                <h3 class="font-bold text-gray-900 mb-2 flex items-center">
                    <svg class="w-5 h-5 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    Cookie Policy
                </h3>
                <p class="text-gray-600">
                    We use essential cookies to ensure the website functions properly and performance cookies to analyze 
                    how visitors use our site. You can disable non-essential cookies in your browser settings.
                </p>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up delay-2100">5. Data Security</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-2250">
                We have put in place appropriate security measures to prevent your personal data from being 
                accidentally lost, used or accessed in an unauthorised way, altered or disclosed.
            </p>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up delay-2400">6. Data Retention</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-2550">
                We will only retain your personal data for as long as necessary to fulfil the purposes we collected 
                it for, including for the purposes of satisfying any legal, accounting, or reporting requirements.
            </p>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up delay-2700">7. Your Legal Rights</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-2850">
                Under certain circumstances, you have rights under data protection laws in relation to your personal data:
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                <div class="flex items-start p-4 bg-gray-50 rounded-lg transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-3000">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-3 mt-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <p class="text-gray-600">Request access to your personal data</p>
                </div>
                <div class="flex items-start p-4 bg-gray-50 rounded-lg transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-3150">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-3 mt-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <p class="text-gray-600">Request correction of your personal data</p>
                </div>
                <div class="flex items-start p-4 bg-gray-50 rounded-lg transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-3300">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-3 mt-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <p class="text-gray-600">Request erasure of your personal data</p>
                </div>
                <div class="flex items-start p-4 bg-gray-50 rounded-lg transform transition-all duration-300 hover:shadow-md hover:-translate-y-1 animate-fade-in delay-3450">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mr-3 mt-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <p class="text-gray-600">Object to processing of your personal data</p>
                </div>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-900 mt-12 mb-6 pb-2 border-b border-gray-200 animate-slide-up delay-3600">8. Contact Us</h2>
            <p class="text-gray-600 mb-6 animate-fade-in delay-3750">
                If you have any questions about this privacy policy or our privacy practices, please contact us:
            </p>
            <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-6 animate-fade-in delay-3900">
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
    
    <div class="mt-12 text-center animate-fade-in delay-4050">
        <a href="{{ route('contact') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transform transition-all duration-300 hover:scale-105">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
            </svg>
            Contact us for more information
        </a>
    </div>
</div>
@endsection