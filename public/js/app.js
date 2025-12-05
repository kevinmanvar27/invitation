// jQuery functionality for the wedding invitation site
// This file works directly with the CDN version of jQuery

// Wait for the document to be ready
$(document).ready(function() {
    // Mobile menu toggle functionality - handles both navigation structures
    $('.mobile-menu-button').on('click', function() {
        $('#mobile-menu').toggleClass('open');
    });
    
    // Close mobile menu when clicking close button
    $('.mobile-close-button').on('click', function() {
        $('#mobile-menu').removeClass('open');
    });
    
    // Close mobile menu when clicking on a link
    $('#mobile-menu a').on('click', function() {
        $('#mobile-menu').removeClass('open');
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
    
    // Template carousel functionality with smooth transitions
    $('[data-carousel-target]').on('click', function() {
        const targetIndex = $(this).data('carousel-target');
        
        // Hide all carousel items
        $('[data-carousel-item]').removeClass('active');
        
        // Remove active class from all indicators
        $('[data-carousel-target]').removeClass('active');
        
        // Show target item
        $(`[data-carousel-item="${targetIndex}"]`).addClass('active');
        
        // Set active indicator
        $(this).addClass('active');
    });
    
    // Enhanced carousel functionality with auto-play, navigation controls, and responsive behavior
    function initCarousel(carouselId) {
        const carousel = $(`#${carouselId}`);
        if (!carousel.length) return;
        
        const carouselInner = carousel.find('.carousel-inner');
        const items = carousel.find('[data-carousel-item]');
        const indicators = carousel.find('[data-carousel-target]');
        const prevBtn = carousel.find('[data-carousel-prev]');
        const nextBtn = carousel.find('[data-carousel-next]');
        
        let currentIndex = 0;
        let intervalId = null;
        const intervalTime = 5000; // 5 seconds
        
        // Update carousel position
        function updateCarousel() {
            const itemWidth = carouselInner.width();
            const offset = -currentIndex * itemWidth;
            carouselInner.css('transform', `translateX(${offset}px)`);
            
            // Update active classes
            items.removeClass('active');
            items.eq(currentIndex).addClass('active');
            
            indicators.removeClass('active');
            indicators.eq(currentIndex).addClass('active');
        }
        
        // Go to next slide
        function nextSlide() {
            currentIndex = (currentIndex + 1) % items.length;
            updateCarousel();
        }
        
        // Go to previous slide
        function prevSlide() {
            currentIndex = (currentIndex - 1 + items.length) % items.length;
            updateCarousel();
        }
        
        // Go to specific slide
        function goToSlide(index) {
            currentIndex = index;
            updateCarousel();
        }
        
        // Start auto play
        function startAutoPlay() {
            clearInterval(intervalId);
            intervalId = setInterval(nextSlide, intervalTime);
        }
        
        // Stop auto play
        function stopAutoPlay() {
            clearInterval(intervalId);
        }
        
        // Event listeners
        prevBtn.on('click', function() {
            prevSlide();
            startAutoPlay(); // Restart timer
        });
        
        nextBtn.on('click', function() {
            nextSlide();
            startAutoPlay(); // Restart timer
        });
        
        indicators.on('click', function() {
            const targetIndex = parseInt($(this).data('carousel-target'));
            goToSlide(targetIndex);
            startAutoPlay(); // Restart timer
        });
        
        // Pause on hover
        carousel.on('mouseenter', stopAutoPlay);
        carousel.on('mouseleave', startAutoPlay);
        
        // Keyboard navigation
        $(document).on('keydown', function(e) {
            if (e.key === 'ArrowLeft') {
                prevSlide();
                startAutoPlay();
            } else if (e.key === 'ArrowRight') {
                nextSlide();
                startAutoPlay();
            }
        });
        
        // Initialize
        updateCarousel();
        startAutoPlay();
        
        // Handle window resize
        $(window).on('resize', function() {
            updateCarousel();
        });
    }
    
    // Initialize carousels
    $(document).ready(function() {
        initCarousel('templatesCarousel');
        initCarousel('testimonialsCarousel');
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
        $('.form-control').removeClass('is-valid is-invalid');
        
        // Validation
        let isValid = true;
        
        if (name.val().trim() === '') {
            name.addClass('is-invalid');
            isValid = false;
        } else {
            name.addClass('is-valid');
        }
        
        if (email.val().trim() === '' || !isValidEmail(email.val())) {
            email.addClass('is-invalid');
            isValid = false;
        } else {
            email.addClass('is-valid');
        }
        
        if (subject.val().trim() === '') {
            subject.addClass('is-invalid');
            isValid = false;
        } else {
            subject.addClass('is-valid');
        }
        
        if (message.val().trim() === '') {
            message.addClass('is-invalid');
            isValid = false;
        } else {
            message.addClass('is-valid');
        }
        
        // If valid, show success message
        if (isValid) {
            // Create success message
            const successMessage = $('<div class="alert alert-success">Thank you for your message! We\'ll get back to you soon.</div>');
            
            // Insert before the form
            $(this).before(successMessage);
            
            // Reset form
            $(this)[0].reset();
            
            // Remove success message after 5 seconds
            setTimeout(function() {
                successMessage.remove();
                $('.form-control').removeClass('is-valid');
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
    
    // Add loading states to buttons
    $('.btn').on('click', function() {
        const button = $(this);
        
        // Skip if already loading
        if (button.hasClass('btn-loading')) return;
        
        // Store original content
        const originalContent = button.html();
        
        // Add loading state
        button.addClass('btn-loading').html('<span class="btn-text">' + originalContent + '</span>');
        
        // Simulate API call delay
        setTimeout(function() {
            button.removeClass('btn-loading').html(originalContent);
        }, 1000);
    });
});