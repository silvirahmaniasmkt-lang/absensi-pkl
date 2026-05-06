@extends('layouts.app')

@section('title','Dashboard')

@section('content')

<style>
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

/* HILANGKAN GARIS LINK */
a{
    text-decoration:none !important;
}
</style>

<div class="container-fluid">

<!-- TANGGAL -->
<div class="mb-3 text-muted">
📅 {{ date('d F Y') }} | 🕒 <span id="jam"></span>
</div>

<!-- INFO CARDS -->
<div class="row g-3 mb-4">

<div class="col-6 col-md-4">
<div class="card-soft text-center h-100">
<div style="font-size:22px;">✅</div>
<small>Total Hadir</small>
<h3 class="mt-1">
{{ $data->where('status','hadir')->count() }}
</h3>
</div>
</div>

<div class="col-6 col-md-4">
<div class="card-soft text-center h-100">
<div style="font-size:22px;">⏰</div>
<small>Terlambat</small>
<h3 class="mt-1">
{{ $data->where('status','terlambat')->count() }}
</h3>
</div>
</div>

<div class="col-12 col-md-4">
<div class="card-soft text-center h-100">
<div style="font-size:22px;">📊</div>
<small>Status Hari Ini</small>
<div class="mt-2">
@if($today)
<span class="badge bg-success">Sudah Absen</span>
@else
<span class="badge bg-danger">Belum Absen</span>
@endif
</div>
</div>
</div>

</div>

<!-- ACTION CARDS (TERPISAH & SEJAJAR) -->
<div class="row g-3 mb-4">

<div class="col-6">
<div class="card-soft text-center h-100">
<div style="font-size:26px;">📥</div>
<h6 class="mt-2">Absen Masuk</h6>

<a href="/absen/masuk" class="btn-green w-100 mt-2">
Isi Absen
</a>

</div>
</div>

<div class="col-6">
<div class="card-soft text-center h-100">
<div style="font-size:26px;">📤</div>
<h6 class="mt-2">Absen Pulang</h6>

<a href="/absen/pulang" class="btn-red w-100 mt-2">
Isi Absen
</a>

</div>
</div>

</div>

<!-- RIWAYAT (CARD SENDIRI) -->
<div class="card-soft">

<div class="d-flex justify-content-between mb-3">
<h5>📊 Riwayat Terbaru</h5>
<a href="/riwayat">Lihat Semua →</a>
</div>

<div class="table-responsive">
<table class="table table-hover">

<thead>
<tr>
<th>Tanggal</th>
<th>Masuk</th>
<th>Pulang</th>
<th>Status</th>
</tr>
</thead>

<tbody>
@forelse($data->take(5) as $d)
<tr>
<td>{{ $d->tanggal }}</td>
<td>{{ $d->jam_masuk ?? '-' }}</td>
<td>{{ $d->jam_pulang ?? '-' }}</td>

<td>
@if($d->status=='hadir')
<span class="badge bg-success">Hadir</span>
@elseif($d->status=='terlambat')
<span class="badge bg-danger">Terlambat</span>
@elseif($d->status=='izin')
<span class="badge bg-warning text-dark">Izin</span>
@else
<span class="badge bg-secondary">Sakit</span>
@endif
</td>

</tr>
@empty
<tr>
<td colspan="4" class="text-center">Belum ada data</td>
</tr>
@endforelse
</tbody>

</table>
</div>

</div>

</div>

<!-- SCRIPT -->
<script>
setInterval(()=>{
document.getElementById('jam').innerHTML =
new Date().toLocaleTimeString('id-ID');
},1000);
</script>

@endsection