@extends('layouts.user')

@section('title', $parfum->nama_produk)



@section('content')

<section style="padding-top:120px;">
<div class="container">

    <a href="javascript:void(0)" onclick="goBack()" class="back-home-btn">

        <i class="fas fa-arrow-left"></i>
    </a>

    <div class="detail-wrapper">

    {{-- LEFT — IMAGE --}}
    <div class="detail-image">
        <img
            src="{{ $parfum->gambar ? asset('storage/'.$parfum->gambar) : asset('assets/images/no-image.png') }}"
            alt="{{ $parfum->nama_produk }}"
            class="detail-img">
    </div>

    {{-- RIGHT — INFO --}}
    <div class="detail-info">

        <span class="badge-category">
            {{ strtoupper($parfum->kategori ?? '-') }}
        </span>

        <h1 class="detail-title">{{ $parfum->nama_produk }}</h1>

        @if($parfum->label)
            <span class="product-badge label-{{ $parfum->label }}">
                {{ Str::title(str_replace('_',' ', $parfum->label)) }}
            </span>
        @endif

        <p class="detail-price">
            Rp {{ number_format($parfum->harga_produk, 0, ',', '.') }}
        </p>

        <hr style="margin:18px 0;opacity:.25;">

        <div class="detail-desc">
            {!! nl2br(e($parfum->deskripsi_produk ?? 'Tidak ada deskripsi.')) !!}
        </div>

        <div class="btn-row">
            @if($parfum->link_shopee)
                <a href="{{ $parfum->link_shopee }}" target="_blank" class="btn btn-primary">
                    🛒 Beli di Shopee
                </a>
            @endif

        </div>

    </div>

</div>
</section>


{{-- ========= RELATED PRODUCTS ========= --}}
@if($related->count())
<section style="padding:70px 0;background:#fafafa;">
<div class="container">

    <h3 style="font-weight:300;margin-bottom:18px;">Produk Terkait</h3>

    <div class="related-grid">
        @foreach($related as $item)
            <a href="{{ route('katalog.detail', $item->id) }}" class="related-card">
                <img
                    src="{{ $item->gambar ? asset('storage/'.$item->gambar) : asset('assets/images/no-image.png') }}"
                    class="related-img">
                <div style="padding:14px 14px 18px;">
                    <h4 style="font-size:17px;font-weight:400;margin-bottom:4px;">
                        {{ $item->nama_produk }}
                    </h4>
                    <div style="color:#d4a574;font-weight:500;">
                        Rp {{ number_format($item->harga_produk, 0, ',', '.') }}
                    </div>
                </div>
            </a>
        @endforeach
    </div>

</div>
</section>
@endif

@endsection
