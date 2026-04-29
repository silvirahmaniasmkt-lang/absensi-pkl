@extends('layouts.app')

@section('title','Absen Masuk')

@section('content')

<div class="d-flex justify-content-center mt-4">
    <div class="card-soft p-4 shadow" style="width:100%; max-width:500px; border-radius:15px;">

        <h4 class="mb-3 text-center">📥 Absen Masuk</h4>

        <div class="alert alert-info">
            ⏰ Jam masuk maksimal: <b>08:00</b><br>
            ⚠️ Lewat dari itu akan dianggap <b>Terlambat</b>
        </div>

        <form method="POST" action="/absen/masuk">
            @csrf

            <div class="mb-3">
                <label>📅 Tanggal</label>
                <input type="text" class="form-control" id="tanggal" readonly>
            </div>

            <div class="mb-3">
                <label>⏰ Jam Masuk</label>
                <input type="text" class="form-control" id="jam" readonly>
            </div>

            <div class="mb-3">
                <label>📊 Status</label>
                <select name="status" class="form-control" required>
                    <option value="hadir">Hadir</option>
                    <option value="izin">Izin</option>
                    <option value="sakit">Sakit</option>
                </select>
            </div>

            <div class="mb-3">
                <label>📝 Keterangan ( Opsional )</label>
                <textarea name="keterangan" class="form-control"></textarea>
            </div>

            <button id="btnMasuk" type="submit" class="btn btn-primary w-100 btn-ripple">
                ✅ Konfirmasi Absen Masuk
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

// FORM MASUK
const formMasuk = document.querySelector('form[action="/absen/masuk"]');
const btnMasuk = document.getElementById('btnMasuk');

if(formMasuk){
    formMasuk.addEventListener('submit', function(){
        btnMasuk.disabled = true;
        btnMasuk.innerHTML = `
            <span class="spinner-border spinner-border-sm me-2"></span>
            Menyimpan...
        `;
    });
}

const btn = document.getElementById('btnMasuk');
const form = document.querySelector('form[action="/absen/masuk"]');

if(btn){

    // RIPPLE EFFECT POSISI KLIK
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

    // SUBMIT EFFECT
    form.addEventListener('submit', function(){
        btn.disabled = true;
        btn.innerHTML = `
            <span class="spinner-border spinner-border-sm me-2"></span>
            Menyimpan...
        `;

        // simulasi sukses (kalau mau real, nanti pakai response Laravel)
        setTimeout(() => {
            btn.classList.add('btn-success-state');
            btn.innerHTML = `✔️ Berhasil`;
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