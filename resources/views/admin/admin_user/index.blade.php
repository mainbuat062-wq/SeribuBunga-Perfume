@extends('layouts.admin')

@section('title', 'Manajemen Admin')

@section('styles')
<style>
    /* Styling Tambahan agar seragam dengan Dashboard */
    .card {
        border: none;
        border-radius: 16px;
        transition: all 0.3s ease;
    }
    
    .form-control, .form-select {
        border-radius: 10px;
        padding: 10px 15px;
        border: 1px solid #e2e8f0;
    }

    .form-control:focus, .form-select:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.15);
    }

    .avatar-initial {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #fff;
        font-size: 14px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    /* Soft Badge Styles */
    .badge-soft-success {
        background-color: rgba(25, 135, 84, 0.1);
        color: #198754;
    }
    .badge-soft-warning {
        background-color: rgba(255, 193, 7, 0.1);
        color: #856404;
    }
    .badge-soft-secondary {
        background-color: rgba(108, 117, 125, 0.1);
        color: #6c757d;
    }
    
    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        color: #8898aa;
        background-color: #f8f9fe;
        border-bottom: 1px solid #e9ecef;
    }
    
    .table td {
        vertical-align: middle !important;
        font-size: 0.875rem;
    }
.bg-gradient-0 { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .bg-gradient-1 { background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%); }
    .bg-gradient-2 { background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%); }
    .bg-gradient-3 { background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%); }
    /* === ROLE SELECT (CHIP STYLE) === */
.role-select {
    border-radius: 20px;
    padding: 6px 14px;
    font-size: 13px;
    font-weight: 600;
    border: 0;
    outline: none;
    cursor: pointer;
    appearance: none;
    text-align-last: center;
}

/* warna role */
.role-admin {
    background: rgba(108,117,125,.12);
    color: #495057;
}

.role-superadmin {
    background: rgba(78,115,223,.15);
    color: #4e73df;
}

/* === HEADER ICON SOFT === */
.header-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* === STATUS BADGE FIX === */
.badge-soft-success,
.badge-soft-warning {
    font-size: 12px;
    padding: 6px 14px;
}
/* =========================
   MOBILE FIX – KELOLA ADMIN
   ========================= */
@media (max-width: 768px) {

    /* Card full width & jarak rapi */
    .card {
        border-radius: 14px;
        margin-bottom: 16px;
    }

    /* Header jangan kepanjangan */
    .page-header h2 {
        font-size: 22px;
    }

    /* Table lebih aman di mobile */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    /* Avatar + nama rapat */
    .avatar-initial {
        width: 36px;
        height: 36px;
        font-size: 13px;
    }

    /* Role dropdown jangan melebar */
    .role-select {
        padding: 6px 10px;
        font-size: 12px;
    }

    /* Kolom aksi jangan maksa lebar */
    td.text-end {
        white-space: nowrap;
    }
}

</style>
@endsection

@section('content')

<div class="container-fluid pb-5">

    {{-- HEADER --}}
    <div class="page-header mb-4 mt-3">
        <h2 class="fw-bold text-dark">Manajemen Admin</h2>
        <p class="text-muted">Kelola administrator sistem dan hak akses dengan mudah.</p>
    </div>

    <div class="row mb-4">

        <div class="col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-body p-4">
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="header-icon mr-3" style="background: rgba(78,115,223,.15); color:#4e73df;">

                            <i class="fas fa-user-plus fa-lg"></i>
                        </div>
                        <h5 class="mb-0 fw-bold">Tambah Admin</h5>
                    </div>

                    {{-- ALERTS --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3 small" role="alert">
                            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-3 small" role="alert">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.admin-user.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" required value="{{ old('name') }}" placeholder="Contoh: John Doe">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Email Address</label>
                            <input type="email" name="email" class="form-control" required value="{{ old('email') }}" placeholder="admin@example.com">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted text-uppercase">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted text-uppercase">Role Akses</label>
                            <select name="role" class="form-select" required>
                                <option value="admin">Admin Biasa</option>
                                <option value="superadmin">Super Admin</option>
                            </select>
                        </div>

                        <button class="btn btn-primary w-100 py-2 fw-bold shadow-sm">
                            <i class="fas fa-save me-2"></i> Simpan Data
                        </button>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm h-100">
                <div class="card-body p-0">
                    
                    {{-- Header Tabel --}}
                    <div class="p-4 border-bottom d-flex align-items-center">
<div class="header-icon mr-3" style="background:rgba(23,162,184,.15); color:#17a2b8;">
    <i class="fas fa-users"></i>
</div>


                        <div>
                            <h5 class="mb-0 fw-bold">Daftar Administrator</h5>
                            <p class="text-muted small mb-0">{{ $admins->count() }} akun terdaftar</p>
                        </div>
                    </div>

                    {{-- Tabel --}}
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4 py-3">User</th>
                                    <th class="d-none d-md-table-cell">Email</th>
                                    <th class="py-3 text-center">Status</th>
                                    <th class="py-3 text-center">Role</th>
                                    <th class="pe-4 py-3 text-end">Aksi</th>
                                </tr>
                            </thead>

<tbody>
    @forelse($admins as $admin)
    <tr>
<td class="pl-4">
    <div class="d-flex align-items-center">

        @php
            $bgClass = 'bg-gradient-' . ($loop->index % 4);
        @endphp

        <div class="avatar-initial mr-3 {{ $bgClass }}">
            {{ strtoupper(substr($admin->name, 0, 1)) }}
        </div>

        <div class="lh-sm">
            <div class="font-weight-bold text-dark">
                {{ $admin->name }}
            </div>

        </div>

    </div>
</td>


        {{-- ... (kode ke bawah sama seperti sebelumnya) ... --}}
<td class="d-none d-md-table-cell">
    {{ $admin->email }}
</td>


        <td class="text-center">
            @if($admin->is_active)
                <span class="badge badge-soft-success rounded-pill px-3 py-2">Aktif</span>
            @else
                <span class="badge badge-soft-warning rounded-pill px-3 py-2">Pending</span>
            @endif
        </td>

        <td class="text-center">
            <form action="{{ route('admin.admin-user.update-role', $admin->id) }}" method="POST">
                @csrf
<select name="role"
        onchange="this.form.submit()"
        class="role-select {{ $admin->role === 'superadmin' ? 'role-superadmin' : 'role-admin' }}">
    <option value="admin" {{ $admin->role === 'admin' ? 'selected' : '' }}>Admin</option>
    <option value="superadmin" {{ $admin->role === 'superadmin' ? 'selected' : '' }}>Super Admin</option>
</select>

            </form>
        </td>

        <td class="text-end pe-4">
            @if($admin->role !== 'superadmin')
                <form action="{{ route('admin.admin-user.destroy', $admin->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus akses admin ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-icon btn-light text-danger btn-sm rounded-circle" style="width: 32px; height: 32px;" title="Hapus Admin">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            @else
<button class="btn btn-sm btn-light text-muted rounded-pill px-3 border-0" disabled>
    <i class="fas fa-lock mr-1"></i> Locked
</button>

            @endif
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="text-center py-5">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <div class="bg-light rounded-circle p-4 mb-3">
                    <i class="fas fa-user-slash fa-2x text-muted"></i>
                </div>
                <h6 class="text-muted fw-bold">Belum ada data admin</h6>
                <p class="text-muted small mb-0">Silakan tambahkan admin baru melalui form di samping.</p>
            </div>
        </td>
    </tr>
    @endforelse
</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection