<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\Admin\AuthController;

// Homepage
Route::get('/', function () {
    return view('home');
})->name('home');

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth routes (tidak perlu middleware)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected admin routes (perlu login)
    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('berita', AdminBeritaController::class)->parameters([
            'berita' => 'berita'
        ]);

        // Kontak Management Routes
        Route::prefix('kontak')->name('kontak.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\KontakController::class, 'index'])->name('index');
            Route::get('/{kontak}', [\App\Http\Controllers\Admin\KontakController::class, 'show'])->name('show');
            Route::delete('/{kontak}', [\App\Http\Controllers\Admin\KontakController::class, 'destroy'])->name('destroy');
            Route::post('/{kontak}/reply', [\App\Http\Controllers\Admin\KontakController::class, 'reply'])->name('reply');
            Route::post('/{kontak}/mark-as-read', [\App\Http\Controllers\Admin\KontakController::class, 'markAsRead'])->name('markAsRead');
            Route::post('/{kontak}/mark-as-unread', [\App\Http\Controllers\Admin\KontakController::class, 'markAsUnread'])->name('markAsUnread');
            Route::post('/bulk-delete', [\App\Http\Controllers\Admin\KontakController::class, 'bulkDelete'])->name('bulkDelete');
            Route::post('/bulk-mark-as-read', [\App\Http\Controllers\Admin\KontakController::class, 'bulkMarkAsRead'])->name('bulkMarkAsRead');
        });
    });
});

// Redirect /admin ke dashboard atau login
Route::get('/admin', function () {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('admin.login');
})->name('admin.home');

// Tentang Kami
Route::get('/tentang-kami', function () {
    return view('tentang-kami.index');
})->name('tentang-kami');

// Tentang Kami Submenu
Route::get('/sejarah', function () {
    return view('tentang-kami.sejarah');
})->name('sejarah');

Route::get('/tupoksi', function () {
    return view('tentang-kami.tupoksi');
})->name('tupoksi');

Route::get('/struktur', function () {
    return view('tentang-kami.struktur');
})->name('struktur');

// Route::get('/dukungan', function () {
//     return view('tentang-kami.dukungan');
// })->name('dukungan');

Route::get('/statistik', function () {
    return view('tentang-kami.statistik');
})->name('statistik');

// Route::get('/survey', function () {
//     return view('tentang-kami.survey');
// })->name('survey');

// Berita
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.detail');

// Peraturan
Route::get('/peraturan', function () {
    return view('peraturan');
})->name('peraturan');

// Galeri
Route::get('/galeri', function () {
    return view('galeri');
})->name('galeri');

// SAKIP
Route::get('/sakip', function () {
    return view('sakip');
})->name('sakip');

// Kontak
Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');
Route::post('/kontak', [\App\Http\Controllers\KontakController::class, 'store'])->name('kontak.store');
