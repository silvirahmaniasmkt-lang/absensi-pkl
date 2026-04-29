<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>@yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    margin:0;
    font-family:"Century Gothic", sans-serif;
    background:#f5f7fb;
}

/* SIDEBAR */
.sidebar{
    width:250px;
    height:100vh;
    position:fixed;
    background: linear-gradient(180deg,#1e3a8a,#2563eb);
    color:#fff;
    padding:20px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
}

.sidebar h5{
    font-weight:bold;
}

/* MENU */
.menu a{
    display:flex;
    align-items:center;
    gap:12px;
    padding:12px;
    border-radius:10px;
    color:#fff;
    text-decoration:none;
    margin-bottom:10px;
    transition:.2s;
}

.menu a:hover,
.menu a.active{
    background: rgba(255,255,255,0.15);
}

/* CONTENT */
.content{
    margin-left:260px;
    padding:25px;
}

/* TOPBAR */
.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

/* GREETING */
.greeting{
    background:#fff;
    padding:10px 15px;
    border-radius:12px;
    border-left:4px solid #3b82f6; /* garis biru kiri 🔥 */
    box-shadow:0 3px 10px rgba(0,0,0,0.05);
}

/* PROFILE */
.profile{
    background: rgba(255,255,255,0.15);
    padding:15px;
    border-radius:15px;
}

.profile-circle{
    width:40px;
    height:40px;
    border-radius:50%;
    background:#fff;
    color:#2563eb;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:bold;
}

/* CARD */
.card-soft{
    background:#fff;
    border-radius:15px;
    padding:20px;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
}

/* CARD BORDER */
.card-green{ border-left:5px solid #22c55e; }
.card-red{ border-left:5px solid #ef4444; }
.card-blue{ border-left:5px solid #3b82f6; }

/* ACTION */
.action-card{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

/* BUTTON */
.btn-green{
    background:#22c55e;
    color:#fff;
    border:none;
    padding:10px 15px;
    border-radius:10px;
    text-decoration: none !important;
    display: inline-block;
    color: #fff;
}
.btn-red{
    background:#ef4444;
    color:#fff;
    border:none;
    padding:10px 15px;
    border-radius:10px;
    text-decoration: none !important;
    display: inline-block;
    color: #fff;
}

/* TABLE */
.table{
    margin:0;
}

/* HOVER */
.card-soft:hover{
    transform: translateY(-3px);
    transition:.2s;
}

.table-hover tbody tr:hover {
    transform: scale(1.01);
    transition: 0.2s;
}

/* HILANGKAN GARIS BAWAH SEMUA LINK */
a,
a:hover,
a:focus {
    text-decoration: none !important;
}

/* BIAR LINK DI DALAM BUTTON IKUT RAPI */
.btn-green:hover,
.btn-red:hover {
    text-decoration: none !important;
}

/* OPTIONAL: BIAR LEBIH HALUS */
.btn-green:hover{
    background:#16a34a;
    transform: translateY(-1px);
    transition:0.2s;
}

.btn-red:hover{
    background:#dc2626;
    transform: translateY(-1px);
    transition:0.2s;
}

/* RIPPLE EFFECT */
.btn-ripple {
    position: relative;
    overflow: hidden;
}

.btn-ripple span {
    position: relative;
    z-index: 2;
}

/* ANIMASI RIPPLE */
.btn-ripple::after {
    content: "";
    position: absolute;
    width: 0;
    height: 0;
    background: rgba(255,255,255,0.4);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    pointer-events: none;
}

.btn-ripple:active::after {
    width: 200px;
    height: 200px;
    transition: 0.4s;
}

/* SUCCESS STATE */
.btn-success-state {
    background: #22c55e !important;
    border: none;
}

</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

<div>

<h5>☁️ PKL BMKG</h5>

<div class="menu mt-4">

@if(auth()->user()->role == 'siswa')

<a href="/dashboard" class="{{ request()->is('dashboard')?'active':'' }}">
<i class="bi bi-house"></i> Dashboard
</a>

<a href="/absen_masuk">
<i class="bi bi-box-arrow-in-right"></i> Absen Masuk
</a>

<a href="/absen/pulang">
<i class="bi bi-box-arrow-left"></i> Absen Pulang
</a>

<a href="/riwayat">
<i class="bi bi-clock-history"></i> Riwayat
</a>

<a href="/rekap">
<i class="bi bi-bar-chart"></i> Rekap
</a>

@endif

@if(auth()->user()->role == 'admin')

<a href="/admin" class="{{ request()->is('admin')?'active':'' }}">
<i class="bi bi-speedometer2"></i> Dashboard Admin
</a>

@endif

</div>

</div>

<!-- PROFILE -->
<div class="profile">
<div class="d-flex align-items-center gap-2">

<div class="profile-circle">
{{ strtoupper(substr(auth()->user()->name,0,1)) }}
</div>

<div>
<b>{{ auth()->user()->name }}</b><br>

@if(auth()->user()->role == 'admin')
<span class="badge bg-warning text-dark">Admin</span>
@else
<span class="badge bg-light text-dark">Siswa</span>
@endif

</div>

</div>

<form method="POST" action="/logout" class="mt-3">
@csrf
<button class="btn btn-light w-100">Logout</button>
</form>

</div>

</div>

<!-- SIDEBAR -->
<div class="sidebar">

<div>

<h5>☁️ ABSENSI PKL</h5>

<div class="menu mt-4">

@if(auth()->user()->role == 'admin')

<a href="/admin">
<i class="bi bi-speedometer2"></i> Dashboard
</a>

<a href="/admin/siswa">
<i class="bi bi-people"></i> Data Siswa
</a>

<a href="/admin/absensi">
<i class="bi bi-table"></i> Data Absensi
</a>

<a href="/admin/rekap">
<i class="bi bi-bar-chart"></i> Rekap Laporan
</a>

@else

<a href="/dashboard">
<i class="bi bi-house"></i> Dashboard
</a>

<a href="/absen/masuk">
<i class="bi bi-box-arrow-in-right"></i> Absen Masuk
</a>

<a href="/absen/pulang">
<i class="bi bi-box-arrow-left"></i> Absen Pulang
</a>

<a href="/riwayat">
<i class="bi bi-clock-history"></i> Riwayat
</a>

@endif

</div>

</div>

<!-- PROFILE -->
<div class="profile">

<div class="d-flex align-items-center gap-2">

<div class="profile-circle">
{{ strtoupper(substr(auth()->user()->name,0,1)) }}
</div>

<div>
<b>{{ auth()->user()->name }}</b><br>
<small>{{ ucfirst(auth()->user()->role) }}</small>
</div>

</div>

<form method="POST" action="/logout" class="mt-3">
@csrf
<button class="btn btn-light w-100">Logout</button>
</form>

</div>

</div>

<!-- CONTENT -->
<div class="content">

<div class="topbar">

<div></div> {{-- ini kosong biar dorong ke kanan --}}

<div class="greeting">
☀️ Selamat datang kembali, {{ auth()->user()->name }}
</div>

</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

@yield('content')

</div>

</body>
</html>