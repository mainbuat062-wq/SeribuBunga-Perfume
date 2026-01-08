@extends('layouts.admin')

@section('title', 'Kelola Parfum')

@section('styles')
<style>
    /* Header Bar Container */
    .header-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
    }

    /* Sisi kiri dan kanan diberi lebar yang sama agar judul tetap di tengah */
    .header-left, .header-right {
        flex: 1;
        display: flex;
        align-items: center;
    }

    .header-right {
        justify-content: flex-end;
    }

    .header-bar h2 {
        flex: 2; /* Memberikan ruang lebih besar untuk judul */
        font-size: 1.35rem;
        font-weight: 700;
        margin: 0;
        text-align: center;
        color: #333;
    }

/* Utilitas Potong Teks (Max 2 Baris) */
.text-trunc-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2; /* Prefix untuk Chrome, Safari, Edge, dan Firefox baru */
    line-clamp: 2;         /* Properti standar untuk kompatibilitas masa depan */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 1.4;
}

    /* Badge Custom Styles (Soft Colors) */
    .badge-soft-blue   { background-color: #e3f2fd; color: #0d47a1; }
    .badge-soft-gold   { background-color: #fff8e1; color: #ff8f00; }
    .badge-soft-green  { background-color: #e8f5e9; color: #2e7d32; }
    .badge-soft-orange { background-color: #fff3e0; color: #e65100; }
    .badge-soft-gray   { background-color: #f5f5f5; color: #616161; }
    .badge-soft-dark   { background-color: #eeeeee; color: #212121; }

    /* Gap antar tombol aksi */
    .btn-group-gap {
        display: flex;
        gap: 5px;
        justify-content: center;
    }

    @media(max-width: 768px) {
        .header-bar h2 { font-size: 1.1rem; }
        .btn-text { display: none; } /* Sembunyikan teks tombol di HP, hanya ikon */
        .header-left, .header-right { flex: 0 0 auto; }
    }
</style>
@endsection

@section('content')

<div class="container-fluid">
    
    <div class="header-bar">
        <div class="header-left">
            <button onclick="history.back()" class="btn btn-light shadow-sm border">
                <i class="fas fa-arrow-left"></i>
            </button>
        </div>

        <h2>Kelola Parfum</h2>

        <div class="header-right">
            <a href="{{ route('admin.parfum.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus"></i> <span class="btn-text">Tambah Parfum</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if($parfums->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4" width="80">Foto</th>
                                <th>Produk</th>
                                <th>Kategori</th>
                                <th>Label</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th class="text-center">Shopee</th>
                                <th class="text-center pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($parfums as $parfum)
                            <tr>
                                <td class="ps-4">
                                    @if($parfum->gambar)
                                        <img src="{{ asset('storage/'.$parfum->gambar) }}" 
                                             class="rounded shadow-sm border" 
                                             style="width:50px; height:50px; object-fit:cover">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center border" style="width:50px; height:50px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $parfum->nama_produk }}</div>
                                    <small class="text-muted text-trunc-2" style="max-width: 250px;">
                                        {{ $parfum->deskripsi_produk }}
                                    </small>
                                </td>
                                <td>
                                    <span class="badge badge-soft-blue px-3 py-2">
                                        {{ ucfirst($parfum->kategori) }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $labelStyles = [
                                            'best_seller' => 'badge-soft-gold',
                                            'new'         => 'badge-soft-green',
                                            'limited'     => 'badge-soft-dark',
                                            'promo'       => 'badge-soft-orange',
                                        ];
                                        $style = $labelStyles[$parfum->label] ?? 'badge-soft-gray';
                                    @endphp
                                    @if($parfum->label)
                                        <span class="badge {{ $style }} px-3 py-2">
                                            {{ Str::title(str_replace('_',' ', $parfum->label)) }}
                                        </span>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td class="fw-bold">
                                    Rp {{ number_format($parfum->harga_produk, 0, ',', '.') }}
                                </td>
                                <td>
                                    @if($parfum->status_produk == 'aktif')
                                        <span class="badge bg-success-subtle text-success rounded-pill px-3">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3">Non-Aktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($parfum->link_shopee)
                                        <a href="{{ $parfum->link_shopee }}" target="_blank" class="btn btn-sm btn-outline-warning rounded-circle">
                                            <i class="fas fa-shopping-bag"></i>
                                        </a>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td class="pe-4">
                                    <div class="btn-group-gap">
                                        <a href="{{ route('admin.parfum.show',$parfum->id) }}" class="btn btn-sm btn-outline-secondary" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.parfum.edit', $parfum->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.parfum.destroy', $parfum->id) }}" 
                                              onsubmit="return confirm('Hapus produk ini?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada data parfum yang tersedia.</p>
                    <a href="{{ route('admin.parfum.create') }}" class="btn btn-primary">
                        Tambah Parfum Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection