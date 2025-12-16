# Script Test Login Admin PKL Kominfo
# Jalankan untuk memvalidasi sistem login admin

Write-Host "=== Test Login Admin PKL Kominfo ===" -ForegroundColor Green

# 1. Clear semua cache
Write-Host "🧹 Clearing cache..." -ForegroundColor Blue
php artisan config:clear | Out-Null
php artisan route:clear | Out-Null
php artisan view:clear | Out-Null

# 2. Cek migration admin_users
Write-Host "🗄️ Checking admin_users table..." -ForegroundColor Blue
$tables = php artisan tinker --execute="echo 'Tables: '; Schema::hasTable('admin_users') ? print 'admin_users: OK' : print 'admin_users: MISSING';" 2>&1
Write-Host $tables -ForegroundColor Yellow

# 3. Cek admin users
Write-Host "👤 Checking admin users..." -ForegroundColor Blue
$adminCount = php artisan tinker --execute="echo App\Models\AdminUser::count();" 2>&1
Write-Host "Total admin users: $adminCount" -ForegroundColor Yellow

# 4. Test routes
Write-Host "🔗 Checking auth routes..." -ForegroundColor Blue
$authRoutes = @(
    "admin.login",
    "admin.register", 
    "admin.logout",
    "admin.dashboard"
)

foreach ($route in $authRoutes) {
    $routeExists = php artisan route:list | findstr $route
    if ($routeExists) {
        Write-Host "✓ Route $route exists" -ForegroundColor Green
    } else {
        Write-Host "✗ Route $route missing" -ForegroundColor Red
    }
}

# 5. Test auth guard
Write-Host "🛡️ Checking auth guard..." -ForegroundColor Blue
$guardTest = php artisan tinker --execute="echo config('auth.guards.admin') ? 'Guard admin: OK' : 'Guard admin: MISSING';" 2>&1
Write-Host $guardTest -ForegroundColor Yellow

Write-Host ""
Write-Host "=== Login Credentials ===" -ForegroundColor Cyan
Write-Host "Username: admin" -ForegroundColor White
Write-Host "Password: admin123" -ForegroundColor White
Write-Host ""
Write-Host "Username: operator" -ForegroundColor White  
Write-Host "Password: operator123" -ForegroundColor White
Write-Host ""

Write-Host "=== URLs untuk Test ===" -ForegroundColor Cyan
Write-Host "Login Admin: http://127.0.0.1:8000/admin/login" -ForegroundColor Yellow
Write-Host "Register Admin: http://127.0.0.1:8000/admin/register" -ForegroundColor Yellow
Write-Host "Dashboard: http://127.0.0.1:8000/admin/dashboard" -ForegroundColor Yellow
Write-Host "Redirect Admin: http://127.0.0.1:8000/admin" -ForegroundColor Yellow

Write-Host ""
Write-Host "🚀 Ready! Jalankan server:" -ForegroundColor Green
Write-Host "php artisan serve" -ForegroundColor White