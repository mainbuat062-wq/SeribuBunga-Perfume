<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', $profilToko->nama_toko ?? 'Essence')</title>

    <link rel="stylesheet" href="{{ asset('assets/css/essence.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@300;400;500;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    {{-- SLOT EXTRA STYLE PER HALAMAN --}}
    @stack('styles')
</head>

<body>

@php
    $profilToko = \App\Models\ProfilToko::first();
@endphp


{{-- ================= NAVBAR ================= --}}
<nav class="navbar show" id="navbar">

    <div class="container nav-container">

        {{-- LOGO + NAMA --}}
        <a href="{{ route('home') }}" class="brand-wrap">
            @if($profilToko && $profilToko->logo)
                <img src="{{ asset('storage/'.$profilToko->logo) }}"
                     class="brand-logo">
            @endif
            <span class="brand-name">{{ $profilToko->nama_toko }}</span>
        </a>

        {{-- MENU --}}
        <ul class="nav-menu">
            <li><a href="{{ route('home') }}" class="nav-link">Home</a></li>
            <li><a href="{{ route('katalog') }}" class="nav-link">Katalog</a></li>
        </ul>

        {{-- HAMBURGER MOBILE --}}
        <button class="hamburger" type="button">
    <span></span><span></span><span></span>
</button>

    </div>
</nav>




{{-- =============== PAGE CONTENT =============== --}}
<main class="page-wrapper">
    @yield('content')
</main>





{{-- GLOBAL SCRIPT --}}
<script src="{{ asset('assets/js/essence.js') }}"></script>


{{-- SLOT SCRIPT TAMBAHAN PER PAGE (TERMASUK GLB ANIMATION) --}}
@stack('scripts')
<script>
function goBack() {
    if (document.referrer && window.history.length > 1) {
        window.history.back();
    } else {
        window.location.href = "{{ route('home') }}"; // fallback aman
    }
}
</script>

</body>
</html>
