@extends('layouts.app')

@section('content')
<div class="page-header fade-in mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h2 class="mb-1">
                <i class="bi bi-map" style="color: #6366f1;"></i> Peta Publik Laporan Kejadian
            </h2>
            <p class="mb-0 text-muted">Visualisasi semua laporan kejadian di peta interaktif</p>
        </div>
        <div class="mt-3 mt-md-0">
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>
            @endauth
        </div>
    </div>
</div>

<div class="card fade-in mb-4">
    <div class="card-body p-0">
        <div id="map" style="height: 650px; width: 100%; border-radius: 16px; overflow: hidden;"></div>
    </div>
</div>

<div class="card fade-in">
    <div class="card-body">
        <h5 class="fw-bold mb-4">
            <i class="bi bi-info-circle" style="color: #6366f1;"></i> Legenda
        </h5>
        <div class="row g-3">
            <div class="col-md-4 col-12 mb-3 mb-md-0">
                <div class="d-flex align-items-center">
                    <div style="width: 20px; height: 20px; background: #ef4444; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3); margin-right: 1rem;"></div>
                    <div>
                        <div class="fw-bold">Urgensi Tinggi</div>
                        <small class="text-muted">Memerlukan penanganan segera</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 mb-3 mb-md-0">
                <div class="d-flex align-items-center">
                    <div style="width: 20px; height: 20px; background: #f59e0b; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3); margin-right: 1rem;"></div>
                    <div>
                        <div class="fw-bold">Urgensi Sedang</div>
                        <small class="text-muted">Perlu perhatian dalam waktu dekat</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="d-flex align-items-center">
                    <div style="width: 20px; height: 20px; background: #3b82f6; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3); margin-right: 1rem;"></div>
                    <div>
                        <div class="fw-bold">Urgensi Rendah</div>
                        <small class="text-muted">Dapat ditangani secara rutin</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    .leaflet-popup-content {
        margin: 15px;
        min-width: 200px;
    }
    .popup-content {
        font-family: 'Inter', sans-serif;
    }
    .popup-title {
        font-weight: 700;
        margin-bottom: 8px;
        color: #1e293b;
        font-size: 1.1rem;
    }
    .popup-info {
        font-size: 0.9rem;
        color: #64748b;
    }
    .popup-info .badge {
        margin-top: 0.5rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // Initialize map centered on Indonesia
    var map = L.map('map').setView([-2.5489, 118.0149], 5);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);

    // Fetch incidents from API
    fetch('{{ route("api.incidents-map") }}')
        .then(response => response.json())
        .then(data => {
            data.forEach(incident => {
                // Determine marker color based on urgency
                let markerColor = '#3b82f6';
                if (incident.urgency_level === 'high') {
                    markerColor = '#ef4444';
                } else if (incident.urgency_level === 'medium') {
                    markerColor = '#f59e0b';
                } else if (incident.urgency_level === 'low') {
                    markerColor = '#3b82f6';
                }

                // Create custom icon
                var icon = L.divIcon({
                    className: 'custom-marker',
                    html: `<div style="
                        background-color: ${markerColor};
                        width: 24px;
                        height: 24px;
                        border-radius: 50%;
                        border: 4px solid white;
                        box-shadow: 0 3px 6px rgba(0,0,0,0.4);
                    "></div>`,
                    iconSize: [24, 24],
                    iconAnchor: [12, 12]
                });

                // Determine badge color
                let badgeColor = 'bg-info';
                if (incident.urgency_level === 'high') {
                    badgeColor = 'bg-danger';
                } else if (incident.urgency_level === 'medium') {
                    badgeColor = 'bg-warning';
                }

                // Create marker
                var marker = L.marker([incident.latitude, incident.longitude], { icon: icon })
                    .addTo(map)
                    .bindPopup(`
                        <div class="popup-content">
                            <div class="popup-title">${incident.title}</div>
                            <div class="popup-info">
                                <strong>Kategori:</strong> ${incident.category || 'Belum diproses'}<br>
                                <strong>Urgensi:</strong> <span class="badge ${badgeColor}">${incident.urgency_level}</span>
                            </div>
                        </div>
                    `);
            });
        })
        .catch(error => {
            console.error('Error fetching incidents:', error);
        });
</script>
@endpush
