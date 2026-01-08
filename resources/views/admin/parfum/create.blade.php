@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0">Tambah Produk Parfum</h1>
        <a href="{{ route('admin.parfum.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.parfum.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- ===================== INFORMASI PRODUK ===================== --}}
                <h6 class="fw-bold text-primary mb-3">Informasi Produk</h6>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" name="nama_produk"
                            class="form-control @error('nama_produk') is-invalid @enderror"
                            value="{{ old('nama_produk') }}" required>
                        @error('nama_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                            <option value="">Pilih Kategori</option>
                            <option value="pria" {{ old('kategori')=='pria'?'selected':'' }}>Pria</option>
                            <option value="wanita" {{ old('kategori')=='wanita'?'selected':'' }}>Wanita</option>
                            <option value="unisex" {{ old('kategori')=='unisex'?'selected':'' }}>Unisex</option>
                        </select>
                        @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Produk</label>
                    <textarea name="deskripsi_produk" rows="4"
                        class="form-control @error('deskripsi_produk') is-invalid @enderror"
                    >{{ old('deskripsi_produk') }}</textarea>
                    @error('deskripsi_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- ===================== HARGA & STATUS ===================== --}}
                <h6 class="fw-bold text-primary mt-4 mb-3">Harga & Status</h6>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Harga Produk <span class="text-danger">*</span></label>
                        <input type="number" name="harga_produk"
                            class="form-control @error('harga_produk') is-invalid @enderror"
                            value="{{ old('harga_produk') }}" min="0" step="0.01" required>
                        @error('harga_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Label Produk</label>
                        <select name="label" class="form-select @error('label') is-invalid @enderror">
                            <option value="">— Tidak Ada —</option>
                            <option value="best_seller" {{ old('label')=='best_seller'?'selected':'' }}>Best Seller</option>
                            <option value="new" {{ old('label')=='new'?'selected':'' }}>New</option>
                            <option value="limited" {{ old('label')=='limited'?'selected':'' }}>Limited</option>
                            <option value="promo" {{ old('label')=='promo'?'selected':'' }}>Promo</option>
                        </select>
                        @error('label') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Status Produk <span class="text-danger">*</span></label>
                        <select name="status_produk" class="form-select @error('status_produk') is-invalid @enderror" required>
                            <option value="">Pilih Status</option>
                            <option value="aktif" {{ old('status_produk')=='aktif'?'selected':'' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status_produk')=='nonaktif'?'selected':'' }}>Non-Aktif</option>
                        </select>
                        @error('status_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- ===================== GAMBAR & LINK ===================== --}}
                <h6 class="fw-bold text-primary mt-4 mb-3">Media</h6>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Gambar Produk</label>
                        <input type="file" name="gambar"
                            class="form-control @error('gambar') is-invalid @enderror"
                            accept="image/*">
                        <small class="text-muted">Format JPG / PNG / WEBP — Maksimal 2MB</small>
                        @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror

                        {{-- Preview --}}
                        <img id="preview" class="mt-2 rounded d-none" style="max-height: 140px;">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Link Shopee</label>
                        <input type="text" name="link_shopee"
                            class="form-control @error('link_shopee') is-invalid @enderror"
                            value="{{ old('link_shopee') }}"
                            placeholder="https://shopee.co.id/produk-anda">
                        @error('link_shopee') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- ===================== BUTTON ===================== --}}
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Produk
                    </button>
                    <a href="{{ route('admin.parfum.index') }}" class="btn btn-outline-secondary">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('gambar').addEventListener('change', function(e){
    let preview = document.getElementById('preview');
    preview.src = URL.createObjectURL(e.target.files[0]);
    preview.classList.remove('d-none');
});
</script>
@endsection
