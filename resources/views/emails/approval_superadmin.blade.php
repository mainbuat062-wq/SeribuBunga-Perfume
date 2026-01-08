<h3>Pengajuan Super Admin Baru</h3>

<p><strong>Nama:</strong> {{ $user->name }}</p>
<p><strong>Email:</strong> {{ $user->email }}</p>

<p>Silakan pilih tindakan:</p>

<p>
    <a href="{{ route('admin.approve', $token) }}">✔ SETUJUI</a> |
    <a href="{{ route('admin.reject', $token) }}">❌ TOLAK</a>
</p>

<p>Link berlaku 24 jam.</p>
