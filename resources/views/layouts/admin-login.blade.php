<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Cache control meta tags -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <title>{{ config('app.name', 'Laravel') }} - Admin Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Admin Styles -->
    <link rel="stylesheet" href="{{ asset('css/admin/admin-panel.css') }}">
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <!-- Page Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Force reload CSS on page load to prevent caching issues -->
    <script>
        (function() {
            // Function to force reload all stylesheets
            function reloadStylesheets() {
                var links = document.getElementsByTagName('link');
                for (var i = 0; i < links.length; i++) {
                    var link = links[i];
                    if (link.rel === 'stylesheet') {
                        var href = link.href;
                        // Add a timestamp to force reload
                        var timestamp = '_cache_bust=' + new Date().getTime();
                        if (href.indexOf('?') >= 0) {
                            link.href = href + '&' + timestamp;
                        } else {
                            link.href = href + '?' + timestamp;
                        }
                    }
                }
            }
            
            // Reload stylesheets on page load
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', reloadStylesheets);
            } else {
                reloadStylesheets();
            }
        })();
    </script>
</body>
</html>