@extends('layouts.admin')

@section('title', 'Dashboard')

@section('styles')
<style>
    /* Custom Dashboard Styles */
    .stat-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 16px; /* Lebih rounded modern */
        height: 100%;
        background: #fff;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
    }

    .icon-shape {
        width: 54px;
        height: 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .text-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .badge-soft-green {
        background-color: rgba(25, 135, 84, 0.1);
        color: #198754;
    }

    .badge-soft-gray {
        background-color: rgba(108, 117, 125, 0.1);
        color: #6c757d;
    }
    /* ===== DASHBOARD MOBILE ICON FIX ===== */
@media (max-width: 576px) {

    .stat-card {
        padding: 10px !important;
    }

    .icon-shape {
        width: 42px;
        height: 42px;
        font-size: 1.2rem;
        border-radius: 12px;
    }

    .stat-card h3 {
        font-size: 1.4rem;
        line-height: 1.2;
    }

    .stat-card small {
        font-size: 0.65rem !important;
        letter-spacing: .4px;
    }
}

</style>
@endsection

@section('content')
<div class="container-fluid pb-5">

    {{-- ===== HEADER SECTION ===== --}}
    <div class="page-header mb-4 mt-3">
        <h2 class="fw-bold text-dark">Dashboard</h2>
        <p class="text-muted">Selamat datang kembali! Berikut adalah ringkasan produk dan profil toko Anda.</p>
    </div>

{{-- ===== STATS SECTION ===== --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <a href="{{ route('admin.parfum.index', ['label' => 'best_seller']) }}" class="text-decoration-none">
                <div class="card stat-card shadow-sm p-3">
                    <div class="d-flex align-items-center">

                        {{-- FIX: Gunakan text-white agar kontras dengan background --}}
                        <div class="icon-shape bg-warning text-white me-3 shadow-sm">
                            <i class="fas fa-award"></i>
                        </div>
                        <div>
                            <small class="text-muted fw-bold d-block mb-1 text-uppercase" style="font-size: 0.7rem;">Best Seller</small>
                            <h3 class="mb-0 fw-bold text-dark">{{ $labelStats['best_seller'] }}</h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="{{ route('admin.parfum.index', ['label' => 'new']) }}" class="text-decoration-none">
                <div class="card stat-card shadow-sm p-3">
                    <div class="d-flex align-items-center">

                        <div class="icon-shape bg-success text-white me-3 shadow-sm">
                            <i class="fas fa-star"></i>
                        </div>
                        <div>
                            <small class="text-muted fw-bold d-block mb-1 text-uppercase" style="font-size: 0.7rem;">New Arrival</small>
                            <h3 class="mb-0 fw-bold text-dark">{{ $labelStats['new'] }}</h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="{{ route('admin.parfum.index', ['label' => 'limited']) }}" class="text-decoration-none">
                <div class="card stat-card shadow-sm p-3">
                    <div class="d-flex align-items-center">

                        <div class="icon-shape bg-danger text-white me-3 shadow-sm">
                            <i class="fas fa-stopwatch"></i>
                        </div>
                        <div>
                            <small class="text-muted fw-bold d-block mb-1 text-uppercase" style="font-size: 0.7rem;">Limited</small>
                            <h3 class="mb-0 fw-bold text-dark">{{ $labelStats['limited'] }}</h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="{{ route('admin.parfum.index', ['label' => 'promo']) }}" class="text-decoration-none">
                <div class="card stat-card shadow-sm p-3">
                    <div class="d-flex align-items-center">

                        <div class="icon-shape bg-primary text-white me-3 shadow-sm">
                            <i class="fas fa-percentage"></i>
                        </div>
                        <div>
                            <small class="text-muted fw-bold d-block mb-1 text-uppercase" style="font-size: 0.7rem;">On Promo</small>
                            <h3 class="mb-0 fw-bold text-dark">{{ $labelStats['promo'] }}</h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- ===== MAIN CONTENT GRID ===== --}}
    <div class="row g-4">
        
        {{-- KOLOM KIRI: PROFIL TOKO --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                
                {{-- Card Header --}}
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom-0">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-store me-2 text-primary"></i>Profil Toko</h5>
                    @if($profilToko)
                        <a href="{{ route('admin.profil-toko.edit', $profilToko->id) }}" class="btn btn-sm btn-outline-primary fw-bold rounded-pill px-3">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                    @else
                        <a href="{{ route('admin.profil-toko.create') }}" class="btn btn-sm btn-primary rounded-pill px-3">
                            <i class="fas fa-plus me-1"></i> Buat Profil
                        </a>
                    @endif
                </div>

                {{-- Card Body --}}
                <div class="card-body p-4">
                    @if($profilToko)
                        <div class="row align-items-center mb-4">
                            <div class="col-md-auto text-center text-md-start mb-3 mb-md-0">
                                @if($profilToko->logo)
                                    <img src="{{ asset('storage/'.$profilToko->logo) }}" 
                                         class="rounded-circle shadow-sm border p-1"
                                         style="width: 100px; height: 100px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center mx-auto" 
                                         style="width:100px; height:100px">
                                        <i class="fas fa-image fa-2x text-muted"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="col-md ps-md-4 text-center text-md-start">
                                <h3 class="fw-bold mb-1 text-dark">{{ $profilToko->nama_toko }}</h3>
                                <p class="text-primary fw-medium mb-0">{{ $profilToko->tagline ?? 'Belum ada tagline' }}</p>
                            </div>
                        </div>

                        <div class="list-group list-group-flush">
                            <div class="list-group-item border-0 px-0 pb-3">
                                <span class="text-muted small fw-bold text-uppercase mb-1 d-block">Deskripsi</span>
                                <div id="descContainer">
                                    <p class="text-dark small text-clamp-3 mb-1" id="descText" style="line-height: 1.6;">
                                        {{ $profilToko->deskripsi }}
                                    </p>
                                    @if(strlen($profilToko->deskripsi) > 150)
                                        <button class="btn btn-link btn-sm p-0 text-decoration-none fw-bold" id="btnToggleDesc" onclick="toggleDescription()">
                                            Lihat Selengkapnya
                                        </button>
                                    @endif
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <span class="text-muted small fw-bold text-uppercase d-block mb-1">WhatsApp / No. HP</span>
                                        <span class="fw-bold text-dark d-flex align-items-center">
                                            <i class="fab fa-whatsapp text-success me-2 fs-5"></i>
                                            {{ $profilToko->no_hp ?? '-' }}
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="text-muted small fw-bold text-uppercase d-block mb-1">Email</span>
                                        <span class="fw-bold text-dark d-flex align-items-center">
                                            <i class="fas fa-envelope text-danger me-2 fs-5"></i>
                                            {{ $profilToko->email ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <span class="text-muted small fw-bold text-uppercase d-block mb-1">Lokasi Toko</span>
                                        @if($profilToko->alamat)
                                            <a href="{{ $profilToko->alamat }}" target="_blank" class="btn btn-sm btn-light border w-100 text-start">
                                                <i class="fas fa-map-marked-alt text-primary me-2"></i> Buka Maps
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <span class="text-muted small fw-bold text-uppercase d-block mb-1">E-Commerce</span>
                                        @if($profilToko->link_toko_shopee)
                                            <a href="{{ $profilToko->link_toko_shopee }}" target="_blank" class="btn btn-sm btn-warning text-white w-100 text-start">
                                                <i class="fas fa-shopping-bag me-2"></i> Kunjungi Shopee
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ===== ACTIVE PROMO PREVIEW ===== --}}
                        @if($profilToko->promo_image || $profilToko->promo_text)
                        <div class="mt-4 p-3 rounded-4 border">
                            <h6 class="fw-bold text-primary mb-3 d-flex align-items-center">
                                <i class="fas fa-bullhorn me-2"></i>Promo Sedang Aktif
                            </h6>
                            <div class="row align-items-center">
                                @if($profilToko->promo_image)
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <img src="{{ asset('storage/'.$profilToko->promo_image) }}" class="rounded-3 shadow-sm img-fluid border bg-white">
                                </div>
                                @endif
                                <div class="col-md">
                                    <p class="fw-bold text-dark mb-2">{{ $profilToko->promo_text }}</p>
                                    @if($profilToko->promo_until)
                                        @php $expired = now()->gt($profilToko->promo_until); @endphp
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <small class="text-muted">
                                                <i class="far fa-clock me-1"></i> Berakhir: 
                                                {{ \Carbon\Carbon::parse($profilToko->promo_until)->format('d M Y, H:i') }}
                                            </small>
                                            <span class="badge {{ $expired ? 'badge-soft-gray' : 'badge-soft-green' }} rounded-pill px-3">
                                                {{ $expired ? 'Expired' : 'Aktif' }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif

                    @else
                        {{-- Empty State --}}
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <span class="fa-stack fa-2x">
                                    <i class="fas fa-circle fa-stack-2x text-light"></i>
                                    <i class="fas fa-store-slash fa-stack-1x text-secondary"></i>
                                </span>
                            </div>
                            <h5 class="text-muted">Profil Kosong</h5>
                            <p class="text-muted small mb-3">Profil toko belum dikonfigurasi. Silakan buat profil untuk melengkapi data dashboard.</p>
                            <a href="{{ route('admin.profil-toko.create') }}" class="btn btn-primary rounded-pill">
                                Buat Profil Sekarang
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: SHORTCUTS --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-4 border-bottom pb-2">Shortcut Cepat</h6>
                    <div class="d-grid gap-3">
                        <a href="{{ route('admin.parfum.create') }}" class="btn btn-primary py-3 rounded-3 shadow-sm d-flex align-items-center justify-content-center">
                            <i class="fas fa-plus-circle fa-lg me-2"></i> 
                            <span class="fw-bold">Tambah Parfum</span>
                        </a>
                        <a href="{{ route('admin.parfum.index') }}" class="btn btn-light py-3 border rounded-3 d-flex align-items-center justify-content-center hover-shadow">
                            <i class="fas fa-boxes me-2 text-muted"></i> 
                            <span class="text-dark">Kelola Produk</span>
                        </a>
                        <a href="#" class="btn btn-light py-3 border rounded-3 d-flex align-items-center justify-content-center hover-shadow">
                            <i class="fas fa-users me-2 text-muted"></i> 
                            <span class="text-dark">Data Pelanggan</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 bg-dark text-white overflow-hidden">
                <div class="card-body p-4 text-center position-relative">
                    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10" style="background: url('https://source.unsplash.com/random/400x200?perfume') center/cover;"></div>
                    <div class="position-relative z-1">
                        <h5 class="mb-1">{{ now()->format('l, d F Y') }}</h5>
                        <p class="mb-0 text-white-50">Have a productive day!</p>
                    </div>
                </div>
            </div>
        </div>

    </div> </div>

<script>
function toggleDescription() {
    const text = document.getElementById('descText');
    const btn = document.getElementById('btnToggleDesc');
    
    if (text.classList.contains('text-clamp-3')) {
        text.classList.remove('text-clamp-3');
        btn.innerText = 'Sembunyikan';
    } else {
        text.classList.add('text-clamp-3');
        btn.innerText = 'Lihat Selengkapnya';
    }
}
</script>
@endsection