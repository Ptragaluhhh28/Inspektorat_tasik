<?php

// 1. Paksa tampilkan error di level tertinggi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Setup folder storage di /tmp (satu-satunya tempat yang bisa ditulis di Vercel)
$storagePath = '/tmp/storage';
$dirs = [
    $storagePath . '/app/public',
    $storagePath . '/framework/cache/data',
    $storagePath . '/framework/sessions',
    $storagePath . '/framework/testing',
    $storagePath . '/framework/views',
    $storagePath . '/bootstrap/cache',
    $storagePath . '/logs',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        if (!mkdir($dir, 0755, true)) {
            die("Gagal membuat folder di /tmp: $dir");
        }
    }
}

// 3. Set Env untuk Laravel
putenv('APP_STORAGE=' . $storagePath);
$_ENV['APP_STORAGE'] = $storagePath;

// 4. Jalankan Laravel dengan Catch Error
try {
    // Pastikan autoload ada
    if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
        die("Vendor autoload tidak ditemukan! Vercel gagal menjalankan composer install.");
    }
    
    require __DIR__ . '/../vendor/autoload.php';
    require __DIR__ . '/../public/index.php';
    
} catch (\Throwable $e) {
    echo "<h1>Laravel Gagal Booting (Vercel)</h1>";
    echo "<p><b>Pesan:</b> " . $e->getMessage() . "</p>";
    echo "<p><b>Lokasi:</b> " . $e->getFile() . " baris " . $e->getLine() . "</p>";
    echo "<hr><pre>" . $e->getTraceAsString() . "</pre>";
}
