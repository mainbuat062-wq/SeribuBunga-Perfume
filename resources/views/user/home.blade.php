@extends('layouts.user')

@section('title', $profilToko?->nama_toko ?? 'Essence — Luxury Perfume')


@section('content')


<!-- ========= HERO ========= -->
<section id="home" class="hero">

    <div class="container">
        <div class="hero-content">

            {{-- TEXT LEFT --}}
            <div class="hero-text">
                <h1 class="hero-title">
    {{ $profilToko?->nama_toko ?? 'About The Brand' }}
</h1>

<p class="hero-subtitle">
    {{ $profilToko?->tagline ?? 'The Art of Scent, The Essence of Elegance' }}
</p>


                <a href="{{ route('katalog') }}" class="promo-btn">
                    Lihat Katalog
                </a>
            </div>

            {{-- GLB RIGHT --}}
            <div class="hero-image" id="heroGLB">
                <div id="glbSlot">
                <model-viewer
                    id="perfumeGLB"
                    src="/storage/parfum/perfume_bottle.glb"
                    auto-rotate
                    camera-controls
                    disable-zoom
                    interaction-prompt="none"
                    shadow-intensity="1"
                    field-of-view="20deg">
                </model-viewer>
                </div>
            </div>

        </div>
    </div>

    <div class="scroll-indicator">
        <span>Scroll to explore</span>
        <div class="scroll-line"></div>
    </div>

</section>

@if($highlight->count())
<section class="featured">
 <div class="container">

  <h2 class="section-title">Highlight Produk</h2>

  <div class="highlight-wrapper">
      <div class="highlight-track" id="highlightTrack">

          {{-- LIST ASLI --}}
          @foreach ($highlight as $parfum)
              @include('components.highlight-card', ['parfum' => $parfum])
          @endforeach

          {{-- DUPLIKASI (UNTUK LOOP MULUS) --}}
          @foreach ($highlight as $parfum)
              @include('components.highlight-card', ['parfum' => $parfum])
          @endforeach

      </div>
  </div>

 </div>
</section>
@endif

<!-- ========= ABOUT ========= -->
<section id="about" class="about">
    <div class="container">

        <div class="about-content">

            {{-- GLB LANDING AREA --}}
            <div class="about-image">
                <div class="about-visual" id="aboutGLB">
                <model-viewer
                    id="perfumeGLB"
                    src="/storage/parfum/bleu_de_chanel_perfume..glb"
                    auto-rotate
                    camera-controls
                    disable-zoom
                    interaction-prompt="none"
                    shadow-intensity="1"
                    field-of-view="20deg">
                </model-viewer>
                </div>
            </div>

            {{-- TEXT BLOCK --}}
            <div class="about-text">
                <h2>About me</h2>

<p>
    {!! nl2br(e($profilToko?->deskripsi ?? 'Essence is a modern fragrance house...')) !!}
</p>

            </div>
        </div>
    </div>
</section>

@if($profilToko && (!$profilToko->promo_until || now()->lt($profilToko->promo_until)))

<section class="promo-section">
  <div class="promo-container promo-grid">

<div class="promo-content">

    <div class="promo-label">Limited Time</div>

    <h2 class="promo-title">{{ $profilToko->promo_text ?? 'Collection Sale' }}</h2>

    <p id="promoCountdown" class="promo-countdown">—</p>

    @if($profilToko->link_toko_shopee)
    <a href="{{ $profilToko->link_toko_shopee }}"
       target="_blank"
       class="promo-btn">
       Beli di Shopee
    </a>
    @endif
</div>

    <div class="promo-image-wrapper">
      <img
        src="{{ $profilToko->promo_image
              ? asset('storage/'.$profilToko->promo_image)
              : 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?w=600' }}"
        alt="Promo Collection"
        class="promo-image">
    </div>

  </div>
</section>
@endif


<!-- ========= KATALOG PREVIEW ========= -->
@if($parfums->count())
<section id="collection">
    <div class="container">

        <h2 class="section-title">Katalog Produk</h2>
        <p class="section-subtitle">Semua produk tersedia</p>

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
        <div style="text-align:center;margin-top:18px;">
            <a href="{{ route('katalog') }}" class="promo-btn">Lihat Semua Produk</a>
        </div>
    </div>
</section>
@endif

<section class="visit-store">
  <div class="visit-container visit-box">

<h2 class="visit-title">
    {{ $profilToko?->visit_title ?? 'Visit Our Store' }}
