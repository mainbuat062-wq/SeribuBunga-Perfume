@extends('layouts.user')

@section('title', 'Katalog Produk')

@section('content')

<section class="container" style="margin-top:120px">
<a href="javascript:void(0)" onclick="goBack()" class="back-home-btn">

    <i class="fas fa-arrow-left"></i>
</a>

    <h1 class="section-title">Katalog Produk</h1>
    <p class="section-subtitle">
        Temukan aroma yang paling sesuai dengan kepribadianmu
    </p>

    @if($parfums->count())

        <div class="product-grid">

            @foreach ($parfums as $parfum)
            <article class="product-card">

                <a href="{{ route('katalog.detail', $parfum->id) }}" class="product-link">

                    <div class="product-image">
                        <img
                            src="{{ $parfum->gambar ? asset('storage/'.$parfum->gambar) : asset('assets/images/no-image.png') }}"
                            alt="{{ $parfum->nama_produk }}"
                            class="product-img"
                            loading="lazy">
                    </div>

                    <div class="product-info">
                        <h3 class="product-name">{{ $parfum->nama_produk }}</h3>

                        <p class="product-notes">
                            {{ Str::limit($parfum->deskripsi_produk, 90) }}
                        </p>

                        <p class="product-price">
                            Rp {{ number_format($parfum->harga_produk, 0, ',', '.') }}
                        </p>
                    </div>

                </a>

            </article>
            @endforeach

        </div>

    @else
        <div class="empty-state">
            <i class="fas fa-inbox" style="font-size:40px;margin-bottom:6px;"></i>
            <p>Belum ada produk yang tersedia untuk saat ini.</p>
        </div>
    @endif

</section>

@endsection
