<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin') - PKL Kominfo</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        :root {
            --primary-color: #0f172a;
            --secondary-color: #1e293b;
            --accent-color: #3b82f6;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --text-color: #334155;
            --light-bg: #f8fafc;
            --border-color: #e2e8f0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--light-bg);
            color: var(--text-color);
        }

        .sidebar {
            min-height: 100vh;
            background: var(--primary-color);
            border-right: 1px solid var(--border-color);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.7);
            padding: 0.875rem 1.25rem;
            margin: 0.125rem 0.75rem;
            border-radius: 0.75rem;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        .sidebar .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--accent-color), #60a5fa);
            opacity: 0;
            transition: opacity 0.2s ease;
            border-radius: 0.75rem;
        }
        
        .sidebar .nav-link:hover::before,
        .sidebar .nav-link.active::before {
            opacity: 1;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            transform: translateX(2px);
        }
        
        .sidebar .nav-link i {
            position: relative;
            z-index: 1;
            width: 20px;
            text-align: center;
        }
        
        .sidebar .nav-link span {
            position: relative;
            z-index: 1;
        }
        
        .main-content {
            min-height: 100vh;
            background-color: var(--light-bg);
        }
        
        .card {
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
            background: white;
        }
        
        .card:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .stat-card {
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--accent-color);
        }
        
        .stat-card.primary::before { background: var(--accent-color); }
        .stat-card.success::before { background: var(--success-color); }
        .stat-card.warning::before { background: var(--warning-color); }
        .stat-card.danger::before { background: var(--danger-color); }
        
        .admin-header {
            background: white;
            border-bottom: 1px solid var(--border-color);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            margin-bottom: 2rem;
        }
        
        .page-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
        }
        
        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
        }
        
        .breadcrumb-item {
            font-size: 0.875rem;
            color: #64748b;
        }
        
        .breadcrumb-item.active {
            color: var(--accent-color);
            font-weight: 500;
        }
        
        .btn-primary {
            background: var(--accent-color);
            border-color: var(--accent-color);
            border-radius: 0.5rem;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.2s ease;
        }
        
        .btn-primary:hover {
            background: #2563eb;
            border-color: #2563eb;
            transform: translateY(-1px);
        }
        
        .alert {
            border: none;
            border-radius: 0.75rem;
            font-weight: 500;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            color: #991b1b;
        }
        
        .text-primary { color: var(--accent-color) !important; }
        .text-success { color: var(--success-color) !important; }
        .text-warning { color: var(--warning-color) !important; }
        .text-danger { color: var(--danger-color) !important; }
        
        .bg-primary { background-color: var(--accent-color) !important; }
        .bg-success { background-color: var(--success-color) !important; }
        .bg-warning { background-color: var(--warning-color) !important; }
        .bg-danger { background-color: var(--danger-color) !important; }
        
        /* Modern scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        /* Progress bars */
        .progress {
            height: 0.5rem;
            border-radius: 0.5rem;
            background-color: #f1f5f9;
        }
        
        .progress-bar {
            border-radius: 0.5rem;
        }
        
        /* Card header styling */
        .card-header {
            background: white;
            border-bottom: 1px solid var(--border-color);
            border-radius: 1rem 1rem 0 0 !important;
            padding: 1.25rem;
        }
        
        .card-header h6 {
            margin: 0;
            font-weight: 600;
            color: var(--primary-color);
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-4">
                    <!-- Logo & Brand -->
                    <div class="text-center mb-5">
                        <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                             style="width: 60px; height: 60px;">
                            <i class="fas fa-shield-alt text-primary fs-4"></i>
                        </div>
                        <h4 class="text-white fw-bold mb-1">Inspektorat</h4>
                        <p class="text-white-50 small mb-0">Kota Tasikmalaya</p>
                        <div class="bg-white bg-opacity-10 rounded-pill px-3 py-1 mt-2 d-inline-block">
                            <small class="text-white-50">Admin Panel</small>
                        </div>
                    </div>
                    
                    <!-- Navigation Menu -->
                    <div class="px-2">
                        <ul class="nav flex-column gap-1">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                                   href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-home"></i>
                                    <span class="ms-3">Dashboard</span>
                                </a>
                            </li>
                            
                            <!-- Content Management -->
                            <li class="nav-item mt-3">
                                <div class="text-white-50 small fw-semibold px-3 mb-2 text-uppercase tracking-wider">
                                    Content Management
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}" 
                                   href="{{ route('admin.berita.index') }}">
                                    <i class="fas fa-newspaper"></i>
                                    <span class="ms-3">Berita</span>
                                    <span class="badge bg-danger bg-opacity-75 rounded-pill ms-auto">2</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-images"></i>
                                    <span class="ms-3">Galeri</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-file-alt"></i>
                                    <span class="ms-3">SAKIP</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-gavel"></i>
                                    <span class="ms-3">Peraturan</span>
                                </a>
                            </li>
                            
                            <!-- Communication -->
                            <li class="nav-item mt-3">
                                <div class="text-white-50 small fw-semibold px-3 mb-2 text-uppercase tracking-wider">
                                    Communication
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-envelope"></i>
                                    <span class="ms-3">Kontak Masuk</span>
                                    <span class="badge bg-success bg-opacity-75 rounded-pill ms-auto">5</span>
                                </a>
                            </li>
                            
                            <!-- Analytics -->
                            <li class="nav-item mt-3">
                                <div class="text-white-50 small fw-semibold px-3 mb-2 text-uppercase tracking-wider">
                                    Analytics
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-chart-bar"></i>
                                    <span class="ms-3">Statistik</span>
                                </a>
                            </li>
                            
                            <!-- System -->
                            <li class="nav-item mt-4">
                                <hr class="border-white border-opacity-25 my-3">
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/') }}" target="_blank">
                                    <i class="fas fa-external-link-alt"></i>
                                    <span class="ms-3">Lihat Website</span>
                                    <i class="fas fa-arrow-up-right-from-square ms-auto opacity-50"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span class="ms-3">Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <!-- Modern Header -->
                <div class="admin-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
                                            <i class="fas fa-home me-1"></i>Home
                                        </a>
                                    </li>
                                    @yield('breadcrumb')
                                </ol>
                            </nav>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <!-- Quick Actions -->
                            <div class="dropdown">
                                <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-plus me-1"></i>Quick Actions
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('admin.berita.create') }}">
                                        <i class="fas fa-newspaper me-2"></i>Tambah Berita
                                    </a></li>
                                    <li><a class="dropdown-item" href="#">
                                        <i class="fas fa-images me-2"></i>Upload Galeri
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">
                                        <i class="fas fa-cog me-2"></i>Pengaturan
                                    </a></li>
                                </ul>
                            </div>
                            
                            <!-- Current Time -->
                            <div class="text-muted small">
                                <i class="fas fa-clock me-1"></i>
                                <span id="current-time">{{ now()->format('d M Y, H:i') }}</span>
                            </div>
                            
                            <!-- User Profile -->
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle me-1"></i>Admin
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">
                                        <i class="fas fa-user me-2"></i>Profile
                                    </a></li>
                                    <li><a class="dropdown-item" href="#">
                                        <i class="fas fa-cog me-2"></i>Settings
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-2').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </a></li>
                                </ul>
                                <form id="logout-form-2" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Page Content -->
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Admin Panel Scripts -->
    <script>
        // Update current time every minute
        function updateTime() {
            const now = new Date();
            const options = { 
                day: '2-digit', 
                month: 'short', 
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            document.getElementById('current-time').textContent = now.toLocaleDateString('id-ID', options);
        }
        
        // Update time immediately and then every minute
        updateTime();
        setInterval(updateTime, 60000);
        
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    if (alert.querySelector('.btn-close')) {
                        alert.querySelector('.btn-close').click();
                    }
                }, 5000);
            });
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Add loading state to buttons
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
                    
                    // Re-enable button after 3 seconds (fallback)
                    setTimeout(() => {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                    }, 3000);
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>