</h2>

<p class="visit-text">
    {{ $profilToko?->visit_description ?? 'Belanja koleksi lengkap di Shopee dengan promo eksklusif.' }}
</p>


    @if($profilToko && $profilToko->link_toko_shopee)
        <a href="{{ $profilToko->link_toko_shopee }}"
           target="_blank"
           rel="noopener noreferrer"
           class="visit-btn">
            Kunjungi Toko Shopee
        </a>
    @else
        <span class="visit-btn disabled">
            Link Shopee belum tersedia
        </span>
    @endif

  </div>
</section>
{{-- =============== FOOTER =============== --}}
<footer class="footer-merged">
    <div class="container footer-grid">

        {{-- KOLOM 1: BRAND (Atas Tengah di Mobile) --}}
        <div class="footer-col">
            <h3 class="footer-brand">{{ $profilToko->nama_toko ?? 'SeribuBunga Parfume' }}</h3>
            <p class="footer-desc">
                {{ $profilToko->tagline ?? 'Aroma yang Bercerita di Setiap Semprotannya' }}
            </p>
        </div>

        {{-- KOLOM 2: MENU --}}
        <div class="footer-col">
            <h4>Menu</h4>
            <ul class="footer-links">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('katalog') }}">Katalog</a></li>
            </ul>
        </div>
        
        {{-- KOLOM 3: DUKUNGAN --}}
        <div class="footer-col">
            <h4>Dukungan</h4>
            <p class="footer-desc" style="font-size: 9px; opacity: 0.7; margin-bottom: 5px;">
                3D Models License:
            </p>
            <ul class="footer-links">
                <li><a href="https://sketchfab.com/michaelablanchfield" target="_blank">— Michaela</a></li>
                <li><a href="https://sketchfab.com/szsakaria" target="_blank">— szsakaria</a></li>
            </ul>
        </div>

        {{-- KOLOM 4: KONTAK --}}
        <div class="footer-col">
            <h4>Kontak</h4>
            <ul class="footer-contact">

@if($profilToko?->alamat)
<li>
    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($profilToko->alamat) }}"
       target="_blank" class="contact-item">
        <i class="fa-solid fa-location-dot"></i>
        <span>Buka Maps</span>
    </a>
</li>
@endif

@if($profilToko?->email)
<li>
    <a href="mailto:{{ $profilToko->email }}" class="contact-item">
        <i class="fa-solid fa-envelope"></i>
        <span>{{ $profilToko->email }}</span>
    </a>
</li>
@endif

@if($profilToko?->no_hp)
@php
    $wa = preg_replace('/[^0-9]/', '', $profilToko->no_hp);
    if(Str::startsWith($wa,'0')) $wa = '62'.substr($wa,1);
@endphp
<li>
    <a href="https://wa.me/{{ $wa }}" target="_blank" class="contact-item">
        <i class="fa-solid fa-phone"></i>
        <span>{{ $profilToko->no_hp }}</span>
    </a>
</li>
@endif

@if($profilToko?->link_toko_shopee)
<li>
    <a href="{{ $profilToko->link_toko_shopee }}" class="contact-item shop-link" target="_blank">
        <i class="fa-brands fa-shopify"></i>
        <span>Buka Toko di Shopee</span>
    </a>
</li>
@endif

            </ul>
        </div>

    </div>

    <div class="footer-bottom">
        <p>© {{ date('Y') }} {{ $profilToko->nama_toko ?? 'SeribuBunga' }} — All rights reserved.</p>
    </div>
</footer>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const endTime = "{{ $profilToko->promo_until ?? '' }}";
    const el = document.getElementById("promoCountdown");

    if (!endTime || !el) return;

    function updateCountdown() {
        const end = new Date(endTime).getTime();
        const now = new Date().getTime();
        const diff = end - now;

        if (diff <= 0) {
            el.innerHTML = "Promo telah berakhir";
            el.classList.add("expired");
            return;
        }

        const d = Math.floor(diff / (1000 * 60 * 60 * 24));
        const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const s = Math.floor((diff % (1000 * 60)) / 1000);

        el.innerHTML =
            (d > 0 ? d + " hari " : "") +
            h.toString().padStart(2,"0") + ":" +
            m.toString().padStart(2,"0") + ":" +
            s.toString().padStart(2,"0");
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
});
</script>

<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<script src="{{ asset('assets/js/essence.js') }}"></script>

@endsection
