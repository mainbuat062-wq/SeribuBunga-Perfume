<article class="product-card">

    <a href="{{ route('katalog.detail', $parfum->id) }}" class="product-image">
        <img
            src="{{ $parfum->gambar ? asset('storage/'.$parfum->gambar) : asset('assets/images/no-image.png') }}"
            alt="{{ $parfum->nama_produk }}"
            class="product-img">

        @if($parfum->label)
            <span class="product-badge label-{{ $parfum->label }}">
                {{ strtoupper(str_replace('_',' ', $parfum->label)) }}
            </span>
        @endif
    </a>

    <div class="product-info">
        <h3 class="product-name">{{ $parfum->nama_produk }}</h3>
        <p class="product-price">
            Rp {{ number_format($parfum->harga_produk, 0, ',', '.') }}
        </p>
    </div>

</article>
