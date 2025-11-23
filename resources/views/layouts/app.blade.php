<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Local Incident Radar') }} - @yield('title', 'Dashboard')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #8b5cf6;
            --accent: #ec4899;
            --dark: #1e293b;
            --light: #f8fafc;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-link {
            font-weight: 500;
            color: var(--dark) !important;
            margin: 0 0.5rem;
            transition: all 0.3s;
            border-radius: 8px;
            padding: 0.5rem 1rem !important;
        }

        .nav-link:hover {
            color: var(--primary) !important;
            background: rgba(99, 102, 241, 0.1);
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            background: white;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border: none;
            padding: 1.25rem 1.5rem;
            font-weight: 600;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border: none;
            border-radius: 12px;
            padding: 12px 28px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
        }

        .btn-outline-primary {
            border: 2px solid var(--primary);
            color: var(--primary);
            border-radius: 12px;
            padding: 10px 24px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .badge {
            padding: 8px 14px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .table {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .table thead {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
        }

        .table thead th {
            border: none;
            padding: 1.25rem;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            padding: 1.25rem;
            vertical-align: middle;
            border-color: #f1f5f9;
        }

        .table tbody tr {
            transition: all 0.3s;
        }

        .table tbody tr:hover {
            background: rgba(99, 102, 241, 0.05);
            transform: scale(1.01);
        }

        .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            padding: 12px 18px;
            transition: all 0.3s;
            font-size: 0.95rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.75rem;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 1.25rem 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .alert-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .alert-info {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }

        .alert-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .main-content {
            padding: 2rem 0;
            min-height: calc(100vh - 200px);
        }

        .page-header {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .page-header h2 {
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .page-header p {
            color: #64748b;
            margin: 0;
        }

        .footer {
            background: var(--dark);
            color: white;
            padding: 2.5rem 0;
            margin-top: 4rem;
        }

        .dropdown-menu {
            border-radius: 12px;
            border: none;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            padding: 0.5rem;
        }

        .dropdown-item {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: all 0.3s;
        }

        .dropdown-item:hover {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        /* Pagination Responsive */
        .pagination {
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.5rem;
            margin: 0;
        }

        .pagination .page-link {
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            color: var(--primary);
            font-weight: 600;
            transition: all 0.3s;
            min-width: 44px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pagination .page-link:hover {
            background: rgba(99, 102, 241, 0.1);
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-color: var(--primary);
            color: white;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .pagination .page-item.disabled .page-link {
            color: #94a3b8;
            background: #f1f5f9;
            border-color: #e2e8f0;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .pagination .page-item.disabled .page-link:hover {
            transform: none;
            background: #f1f5f9;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .container {
                max-width: 100%;
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }

        @media (max-width: 992px) {
            .navbar-brand {
                font-size: 1.25rem;
            }
            .nav-link {
                padding: 0.5rem 0.75rem !important;
                margin: 0.25rem 0;
            }
            .main-content {
                padding: 1.5rem 0;
            }
            .page-header {
                padding: 1.5rem;
            }
            .page-header h2 {
                font-size: 1.5rem;
            }
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1rem 0;
            }
            .page-header {
                padding: 1rem;
            }
            .page-header h2 {
                font-size: 1.25rem;
            }
            .card-body {
                padding: 1.5rem !important;
            }
            .table {
                font-size: 0.875rem;
                min-width: 800px;
            }
            .table thead th {
                padding: 0.75rem 0.5rem;
                font-size: 0.75rem;
            }
            .table tbody td {
                padding: 0.75rem 0.5rem;
            }
            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }
            .btn-lg {
                padding: 0.75rem 1.5rem;
                font-size: 1rem;
            }
            .pagination {
                font-size: 0.8rem;
            }
            .pagination .page-link {
                padding: 0.4rem 0.6rem;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.1rem;
            }
            .page-header {
                padding: 1rem;
            }
            .page-header h2 {
                font-size: 1.1rem;
            }
            .card-body {
                padding: 1rem !important;
            }
            .table {
                font-size: 0.75rem;
                min-width: 700px;
            }
            .table thead th {
                padding: 0.5rem 0.25rem;
                font-size: 0.7rem;
            }
            .table tbody td {
                padding: 0.5rem 0.25rem;
            }
            .badge {
                padding: 4px 8px;
                font-size: 0.7rem;
            }
            .pagination {
                font-size: 0.75rem;
            }
            .pagination .page-link {
                padding: 0.35rem 0.5rem;
                font-size: 0.75rem;
            }
            .pagination .page-item:first-child .page-link,
            .pagination .page-item:last-child .page-link {
                display: none;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
                @php
                    $logoPath = public_path('logo.png');
                    $logoUrl = asset('logo.png') . '?v=' . filemtime($logoPath);
                @endphp
                @if(file_exists($logoPath))
                    <img src="{{ $logoUrl }}" alt="DHA Production Logo" style="height: 40px; margin-right: 10px; object-fit: contain; max-width: 150px;">
                @endif
                <span><i class="bi bi-radar"></i> Local Incident Radar</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('incidents.create') }}">
                                <i class="bi bi-plus-circle"></i> Buat Laporan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('map') }}">
                                <i class="bi bi-map"></i> Peta Publik
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person"></i> Profile
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show fade-in" role="alert">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show fade-in" role="alert">
                    <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show fade-in" role="alert">
                    <i class="bi bi-info-circle-fill"></i> {{ session('info') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-radar"></i> Local Incident Radar
                    </h5>
                    <p class="text-muted small">
                        Sistem pelaporan kejadian lokal dengan teknologi AI untuk analisis otomatis dan respons cepat.
                    </p>
                    <div class="mt-3">
                        <span class="badge bg-warning">DEMO VERSION</span>
                    </div>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-3">Kontak</h5>
                    <p class="text-muted small mb-2">
                        <i class="bi bi-envelope"></i> 
                        <a href="mailto:dhaproductionengineering@gmail.com" class="text-white text-decoration-none">
                            dhaproductionengineering@gmail.com
                        </a>
                    </p>
                    <p class="text-muted small mb-2">
                        <i class="bi bi-github"></i> 
                        <a href="https://github.com/dhall-afdhal" target="_blank" class="text-white text-decoration-none">
                            @dhall-afdhal
                        </a>
                    </p>
                    <p class="text-muted small">
                        <i class="bi bi-building"></i> DHA Production Engineering
                    </p>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3">Informasi</h5>
                    <p class="text-muted small mb-2">
                        Versi ini adalah <strong>DEMO</strong> untuk demonstrasi fitur.
                    </p>
                    <p class="text-muted small">
                        Untuk versi full/production, silakan hubungi kami melalui email di atas.
                    </p>
                </div>
            </div>
            <hr style="border-color: rgba(255,255,255,0.1);">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-2 small">
                        © <b>2020 - {{ date('Y') }}</b> <b>𝘈𝘧𝘥𝘩𝘢𝘭 & 𝘋𝘏𝘈 𝘗𝘳𝘰𝘥𝘶𝘤𝘵𝘪𝘰𝘯</b> — All rights reserved.
                    </p>
                    <p class="mb-0 small text-muted">
                        <i>Diciptakan dengan semangat belajar, keamanan, dan inovasi oleh Afdhal.</i>
                    </p>
                    <p class="mt-2 mb-0">
                        <a href="https://github.com/dhall-afdhal" target="_blank" class="text-white text-decoration-none">
                            <i class="bi bi-github"></i> Follow @dhall-afdhal
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
