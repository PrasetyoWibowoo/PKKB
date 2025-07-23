<?php

/**
 * Laravel Vercel Entry Point
 * Simple and Clean Configuration
 */

// Set memory limit for Composer
ini_set('memory_limit', '512M');

// Set timezone
date_default_timezone_set('UTC');

// Create required directories in /tmp for Vercel
$requiredDirs = [
    '/tmp/storage',
    '/tmp/storage/app',
    '/tmp/storage/app/public', 
    '/tmp/storage/framework',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs'
];

foreach ($requiredDirs as $dir) {
    if (!file_exists($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Set Laravel environment variables for Vercel
$_ENV['APP_ENV'] = 'production';
$_ENV['APP_DEBUG'] = 'false';
$_ENV['VIEW_COMPILED_PATH'] = '/tmp';
$_ENV['CACHE_DRIVER'] = 'array';
$_ENV['SESSION_DRIVER'] = 'cookie';
$_ENV['LOG_CHANNEL'] = 'stderr';

// Change to Laravel's public directory
chdir(dirname(__DIR__));

// Load Laravel's front controller
require_once __DIR__ . '/../public/index.php';
