@extends('layouts.admin')

@section('title', 'Edit Profil Toko')

@section('styles')
<style>
    .form-section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-section-title i {
        color: #4e73df;
    }
    .card {
        border: none;
        border-radius: 12px;
    }
    .preview-container {
        position: relative;
        display: inline-block;
    }
    .img-preview-wrapper {
        width: 120px;
        height: 120px;
        border: 2px dashed #ddd;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background-color: #f8f9fc;
        margin-bottom: 10px;
    }
    .img-preview-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    .promo-preview-wrapper {
        width: 100%;
        max-width: 400px;
        height: 180px;
        border-radius: 12px;
        border: 2px dashed #ddd;
        background-color: #f8f9fc;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .promo-preview-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .input-group-text {
        background-color: #f8f9fc;
        border-right: none;
    }
    .form-control {
        border-left: none;
    }
    .form-control:focus {
        border-color: #ddd;
        box-shadow: none;
    }
    .input-group:focus-within .input-group-text {
        border-color: #4e73df;
        color: #4e73df;
    }
    .input-group:focus-within .form-control {
        border-color: #4e73df;
    }
</style>
@endsection

@section('content')
<div class="container-fluid pb-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Edit Profil Toko</h1>
            <p class="text-muted small">Kelola informasi identitas dan tampilan toko Anda.</p>
        </div>
        
        <button onclick="history.back()" class="btn btn-white shadow-sm border rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </button>
    </div>

    <form action="{{ route('admin.profil-toko.update', $profilToko->id) }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="form-section-title">
                            <i class="fas fa-store"></i> Identitas Utama
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="form-label d-block">Logo Toko</label>
                                <div class="preview-container text-center">
                                    <div class="img-preview-wrapper shadow-sm mx-auto">
                                        <img src="{{ $profilToko->logo ? asset('storage/'.$profilToko->logo) : 'https://via.placeholder.com/120' }}" 
                                             id="logoPreview">
                                    </div>
                                    <label for="logoInput" class="btn btn-sm btn-outline-primary mt-2">
                                        <i class="fas fa-upload me-1"></i> Ganti Logo
                                    </label>
                                    <input type="file" name="logo" id="logoInput" class="d-none" accept="image/*" onchange="previewLogo(event)">
                                    <div class="text-muted mt-1" style="font-size: 10px;">PNG/JPG (Max 2MB)</div>
                                </div>
                            </div>
                            
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Nama Toko <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_toko" class="form-control border-start @error('nama_toko') is-invalid @enderror" 
                                           style="border-left: 1px solid #ddd;"
                                           value="{{ old('nama_toko', $profilToko->nama_toko) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Tagline</label>
                                    <input type="text" name="tagline" class="form-control border-start @error('tagline') is-invalid @enderror" 
                                           style="border-left: 1px solid #ddd;"
                                           placeholder="Contoh: Parfum Premium Harga Terjangkau"
                                           value="{{ old('tagline', $profilToko->tagline) }}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-bold">Deskripsi Toko (About Us)</label>
                            <textarea name="deskripsi" class="form-control border-start @error('deskripsi') is-invalid @enderror" 
                                      style="border-left: 1px solid #ddd;" rows="5" 
                                      placeholder="Ceritakan sejarah singkat atau visi misi toko Anda...">{{ old('deskripsi', $profilToko->deskripsi) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="form-section-title">
                            <i class="fas fa-bullhorn"></i> Informasi Promo (Banner)
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Banner Promo</label>
                                <div class="promo-preview-wrapper shadow-sm mb-3">
                                    <img src="{{ $profilToko->promo_image ? asset('storage/'.$profilToko->promo_image) : 'https://via.placeholder.com/400x180' }}" 
                                         id="promoPreview" class="{{ $profilToko->promo_image ? '' : 'opacity-50' }}">
                                </div>
                                <input type="file" name="promo_image" class="form-control @error('promo_image') is-invalid @enderror" 
                                       accept="image/*" onchange="previewPromo(event)">
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Teks Promo</label>
                                    <input type="text" name="promo_text" class="form-control border-start" style="border-left: 1px solid #ddd;"
                                           value="{{ old('promo_text', $profilToko->promo_text) }}" 
                                           placeholder="Contoh: Diskon Akhir Tahun 50%">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Berlaku Sampai</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        <input type="datetime-local" name="promo_until" class="form-control" 
                                               value="{{ old('promo_until', $profilToko->promo_until) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="form-section-title">
                            <i class="fas fa-address-book"></i> Kontak & Lokasi
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">WhatsApp / No. HP</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $profilToko->no_hp) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Email Toko</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $profilToko->email) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Link Google Maps</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                <textarea name="alamat" class="form-control" rows="2" placeholder="Tempel link share Google Maps">{{ old('alamat', $profilToko->alamat) }}</textarea>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Link Toko Shopee</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-shopping-cart"></i></span>
                                <input type="text" name="link_toko_shopee" class="form-control" 
                                       placeholder="shopee.co.id/nama-toko"
                                       value="{{ old('link_toko_shopee', $profilToko->link_toko_shopee) }}">
                            </div>
                        </div>

                        <hr>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-2 shadow-sm">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.profil-toko.index') }}" class="btn btn-light border py-2">
                                Batalkan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function previewLogo(event){
    const img = document.getElementById("logoPreview");
    if(event.target.files[0]){
        img.src = URL.createObjectURL(event.target.files[0]);
    }
}

function previewPromo(event){
    const img = document.getElementById("promoPreview");
    if(event.target.files[0]){
        img.classList.remove("opacity-50");
        img.src = URL.createObjectURL(event.target.files[0]);
    }
}
</script>
@endsection