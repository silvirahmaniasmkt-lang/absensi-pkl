@extends('layouts.app')

@section('title','Data Absensi')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold">📋 Data Absensi</h2>
    <p class="text-muted">✅ Kelola informasi kehadiran siswa secara cepat, tepat, dan praktis.</p>
</div>

<div class="card-soft">

    <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
        <h5 class="mb-0">Daftar Absensi</h5>
        <span class="badge bg-primary">Total: {{ count($data) }}</span>
    </div>

    <div class="p-3">

    {{-- 🔍 FILTER --}}
    <form method="GET" action="/admin/absensi" class="row g-2 mb-3">

        <div class="col-md-3">
            <input type="text" name="nama" value="{{ request('nama') }}"
                class="form-control" placeholder="Cari nama...">
        </div>

        <div class="col-md-2">
            <input type="date" name="from" value="{{ request('from') }}"
                class="form-control">
        </div>

        <div class="col-md-2">
            <input type="date" name="to" value="{{ request('to') }}"
                class="form-control">
        </div>

        <div class="col-md-2">
            <select name="status" class="form-control">
                <option value="">-- Status --</option>
                <option value="hadir" {{ request('status')=='hadir' ? 'selected' : '' }}>Hadir</option>
                <option value="izin" {{ request('status')=='izin' ? 'selected' : '' }}>Izin</option>
                <option value="sakit" {{ request('status')=='sakit' ? 'selected' : '' }}>Sakit</option>
            </select>
        </div>

        <div class="col-md-3">
            <button class="btn btn-primary">Filter</button>
            <a href="/admin/absensi" class="btn btn-secondary">Reset</a>
        </div>

    </form>

    {{-- NOTIF --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- TABLE --}}
    <div class="table-responsive">
    <table class="table table-hover align-middle">

        <thead>
        <tr>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Masuk</th>
            <th>Pulang</th>
            <th>Status</th>
            <th>Aksi</th>
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

                @else
                <span class="badge bg-secondary">Sakit</span>
                @endif
            </td>

            <td>
                <form action="/admin/absensi/{{ $d->id }}" method="POST"
                    onsubmit="return confirm('Yakin mau hapus data ini? Data tidak bisa dikembalikan!')">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm">
                        🗑 Hapus
                    </button>

                </form>
            </td>

        </tr>

        @empty
        <tr>
            <td colspan="6" class="text-center text-muted">
                Data tidak ditemukan
            </td>
        </tr>
        @endforelse

        </tbody>

    </table>
    </div>

</div>

@endsection