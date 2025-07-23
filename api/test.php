<?php

/**
 * Simple Test File for Vercel PHP
 */

// Check PHP version and basic functionality
echo json_encode([
    'status' => 'success',
    'message' => 'PHP is working on Vercel!',
    'php_version' => PHP_VERSION,
    'timestamp' => date('Y-m-d H:i:s'),
    'environment' => [
        'APP_ENV' => $_ENV['APP_ENV'] ?? 'not_set',
        'memory_limit' => ini_get('memory_limit'),
        'max_execution_time' => ini_get('max_execution_time')
    ],
    'directories' => [
        'current_dir' => getcwd(),
        'script_dir' => __DIR__,
        'tmp_exists' => is_dir('/tmp'),
        'public_exists' => file_exists(dirname(__DIR__) . '/public/index.php')
    ]
]);

?>
