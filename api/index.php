<?php

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Vercel's filesystem is read-only (except for /tmp).
 * We need to move Laravel's storage and cache to /tmp.
 */

$storagePath = '/tmp/storage';

$storageDirs = [
    $storagePath . '/app/public',
    $storagePath . '/framework/cache/data',
    $storagePath . '/framework/sessions',
    $storagePath . '/framework/testing',
    $storagePath . '/framework/views',
    $storagePath . '/bootstrap/cache',
    $storagePath . '/logs',
];

foreach ($storageDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Set environment variables for storage path
putenv('APP_STORAGE=' . $storagePath);
$_ENV['APP_STORAGE'] = $storagePath;

// Verify required files
$autoload = __DIR__ . '/../vendor/autoload.php';
$appEntry = __DIR__ . '/../public/index.php';

if (!file_exists($autoload)) {
    die("Error: vendor/autoload.php not found. Did the build fail?");
}

if (!file_exists($appEntry)) {
    die("Error: public/index.php not found. Current directory: " . __DIR__);
}

// Forward the request to Laravel's entry point with detailed error catching
try {
    require $appEntry;
} catch (\Throwable $e) {
    echo "<h1>Laravel Startup Error (Vercel)</h1>";
    echo "<p><b>Message:</b> " . $e->getMessage() . "</p>";
    echo "<p><b>File:</b> " . $e->getFile() . " on line " . $e->getLine() . "</p>";
    echo "<h3>Stack Trace:</h3>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
