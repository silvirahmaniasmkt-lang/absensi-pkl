@extends('layouts.app')

@section('title','Rekap')

@section('content')

<div class="row">

<div class="col-md-4">
<div class="card p-3 text-center shadow">
<h6>Hadir</h6>
<h3>{{ $hadir }}</h3>
</div>
</div>

<div class="col-md-4">
<div class="card p-3 text-center shadow">
<h6>Izin</h6>
<h3>{{ $izin }}</h3>
</div>
</div>

<div class="col-md-4">
<div class="card p-3 text-center shadow">
<h6>Sakit</h6>
<h3>{{ $sakit }}</h3>
</div>
</div>

</div>

@endsection