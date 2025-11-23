@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card">
            <div class="card-body p-5 text-center">
                <i class="bi bi-envelope-check" style="font-size: 3rem; color: #667eea;"></i>
                <h2 class="mt-3 mb-3">Verifikasi Email</h2>
                <p class="text-muted">Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi email Anda dengan mengklik link yang telah kami kirim.</p>

                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success">
                        Link verifikasi baru telah dikirim ke email Anda.
                    </div>
                @endif

                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-envelope"></i> Kirim Ulang Email Verifikasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


