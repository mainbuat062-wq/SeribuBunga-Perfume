<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Admin — SeribuBunga Parfume</title>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

<style>
:root{
    --ink:#1f2937;
    --accent:#d4a574;
    --cream:#f6f2eb;
    --navy:#111827;
}

/* GLOBAL */
body{
    margin:0;
    font-family:'Lato', sans-serif;
    background:linear-gradient(180deg,#faf7f2,#f1ede6);
    color:var(--ink);
}

/* WRAPPER */
.auth-wrapper{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:28px;
}

/* CARD */
.auth-card{
    background:#ffffff;
    border:1px solid rgba(0,0,0,.06);
    border-radius:22px;
    padding:38px 34px;
    max-width:420px;
    width:100%;
    box-shadow:0 28px 60px rgba(0,0,0,.08);
    animation:fade .5s ease;
}

@keyframes fade {from{opacity:0;transform:translateY(12px)}}

/* BRAND */
.brand{
    text-align:center;
    margin-bottom:18px;
}

.brand-name{
    font-family:'Playfair Display', serif;
    font-size:26px;
    font-weight:600;
}

.brand-tagline{
    font-size:13px;
    color:#6f6f6f;
}

/* TITLE */
.auth-title{
    font-family:'Playfair Display', serif;
    font-size:22px;
    margin:10px 0 6px;
}

/* FORM */
.label{
    font-size:13px;
    margin-bottom:6px;
    font-weight:600;
}

.input{
    width:100%;
    padding:12px 14px;
    border-radius:12px;
    border:1px solid #d1d5db;
    background:#fafafa;
    outline:none;
    transition:.25s ease;
}

.input:focus{
    border-color:var(--accent);
    background:#fff;
    box-shadow:0 0 0 3px rgba(212,165,116,.18);
}

/* BUTTON */
.btn{
    width:100%;
    padding:12px;
    border-radius:12px;
    border:0;
    background:var(--navy);
    color:#fff;
    font-weight:600;
    letter-spacing:.5px;
    cursor:pointer;
    transition:.25s ease;
}

.btn:hover{
    transform:translateY(-2px);
    box-shadow:0 18px 38px rgba(0,0,0,.18);
}

/* FOOTER */
.auth-footer{
    margin-top:14px;
    text-align:center;
    font-size:12px;
    color:#777;
}
</style>
</head>

<body>

<div class="auth-wrapper">

    <div class="auth-card">

        <div class="brand">
            <div class="brand-name">Login Admin</div>
        </div>


        @if(session('error'))
            <p style="color:#b91c1c;font-size:13px;margin-bottom:8px;">
                {{ session('error') }}
            </p>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf

            <label class="label">Email</label>
            <input type="email" name="email" class="input" required value="{{ old('email') }}">

            <label class="label" style="margin-top:10px;">Password</label>
            <input type="password" name="password" class="input" required>

            <button class="btn" style="margin-top:14px;">
                Masuk ke Dashboard
            </button>
        </form>

        <div class="auth-footer">
            © {{ date('Y') }} — Admin Panel
        </div>

    </div>
</div>

</body>
</html>
