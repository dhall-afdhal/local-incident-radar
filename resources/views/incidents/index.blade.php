@extends('layouts.app')

@section('content')
<div class="page-header fade-in">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h2 class="mb-2">
                <i class="bi bi-clipboard-data" style="color: #6366f1;"></i> Dashboard Laporan
            </h2>
            <p class="mb-0">Kelola dan monitor semua laporan kejadian</p>
        </div>
        <a href="{{ route('incidents.create') }}" class="btn btn-primary mt-3 mt-md-0">
            <i class="bi bi-plus-circle"></i> Buat Laporan Baru
        </a>
    </div>
</div>

<!-- Filters -->
<div class="card mb-4 fade-in">
    <div class="card-body p-4">
        <h5 class="mb-4 fw-bold">
            <i class="bi bi-funnel"></i> Filter Laporan
        </h5>
        <form method="GET" action="{{ route('dashboard') }}" class="row g-3">
            <div class="col-md-3 col-12">
                <label class="form-label">
                    <i class="bi bi-tags"></i> Kategori
                </label>
                <select name="category" class="form-select">
                    <option value="">Semua Kategori</option>
                    <option value="infrastruktur" {{ request('category') == 'infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                    <option value="keamanan" {{ request('category') == 'keamanan' ? 'selected' : '' }}>Keamanan</option>
                    <option value="kesehatan" {{ request('category') == 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                    <option value="lingkungan" {{ request('category') == 'lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                    <option value="lalu-lintas" {{ request('category') == 'lalu-lintas' ? 'selected' : '' }}>Lalu Lintas</option>
                    <option value="umum" {{ request('category') == 'umum' ? 'selected' : '' }}>Umum</option>
                </select>
            </div>
            <div class="col-md-3 col-12">
                <label class="form-label">
                    <i class="bi bi-exclamation-triangle"></i> Urgensi
                </label>
                <select name="urgency" class="form-select">
                    <option value="">Semua Urgensi</option>
                    <option value="low" {{ request('urgency') == 'low' ? 'selected' : '' }}>Rendah</option>
                    <option value="medium" {{ request('urgency') == 'medium' ? 'selected' : '' }}>Sedang</option>
                    <option value="high" {{ request('urgency') == 'high' ? 'selected' : '' }}>Tinggi</option>
                </select>
            </div>
            <div class="col-md-3 col-12">
                <label class="form-label">
                    <i class="bi bi-check-circle"></i> Status
                </label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="reviewed" {{ request('status') == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                    <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                </select>
            </div>
            <div class="col-md-3 col-12 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Terapkan Filter
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Table -->
<div class="card fade-in">
    <div class="card-body p-0">
        <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Judul Laporan</th>
                        <th>Kategori</th>
                        <th>Urgensi</th>
                        <th>Status</th>
                        <th>Pelapor</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($incidents as $incident)
                        <tr>
                            <td>
                                <strong style="color: #1e293b;">{{ $incident->title }}</strong>
                                @if($incident->summary)
                                    <br><small class="text-muted">{{ Str::limit($incident->summary, 60) }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="badge" style="background: linear-gradient(135deg, #64748b 0%, #475569 100%);">
                                    {{ $incident->category ?? 'Belum diproses' }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $urgencyColors = [
                                        'high' => 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)',
                                        'medium' => 'linear-gradient(135deg, #f59e0b 0%, #d97706 100%)',
                                        'low' => 'linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)'
                                    ];
                                    $color = $urgencyColors[$incident->urgency_level] ?? 'linear-gradient(135deg, #64748b 0%, #475569 100%)';
                                @endphp
                                <span class="badge" style="background: {{ $color }}; color: white;">
                                    {{ ucfirst($incident->urgency_level) }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $statusColors = [
                                        'resolved' => 'linear-gradient(135deg, #10b981 0%, #059669 100%)',
                                        'reviewed' => 'linear-gradient(135deg, #6366f1 0%, #4f46e5 100%)',
                                        'pending' => 'linear-gradient(135deg, #f59e0b 0%, #d97706 100%)'
                                    ];
                                    $statusColor = $statusColors[$incident->status] ?? 'linear-gradient(135deg, #64748b 0%, #475569 100%)';
                                @endphp
                                <span class="badge" style="background: {{ $statusColor }}; color: white;">
                                    {{ ucfirst($incident->status) }}
                                </span>
                            </td>
                            <td>
                                <i class="bi bi-person"></i> {{ $incident->user->name }}
                            </td>
                            <td>
                                <i class="bi bi-calendar"></i> {{ $incident->created_at->format('d M Y') }}
                                <br>
                                <small class="text-muted">{{ $incident->created_at->format('H:i') }}</small>
                            </td>
                            <td>
                                <a href="{{ route('incidents.show', $incident) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div style="width: 100px; height: 100px; background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                                    <i class="bi bi-inbox" style="font-size: 3rem; color: #94a3b8;"></i>
                                </div>
                                <h5 class="fw-bold mb-2">Belum ada laporan</h5>
                                <p class="text-muted mb-3">Mulai dengan membuat laporan pertama Anda</p>
                                <a href="{{ route('incidents.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i> Buat Laporan Pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($incidents->hasPages())
            <div class="p-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <div class="text-muted small">
                        Menampilkan {{ $incidents->firstItem() }} sampai {{ $incidents->lastItem() }} dari {{ $incidents->total() }} hasil
                    </div>
                    <div>
                        {{ $incidents->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<div class="mt-4 text-center">
    <a href="{{ route('map') }}" class="btn btn-outline-primary">
        <i class="bi bi-map"></i> Lihat Peta Publik
    </a>
</div>
@endsection
