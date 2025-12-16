-- Script untuk setup database MySQL untuk PKL Kominfo
-- Jalankan script ini di MySQL command line atau phpMyAdmin

-- Membuat database
CREATE DATABASE IF NOT EXISTS pkl_kominfo 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

-- Membuat user khusus untuk aplikasi (opsional)
-- CREATE USER IF NOT EXISTS 'pkl_user'@'localhost' IDENTIFIED BY 'pkl_password';
-- GRANT ALL PRIVILEGES ON pkl_kominfo.* TO 'pkl_user'@'localhost';
-- FLUSH PRIVILEGES;

-- Gunakan database
USE pkl_kominfo;

-- Tabel untuk berita
CREATE TABLE IF NOT EXISTS berita (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    konten TEXT NOT NULL,
    excerpt TEXT,
    gambar VARCHAR(255),
    status ENUM('draft', 'published') DEFAULT 'draft',
    views INT DEFAULT 0,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    INDEX idx_status (status),
    INDEX idx_created_at (created_at)
);

-- Tabel untuk galeri
CREATE TABLE IF NOT EXISTS galeri (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    gambar VARCHAR(255) NOT NULL,
    kategori ENUM('kegiatan', 'fasilitas', 'event') DEFAULT 'kegiatan',
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    INDEX idx_kategori (kategori)
);

-- Tabel untuk dokumen SAKIP
CREATE TABLE IF NOT EXISTS dokumen_sakip (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_dokumen VARCHAR(255) NOT NULL,
    jenis_dokumen ENUM('renstra', 'renja', 'lakip', 'ikm', 'lke') NOT NULL,
    tahun YEAR NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    ukuran_file INT,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    INDEX idx_jenis_tahun (jenis_dokumen, tahun)
);

-- Tabel untuk peraturan
CREATE TABLE IF NOT EXISTS peraturan (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nomor_peraturan VARCHAR(100) NOT NULL,
    judul VARCHAR(255) NOT NULL,
    jenis ENUM('undang-undang', 'peraturan-pemerintah', 'peraturan-menteri', 'peraturan-daerah', 'keputusan') NOT NULL,
    tahun YEAR NOT NULL,
    tentang TEXT NOT NULL,
    file_path VARCHAR(255),
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    INDEX idx_jenis (jenis),
    INDEX idx_tahun (tahun)
);

-- Tabel untuk statistik pengunjung
CREATE TABLE IF NOT EXISTS statistik_pengunjung (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tanggal DATE NOT NULL,
    jumlah_pengunjung INT DEFAULT 0,
    unique_visitors INT DEFAULT 0,
    page_views INT DEFAULT 0,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    UNIQUE KEY unique_tanggal (tanggal)
);

-- Tabel untuk kontak masuk
CREATE TABLE IF NOT EXISTS kontak_masuk (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telepon VARCHAR(20),
    subjek VARCHAR(255) NOT NULL,
    pesan TEXT NOT NULL,
    status ENUM('baru', 'dibaca', 'direspon') DEFAULT 'baru',
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    INDEX idx_status (status),
    INDEX idx_created_at (created_at)
);

-- Tabel untuk menu navigasi
CREATE TABLE IF NOT EXISTS menus (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    url VARCHAR(255),
    parent_id BIGINT UNSIGNED NULL,
    urutan INT DEFAULT 0,
    status BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (parent_id) REFERENCES menus(id) ON DELETE CASCADE,
    INDEX idx_parent_urutan (parent_id, urutan)
);

-- Insert data sample
INSERT INTO berita (judul, slug, konten, excerpt, status, views) VALUES 
('Selamat Datang di Portal PKL Kominfo', 'selamat-datang-portal-pkl-kominfo', 'Ini adalah artikel pertama di portal PKL Kominfo Tasikmalaya.', 'Artikel pembuka portal PKL Kominfo', 'published', 10),
('Kegiatan PKL Semester Genap 2025', 'kegiatan-pkl-semester-genap-2025', 'Laporan kegiatan PKL semester genap tahun 2025.', 'Laporan kegiatan PKL terbaru', 'published', 5);

INSERT INTO galeri (judul, deskripsi, gambar, kategori) VALUES 
('Kegiatan PKL Hari Pertama', 'Dokumentasi kegiatan PKL hari pertama', 'pkl-hari-1.jpg', 'kegiatan'),
('Fasilitas Kantor Kominfo', 'Fasilitas yang tersedia di kantor', 'fasilitas-kantor.jpg', 'fasilitas');

INSERT INTO menus (nama, url, parent_id, urutan, status) VALUES 
('Beranda', '/', NULL, 1, TRUE),
('Tentang Kami', '#', NULL, 2, TRUE),
('Sejarah', '/tentang-kami/sejarah', 2, 1, TRUE),
('Struktur Organisasi', '/tentang-kami/struktur', 2, 2, TRUE),
('Tupoksi', '/tentang-kami/tupoksi', 2, 3, TRUE),
('Berita', '/berita', NULL, 3, TRUE),
('Galeri', '/galeri', NULL, 4, TRUE),
('SAKIP', '/sakip', NULL, 5, TRUE),
('Peraturan', '/peraturan', NULL, 6, TRUE),
('Kontak', '/kontak', NULL, 7, TRUE);

-- Menampilkan database yang sudah dibuat
SHOW DATABASES;
SHOW TABLES;