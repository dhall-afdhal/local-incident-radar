@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="page-header fade-in mb-4">
            <div class="d-flex align-items-center">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary me-3">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <h2 class="mb-1">
                        <i class="bi bi-plus-circle" style="color: #6366f1;"></i> Buat Laporan Kejadian
                    </h2>
                    <p class="mb-0 text-muted">Lengkapi form di bawah untuk membuat laporan baru</p>
                </div>
            </div>
        </div>

        <div class="card fade-in">
            <div class="card-body p-5">
                <form method="POST" action="{{ route('incidents.store') }}" enctype="multipart/form-data" id="incidentForm">
                    @csrf

                    <div class="row">
                        <div class="col-lg-8 col-md-12">
                            <div class="mb-4">
                                <label for="title" class="form-label">
                                    <i class="bi bi-type"></i> Judul Laporan <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required placeholder="Contoh: Jalan Berlubang di Jalan Sudirman">
                                @error('title')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label">
                                    <i class="bi bi-file-text"></i> Deskripsi Kejadian <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="6" required placeholder="Jelaskan kejadian secara detail...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                                <small class="text-muted mt-2 d-block">
                                    <i class="bi bi-info-circle"></i> Jelaskan kejadian secara detail. AI akan menganalisis laporan ini untuk menghasilkan ringkasan, kategori, dan level urgensi.
                                </small>
                            </div>

                            <div class="mb-4">
                                <label for="image" class="form-label">
                                    <i class="bi bi-camera"></i> Foto Kejadian
                                </label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                                @error('image')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                                <small class="text-muted mt-2 d-block">
                                    <i class="bi bi-info-circle"></i> Format: JPG, PNG, GIF (Maks: 2MB)
                                </small>
                                <div id="imagePreview" class="mt-3" style="display: none;">
                                    <img id="preview" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px; border: 2px solid #e2e8f0;">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
                            <div class="card" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border: none;">
                                <div class="card-body">
                                    <h5 class="fw-bold mb-3">
                                        <i class="bi bi-geo-alt-fill" style="color: #6366f1;"></i> Lokasi GPS
                                    </h5>
                                    <div class="mb-3">
                                        <label for="latitude" class="form-label small">Latitude</label>
                                        <input type="number" step="any" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" value="{{ old('latitude') }}" required placeholder="-6.2088">
                                        @error('latitude')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="longitude" class="form-label small">Longitude</label>
                                        <input type="number" step="any" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude" value="{{ old('longitude') }}" required placeholder="106.8456">
                                        @error('longitude')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="button" class="btn btn-primary w-100" onclick="getCurrentLocation()">
                                        <i class="bi bi-crosshair"></i> Gunakan Lokasi Saat Ini
                                    </button>
                                    <small class="text-muted d-block mt-2">
                                        <i class="bi bi-info-circle"></i> Klik tombol di atas untuk mendapatkan koordinat GPS otomatis
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-send"></i> Kirim Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function getCurrentLocation() {
        if (navigator.geolocation) {
            const btn = event.target.closest('button');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Mengambil lokasi...';
            btn.disabled = true;

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    document.getElementById('latitude').value = position.coords.latitude.toFixed(8);
                    document.getElementById('longitude').value = position.coords.longitude.toFixed(8);
                    btn.innerHTML = '<i class="bi bi-check-circle"></i> Lokasi berhasil diambil';
                    btn.classList.remove('btn-primary');
                    btn.classList.add('btn-success');
                    setTimeout(() => {
                        btn.innerHTML = originalText;
                        btn.classList.remove('btn-success');
                        btn.classList.add('btn-primary');
                        btn.disabled = false;
                    }, 2000);
                },
                function(error) {
                    alert('Tidak dapat mengambil lokasi: ' + error.message);
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            );
        } else {
            alert('Geolocation tidak didukung oleh browser Anda.');
        }
    }

    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection
