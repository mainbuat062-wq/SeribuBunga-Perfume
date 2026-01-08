<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Admin Panel</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
<style>
/* ===== ADMIN PANEL — STABLE SIDEBAR THEME ===== */

/* Base */
:root{
    --sidebar-bg:#0F1C2E;
    --sidebar-hover:#0B1525;
    --sidebar-active:#D18B32;
    --text-muted:#D5DBE8;
}

body{
    font-family:'Inter',system-ui,sans-serif;
    background:#F5F5F5;
    color:#1E1E1E;
    margin:0;
}

/* ==== SIDEBAR CONTAINER ==== */
.sidebar{
    width:250px;
    min-height:100vh;

    display:flex;
    flex-direction:column;

    background:var(--sidebar-bg);
    border-right:1px solid rgba(255,255,255,.08);
}

/* ==== BRAND (HEADER) ==== */
.sidebar-brand{
    height:68px;
    padding:0 14px;

    display:flex;
    align-items:center;
    justify-content:center;
    gap:.6rem;

    font-size:1.25rem;
    font-weight:700;
    color:#fff;
    white-space:nowrap;
}

.sidebar-brand i{
    width:18px;
    font-size:18px;
}

/* ==== MENU WRAPPER ==== */
.sidebar nav{
    flex:1;
    padding:12px 12px 18px;
}

/* ==== MENU ITEM (KONSISTEN) ==== */
.sidebar .nav-link{
    display:flex;
    align-items:center;
    gap:.6rem;

    height:46px;
    padding:0 14px;
    margin:.22rem 0;

    border-radius:12px;

    font-size:14px;
    font-weight:500;

    color:var(--text-muted);
    background:transparent;
    text-decoration:none;
    white-space:nowrap;
}

/* Icon konsisten */
.sidebar .nav-link i{
    width:18px;
    text-align:center;
}

/* Hover */
.sidebar .nav-link:hover{
    background:var(--sidebar-hover);
    color:#fff;
}

/* Active */
.sidebar .nav-link.active{
    background:var(--sidebar-active);
    color:#fff;
    font-weight:600;
}

/* Divider */
.sidebar hr{
    border-color:rgba(255,255,255,.25);
    margin:.6rem 0;
}

/* ==== CONTENT AREA ==== */
.admin-content{
    padding:1.5rem 1.5rem 3rem;
}

/* Cards theme */
.card{
    border:0;
    border-radius:14px;
    box-shadow:0 8px 18px rgba(0,0,0,.06);
}
/* ===== MOBILE SIDEBAR RESPONSIVE ===== */

/* =========================
   MOBILE FIX – ADMIN LAYOUT
   ========================= */
@media(max-width: 992px){

    .admin-layout{
        flex-direction: column;
    }

    body.sidebar-open{
        overflow: hidden;
    }

    .sidebar{
        position: fixed;
        top: 0;
        left: -260px;
        width: 250px;
        height: 100vh;
        z-index: 1100;
        transition: left .3s ease;
    }

    .sidebar.active{
        left: 0;
    }

    .sidebar-overlay{
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,.45);
        z-index: 1090;
        display: none;
    }

    .sidebar-overlay.show{
        display: block;
    }

    .admin-content{
        padding: 1rem;
    }
}

.text-truncate-3{
    display: -webkit-box;
    -webkit-line-clamp: 3;   /* Safari / Chrome */
    -webkit-box-orient: vertical;

    line-clamp: 3;           /* Standard property (fallback) */
    overflow: hidden;
}
.desc-wrap{
    max-width: 600px;              /* batas lebar agar tidak kepanjangan */
}

.text-clamp-3{
    display: -webkit-box;
    -webkit-line-clamp: 3;         /* potong 3 baris */
    line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
/* -------- TABEL KOMPAK (MAX WIDTH KETAT) -------- */

.table-compact{
    table-layout: fixed;   /* << ini penting, paksa kolom tidak melebar */
    width: 100%;
}

/* Semua kolom wrap & tidak memanjang */
.table-compact td,
.table-compact th{
    vertical-align: middle;
    white-space: normal;
    word-wrap: break-word;
}

/* Foto */
.col-foto{
    width: 64px;
}

/* Kolom produk diperkecil & dibatasi */
.col-produk{
    max-width: 220px;
    white-space: normal;
}

/* Truncate deskripsi lebih ketat */
.text-trunc-2{
    display:-webkit-box;
    -webkit-line-clamp:2;
    line-clamp:2;
    -webkit-box-orient:vertical;
    overflow:hidden;
}

/* kolom lain dipersempit */
.col-kategori{ width:90px; }
.col-label{ width:90px; }
.col-harga{ width:110px; }
.col-status{ width:90px; }
.col-shopee{ width:80px; }
.col-aksi{ width:90px; }



/* --- PROFILE CARD LAYOUT FIX --- */

.profile-wrapper{
    max-width: 860px;      /* batasi lebar */
    margin:auto;           /* posisikan center */
}

.profile-header{
    display:grid;
    grid-template-columns:110px 1fr;
    gap:18px;
    align-items:flex-start;
}

.profile-logo img{
    width:95px;
    height:95px;
    object-fit:contain;
    border-radius:12px;
    box-shadow:0 6px 16px rgba(0,0,0,.08);
    background:#fff;
}

/* tabel informasi */
.profile-table{
    width:100%;
}

.profile-table th{
    width:160px;
    white-space:nowrap;
    font-weight:600;
}

.profile-table td{
    max-width:560px;
    line-height:1.45;
}

/* batasi panjang deskripsi */
.desc-wrap{
    max-width:540px;
}

.text-clamp-3{
    display:-webkit-box;
    -webkit-line-clamp:3;
    line-clamp:3;
    -webkit-box-orient:vertical;
    overflow:hidden;
}

/* Mobile */
@media(max-width:768px){
    .profile-wrapper{ max-width:100%; }
    .profile-header{
        grid-template-columns:1fr;
        text-align:center;
    }
    .profile-logo img{ margin:auto; }
}
.admin-layout{
    display:flex;
    min-height:100vh;
}

/* MOBILE ONLY */
/* DESKTOP SIDEBAR STABLE */
@media(min-width: 993px){
    .sidebar{
        position:sticky;
        top:0;
        height:100vh;
        flex-shrink:0;
    }

    .flex-grow-1{
        min-width:0;
    }
}

</style>

    
    @yield('styles')
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="sidebar">


            <div class="sidebar-brand">
                <i class="fas fa-spray-can"></i> Parfum Admin
            </div>
            
<nav class="nav flex-column">


    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
       href="{{ route('admin.dashboard') }}">
        <i class="fas fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>

    <a class="nav-link {{ request()->routeIs('admin.parfum.*') ? 'active' : '' }}"
       href="{{ route('admin.parfum.index') }}">
        <i class="fas fa-spray-can"></i>
        <span>Kelola Parfum</span>
    </a>

    <a class="nav-link {{ request()->routeIs('admin.profil-toko.*') ? 'active' : '' }}"
       href="{{ route('admin.profil-toko.index') }}">
        <i class="fas fa-store"></i>
        <span>Profil Toko</span>
    </a>

    <a class="nav-link {{ request()->routeIs('admin.admin-user.*') ? 'active' : '' }}"
       href="{{ route('admin.admin-user.index') }}">
        <i class="fas fa-users-cog"></i>
        <span>Kelola Admin</span>
    </a>

    <hr class="my-2" style="border-color: rgba(255,255,255,0.2);">

    <a class="nav-link" href="{{ route('home') }}" target="_blank">
        <i class="fas fa-external-link-alt"></i>
        <span>Lihat Website</span>
    </a>

    <a class="nav-link"
       href="#"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span>
    </a>

</nav>

        </div>
        
        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand navbar-light bg-white mb-4">
<button id="sidebarToggle" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link"
                           role="button" data-toggle="dropdown">
                            <i class="fas fa-user-circle fa-lg"></i>
                            <span class="ml-2 d-none d-lg-inline text-gray-600">
                                {{ Auth::user()->name }}
                            </span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </div>
    <form id="logout-form"
      action="{{ route('admin.logout') }}"
      method="POST"
      style="display:none;">
    @csrf
</form>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Scripts -->
    <script>
        // Auto-hide alerts after 5 seconds
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);
        });
    </script>
    <script>
const sidebar = document.querySelector(".sidebar");
const overlay = document.getElementById("sidebarOverlay");
const toggleBtn = document.getElementById("sidebarToggle");

toggleBtn.addEventListener("click", () => {
    sidebar.classList.toggle("active");
    overlay.classList.toggle("show");
});

overlay.addEventListener("click", () => {
    sidebar.classList.remove("active");
    overlay.classList.remove("show");
});
</script>
<script>
function toggleDesc(){
    const short = document.getElementById('descShort');
    const full  = document.getElementById('descFull');
    const btn   = document.getElementById('toggleBtn');

    if(full.classList.contains('d-none')){
        full.classList.remove('d-none');
        short.classList.add('d-none');
        btn.innerText = "Tutup";
    }else{
        full.classList.add('d-none');
        short.classList.remove('d-none');
        btn.innerText = "Lihat Selengkapnya";
    }
}
</script>
<script>
const text = document.getElementById("descText");
const btn  = document.getElementById("toggleDesc");

btn.addEventListener("click", () => {
    text.classList.toggle("text-clamp-3");

    if(text.classList.contains("text-clamp-3")){
        btn.innerText = "Lihat Selengkapnya";
    } else {
        btn.innerText = "Tutup";
    }
});
</script>

    @yield('scripts')
</body>
</html>