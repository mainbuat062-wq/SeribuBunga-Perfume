@extends('layouts.admin')

@section('title', 'Profil Toko')

@section('content')

<div class="admin-content">

    <div class="page-header">
        <h2>Profil Toko</h2>

        @if(!$profilToko)
            <a href="{{ route('admin.profil-toko.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Profil Toko
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif


    @if($profilToko)

    <div class="card">
        <div class="card-body">

            {{-- LOGO TOKO --}}
            @if($profilToko->logo)
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/'.$profilToko->logo) }}"
                         class="img-fluid rounded shadow-sm"
                         style="max-height:130px;object-fit:contain">
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Informasi Toko</h5>

                <a href="{{ route('admin.profil-toko.edit', $profilToko->id) }}"
                   class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i> Edit Profil
                </a>
            </div>


            <table class="table table-borderless">

                <tr>
                    <th width="220">Nama Toko</th>
                    <td>{{ $profilToko->nama_toko }}</td>
                </tr>

                @if($profilToko->tagline)
                <tr>
                    <th>Tagline</th>
                    <td>{{ $profilToko->tagline }}</td>
                </tr>
                @endif

                @if($profilToko->deskripsi)
<tr>
    <th>Deskripsi</th>
<td>
    <div class="desc-wrap">
        <span class="text-clamp-3 d-block" id="descText">
            {{ $profilToko->deskripsi }}
        </span>

        <a href="javascript:void(0)" id="toggleDesc">
            Lihat Selengkapnya
        </a>
    </div>
</td>

</tr>

                @endif

                @if($profilToko->alamat)
                <tr>
                    <th>Alamat / Maps</th>
                    <td>
                        <a href="{{ $profilToko->alamat }}" target="_blank">
                            Lihat Lokasi
                        </a>
                    </td>
                </tr>
                @endif

                @if($profilToko->no_hp)
                <tr>
                    <th>No. HP</th>
                    <td>{{ $profilToko->no_hp }}</td>
                </tr>
                @endif

                @if($profilToko->email)
                <tr>
                    <th>Email</th>
                    <td>{{ $profilToko->email }}</td>
                </tr>
                @endif

                @if($profilToko->link_toko_shopee)
                <tr>
                    <th>Toko Shopee</th>
                    <td>
                        <a href="{{ $profilToko->link_toko_shopee }}"
                           target="_blank"
                           class="btn btn-sm btn-accent">
                            <i class="fas fa-store"></i> Buka di Shopee
                        </a>
                    </td>
                </tr>
                @endif


                {{-- PROMO TOKO --}}
                @if($profilToko->promo_image || $profilToko->promo_text || $profilToko->promo_until)

                    <tr class="table-active">
                        <th colspan="2">Informasi Promo</th>
                    </tr>

                    @if($profilToko->promo_image)
                    <tr>
                        <th>Banner Promo</th>
                        <td>
                            <img src="{{ asset('storage/'.$profilToko->promo_image) }}"
                                 class="rounded shadow-sm"
                                 style="height:120px;width:180px;object-fit:cover">
                        </td>
                    </tr>
                    @endif

                    @if($profilToko->promo_text)
                    <tr>
                        <th>Teks Promo</th>
                        <td>{{ $profilToko->promo_text }}</td>
                    </tr>
                    @endif

                    @if($profilToko->promo_until)
                        @php $expired = now()->gt($profilToko->promo_until); @endphp
                        <tr>
                            <th>Berlaku Sampai</th>
                            <td>
                                {{ \Carbon\Carbon::parse($profilToko->promo_until)->format('d M Y H:i') }}

                                @if($expired)
                                    <span class="badge badge-soft-gray ml-2">Sudah Berakhir</span>
                                @else
                                    <span class="badge badge-soft-green ml-2">Aktif</span>
                                @endif
                            </td>
                        </tr>
                    @endif

                @endif

            </table>

        </div>
    </div>

    @else

    <div class="empty-state">
        <i class="fas fa-store"></i>
        <p>Belum ada profil toko</p>

        <a href="{{ route('admin.profil-toko.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Profil Toko
        </a>
    </div>

    @endif

</div>

@endsection
