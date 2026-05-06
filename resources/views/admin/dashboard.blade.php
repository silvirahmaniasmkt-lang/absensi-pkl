@extends('layouts.app')

@section('title','Dashboard Admin')

@section('content')

<div class="container-fluid">

<!-- TANGGAL -->
<div class="mb-3 text-muted">
📅 {{ date('d F Y') }} | 🕒 <span id="jam"></span>
</div>

<!-- INFO CARDS (MODEL SISWA) -->
<div class="row g-3 mb-4">

<div class="col-6 col-md-3">
<div class="card-soft text-center h-100">
<div style="font-size:22px;">👥</div>
<small>Total Siswa</small>
<h3 class="mt-1">{{ $siswa }}</h3>
</div>
</div>

<div class="col-6 col-md-3">
<div class="card-soft text-center h-100">
<div style="font-size:22px;">📊</div>
<small>Total Absensi</small>
<h3 class="mt-1">{{ $totalAbsensi }}</h3>
</div>
</div>

<div class="col-6 col-md-3">
<div class="card-soft text-center h-100">
<div style="font-size:22px;">✅</div>
<small>Hadir</small>
<h3 class="mt-1">{{ $hadir }}</h3>
</div>
</div>

<div class="col-6 col-md-3">
<div class="card-soft text-center h-100">
<div style="font-size:22px;">📌</div>
<small>Izin / Sakit</small>
<h3 class="mt-1">{{ $izin + $sakit }}</h3>
</div>
</div>

</div>

<!-- CHART -->
<div class="card-soft mb-4">
<h5>📊 Statistik Kehadiran</h5>
<canvas id="chartAbsensi"></canvas>
</div>

<!-- FILTER -->
<div class="card-soft mb-4">

<form method="GET" class="row g-2">

<div class="col-6 col-md-3">
<input type="text" name="nama" class="form-control" placeholder="Cari nama siswa" value="{{ request('nama') }}">
</div>

<div class="col-6 col-md-3">
<input type="date" name="from" class="form-control" value="{{ request('from') }}">
</div>

<div class="col-6 col-md-3">
<input type="date" name="to" class="form-control" value="{{ request('to') }}">
</div>

<div class="col-6 col-md-2">
<select name="status" class="form-control">
<option value="">Status</option>
<option value="hadir" {{ request('status')=='hadir'?'selected':'' }}>Hadir</option>
<option value="izin" {{ request('status')=='izin'?'selected':'' }}>Izin</option>
<option value="sakit" {{ request('status')=='sakit'?'selected':'' }}>Sakit</option>
</select>
</div>

<div class="col-12 col-md-1">
<button class="btn btn-primary w-100">🔎</button>
</div>

</form>

</div>

<!-- TABLE -->
<div class="card-soft">

<div class="d-flex justify-content-between mb-3">
<h5>📋 Data Absensi</h5>
</div>

<div class="table-responsive">
<table class="table table-hover align-middle">

<thead>
<tr>
<th>Nama</th>
<th>Tanggal</th>
<th>Masuk</th>
<th>Pulang</th>
<th>Status</th>
<th>Keterangan</th>
</tr>
</thead>

<tbody>

@forelse($data as $d)
<tr>
<td>{{ $d->user->name ?? '-' }}</td>
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

@elseif($d->status=='sakit')
<span class="badge bg-secondary">Sakit</span>

@else
<span class="badge bg-dark">-</span>
@endif
</td>

<td>
{{ $d->keterangan ?? '-' }}

@if($d->keterangan_pulang)
<br><small class="text-muted">Pulang: {{ $d->keterangan_pulang }}</small>
@endif
</td>

</tr>

@empty
<tr>
<td colspan="6" class="text-center">Data tidak ditemukan</td>
</tr>
@endforelse

</tbody>

</table>
</div>

</div>

</div>

<!-- CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('chartAbsensi');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Hadir','Izin','Sakit'],
        datasets: [{
            label: 'Jumlah',
            data: [{{ $hadir }}, {{ $izin }}, {{ $sakit }}],
            backgroundColor: ['#22c55e','#facc15','#ef4444']
        }]
    }
});
</script>

<!-- JAM -->
<script>
setInterval(()=>{
document.getElementById('jam').innerHTML =
new Date().toLocaleTimeString('id-ID');
},1000);
</script>

@endsection