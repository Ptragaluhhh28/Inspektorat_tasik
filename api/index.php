<?php

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Forward the request to Laravel's entry point
require __DIR__ . '/../public/index.php';
