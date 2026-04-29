@extends('layouts.app')

@section('title','Data Siswa')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold">👨‍🎓 Data Siswa</h2>
    <p class="text-muted">🗂️ Rekap data siswa tersusun rapi dan mudah dikelola.</p>
</div>

<div class="card-soft p-3">

    {{-- 🔍 SEARCH --}}
    <form method="GET" action="/admin/siswa" class="mb-3 d-flex gap-2">
        <input type="text" name="search" 
            value="{{ $search ?? '' }}"
            placeholder="Cari nama / email..."
            class="form-control w-25">

        <button class="btn btn-primary">Cari</button>
    </form>

    {{-- ✅ NOTIF --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-hover align-middle">

        <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
        </thead>

        <tbody>

        @foreach($data as $i => $d)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $d->name }}</td>
            <td>{{ $d->email }}</td>
            <td>
                <span class="badge bg-primary">
                    {{ ucfirst($d->role) }}
                </span>
            </td>

            {{-- 🗑️ HAPUS --}}
            <td>
                <form action="/admin/siswa/{{ $d->id }}" method="POST"
                    onsubmit="return confirm('Hapus siswa ini?')">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm">
                        🗑️ Hapus
                    </button>

                </form>
            </td>

        </tr>
        @endforeach

        </tbody>

    </table>

</div>

@endsection