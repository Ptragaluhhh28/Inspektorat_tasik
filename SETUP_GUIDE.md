# Setup Guide: Laravel dengan Nginx dan MySQL

## Prasyarat

-   Nginx terinstall di Windows
-   MySQL Server terinstall dan berjalan
-   PHP 8.2+ dengan extension yang diperlukan
-   Composer

## Langkah-langkah Setup

### 1. Setup Database MySQL

#### A. Start MySQL Service

```bash
# Start MySQL service (sebagai Administrator)
net start mysql
# atau
services.msc -> MySQL80 -> Start
```

#### B. Buat Database

```bash
# Login ke MySQL
mysql -u root -p

# Jalankan script setup
source d:/Project pkl/PKL_Kominfo/database/setup_mysql.sql
```

Atau import file SQL:

```bash
mysql -u root -p < "d:\Project pkl\PKL_Kominfo\database\setup_mysql.sql"
```

### 2. Konfigurasi Laravel untuk MySQL

#### A. Update Environment File

```bash
# Backup current .env
copy .env .env.backup

# Gunakan konfigurasi MySQL
copy .env.mysql .env
```

#### B. Test Koneksi Database

```bash
php artisan migrate:status
```

#### C. Jalankan Migrasi

```bash
php artisan migrate
```

### 3. Setup Nginx

#### A. Copy Konfigurasi Nginx

Copy file `nginx.conf` ke folder konfigurasi Nginx Anda:

```bash
# Contoh path Nginx di Windows
copy nginx.conf "C:\nginx\conf\sites-available\pkl-kominfo.conf"
```

#### B. Enable Site (jika menggunakan sites-available/sites-enabled)

```bash
# Buat symbolic link atau copy ke sites-enabled
copy "C:\nginx\conf\sites-available\pkl-kominfo.conf" "C:\nginx\conf\sites-enabled\"
```

#### C. Update nginx.conf utama

Tambahkan di bagian `http` block di `C:\nginx\conf\nginx.conf`:

```nginx
include sites-enabled/*;
```

#### D. Update hosts file (opsional)

Edit `C:\Windows\System32\drivers\etc\hosts` dan tambahkan:

```
127.0.0.1 pkl-kominfo.local
```

#### E. Test dan Restart Nginx

```bash
# Test konfigurasi
nginx -t

# Restart Nginx
nginx -s reload
# atau
nginx -s stop
nginx
```

### 4. Setup PHP-FPM (jika belum ada)

#### A. Install PHP-FPM

Download dan setup PHP-FPM untuk Windows atau gunakan alternatif seperti:

-   XAMPP
-   Laragon
-   Manual PHP CGI

#### B. Konfigurasi PHP-FPM

Pastikan PHP-FPM berjalan di port 9000:

```bash
# Untuk XAMPP
# Start Apache dan MySQL di XAMPP Control Panel

# Untuk Laragon
# Start All Services
```

### 5. Verifikasi Setup

#### A. Test Database Connection

```bash
cd "d:\Project pkl\PKL_Kominfo"
php artisan tinker
# Di tinker console:
DB::connection()->getPdo();
```

#### B. Test Web Server

1. Akses `http://localhost` atau `http://pkl-kominfo.local`
2. Pastikan halaman Laravel tampil tanpa error

### 6. Troubleshooting

#### Database Issues

```bash
# Cek status MySQL
net start | findstr MySQL

# Cek koneksi
php artisan migrate:status

# Reset database
php artisan migrate:fresh
```

#### Nginx Issues

```bash
# Cek syntax error
nginx -t

# Cek log error
type "C:\nginx\logs\error.log"

# Cek PHP-FPM
netstat -an | findstr :9000
```

#### Permission Issues

```bash
# Set permission folder storage dan bootstrap/cache
icacls "d:\Project pkl\PKL_Kominfo\storage" /grant Everyone:F /T
icacls "d:\Project pkl\PKL_Kominfo\bootstrap\cache" /grant Everyone:F /T
```

## File Konfigurasi Penting

-   `.env` - Environment configuration
-   `nginx.conf` - Nginx virtual host
-   `database/setup_mysql.sql` - Database setup script
-   `.env.mysql` - MySQL environment template

## URL Akses

-   Development: `http://127.0.0.1:8000` (php artisan serve)
-   Production: `http://localhost` atau `http://pkl-kominfo.local` (Nginx)

## Notes

-   Pastikan firewall tidak memblokir port 80 dan 3306
-   Untuk production, ganti `APP_DEBUG=false` dan `APP_ENV=production`
-   Backup database secara berkala
-   Monitor log files untuk troubleshooting
