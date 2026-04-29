@extends('layouts.app')

@section('title','Absen Pulang')

@section('content')

<div class="d-flex justify-content-center mt-4">
    <div class="card-soft p-4 shadow" style="width:100%; max-width:500px; border-radius:15px;">

        <h4 class="mb-3 text-center">📤 Absen Pulang</h4>

        <div class="alert alert-warning text-center">
            ⚠️ Pastikan semua pekerjaan sudah selesai sebelum absen pulang
        </div>

        <form method="POST" action="/absen/pulang">
        @csrf

        <!-- TANGGAL -->
        <div class="mb-3">
            <label>📅 Tanggal</label>
            <input type="text" class="form-control" id="tanggal" readonly>
        </div>

        <!-- JAM -->
        <div class="mb-3">
            <label>🕒 Jam Pulang</label>
            <input type="text" class="form-control" id="jam" readonly>
        </div>

        <!-- KETERANGAN -->
        <div class="mb-3">
            <label>📝 Keterangan Pulang</label>
            <textarea name="keterangan_pulang" class="form-control" placeholder="Contoh: selesai tugas"></textarea>
        </div>

        <!-- BUTTON -->
        <button id="btnPulang" type="submit" class="btn btn-danger w-100 btn-ripple">
            🚀 Selesaikan Absen Pulang
        </button>

        </form>

    </div>
</div>

<script>
// tanggal otomatis
document.getElementById('tanggal').value =
new Date().toLocaleDateString('id-ID');

// jam realtime
setInterval(()=>{
document.getElementById('jam').value =
new Date().toLocaleTimeString('id-ID');
},1000);

// ambil element
const formPulang = document.querySelector('form[action="/absen/pulang"]');
const btnPulang = document.getElementById('btnPulang');

// 🔥 RIPPLE EFFECT
if(btnPulang){
    btnPulang.addEventListener('click', function(e){
        const circle = document.createElement("span");
        const diameter = Math.max(btnPulang.clientWidth, btnPulang.clientHeight);
        const radius = diameter / 2;

        circle.style.width = circle.style.height = `${diameter}px`;
        circle.style.left = `${e.clientX - btnPulang.getBoundingClientRect().left - radius}px`;
        circle.style.top = `${e.clientY - btnPulang.getBoundingClientRect().top - radius}px`;
        circle.style.position = "absolute";
        circle.style.background = "rgba(255,255,255,0.4)";
        circle.style.borderRadius = "50%";
        circle.style.transform = "scale(0)";
        circle.style.animation = "ripple 0.5s linear";

        btnPulang.appendChild(circle);

        setTimeout(() => circle.remove(), 500);
    });
}

// 🔥 SUBMIT EFFECT
if(formPulang){
    formPulang.addEventListener('submit', function(){
        btnPulang.disabled = true;
        btnPulang.innerHTML = `
            <span class="spinner-border spinner-border-sm me-2"></span>
            Menyimpan...
        `;

        // simulasi sukses
        setTimeout(() => {
            btnPulang.classList.add('btn-success-state');
            btnPulang.innerHTML = `✔️ Berhasil`;
        }, 1500);
    });
}

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