@extends('layouts.admin')

@section('title', 'Detail Parfum')
<style>
.detail-card{
    border:0;
    border-radius:16px;
    box-shadow:0 12px 35px rgba(0,0,0,.06);
}

.detail-header{
    background:#F4F6FA;
    border-bottom:1px solid rgba(0,0,0,.06);
}

.product-image-box{
    background:#faf7f2;
    border-radius:14px;
    padding:18px;
}

.product-image-box img{
    width:100%;
    object-fit:contain;
}

.price-highlight{
    font-size:28px;
    font-weight:700;
    color:#2f7a44;
}

.badge-label{
    padding:6px 10px;
    border-radius:10px;
    font-size:12px;
}

.desc-box{
    background:#f6f8fb;
    border-radius:12px;
    padding:14px;
}
</style>

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between mb-4">
        <div>
            <h2 class="mb-0">Detail Produk</h2>
            <p class="text-muted mb-0">Informasi lengkap tentang {{ $parfum->nama_produk }}</p>
        </div>
        <div class="d-flex gap-2">

            <a href="{{ route('admin.parfum.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        {{-- INFO PRODUK --}}
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Produk</h5>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-5">

                            {{-- Gambar --}}
                            @if($parfum->gambar)
                                <img src="{{ asset('storage/'.$parfum->gambar) }}"
                                     class="img-fluid rounded shadow-sm">
                            @else
                                <img src="{{ asset('images/no-image.png') }}"
                                     class="img-fluid rounded shadow-sm">
                            @endif
                        </div>

                        <div class="col-md-7">

                            <h3 class="mb-2">{{ $parfum->nama_produk }}</h3>

                            {{-- Kategori --}}
                            <span class="badge bg-info text-dark text-capitalize mb-2">
                                {{ $parfum->kategori }}
                            </span>

                            {{-- Label --}}
                            @if($parfum->label)
                                @php
                                    $colors = [
                                        'best_seller' => 'warning',
                                        'new' => 'primary',
                                        'limited' => 'dark',
                                        'promo' => 'success',
                                    ];
                                @endphp
                                <span class="badge bg-{{ $colors[$parfum->label] ?? 'secondary' }}">
                                    {{ Str::title(str_replace('_',' ', $parfum->label)) }}
                                </span>
                            @endif

                            <hr>

                            <table class="table table-borderless">
                                <tr>
                                    <th width="35%">Harga</th>
                                    <td>
                                        <h4 class="text-success mb-0">
                                            Rp {{ number_format($parfum->harga_produk,0,',','.') }}
                                        </h4>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($parfum->status_produk == 'aktif')
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Non-Aktif</span>
                                        @endif
                                    </td>
                                </tr>

                                @if($parfum->link_shopee)
                                <tr>
                                    <th>Link Shopee</th>
                                    <td>
                                        <a href="{{ $parfum->link_shopee }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            Buka Produk
                                        </a>
                                    </td>
                                </tr>
                                @endif

                                <tr>
                                    <th>Tanggal Dibuat</th>
                                    <td>{{ $parfum->created_at->format('d F Y, H:i') }}</td>
                                </tr>

                                <tr>
                                    <th>Terakhir Diperbarui</th>
                                    <td>{{ $parfum->updated_at->format('d F Y, H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    @if($parfum->deskripsi_produk)
                        <div class="mt-4">
                            <h5>Deskripsi</h5>
                            <div class="p-3 bg-light rounded">
                                {!! nl2br(e($parfum->deskripsi_produk)) !!}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        {{-- PANEL AKSI --}}
        <div class="col-md-4">

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-tools"></i> Aksi
                    </h6>
                </div>
                <div class="card-body">

                    <a href="{{ route('admin.parfum.edit', $parfum->id) }}"
                       class="btn btn-warning w-100 mb-2">
                        <i class="fas fa-edit"></i> Edit Produk
                    </a>

                    <form action="{{ route('admin.parfum.destroy', $parfum->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger w-100">
                            <i class="fas fa-trash"></i> Hapus Produk
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
