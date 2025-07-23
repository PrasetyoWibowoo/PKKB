#!/usr/bin/env php
<?php

/**
 * Laravel Vercel Entry Point
 * Optimized for Vercel serverless deployment
 */

// Set memory limit untuk Composer
ini_set('memory_limit', '512M');

// Set timezone
date_default_timezone_set('UTC');

// Create required directories di /tmp untuk Vercel
$requiredDirs = [
    '/tmp/storage',
    '/tmp/storage/app',
    '/tmp/storage/app/public', 
    '/tmp/storage/framework',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
    '/tmp/cache',
    '/tmp/bootstrap/cache'
];

foreach ($requiredDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Set environment variables for production
if (getenv('VERCEL') || getenv('APP_ENV') === 'production') {
    // Override storage paths untuk Vercel
    $_ENV['APP_STORAGE_PATH'] = '/tmp/storage';
    $_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';
    $_ENV['APP_SERVICES_CACHE'] = '/tmp/bootstrap/cache/services.php';
    $_ENV['APP_PACKAGES_CACHE'] = '/tmp/bootstrap/cache/packages.php';
    $_ENV['APP_CONFIG_CACHE'] = '/tmp/bootstrap/cache/config.php';
    $_ENV['APP_ROUTES_CACHE'] = '/tmp/bootstrap/cache/routes.php';
    $_ENV['APP_EVENTS_CACHE'] = '/tmp/bootstrap/cache/events.php';
}

// Load Laravel application
require_once __DIR__ . '/../public/index.php';
