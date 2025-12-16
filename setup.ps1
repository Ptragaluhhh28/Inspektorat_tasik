# PowerShell Script untuk Setup PKL Kominfo dengan MySQL dan Nginx
# Jalankan sebagai Administrator

Write-Host "=== Setup PKL Kominfo Laravel Project ===" -ForegroundColor Green

# 1. Backup current .env
if (Test-Path ".env") {
    Copy-Item ".env" ".env.backup"
    Write-Host "✓ Backup .env ke .env.backup" -ForegroundColor Yellow
}

# 2. Setup MySQL Environment
if (Test-Path ".env.mysql") {
    Copy-Item ".env.mysql" ".env"
    Write-Host "✓ Menggunakan konfigurasi MySQL" -ForegroundColor Green
} else {
    Write-Host "✗ File .env.mysql tidak ditemukan" -ForegroundColor Red
    exit 1
}

# 3. Test MySQL Connection
Write-Host "Mengecek koneksi MySQL..." -ForegroundColor Blue
$mysqlTest = php artisan migrate:status 2>&1
if ($LASTEXITCODE -eq 0) {
    Write-Host "✓ Koneksi MySQL berhasil" -ForegroundColor Green
    
    # 4. Run Migrations
    Write-Host "Menjalankan migrasi database..." -ForegroundColor Blue
    php artisan migrate --force
    
    if ($LASTEXITCODE -eq 0) {
        Write-Host "✓ Migrasi database selesai" -ForegroundColor Green
    } else {
        Write-Host "✗ Gagal menjalankan migrasi" -ForegroundColor Red
    }
} else {
    Write-Host "✗ Koneksi MySQL gagal. Pastikan MySQL berjalan dan database 'pkl_kominfo' sudah dibuat." -ForegroundColor Red
    Write-Host "Jalankan: mysql -u root -p < database\setup_mysql.sql" -ForegroundColor Yellow
    
    # Fallback ke SQLite
    Write-Host "Menggunakan SQLite sebagai fallback..." -ForegroundColor Yellow
    Copy-Item ".env.backup" ".env"
}

# 5. Clear Cache
Write-Host "Membersihkan cache..." -ForegroundColor Blue
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# 6. Set Permissions
Write-Host "Setting permissions..." -ForegroundColor Blue
if (Test-Path "storage") {
    icacls "storage" /grant Everyone:F /T | Out-Null
}
if (Test-Path "bootstrap\cache") {
    icacls "bootstrap\cache" /grant Everyone:F /T | Out-Null
}

Write-Host "✓ Setup selesai!" -ForegroundColor Green
Write-Host ""
Write-Host "=== Informasi ===" -ForegroundColor Cyan
Write-Host "Development Server: php artisan serve"
Write-Host "URL: http://127.0.0.1:8000"
Write-Host ""
Write-Host "Untuk Nginx:"
Write-Host "1. Copy nginx.conf ke konfigurasi Nginx"
Write-Host "2. Setup PHP-FPM di port 9000"
Write-Host "3. Restart Nginx"
Write-Host ""
Write-Host "Baca SETUP_GUIDE.md untuk detail lengkap" -ForegroundColor Yellow