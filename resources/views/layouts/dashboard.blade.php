<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="منصة إدارة الروابط المختصرة - Click Master">
    <meta name="keywords" content="روابط مختصرة, إدارة روابط, تتبع نقرات">
    <meta name="author" content="Click Master">
    
    <title>{{ \App\Helpers\Config\Setting::getConfig('site-name') }} | @yield('title', 'لوحة التحكم')</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;900&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Unified Style System -->
    <link href="{{ asset('css/unified-style.css') }}" rel="stylesheet">
    
    <!-- Responsive Design -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    
    <!-- Internal Pages Styling -->
    <link href="{{ asset('css/internal-pages.css') }}" rel="stylesheet">
    
    <!-- Fixes CSS -->
    <link href="{{ asset('css/fixes.css') }}" rel="stylesheet">
    
    <!-- Custom Styles -->
    @yield('styles')
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <button class="btn btn-link text-white d-lg-none" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-link me-2"></i>
                {{ \App\Helpers\Config\Setting::getConfig('site-name') }}
            </a>
            
            <div class="navbar-nav ms-auto">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i> لوحة التحكم
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> تسجيل الخروج
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="sidebar-wrapper" id="sidebar">
            <div class="sidebar">
                <!-- User Info -->
                <div class="user-info">
                    <div class="user-avatar">
                        <img src="{{ asset('users/images/user.png') }}" alt="User" class="rounded-circle" />
                        <div class="status-indicator online"></div>
                    </div>
                    <div class="user-details">
                        <div class="user-name">{{ Auth::user()->name }}</div>
                        <div class="user-email">{{ Auth::user()->email }}</div>
                        <div class="user-role">
                            @if(Auth::user()->is_admin)
                                <span class="role-badge admin">مدير</span>
                            @else
                                <span class="role-badge user">مستخدم</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="sidebar-nav">
                    <ul class="nav-list">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>لوحة التحكم</span>
                            </a>
                        </li>

                        @if(Auth::user()->role > 0 || Auth::user()->credit_add > 0)
                            <li class="nav-item">
                                <a href="{{ route('links.add') }}" class="nav-link {{ request()->routeIs('links.add') ? 'active' : '' }}">
                                    <i class="fas fa-plus"></i>
                                    <span>إضافة رابط</span>
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="#" class="nav-link disabled" id="btn-add-link-cant">
                                    <i class="fas fa-lock"></i>
                                    <span>إضافة رابط</span>
                                    <span class="badge bg-warning">مقفل</span>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a href="{{ route('links.mine') }}" class="nav-link {{ request()->routeIs('links.mine') ? 'active' : '' }}">
                                <i class="fas fa-list"></i>
                                <span>روابطي</span>
                            </a>
                        </li>

                        @if(Auth::user()->role == 0)
                            <li class="nav-item">
                                <a href="{{ route('links.mining') }}" class="nav-link {{ request()->routeIs('links.mining') ? 'active' : '' }}">
                                    <i class="fas fa-hammer"></i>
                                    <span>التعدين</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('links.exchange') }}" class="nav-link {{ request()->routeIs('links.exchange') ? 'active' : '' }}">
                                    <i class="fas fa-exchange-alt"></i>
                                    <span>تبادل النقاط</span>
                                </a>
                            </li>
                        @endif

                        @if(Auth::user()->role > 0)
                            <li class="nav-item">
                                <a href="{{ route('admin.links.unconfirmed') }}" class="nav-link {{ request()->routeIs('admin.links.unconfirmed') ? 'active' : '' }}">
                                    <i class="fas fa-clock"></i>
                                    <span>الروابط غير المؤكدة</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.reports.index') }}" class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                                    <i class="fas fa-flag"></i>
                                    <span>التقارير</span>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a href="{{ route('links.check') }}" class="nav-link {{ request()->routeIs('links.check') ? 'active' : '' }}">
                                <i class="fas fa-search"></i>
                                <span>فحص الروابط</span>
                            </a>
                        </li>

                        @if(Auth::user()->role > 0)
                            <li class="nav-item">
                                <a href="{{ route('admin.configs.index') }}" class="nav-link {{ request()->routeIs('admin.configs.*') ? 'active' : '' }}">
                                    <i class="fas fa-cog"></i>
                                    <span>الإعدادات</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.ads.index') }}" class="nav-link {{ request()->routeIs('admin.ads.*') ? 'active' : '' }}">
                                    <i class="fas fa-ad"></i>
                                    <span>الإعلانات</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.catcher.logs', Auth::user()->id) }}" class="nav-link {{ request()->routeIs('admin.catcher.*') ? 'active' : '' }}">
                                    <i class="fas fa-mouse-pointer"></i>
                                    <span>سجلات النظام</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Page Content -->
        <div class="page-content-wrapper">
            <div class="page-content">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Scripts -->
    @yield('scripts')
    
    <!-- Global Scripts -->
    <script>
        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const wrapper = document.getElementById('wrapper');
            
            sidebar.classList.toggle('show');
            wrapper.classList.toggle('sidebar-collapsed');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            
            if (window.innerWidth <= 991.98) {
                if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                    sidebar.classList.remove('show');
                    document.getElementById('wrapper').classList.remove('sidebar-collapsed');
                }
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const wrapper = document.getElementById('wrapper');
            
            if (window.innerWidth > 991.98) {
                sidebar.classList.remove('show');
                wrapper.classList.remove('sidebar-collapsed');
            }
        });

        // Add loading animation to buttons
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('click', function() {
                if (!this.classList.contains('btn-outline') && !this.classList.contains('disabled')) {
                    this.classList.add('loading');
                    setTimeout(() => {
                        this.classList.remove('loading');
                    }, 1500);
                }
            });
        });

        // Enhanced sidebar interactions
        const sidebarLinks = document.querySelectorAll('.sidebar .nav-link');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Remove active class from all links
                sidebarLinks.forEach(l => l.classList.remove('active'));
                // Add active class to clicked link
                this.classList.add('active');
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(102, 126, 234, 0.95)';
                navbar.style.backdropFilter = 'blur(10px)';
            } else {
                navbar.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
                navbar.style.backdropFilter = 'none';
            }
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

        // Initialize tooltips
        if (typeof bootstrap !== 'undefined') {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }

        // Auto-hide alerts after 5 seconds
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    alert.remove();
                }, 300);
            }, 5000);
        });
    </script>
</body>
</html>
