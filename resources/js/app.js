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
        $('[data-carousel-target]').removeClass('bg-primary').addClass('bg-secondary-light');
        
        // Show target item with fade in animation
        const targetItem = $(`[data-carousel-item="${targetIndex}"]`);
        targetItem.removeClass('hidden');
        // Trigger reflow to ensure the element is displayed before adding opacity-100
        targetItem[0].offsetHeight;
        setTimeout(function() {
            targetItem.removeClass('opacity-0');
        }, 10);
        
        // Set active button
        $(this).removeClass('bg-secondary-light').addClass('bg-primary');
    });
    
    // Contact form validation and submission
    $('form').on('submit', function(e) {
        e.preventDefault();
        
        // Get form elements
        const name = $('#name');
        const email = $('#email');
        const subject = $('#subject');
        const message = $('#message');
        
        // Reset validation classes
        $('.border-error-dark, .border-success-dark').removeClass('border-error-dark border-success-dark');
        
        // Validation
        let isValid = true;
        
        if (name.val().trim() === '') {
            name.addClass('border-error-dark');
            isValid = false;
        } else {
            name.addClass('border-success-dark');
        }
        
        if (email.val().trim() === '' || !isValidEmail(email.val())) {
            email.addClass('border-error-dark');
            isValid = false;
        } else {
            email.addClass('border-success-dark');
        }
        
        if (subject.val().trim() === '') {
            subject.addClass('border-error-dark');
            isValid = false;
        } else {
            subject.addClass('border-success-dark');
        }
        
        if (message.val().trim() === '') {
            message.addClass('border-error-dark');
            isValid = false;
        } else {
            message.addClass('border-success-dark');
        }
        
        // If valid, show success message
        if (isValid) {
            // Create success message
            const successMessage = $('<div class="mt-4 p-4 bg-success-light text-success-dark rounded-md text-center animate-pop-in">Thank you for your message! We\'ll get back to you soon.</div>');
            
            // Insert before the form
            $(this).before(successMessage);
            
            // Reset form
            $(this)[0].reset();
            
            // Remove success message after 5 seconds
            setTimeout(function() {
                successMessage.remove();
                $('.border-success-dark').removeClass('border-success-dark');
            }, 5000);
        }
    });
    
    // Email validation helper function
    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    
    // Admin sidebar toggle functionality
    $('#sidebarToggle').on('click', function() {
        $('#adminSidebar').toggleClass('collapsed');
        
        // Rotate the toggle icon
        const svg = $(this).find('svg');
        if ($('#adminSidebar').hasClass('collapsed')) {
            svg.css('transform', 'rotate(180deg)');
        } else {
            svg.css('transform', 'rotate(0deg)');
        }
    });
    
    // Mobile menu toggle for admin
    $('#mobileMenuButton').on('click', function() {
        $('#adminSidebar').toggleClass('mobile-hidden');
    });
    
    // Initialize DataTables for admin tables
    if ($('.datatable').length) {
        $('.datatable').each(function() {
            $(this).DataTable({
                "pageLength": 25,
                "order": [],
                "responsive": true,
                "language": {
                    "search": "Search:",
                    "lengthMenu": "Show _MENU_ entries",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    }
                },
                "columnDefs": [
                    { "orderable": false, "targets": -1 } // Disable sorting on last column (actions)
                ]
            });
        });
    }
    
    // Admin search functionality
    $('.modern-search-input').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        const table = $(this).closest('.p-6').find('.modern-table tbody');
        
        table.find('tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
    
    // Admin filter functionality
    $('.modern-filter-dropdown').on('change', function() {
        // This would typically trigger an AJAX request to filter data
        // For now, we'll just show a message
        const selectedValue = $(this).val();
        if (selectedValue) {
            console.log('Filtering by:', selectedValue);
        }
    });
    
    // Enhanced button hover effects
    $('.modern-btn').on('mouseenter', function() {
        $(this).addClass('transform hover:scale-105');
    }).on('mouseleave', function() {
        $(this).removeClass('transform hover:scale-105');
    });
    
    // Enhanced action button hover effects
    $('.modern-action-btn').on('mouseenter', function() {
        $(this).addClass('transform hover:scale-105');
    }).on('mouseleave', function() {
        $(this).removeClass('transform hover:scale-105');
    });
    
    // Add loading states to buttons
    $('.modern-btn').on('click', function() {
        const button = $(this);
        const originalContent = button.html();
        
        // Show loading state
        button.prop('disabled', true).html(`
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Loading...
        `);
        
        // Simulate API call delay
        setTimeout(function() {
            button.prop('disabled', false).html(originalContent);
        }, 1000);
    });
});