@extends('layouts.app')

@section('title','Dashboard Admin')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold">👨‍💼 Dashboard Admin</h2>
    <p class="text-muted">💻 Pusat manajemen untuk mengakses fitur utama dan informasi penting sistem.</p>
</div>

<!-- 📊 STAT CARD -->
<div class="row mb-4">

<div class="col-md-3">
<div class="card-soft text-center">
<h6>Total Siswa</h6>
<h3>{{ $siswa }}</h3>
</div>
</div>

<div class="col-md-3">
<div class="card-soft text-center">
<h6>Total Absensi</h6>
<h3>{{ $totalAbsensi }}</h3>
</div>
</div>

<div class="col-md-3">
<div class="card-soft text-center">
<h6>Hadir</h6>
<h3>{{ $hadir }}</h3>
</div>
</div>

<div class="col-md-3">
<div class="card-soft text-center">
<h6>Izin / Sakit</h6>
<h3>{{ $izin + $sakit }}</h3>
</div>
</div>

</div>

<!-- 📊 CHART -->
<div class="card-soft mb-4">
<h5>📊 Statistik Kehadiran</h5>
<canvas id="chartAbsensi"></canvas>
</div>

<!-- 🔎 FILTER -->
<div class="card-soft mb-4">

<form method="GET" class="row g-2">

<div class="col-md-3">
<input type="text" name="nama" class="form-control" placeholder="Cari nama siswa" value="{{ request('nama') }}">
</div>

<div class="col-md-3">
<input type="date" name="from" class="form-control" value="{{ request('from') }}">
</div>

<div class="col-md-3">
<input type="date" name="to" class="form-control" value="{{ request('to') }}">
</div>

<div class="col-md-2">
<select name="status" class="form-control">
<option value="">Status</option>
<option value="hadir" {{ request('status')=='hadir'?'selected':'' }}>Hadir</option>
<option value="izin" {{ request('status')=='izin'?'selected':'' }}>Izin</option>
<option value="sakit" {{ request('status')=='sakit'?'selected':'' }}>Sakit</option>
</select>
</div>

<div class="col-md-1">
<button class="btn btn-primary w-100">🔎</button>
</div>

</form>

</div>

<!-- 📋 TABLE -->
<div class="card-soft">

<h5>📋 Data Absensi</h5>

<div class="table-responsive mt-3">

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

@foreach($data as $d)
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
@endforeach

</tbody>

</table>

</div>

</div>

<!-- 📊 CHART SCRIPT -->
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

@endsection