-- Script SQL untuk membuat database pkl_kominfo
-- Jalankan di phpMyAdmin atau MySQL command line

-- Membuat database
CREATE DATABASE IF NOT EXISTS pkl_kominfo 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

-- Gunakan database
USE pkl_kominfo;

-- Membuat user khusus (opsional)
-- CREATE USER IF NOT EXISTS 'pkl_admin'@'localhost' IDENTIFIED BY 'pkl123456';
-- GRANT ALL PRIVILEGES ON pkl_kominfo.* TO 'pkl_admin'@'localhost';
-- FLUSH PRIVILEGES;

-- Menampilkan database yang sudah dibuat
SHOW DATABASES LIKE 'pkl_kominfo';

-- Menampilkan info database
SELECT 
    'Database pkl_kominfo berhasil dibuat!' as message,
    @@character_set_database as charset,
    @@collation_database as collation;