<!DOCTYPE html>
<html>
<head>
    <title>Persetujuan Admin Baru</title>
</head>
<body>
    <h2>Persetujuan Admin Baru</h2>

    <p>Halo Super Admin,</p>

    <p>Ada permintaan admin baru dengan detail:</p>

    <ul>
        <li>Nama: {{ $user->name }}</li>
        <li>Email: {{ $user->email }}</li>
    </ul>

    <p>Silakan pilih tindakan:</p>

    <a href="{{ route('admin.approve', $token) }}"
       style="padding:10px 15px;background:green;color:white;text-decoration:none;">
        APPROVE
    </a>

    <a href="{{ route('admin.reject', $token) }}"
       style="padding:10px 15px;background:red;color:white;text-decoration:none;">
        REJECT
    </a>

    <p style="margin-top:20px;">
        Link berlaku 24 jam dan hanya bisa digunakan sekali.
    </p>
</body>
</html>
