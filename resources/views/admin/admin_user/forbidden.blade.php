@extends('layouts.admin')

@section('title', 'Akses Ditolak')

@section('content')
<div class="container-fluid px-4">
    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-6 text-center">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">

                    <!-- Icon -->
                    <div class="mb-4">
                        <div class="rounded-circle bg-danger mx-auto"
                             style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-lock fa-3x text-white"></i>
                        </div>
                    </div>

                    <!-- Title -->
                    <h2 class="text-danger mb-3">
                        <strong>Akses Ditolak</strong>
                    </h2>

                    <!-- Message -->
                    <p class="text-muted mb-4" style="font-size: 1.1rem;">
                        Maaf, halaman ini hanya dapat diakses oleh
                        <strong>Super Administrator</strong>.
                        <br>
                        Anda tidak memiliki izin untuk membuka halaman ini.
                    </p>

                    <!-- User Info -->
                    @if(Auth::check())
                    <div class="alert alert-light border mb-4">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fas fa-user-circle fa-2x text-primary mr-3"></i>
                            <div class="text-left">
                                <small class="text-muted d-block">Login sebagai:</small>
                                <strong>{{ Auth::user()->name }}</strong><br>
                                <span class="badge badge-info text-uppercase">
                                    {{ Auth::user()->role }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Action Button -->
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg px-5">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Dashboard
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.card {
    border-radius: 15px;
    animation: fadeInUp .5s ease-out;
}
@keyframes fadeInUp {
    from { opacity:0; transform: translateY(30px); }
    to { opacity:1; transform: translateY(0); }
}
</style>
@endsection
