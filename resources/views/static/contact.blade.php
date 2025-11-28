@extends('layouts.home')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-16 animate-fade-in">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 animate-slide-down">Contact Us</h1>
        <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto rounded-full animate-scale-in"></div>
        <p class="mt-6 text-xl text-gray-600 max-w-3xl mx-auto animate-slide-up delay-150">
            We'd love to hear from you. Get in touch with our team.
        </p>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16 animate-fade-in delay-300">
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100 transform transition-all duration-500 hover:shadow-2xl hover:-translate-y-1">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Get in Touch</h2>
            
            <div class="mb-10">
                <h3 class="text-xl font-semibold text-gray-900 mb-5 flex items-center">
                    <svg class="w-6 h-6 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    Contact Information
                </h3>
                <ul class="space-y-5">
                    <li class="flex items-start group">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4 group-hover:bg-blue-200 transition-colors duration-300">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Phone</h4>
                            <span class="text-gray-600">+91 9876543210</span>
                        </div>
                    </li>
                    <li class="flex items-start group">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4 group-hover:bg-blue-200 transition-colors duration-300">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Email</h4>
                            <span class="text-gray-600">info@uvinvite.com</span>
                        </div>
                    </li>
                    <li class="flex items-start group">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4 group-hover:bg-blue-200 transition-colors duration-300">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Address</h4>
                            <span class="text-gray-600">Mavdi chowk, Rajkot, Gujarat, India</span>
                        </div>
                    </li>
                </ul>
            </div>
            
            <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-5 flex items-center">
                    <svg class="w-6 h-6 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Business Hours
                </h3>
                <ul class="space-y-3 text-gray-700">
                    <li class="flex justify-between py-2 border-b border-gray-200">
                        <span>Monday - Friday</span>
                        <span class="font-medium">9:00 AM - 6:00 PM</span>
                    </li>
                    <li class="flex justify-between py-2 border-b border-gray-200">
                        <span>Saturday</span>
                        <span class="font-medium">10:00 AM - 4:00 PM</span>
                    </li>
                    <li class="flex justify-between py-2">
                        <span>Sunday</span>
                        <span class="font-medium text-red-500">Closed</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100 transform transition-all duration-500 hover:shadow-2xl hover:-translate-y-1">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Send us a Message</h2>
            <form class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                    <input type="text" id="name" name="name" class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300 shadow-sm hover:border-blue-400">
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300 shadow-sm hover:border-blue-400">
                </div>
                
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                    <input type="text" id="subject" name="subject" class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300 shadow-sm hover:border-blue-400">
                </div>
                
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                    <textarea id="message" name="message" rows="6" class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-300 shadow-sm hover:border-blue-400"></textarea>
                </div>
                
                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold py-4 px-6 rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-lg transform hover:scale-[1.02] animate-pulse-slow">
                    Send Message
                </button>
            </form>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100 mb-16 animate-fade-in">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Our Location</h2>
        <div class="rounded-2xl overflow-hidden shadow-lg h-96 transform transition-all duration-500 hover:shadow-2xl">
            <!-- Google Maps Embed -->
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3721.307678847049!2d70.7779943154838!3d21.52307198573457!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39580bda122f2fff%3A0x7b69b3b5b5b5b5b5!2sMavdi%20Chowk%2C%20Rajkot%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1628765432198!5m2!1sen!2sin" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
    </div>
    
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl p-12 text-center text-white animate-fade-in">
        <h2 class="text-3xl font-bold mb-6">Need Immediate Assistance?</h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto">
            Our support team is ready to help you with any questions or concerns.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="mailto:info@uvinvite.com" class="inline-block bg-white text-blue-600 font-bold py-4 px-8 rounded-full shadow-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 animate-bounce-slow">
                Email Us
            </a>
            <a href="tel:+919876543210" class="inline-block bg-transparent border-2 border-white text-white font-bold py-4 px-8 rounded-full shadow-lg hover:bg-white hover:text-blue-600 transition-all duration-300 transform hover:scale-105 animate-bounce-slow delay-300">
                Call Us
            </a>
        </div>
    </div>
</div>
@endsection