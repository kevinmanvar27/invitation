// jQuery functionality for the wedding invitation site
// This file works directly with the CDN version of jQuery

// Wait for the document to be ready
$(document).ready(function() {
    // Mobile menu toggle functionality - handles both navigation structures
    $(document).on('click', '#mobile-menu-button', function() {
        const menu = $('#mobile-menu');
        const svg = $(this).find('svg');
        const menuIcon = svg.find('#menu-icon');
        const closeIcon = svg.find('#close-icon');
        
        menu.toggleClass('hidden');
        
        if (menu.hasClass('hidden')) {
            menuIcon.removeClass('hidden').addClass('block');
            closeIcon.removeClass('block').addClass('hidden');
        } else {
            menuIcon.removeClass('block').addClass('hidden');
            closeIcon.removeClass('hidden').addClass('block');
        }
    });
    
    // Close mobile menu when clicking on a link
    $(document).on('click', '#mobile-menu a', function() {
        $('#mobile-menu').addClass('hidden');
        const svg = $('#mobile-menu-button').find('svg');
        svg.find('#menu-icon').removeClass('hidden').addClass('block');
        svg.find('#close-icon').removeClass('block').addClass('hidden');
    });
    
    // Add staggered animations to elements
    $('.staggered-delay').each(function(index) {
        $(this).css('--item-index', index + 1);
    });
    
    // Add scroll animations
    function animateOnScroll() {
        $('.animate-on-scroll').each(function() {
            const elementPosition = $(this).offset().top;
            const screenPosition = $(window).scrollTop() + ($(window).height() / 1.3);
            
            if (elementPosition < screenPosition) {
                $(this).addClass('animated');
            }
        });
    }
    
    $(window).on('scroll', animateOnScroll);
    
    // Trigger animations on page load
    animateOnScroll();
    
    // Enhanced template carousel functionality with smooth transitions
    $('[data-carousel-target]').on('click', function() {
        const targetIndex = $(this).data('carousel-target');
        
        // Hide all carousel items with fade out animation
        $('[data-carousel-item]').each(function() {
            const currentItem = $(this);
            if (!currentItem.hasClass('hidden')) {
                currentItem.addClass('opacity-0');
                setTimeout(function() {
                    currentItem.addClass('hidden');
                }, 300); // Match the transition duration
            }
        });
        
        // Remove active class from all buttons and add inactive class
        $('[data-carousel-target]').removeClass('bg-blue-600').addClass('bg-gray-300');
        
        // Show target item with fade in animation
        const targetItem = $(`[data-carousel-item="${targetIndex}"]`);
        targetItem.removeClass('hidden');
        // Trigger reflow to ensure the element is displayed before adding opacity-100
        targetItem[0].offsetHeight;
        setTimeout(function() {
            targetItem.removeClass('opacity-0');
        }, 10);
        
        // Set active button
        $(this).removeClass('bg-gray-300').addClass('bg-blue-600');
    });
    
    // Contact form validation and submission - only apply to forms with contact fields
    $('form').each(function() {
        const form = $(this);
        
        // Skip admin login forms
        if (form.attr('action') && form.attr('action').includes('admin/login')) {
            return; // Skip this form
        }
        
        // Check if this form has the contact fields
        if (form.find('#name').length > 0 && 
            form.find('#email').length > 0 && 
            form.find('#subject').length > 0 && 
            form.find('#message').length > 0) {
            
            form.on('submit', function(e) {
                e.preventDefault();
                
                // Get form elements
                const name = form.find('#name');
                const email = form.find('#email');
                const subject = form.find('#subject');
                const message = form.find('#message');
                
                // Reset validation classes
                form.find('.border-red-500, .border-green-500').removeClass('border-red-500 border-green-500');
                
                // Validation
                let isValid = true;
                
                if (name.val().trim() === '') {
                    name.addClass('border-red-500');
                    isValid = false;
                } else {
                    name.addClass('border-green-500');
                }
                
                if (email.val().trim() === '' || !isValidEmail(email.val())) {
                    email.addClass('border-red-500');
                    isValid = false;
                } else {
                    email.addClass('border-green-500');
                }
                
                if (subject.val().trim() === '') {
                    subject.addClass('border-red-500');
                    isValid = false;
                } else {
                    subject.addClass('border-green-500');
                }
                
                if (message.val().trim() === '') {
                    message.addClass('border-red-500');
                    isValid = false;
                } else {
                    message.addClass('border-green-500');
                }
                
                // If valid, show success message
                if (isValid) {
                    // Create success message
                    const successMessage = $('<div class="mt-4 p-4 bg-green-100 text-green-700 rounded-md text-center animate-pop-in">Thank you for your message! We\'ll get back to you soon.</div>');
                    
                    // Insert before the form
                    form.before(successMessage);
                    
                    // Reset form
                    form[0].reset();
                    
                    // Remove success message after 5 seconds
                    setTimeout(function() {
                        successMessage.remove();
                        form.find('.border-green-500').removeClass('border-green-500');
                    }, 5000);
                }
            });
        }
    });
    
    // Email validation helper function
    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});