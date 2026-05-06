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
    z-index:1000; /* FIX */
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
    position:relative;
    z-index:1;
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
    border-left:4px solid #3b82f6;
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

/* BUTTON */
.btn-green{
    background:#22c55e;
    color:#fff;
    border:none;
    padding:10px 15px;
    border-radius:10px;
}

.btn-red{
    background:#ef4444;
    color:#fff;
    border:none;
    padding:10px 15px;
    border-radius:10px;
}

/* MOBILE NAV */
.mobile-nav{
    display:none;
    z-index:1000; /* FIX */
}

/* RESPONSIVE */
@media (max-width:768px){

    .sidebar{
        display:none;
    }

    .content{
        margin-left:0;
        padding:15px;
    }

    .topbar{
        flex-direction:column;
        align-items:flex-start;
        gap:10px;
    }

    .greeting{
        width:100%;
    }

    .mobile-nav{
        display:flex;
        justify-content:space-around;
        background:#1e3a8a;
        padding:12px;
        border-radius:12px;
        margin-bottom:15px;
    }

    .mobile-nav a{
        color:#fff;
        font-size:12px;
        text-align:center;
        text-decoration:none;
    }

    .card-soft{
        padding:15px;
        border-radius:16px;
    }

    .card-soft h3{
        font-size:20px;
    }

    .card-soft small{
        font-size:12px;
    }
}

/* CARD GLOBAL (INI YANG BENER 🔥) */
.card-soft{
    background:#fff;
    border-radius:20px;
    padding:20px;
    box-shadow:0 8px 20px rgba(0,0,0,0.06);
    transition:0.2s;
}

.card-soft:hover{
    transform: translateY(-4px);
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

<div>

<h5>☁️ ABSENSI PKL</h5>

<div class="menu mt-4">

@if(auth()->user()->role == 'admin')

<a href="/admin"><i class="bi bi-speedometer2"></i> Dashboard</a>
<a href="/admin/siswa"><i class="bi bi-people"></i> Data Siswa</a>
<a href="/admin/absensi"><i class="bi bi-table"></i> Data Absensi</a>
<a href="/admin/rekap"><i class="bi bi-bar-chart"></i> Rekap</a>

@else

<a href="/dashboard"><i class="bi bi-house"></i> Dashboard</a>
<a href="/absen/masuk"><i class="bi bi-box-arrow-in-right"></i> Absen Masuk</a>
<a href="/absen/pulang"><i class="bi bi-box-arrow-left"></i> Absen Pulang</a>
<a href="/riwayat"><i class="bi bi-clock-history"></i> Riwayat</a>

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

<!-- MOBILE NAV -->
<div class="mobile-nav">

@if(auth()->user()->role == 'admin')

<a href="/admin">
<i class="bi bi-speedometer2"></i><br>Dashboard
</a>

<a href="/admin/siswa">
<i class="bi bi-people"></i><br>Siswa
</a>

<a href="/admin/absensi">
<i class="bi bi-table"></i><br>Absensi
</a>

<a href="/admin/rekap">
<i class="bi bi-bar-chart"></i><br>Rekap
</a>

@else

<a href="/dashboard">
<i class="bi bi-house"></i><br>Home
</a>

<a href="/absen/masuk">
<i class="bi bi-box-arrow-in-right"></i><br>Masuk
</a>

<a href="/absen/pulang">
<i class="bi bi-box-arrow-left"></i><br>Pulang
</a>

<a href="/riwayat">
<i class="bi bi-clock-history"></i><br>Riwayat
</a>

@endif

</div>

<!-- PROFILE MOBILE -->
<div class="profile d-md-none mb-3" style="background:#1e3a8a; color:#fff;">

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

<!-- TOPBAR -->
<div class="topbar">
<div></div>
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