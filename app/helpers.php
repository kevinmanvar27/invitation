<?php

if (!function_exists('versioned_asset')) {
    /**
     * Generate a versioned asset URL with cache busting
     *
     * @param string $path
     * @return string
     */
    function versioned_asset($path)
    {
        $fullPath = public_path($path);
        $version = '';
        
        if (file_exists($fullPath)) {
            // Use file modification time and a random string for stronger cache busting
            $version = '?v=' . filemtime($fullPath) . '&_=' . uniqid();
        }
        
        return asset($path) . $version;
    }
}