@extends('layouts.app')

@section('content')
<div class="page-header fade-in mb-4">
    <div class="d-flex align-items-center justify-content-between flex-wrap">
        <div class="d-flex align-items-center">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary me-3">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h2 class="mb-1">
                    <i class="bi bi-file-text" style="color: #6366f1;"></i> Detail Laporan
                </h2>
                <p class="mb-0 text-muted">Informasi lengkap tentang laporan kejadian</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-md-12 mb-4 mb-lg-0">
        <div class="card fade-in mb-4">
            <div class="card-body p-4">
                <h3 class="fw-bold mb-4" style="color: #1e293b;">{{ $incident->title }}</h3>

                @if($incident->image_path)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $incident->image_path) }}" alt="Foto Kejadian" class="img-fluid rounded" style="max-height: 400px; width: 100%; object-fit: cover; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                    </div>
                @endif

                <div class="mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-file-text" style="color: #6366f1;"></i> Deskripsi
                    </h5>
                    <p class="text-muted" style="line-height: 1.8; font-size: 1.05rem;">{{ $incident->description }}</p>
                </div>

                @if($incident->summary)
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-robot" style="color: #6366f1;"></i> Ringkasan (AI)
                        </h5>
                        <div class="alert alert-info">
                            <i class="bi bi-robot"></i> {{ $incident->summary }}
                        </div>
                    </div>
                @endif

                <div class="row g-3 mb-4">
                    <div class="col-md-4 col-12 mb-3 mb-md-0">
                        <div class="card" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border: none;">
                            <div class="card-body text-center">
                                <i class="bi bi-tags" style="font-size: 2rem; color: #6366f1; margin-bottom: 0.5rem;"></i>
                                <div class="fw-bold mb-1">Kategori</div>
                                <span class="badge" style="background: linear-gradient(135deg, #64748b 0%, #475569 100%); color: white;">
                                    {{ $incident->category ?? 'Belum diproses' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 mb-3 mb-md-0">
                        <div class="card" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border: none;">
                            <div class="card-body text-center">
                                @php
                                    $urgencyColors = [
                                        'high' => 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)',
                                        'medium' => 'linear-gradient(135deg, #f59e0b 0%, #d97706 100%)',
                                        'low' => 'linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)'
                                    ];
                                    $color = $urgencyColors[$incident->urgency_level] ?? 'linear-gradient(135deg, #64748b 0%, #475569 100%)';
                                @endphp
                                <i class="bi bi-exclamation-triangle" style="font-size: 2rem; color: #6366f1; margin-bottom: 0.5rem;"></i>
                                <div class="fw-bold mb-1">Urgensi</div>
                                <span class="badge" style="background: {{ $color }}; color: white;">
                                    {{ ucfirst($incident->urgency_level) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 mb-3 mb-md-0">
                        <div class="card" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border: none;">
                            <div class="card-body text-center">
                                @php
                                    $statusColors = [
                                        'resolved' => 'linear-gradient(135deg, #10b981 0%, #059669 100%)',
                                        'reviewed' => 'linear-gradient(135deg, #6366f1 0%, #4f46e5 100%)',
                                        'pending' => 'linear-gradient(135deg, #f59e0b 0%, #d97706 100%)'
                                    ];
                                    $statusColor = $statusColors[$incident->status] ?? 'linear-gradient(135deg, #64748b 0%, #475569 100%)';
                                @endphp
                                <i class="bi bi-check-circle" style="font-size: 2rem; color: #6366f1; margin-bottom: 0.5rem;"></i>
                                <div class="fw-bold mb-1">Status</div>
                                <span class="badge" style="background: {{ $statusColor }}; color: white;">
                                    {{ ucfirst($incident->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6 col-12 mb-3 mb-md-0">
                        <div class="card" style="background: white; border: 2px solid #e2e8f0;">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person-circle" style="font-size: 2rem; color: #6366f1; margin-right: 1rem;"></i>
                                    <div>
                                        <div class="text-muted small">Pelapor</div>
                                        <div class="fw-bold">{{ $incident->user->name }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card" style="background: white; border: 2px solid #e2e8f0;">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-calendar" style="font-size: 2rem; color: #6366f1; margin-right: 1rem;"></i>
                                    <div>
                                        <div class="text-muted small">Tanggal Laporan</div>
                                        <div class="fw-bold">{{ $incident->created_at->format('d M Y H:i') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border: none;">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">
                            <i class="bi bi-geo-alt-fill" style="color: #6366f1;"></i> Koordinat GPS
                        </h6>
                        <p class="mb-0">
                            <strong>Latitude:</strong> {{ $incident->latitude }}<br>
                            <strong>Longitude:</strong> {{ $incident->longitude }}
                        </p>
                    </div>
                </div>

                @if(!$incident->summary || !$incident->category)
                    <div class="alert alert-warning mt-4">
                        <i class="bi bi-exclamation-triangle"></i> Laporan ini belum diproses dengan AI.
                        <form method="POST" action="{{ route('incidents.process-ai', $incident) }}" class="mt-3">
                            @csrf
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-robot"></i> Proses dengan AI
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-12">
        <div class="card fade-in" style="position: sticky; top: 20px;">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-map" style="color: white;"></i> Lokasi di Peta
                </h5>
            </div>
            <div class="card-body p-0">
                <div id="miniMap" style="height: 400px; border-radius: 0 0 16px 16px;"></div>
            </div>
        </div>
        
        @push('styles')
        <style>
            @media (max-width: 992px) {
                .card[style*="position: sticky"] {
                    position: relative !important;
                    top: 0 !important;
                }
            }
        </style>
        @endpush
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    var map = L.map('miniMap').setView([{{ $incident->latitude }}, {{ $incident->longitude }}], 15);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var marker = L.marker([{{ $incident->latitude }}, {{ $incident->longitude }}])
        .addTo(map)
        .bindPopup('<strong>{{ $incident->title }}</strong>')
        .openPopup();
</script>
@endpush
