<?php

/**
 * Vercel helper functions for Laravel
 * This file contains helper functions specific to Vercel deployment
 */

if (!function_exists('vercel_storage_path')) {
    /**
     * Get the path to the storage directory for Vercel
     * Uses /tmp for writable storage in Vercel environment
     */
    function vercel_storage_path($path = '')
    {
        $basePath = ($_ENV['APP_ENV'] ?? 'local') === 'production' ? '/tmp/storage' : (function_exists('storage_path') ? storage_path() : dirname(__DIR__, 2) . '/storage');
        
        // Create directory if it doesn't exist
        if (!is_dir($basePath)) {
            mkdir($basePath, 0755, true);
        }
        
        return $path ? $basePath . '/' . ltrim($path, '/') : $basePath;
    }
}

if (!function_exists('vercel_cache_path')) {
    /**
     * Get the path to the cache directory for Vercel
     */
    function vercel_cache_path($path = '')
    {
        $basePath = ($_ENV['APP_ENV'] ?? 'local') === 'production' ? '/tmp/cache' : (function_exists('base_path') ? base_path('bootstrap/cache') : dirname(__DIR__, 2) . '/bootstrap/cache');
        
        // Create directory if it doesn't exist
        if (!is_dir($basePath)) {
            mkdir($basePath, 0755, true);
        }
        
        return $path ? $basePath . '/' . ltrim($path, '/') : $basePath;
    }
}

if (!function_exists('is_vercel')) {
    /**
     * Check if the application is running on Vercel
     */
    function is_vercel()
    {
        return isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']);
    }
}
