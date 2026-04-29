@extends('layouts.app')

@section('title','Dashboard')

@section('content')

<p class="mb-3">
📅 {{ date('d F Y') }} | 🕒 <span id="jam"></span>
</p>

<div class="row mb-4">

<div class="col-md-4">
<div class="card-soft card-green">
<h6>✅ Total Hadir</h6>
<h3>{{ $data->where('status','hadir')->count() }}</h3>
</div>
</div>

<div class="col-md-4">
<div class="card-soft card-red">
<h6>⏰ Terlambat</h6>
<h3>{{ $data->where('status','terlambat')->count() }}</h3>
</div>
</div>

<div class="col-md-4">
<div class="card-soft card-blue">
<h6>📊 Status Hari Ini</h6>
<h4>{{ $today ? '✔️ Sudah Absen' : '❌ Belum Absen' }}</h4>
</div>
</div>

</div>

<div class="row mb-4">

<div class="col-md-6">
<div class="card-soft action-card">
<div>
<h5>📥 Absen Masuk</h5>
<p>Isi form kehadiran hari ini</p>
</div>

<a href="/absen/masuk" class="btn-green btn-ripple">
Isi Absen →
</a>

</div>
</div>

<div class="col-md-6">
<div class="card-soft action-card">
<div>
<h5>📤 Absen Pulang</h5>
<p>Selesaikan aktivitas hari ini</p>
</div>

<a href="/absen/pulang" class="btn-red btn-ripple">
Isi Absen →
</a>

</div>
</div>

</div>

<div class="card-soft">

<div class="d-flex justify-content-between mb-3">
<h5>📊 Riwayat Terbaru</h5>
<a href="/riwayat" class="text-decoration-none">Lihat Semua →</a>
</div>

<table class="table table-hover">
<tr>
<th>Tanggal</th>
<th>Masuk</th>
<th>Pulang</th>
<th>Status</th>
</tr>

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
<td colspan="4" class="text-center">
Belum ada data
</td>
</tr>
@endforelse

</table>

</div>

<!-- TOAST -->
<div id="toastSuccess" class="toast-custom">
    🎉 Absen berhasil disimpan!
</div>

<script>
// JAM REALTIME
setInterval(()=>{
document.getElementById('jam').innerHTML =
new Date().toLocaleTimeString('id-ID');
},1000);

// RIPPLE EFFECT UNTUK LINK
document.querySelectorAll('.btn-ripple').forEach(btn => {
    btn.addEventListener('click', function(e){
        const circle = document.createElement("span");
        const diameter = Math.max(btn.clientWidth, btn.clientHeight);
        const radius = diameter / 2;

        circle.style.width = circle.style.height = `${diameter}px`;
        circle.style.left = `${e.clientX - btn.getBoundingClientRect().left - radius}px`;
        circle.style.top = `${e.clientY - btn.getBoundingClientRect().top - radius}px`;
        circle.style.position = "absolute";
        circle.style.background = "rgba(255,255,255,0.4)";
        circle.style.borderRadius = "50%";
        circle.style.transform = "scale(0)";
        circle.style.animation = "ripple 0.5s linear";

        btn.appendChild(circle);
        setTimeout(() => circle.remove(), 500);
    });
});

// TOAST
function showToast(){
    const toast = document.getElementById('toastSuccess');
    toast.classList.add('toast-show');

    setTimeout(()=>{
        toast.classList.remove('toast-show');
    },3000);
}

@if(session('success'))
    showToast();
@endif

// KEYFRAME RIPPLE
const style = document.createElement('style');
style.innerHTML = `
@keyframes ripple {
    to {
        transform: scale(4);
        opacity: 0;
    }
}`;
document.head.appendChild(style);

</script>

@endsection