@extends('layouts.master')

@section('content')
<!-- Contact us form -->
<div class="row mb-4">
    <div class="col-12 col-md-6 col-lg-4 mx-auto">
        <h3 class="mb-2 text-center text-color-theme">Terhubung dengan Tunas Toyota Cimindi</h3>
        <p class="text-muted mb-4 text-center">Get in touch with us, We give you exact and right
            information to you!</p>
    </div>
</div>

<!-- Contact us blocks -->
<div class="row">
    <div class="col-6 col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-body text-center">
                <i class="avatar avatar-60 bi bi-telephone-fill fs-4 bg-theme-light text-color-theme rounded-circle mb-4"></i>
                <h6 class="mb-2">Hotline</h6>
                <p class="text-muted small">022-6613838</p>
                <a href="tel:0226613838" class="btn btn-sm btn-default"><i class="bi bi-telephone"></i> Call Me</a>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-body text-center">
                <i class="avatar avatar-60 bi bi-telephone-fill fs-4 bg-theme-light text-color-theme rounded-circle mb-4"></i>
                <h6 class="mb-2">Sales / Service</h6>
                <p class="text-muted small">0815-9888-627 / 0815-8788-627</p>
                <a href="tel:08159888627" class="btn btn-sm btn-default"><i class="bi bi-telephone"></i> Call Me</a>
                <a href="tel:08158788627" class="btn btn-sm btn-default"><i class="bi bi-telephone"></i> Call Me</a>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-body text-center">
                <i class="avatar avatar-60 bi bi-whatsapp fs-4 bg-theme-light text-color-theme rounded-circle mb-4"></i>
                <h6 class="mb-2">Booking Service</h6>
                <p class="text-muted small">08113-4100-0276</p>
                <a target="_blank" href="https://api.whatsapp.com/send?phone=6281341000276&text=Halo%20Tunas%20Toyota%20Cimindi%20saya%20ingin%20booking%20service" class="btn btn-sm btn-default"><i class="bi bi-whatsapp mx-1"></i>Chat me 1</a><br><br>
                </div>
        </div>
    </div>
</div>

<!-- Address -->
<div class="row mb-3">
    <div class="col">
        <h6 class="my-1">Our Location: </h6>
    </div>
    <div class="col-auto px-0">

    </div>
</div>

<div class="row justify-content-center">
    <div class="col-12 col-md-6  mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <iframe src="https://maps.google.com/maps?q=Tunas%20Toyota%20Cimindi&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    class="h-190 w-100 rounded mb-3" allowfullscreen="" loading="lazy"></iframe>

                <h5 class="text-color-theme mb-2">Tunas Toyota Cimindi</h5>
                <p class="text-muted">Jl. Raya Cimindi No.276<br>ukaraja, Kec. Cicendo, Kota Bandung, Jawa Barat 40175</p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('js')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
@endsection


