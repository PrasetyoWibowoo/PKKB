<?php

/**
 * Laravel Vercel Serverless Function
 * Optimized for Vercel deployment with error handling
 */

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set memory and time limits
ini_set('memory_limit', '1024M');
ini_set('max_execution_time', 30);

// Set timezone
date_default_timezone_set('UTC');

try {
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
            @mkdir($dir, 0755, true);
        }
    }

    // Set Laravel environment variables for Vercel
    $_ENV['APP_ENV'] = 'production';
    $_ENV['APP_DEBUG'] = 'true'; 
    $_ENV['APP_KEY'] = 'base64:' . base64_encode(random_bytes(32));
    $_ENV['VIEW_COMPILED_PATH'] = '/tmp';
    $_ENV['CACHE_DRIVER'] = 'array';
    $_ENV['SESSION_DRIVER'] = 'cookie';
    $_ENV['LOG_CHANNEL'] = 'stderr';
    $_ENV['DB_CONNECTION'] = 'sqlite';
    $_ENV['DB_DATABASE'] = '/tmp/database.sqlite';

    // Ensure we're in the right directory
    $rootPath = dirname(__DIR__);
    chdir($rootPath);

    // Check if Laravel's public index exists
    $laravelIndex = $rootPath . '/public/index.php';
    if (!file_exists($laravelIndex)) {
        throw new Exception("Laravel public/index.php not found at: " . $laravelIndex);
    }

    // Load Laravel's front controller
    require_once $laravelIndex;

} catch (Exception $e) {
    // Handle errors gracefully
    http_response_code(500);
    echo json_encode([
        'error' => 'Server Error',
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString()
    ]);
    exit;
} catch (Error $e) {
    // Handle fatal errors
    http_response_code(500);
    echo json_encode([
        'error' => 'Fatal Error',
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ]);
    exit;
}
