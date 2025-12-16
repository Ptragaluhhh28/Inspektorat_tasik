# Script untuk setup database MySQL untuk PKL Kominfo
# Pastikan XAMPP/WAMP sudah running

Write-Host "=== Setup Database MySQL PKL Kominfo ===" -ForegroundColor Green

# 1. Cek apakah MySQL service berjalan
Write-Host "🔍 Checking MySQL service..." -ForegroundColor Blue
$mysqlService = Get-Service -Name "*mysql*" -ErrorAction SilentlyContinue
if ($mysqlService) {
    Write-Host "✓ MySQL service found: $($mysqlService.Name) - $($mysqlService.Status)" -ForegroundColor Green
} else {
    Write-Host "⚠️ MySQL service not found. Pastikan XAMPP/WAMP sudah running." -ForegroundColor Yellow
}

# 2. Test koneksi MySQL
Write-Host "🔗 Testing MySQL connection..." -ForegroundColor Blue
$mysqlTest = mysql -u root -e "SELECT 'MySQL connection OK' as status;" 2>&1
if ($LASTEXITCODE -eq 0) {
    Write-Host "✓ MySQL connection successful" -ForegroundColor Green
} else {
    Write-Host "✗ MySQL connection failed" -ForegroundColor Red
    Write-Host "Pastikan:" -ForegroundColor Yellow
    Write-Host "- XAMPP/WAMP sudah running" -ForegroundColor White
    Write-Host "- MySQL service aktif" -ForegroundColor White
    Write-Host "- Port 3306 tersedia" -ForegroundColor White
    exit 1
}

# 3. Buat database
Write-Host "🗄️ Creating database..." -ForegroundColor Blue
$createDb = mysql -u root -e "CREATE DATABASE IF NOT EXISTS pkl_kominfo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>&1
if ($LASTEXITCODE -eq 0) {
    Write-Host "✓ Database 'pkl_kominfo' created successfully" -ForegroundColor Green
} else {
    Write-Host "✗ Failed to create database" -ForegroundColor Red
    Write-Host $createDb
    exit 1
}

# 4. Verify database exists
Write-Host "🔍 Verifying database..." -ForegroundColor Blue
$verifyDb = mysql -u root -e "SHOW DATABASES LIKE 'pkl_kominfo';" 2>&1
if ($verifyDb -match "pkl_kominfo") {
    Write-Host "✓ Database verified successfully" -ForegroundColor Green
} else {
    Write-Host "✗ Database verification failed" -ForegroundColor Red
    exit 1
}

# 5. Test Laravel connection
Write-Host "🔧 Testing Laravel database connection..." -ForegroundColor Blue
php artisan config:clear | Out-Null
$laravelTest = php artisan migrate:status 2>&1
if ($LASTEXITCODE -eq 0) {
    Write-Host "✓ Laravel can connect to MySQL" -ForegroundColor Green
} else {
    Write-Host "⚠️ Laravel connection needs migration" -ForegroundColor Yellow
    Write-Host "Running migrations..." -ForegroundColor Blue
    php artisan migrate
    if ($LASTEXITCODE -eq 0) {
        Write-Host "✓ Migrations completed successfully" -ForegroundColor Green
    } else {
        Write-Host "✗ Migration failed" -ForegroundColor Red
    }
}

Write-Host ""
Write-Host "=== Database Setup Complete ===" -ForegroundColor Cyan
Write-Host "Database: pkl_kominfo" -ForegroundColor White
Write-Host "Host: 127.0.0.1:3306" -ForegroundColor White
Write-Host "Username: root" -ForegroundColor White
Write-Host "Password: (empty)" -ForegroundColor White
Write-Host ""
Write-Host "phpMyAdmin: http://localhost/phpmyadmin/" -ForegroundColor Yellow
Write-Host "Laravel App: http://127.0.0.1:8000" -ForegroundColor Yellow