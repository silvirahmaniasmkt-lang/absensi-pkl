@extends('layouts.app')

@section('title','Rekap')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold">📊 Rekap Absensi</h2>
    <p class="text-muted">📈 Kelola laporan rekap absensi siswa dengan mudah dan efisien.</p>
</div>

<div class="card-soft p-3">

    <form method="GET" action="/admin/rekap" class="row g-2 mb-3">

        <div class="col-md-3">
            <input type="date" name="from" value="{{ request('from') }}" class="form-control">
        </div>

        <div class="col-md-3">
            <input type="date" name="to" value="{{ request('to') }}" class="form-control">
        </div>

        <div class="col-md-3">
            <select name="status" class="form-control">
                <option value="">-- Semua Status --</option>
                <option value="hadir" {{ request('status')=='hadir' ? 'selected' : '' }}>Hadir</option>
                <option value="izin" {{ request('status')=='izin' ? 'selected' : '' }}>Izin</option>
                <option value="sakit" {{ request('status')=='sakit' ? 'selected' : '' }}>Sakit</option>
            </select>
        </div>

        <div class="col-md-3">
            <button class="btn btn-primary">Filter</button>
            <a href="/admin/rekap" class="btn btn-secondary">Reset</a>
        </div>

    </form>

    <div class="table-responsive">
    <table class="table table-bordered text-center">

        <thead class="table-light">
            <tr>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Jumlah</th>
            </tr>
        </thead>

        <tbody>

        @php $totalAll = 0; @endphp

        @forelse($data as $d)
        @php $totalAll += $d->total; @endphp

        <tr>
            <td>{{ $d->tanggal }}</td>

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

            <td>{{ $d->total }}</td>
        </tr>

        @empty
        <tr>
            <td colspan="3" class="text-muted">Tidak ada data</td>
        </tr>
        @endforelse

        </tbody>

        <tfoot>
        <tr>
            <th colspan="2">Total</th>
            <th>{{ $totalAll }}</th>
        </tr>
        </tfoot>

    </table>
    </div>

</div>

@endsection