<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Local Incident Radar - Sistem Pelaporan Kejadian Lokal</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #8b5cf6;
            --accent: #ec4899;
            --dark: #1e293b;
            --light: #f8fafc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--dark);
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.05);
            padding: 1rem 0;
            transition: all 0.3s;
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
        }

        .nav-link:hover {
            color: var(--primary) !important;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border: none;
            padding: 12px 28px;
            font-weight: 600;
            border-radius: 12px;
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
            padding: 12px 28px;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s;
        }

        .btn-outline-primary:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: move 20s linear infinite;
        }

        @keyframes move {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }

        .hero-content {
            position: relative;
            z-index: 1;
            color: white;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            animation: fadeInUp 0.8s;
        }

        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.95;
            animation: fadeInUp 1s;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-buttons {
            animation: fadeInUp 1.2s;
        }

        /* Features Section */
        .features {
            padding: 100px 0;
            background: var(--light);
        }

        .feature-card {
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            transition: all 0.3s;
            height: 100%;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.12);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 2rem;
            color: white;
        }

        .feature-card h3 {
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .feature-card p {
            color: #64748b;
            line-height: 1.7;
        }

        /* Stats Section */
        .stats {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* How It Works */
        .how-it-works {
            padding: 100px 0;
            background: white;
        }

        .step-card {
            text-align: center;
            padding: 2rem;
        }

        .step-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0 auto 1.5rem;
        }

        /* CTA Section */
        .cta {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            text-align: center;
        }

        .cta h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .cta p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }

        /* Footer */
        .footer {
            background: var(--dark);
            color: white;
            padding: 60px 0 30px;
        }

        .footer h5 {
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .footer a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.3s;
        }

        .footer a:hover {
            color: white;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero {
                min-height: auto;
                padding: 120px 0 80px;
            }
            .hero h1 {
                font-size: 2.5rem;
            }
            .features {
                padding: 60px 0;
            }
            .stats {
                padding: 60px 0;
            }
            .how-it-works {
                padding: 60px 0;
            }
            .cta {
                padding: 60px 0;
            }
        }

        @media (max-width: 768px) {
            .hero {
                padding: 100px 0 60px;
            }
            .hero h1 {
                font-size: 2rem;
            }
            .hero p {
                font-size: 1rem;
            }
            .hero-buttons .btn {
                display: block;
                width: 100%;
                margin-bottom: 1rem;
            }
            .feature-card {
                margin-bottom: 1.5rem;
            }
            .stat-number {
                font-size: 2.5rem;
            }
            .stat-label {
                font-size: 1rem;
            }
            .cta h2 {
                font-size: 2rem;
            }
            .cta p {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.1rem;
            }
            .hero {
                padding: 80px 0 40px;
            }
            .hero h1 {
                font-size: 1.75rem;
            }
            .hero p {
                font-size: 0.95rem;
            }
            .feature-card {
                padding: 1.5rem;
            }
            .feature-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
            .stat-number {
                font-size: 2rem;
            }
            .step-number {
                width: 50px;
                height: 50px;
                font-size: 1.25rem;
            }
            .cta h2 {
                font-size: 1.75rem;
            }
            .footer {
                padding: 40px 0 20px;
            }
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                @php
                    $logoPath = public_path('logo.png');
                    $logoUrl = file_exists($logoPath) ? asset('logo.png') . '?v=' . filemtime($logoPath) : '';
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
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#how-it-works">Cara Kerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#stats">Statistik</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Masuk</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <h1>Laporkan Kejadian, Lindungi Komunitas</h1>
                    <p>Sistem pelaporan kejadian lokal yang cerdas dengan teknologi AI untuk analisis otomatis dan respons cepat terhadap insiden di sekitar Anda.</p>
                    <div class="hero-buttons">
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg me-3">
                            <i class="bi bi-person-plus"></i> Daftar Sekarang
                        </a>
                        <a href="{{ route('map') }}" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-map"></i> Lihat Peta
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center mt-5 mt-lg-0">
                    <div class="position-relative">
                        <div style="background: rgba(255,255,255,0.1); border-radius: 20px; padding: 2rem; backdrop-filter: blur(10px); display: flex; align-items: center; justify-content: center;">
                            <img src="https://i.gifer.com/origin/80/80600e35d06edc4c53bc6cf15b1a7e82_w200.gif" alt="Local Incident Radar Animation" style="max-width: 100%; height: auto; border-radius: 15px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold mb-3">Fitur Unggulan</h2>
                <p class="text-muted fs-5">Platform lengkap untuk pelaporan dan manajemen kejadian</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-robot"></i>
                        </div>
                        <h3>AI-Powered Analysis</h3>
                        <p>Teknologi AI otomatis menganalisis laporan untuk menghasilkan ringkasan, kategorisasi, dan penentuan level urgensi secara instan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <h3>GPS Tracking</h3>
                        <p>Pelaporan dengan koordinat GPS akurat untuk memudahkan penanganan dan visualisasi lokasi kejadian di peta interaktif.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-camera-fill"></i>
                        </div>
                        <h3>Upload Foto</h3>
                        <p>Sertakan foto kejadian untuk memberikan bukti visual yang jelas dan membantu proses verifikasi laporan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-speedometer2"></i>
                        </div>
                        <h3>Dashboard Real-time</h3>
                        <p>Monitor semua laporan melalui dashboard interaktif dengan filter canggih berdasarkan kategori, urgensi, dan status.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-map"></i>
                        </div>
                        <h3>Peta Publik</h3>
                        <p>Visualisasi semua kejadian di peta interaktif dengan marker berwarna sesuai level urgensi untuk pemahaman cepat.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <h3>Keamanan Data</h3>
                        <p>Sistem keamanan terpercaya dengan enkripsi data dan autentikasi pengguna untuk melindungi informasi sensitif.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section id="stats" class="stats">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6 mb-4 mb-md-0">
                    <div class="stat-item">
                        <div class="stat-number">18+</div>
                        <div class="stat-label">Laporan Aktif</div>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4 mb-md-0">
                    <div class="stat-item">
                        <div class="stat-number">6+</div>
                        <div class="stat-label">Kategori Kejadian</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">AI Powered</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Tersedia</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="how-it-works">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold mb-3">Cara Kerja</h2>
                <p class="text-muted fs-5">Langkah-langkah mudah untuk melaporkan kejadian</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <h4>Daftar & Login</h4>
                        <p>Buat akun baru atau login dengan akun yang sudah ada untuk mengakses platform.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <h4>Buat Laporan</h4>
                        <p>Isi form laporan dengan detail kejadian, upload foto, dan tentukan lokasi GPS.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <h4>AI Processing</h4>
                        <p>Sistem AI otomatis menganalisis laporan dan menghasilkan ringkasan, kategori, dan urgensi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2>Siap Melaporkan Kejadian?</h2>
            <p>Bergabunglah dengan komunitas kami dan bantu menjaga keamanan lingkungan sekitar</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                <i class="bi bi-person-plus"></i> Daftar Gratis Sekarang
            </a>
        </div>
    </section>

    <!-- Demo Notice -->
    <section style="background: #f59e0b; color: white; padding: 2rem 0;">
        <div class="container text-center">
            <h4 class="mb-2">
                <i class="bi bi-info-circle"></i> Versi Demo
            </h4>
            <p class="mb-2 mb-0">
                Ini adalah versi <strong>DEMO</strong> untuk demonstrasi fitur. Untuk versi full/production dengan fitur lengkap, silakan hubungi kami.
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-4 mb-4 mb-md-0">
                    @php
                        $logoPath = public_path('logo.png');
                        $logoUrl = file_exists($logoPath) ? asset('logo.png') . '?v=' . filemtime($logoPath) : '';
                    @endphp
                    @if(file_exists($logoPath))
                        <div class="mb-3">
                            <img src="{{ $logoUrl }}" alt="DHA Production Logo" style="height: 50px; object-fit: contain; max-width: 200px;">
                        </div>
                    @endif
                    <h5><i class="bi bi-radar"></i> Local Incident Radar</h5>
                    <p class="text-white" style="opacity: 0.9;">Platform pelaporan kejadian lokal dengan teknologi AI untuk komunitas yang lebih aman.</p>
                    <div class="mt-3">
                        <span class="badge bg-warning text-dark">DEMO VERSION</span>
                    </div>
                </div>
                <div class="col-md-2 mb-4 mb-md-0">
                    <h5>Platform</h5>
                    <ul class="list-unstyled">
                        <li><a href="#features">Fitur</a></li>
                        <li><a href="#how-it-works">Cara Kerja</a></li>
                        <li><a href="{{ route('map') }}">Peta Publik</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4 mb-md-0">
                    <h5>Akun</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('login') }}">Masuk</a></li>
                        <li><a href="{{ route('register') }}">Daftar</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Kontak & Support</h5>
                    <p class="text-muted mb-2">
                        <i class="bi bi-envelope"></i> 
                        <a href="mailto:dhaproductionengineering@gmail.com" class="text-white text-decoration-none">
                            dhaproductionengineering@gmail.com
                        </a>
                    </p>
                    <p class="text-muted mb-2">
                        <i class="bi bi-github"></i> 
                        <a href="https://github.com/dhall-afdhal" target="_blank" class="text-white text-decoration-none">
                            @dhall-afdhal
                        </a>
                    </p>
                    <p class="text-muted mb-0">
                        <i class="bi bi-building"></i> DHA Production Engineering
                    </p>
                    <div class="mt-3">
                        <a href="https://github.com/dhall-afdhal" target="_blank" class="btn btn-sm btn-outline-light">
                            <i class="bi bi-github"></i> Follow on GitHub
                        </a>
                    </div>
                </div>
            </div>
            <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-2">
                        © <b>2020 - {{ date('Y') }}</b> <b>𝘈𝘧𝘥𝘩𝘢𝘭 & 𝘋𝘏𝘈 𝘗𝘳𝘰𝘥𝘶𝘤𝘵𝘪𝘰𝘯</b> — All rights reserved.
                    </p>
                    <p class="text-muted small mb-2">
                        <i>Diciptakan dengan semangat belajar, keamanan, dan inovasi oleh Afdhal.</i>
                    </p>
                    <p class="text-muted small mb-0">
                        <i>Powered by Modern Web Technologies — Laravel 11, MySQL, Bootstrap 5, LeafletJS, AI Integration.</i>
                    </p>
     
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.boxShadow = '0 2px 20px rgba(0,0,0,0.1)';
            } else {
                navbar.style.boxShadow = '0 2px 20px rgba(0,0,0,0.05)';
            }
        });
    </script>
</body>
</html>

