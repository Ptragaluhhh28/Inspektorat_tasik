# Test Dashboard Script
# Jalankan script ini untuk menguji dashboard admin

Write-Host "=== Testing Dashboard Admin PKL Kominfo ===" -ForegroundColor Green

# 1. Clear cache
Write-Host "Clearing cache..." -ForegroundColor Blue
php artisan config:clear
php artisan cache:clear  
php artisan view:clear

# 2. Check database connection
Write-Host "Checking database..." -ForegroundColor Blue
php artisan migrate:status

# 3. Check if tables have data
Write-Host "Checking data..." -ForegroundColor Blue
php artisan tinker --execute="echo 'Total Berita: ' . App\Models\Berita::count();"

# 4. Test dashboard route
Write-Host "Testing dashboard route..." -ForegroundColor Blue
php artisan route:list | findstr "admin.dashboard"

Write-Host "✓ Setup selesai! Jalankan server dengan:" -ForegroundColor Green
Write-Host "php artisan serve" -ForegroundColor Yellow
Write-Host "Kemudian akses: http://127.0.0.1:8000/admin/dashboard" -ForegroundColor Yellow