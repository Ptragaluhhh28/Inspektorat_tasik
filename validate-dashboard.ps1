# Script untuk test dan validasi dashboard admin
# Jalankan sebelum mengakses dashboard

Write-Host "=== Validasi Dashboard Admin PKL Kominfo ===" -ForegroundColor Green

# 1. Clear semua cache
Write-Host "🧹 Clearing cache..." -ForegroundColor Blue
php artisan config:clear | Out-Null
php artisan cache:clear | Out-Null  
php artisan view:clear | Out-Null
php artisan route:cache | Out-Null

# 2. Cek database dan migration
Write-Host "🗄️  Checking database..." -ForegroundColor Blue
$migrationStatus = php artisan migrate:status 2>&1
if ($LASTEXITCODE -eq 0) {
    Write-Host "✓ Database migration OK" -ForegroundColor Green
} else {
    Write-Host "✗ Database migration error" -ForegroundColor Red
    php artisan migrate
}

# 3. Cek data berita
Write-Host "📰 Checking berita data..." -ForegroundColor Blue
$beritaCount = php artisan tinker --execute="echo App\Models\Berita::count();" 2>&1
Write-Host "Total berita: $beritaCount" -ForegroundColor Yellow

# 4. Test route dashboard
Write-Host "🔗 Checking dashboard route..." -ForegroundColor Blue
$routeCheck = php artisan route:list | findstr "admin.dashboard"
if ($routeCheck) {
    Write-Host "✓ Dashboard route exists" -ForegroundColor Green
} else {
    Write-Host "✗ Dashboard route missing" -ForegroundColor Red
}

# 5. Cek controller dan model
Write-Host "🎛️  Checking controller files..." -ForegroundColor Blue
$files = @(
    "app\Http\Controllers\Admin\DashboardController.php",
    "app\Models\Berita.php", 
    "resources\views\admin\dashboard.blade.php",
    "resources\views\admin\layouts\app.blade.php"
)

foreach ($file in $files) {
    if (Test-Path $file) {
        Write-Host "✓ $file exists" -ForegroundColor Green
    } else {
        Write-Host "✗ $file missing" -ForegroundColor Red
    }
}

Write-Host ""
Write-Host "=== Ready to Test Dashboard ===" -ForegroundColor Cyan
Write-Host "Jalankan server:" -ForegroundColor Yellow
Write-Host "php artisan serve" -ForegroundColor White
Write-Host ""
Write-Host "Akses dashboard:" -ForegroundColor Yellow  
Write-Host "http://127.0.0.1:8000/admin/dashboard" -ForegroundColor White
Write-Host ""

# 6. Auto start server (optional)
$startServer = Read-Host "Start server sekarang? (y/n)"
if ($startServer -eq "y" -or $startServer -eq "Y") {
    Write-Host "🚀 Starting Laravel server..." -ForegroundColor Green
    php artisan serve
}