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

*{
    box-sizing: border-box;
}

.password-wrapper{
    position: relative;
    width: 100%;
}

.password-wrapper .input{
    width: 100%;
    padding-right: 50px; /* ruang buat icon */
}

.toggle-password{
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    border: none;
    background: transparent;
    cursor: pointer;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.toggle-password svg{
    width: 20px;
    height: 20px;
    stroke: #6b7280;
}

.toggle-password:hover svg{
    stroke: var(--navy);
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

<div class="password-wrapper">
    <input type="password" id="password" name="password" class="input" required>

    <button type="button" class="toggle-password" onclick="togglePassword()" aria-label="Toggle Password">
        <!-- Eye icon (default tampil) -->
        <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>

        <!-- Eye off icon (default hidden) -->
        <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" style="display:none;">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 3l18 18" />
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M10.477 10.477a3 3 0 104.243 4.243" />
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9.88 5.08A9.953 9.953 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.97 9.97 0 01-4.118 5.318" />
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M6.228 6.228A9.97 9.97 0 002.458 12c1.274 4.057 5.065 7 9.542 7 1.62 0 3.166-.386 4.522-1.07" />
        </svg>
    </button>
</div>


            <button class="btn" style="margin-top:14px;">
                Masuk ke Dashboard
            </button>
        </form>

        <div class="auth-footer">
            © {{ date('Y') }} — Admin Panel
        </div>

    </div>
</div>
<script>
function togglePassword(){
    const input = document.getElementById("password");
    const eyeOpen = document.getElementById("eyeOpen");
    const eyeClosed = document.getElementById("eyeClosed");

    if(input.type === "password"){
        input.type = "text";
        eyeOpen.style.display = "none";
        eyeClosed.style.display = "block";
    } else {
        input.type = "password";
        eyeOpen.style.display = "block";
        eyeClosed.style.display = "none";
    }
}
</script>


</body>
</html>
