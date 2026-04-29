@extends('layouts.app')

@section('title','Riwayat')

@section('content')

<div class="card p-3 shadow">

<table class="table">
<tr>
<th>Tanggal</th>
<th>Status</th>
<th>Masuk</th>
<th>Pulang</th>
</tr>

@foreach($data as $d)
<tr>
<td>{{ $d->tanggal }}</td>
<td>
<span class="badge 
{{ 
$d->status=='hadir' ? 'bg-success' : 
($d->status=='terlambat' ? 'bg-danger' : 
($d->status=='izin' ? 'bg-warning text-dark' : 
($d->status=='sakit' ? 'bg-secondary' : 'bg-dark'))) 
}}">
{{ ucfirst($d->status) }}
</span>
</td>
<td>{{ $d->jam_masuk }}</td>
<td>{{ $d->jam_pulang }}</td>
</tr>
@endforeach

</table>

</div>

@endsection