@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-lg-5 col-md-7 col-12">
        <div class="card fade-in">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; box-shadow: 0 8px 25px rgba(99, 102, 241, 0.3);">
                        <i class="bi bi-shield-lock" style="font-size: 2.5rem; color: white;"></i>
                    </div>
                    <h2 class="fw-bold mb-2" style="color: #1e293b;">Selamat Datang Kembali</h2>
                    <p class="text-muted">Masuk ke akun Anda untuk melanjutkan</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label">
                            <i class="bi bi-envelope"></i> Email
                        </label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@example.com">
                        @error('email')
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">
                            <i class="bi bi-lock"></i> Password
                        </label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Masukkan password">
                        @error('password')
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">
                                Ingat saya
                            </label>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-decoration-none" style="color: #6366f1;">
                            Lupa password?
                        </a>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-box-arrow-in-right"></i> Masuk
                        </button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <p class="text-muted mb-0">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-decoration-none fw-bold" style="color: #6366f1;">
                            Daftar sekarang
                        </a>
                    </p>
                    <a href="{{ route('welcome') }}" class="text-decoration-none mt-2 d-inline-block" style="color: #64748b;">
                        <i class="bi bi-arrow-left"></i> Kembali ke beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
