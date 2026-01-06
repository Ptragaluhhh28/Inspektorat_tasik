<?php

// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Move storage to /tmp for Vercel's read-only filesystem
$storagePath = '/tmp/storage';
foreach ([
    $storagePath . '/app/public',
    $storagePath . '/framework/cache/data',
    $storagePath . '/framework/sessions',
    $storagePath . '/framework/testing',
    $storagePath . '/framework/views',
    $storagePath . '/bootstrap/cache',
    $storagePath . '/logs',
] as $dir) {
    if (!is_dir($dir)) mkdir($dir, 0755, true);
}

putenv('APP_STORAGE=' . $storagePath);
$_ENV['APP_STORAGE'] = $storagePath;

// Load Laravel
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../public/index.php';
