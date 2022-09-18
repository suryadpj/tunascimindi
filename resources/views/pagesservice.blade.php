@extends('layouts.master')

@section('content')
<div class="card shadow-sm mb-4">
    <div class="card-body text-center ">
        <p><b>Halaman Service</b></p>
    </div>
    <ul class="list-group list-group-flush bg-none">
        <li class="list-group-item"><a href="reservasi" class="text-normal d-block">Reservasi<i class="float-end bi bi-arrow-right"></i></a></li>
        <li class="list-group-item"><a href="history" class="text-normal d-block">History<i class="float-end bi bi-arrow-right"></i></a></li>
        <li class="list-group-item"><a href="aksesoris" class="text-normal d-block">Aksesoris<i class="float-end bi bi-arrow-right"></i></a></li>
        <li class="list-group-item"><a href="promo" class="text-normal d-block">Promo<i class="float-end bi bi-arrow-right"></i></a></li>
    </ul>
</div>

<div class="clearfix"></div>
@endsection

