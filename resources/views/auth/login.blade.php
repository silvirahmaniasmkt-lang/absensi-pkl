<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login PKL</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>

/* RESET (ANTI GARIS PUTIH) */
html, body{
    margin:0;
    padding:0;
    height:100%;
    overflow:hidden;
}

/* BACKGROUND FULL */
body{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;

    display:flex;
    justify-content:center;
    align-items:center;

    font-family:"Century Gothic", sans-serif;

    background: url('/images/bg-space.png') no-repeat center center;
    background-size: cover;
}

/* OVERDRAW BIAR GA ADA GARIS 1PX */
body::after{
    content:"";
    position:absolute;
    top:-2px;
    left:-2px;
    right:-2px;
    bottom:-2px;
    background: url('/images/bg-space.png') no-repeat center center;
    background-size: cover;
    z-index:-1;
}

/* CARD */
.card{
    position:relative;
    z-index:1;
    width:370px;
    padding:35px;
    border-radius:20px;
    background: rgba(255,255,255,0.95);
    backdrop-filter: blur(12px);
    box-shadow:0 20px 60px rgba(0,0,0,0.3);
    animation: fadeIn 0.6s ease;
}

/* INPUT */
.input-icon{
    position:relative;
}

.input-icon i{
    position:absolute;
    left:12px;
    top:50%;
    transform: translateY(-50%);
    color:#6b7280;
    font-size:18px;
}

.input-icon input{
    padding-left:40px;
    height:45px;
    border-radius:10px;
}

.input-icon input:focus{
    border-color:#5f9cff;
    box-shadow:0 0 0 2px rgba(95,156,255,0.2);
}

/* BUTTON */
.btn-main{
    background: linear-gradient(135deg,#5f9cff,#7c4dff);
    color:#fff;
    border:none;
    border-radius:10px;
    height:45px;
    transition:0.3s;
}

.btn-main:hover{
    transform: translateY(-2px);
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

/* ANIMATION */
@keyframes fadeIn{
    from{opacity:0; transform:translateY(20px);}
    to{opacity:1; transform:translateY(0);}
}

</style>
</head>

<body>

<div class="card text-center">

    <!-- LOGO -->
    <div class="mb-3">
        <img src="/images/logo-bmkg.png" width="70">
    </div>

    <h4 class="fw-bold">Selamat Datang 👋</h4>
    <p class="text-muted mb-4">Silakan login untuk melanjutkan</p>

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="/login">
    @csrf

    <div class="mb-3 text-start">
        <label>Email</label>
        <div class="input-icon">
            <i class="bi bi-envelope"></i>
            <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
        </div>
    </div>

    <div class="mb-3 text-start">
        <label>Password</label>
        <div class="input-icon">
            <i class="bi bi-lock"></i>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>
    </div>

    <button class="btn btn-main w-100 mb-3">
        Masuk 🔐
    </button>

    </form>

    <p class="mb-0">
        Belum punya akun? 
        <a href="/register">Daftar ✨</a>
    </p>

</div>

</body>
</html>