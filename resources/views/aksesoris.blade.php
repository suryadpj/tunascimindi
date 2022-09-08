@extends('layouts.master')

@section('content')
    <div class="row mb-3">
        <div class="col">
            <h6 class="title">Aksesoris</h6><br>
            Toyota Customization Option (TCO) merupakan asesoris resmi untuk mendongkrak tampilan mobil anda agar tampil lebih modis khususnya unit Toyota 2021 all model
        </div>
    </div>
    <!-- wallet balance -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <p class="text-muted mb-3">
                <div class="row mb-3">
                    <div class="col-12">
                        <div id="carouselExampleIndicators3" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @php
                                    $c = 0;
                                    $i = 0;
                                @endphp
                                @foreach ($slideraks as $aa)
                                    <button type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="{{ $c }}" @if($c == 0) class="active" aria-current="true" @endif></button>
                                    @php $c = $c+1; @endphp
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @foreach ($slideraks as $a)
                                    @php
                                        $i = $i+1;
                                    @endphp
                                    <div class="carousel-item @if($i == 1) active @endif">
                                        <img src="../{{ $a->img_src }}" class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                          <h5>{{ $a->alt }}</h5>
                                        </div>
                                        {{-- <img src="../{{ $a->img_src }}" class="d-block w-100" alt="..." style="width:100% !important;height:200px !important;"> --}}
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators3" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators3" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 px-0">
            <!-- swiper users connections -->
            <div class="swiper-container connectionwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                        <a class="card text-center">
                            <div class="card-body">
                                <div class="avatar avatar-50 shadow-sm mb-2 rounded-10 theme-bg text-white">
                                    <i class="bi bi bi-clock-history"></i>
                                </div>
                                <p class="text-color-theme size-12 small">GPS Tracker</p>
                            </div>
                        </a>
                    </div>

                    <div class="swiper-slide" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                        <a class="card text-center">
                            <div class="card-body">
                                <div class="avatar avatar-50 shadow-sm mb-2 rounded-10 theme-bg text-white">
                                    <i class="bi bi-card-list"></i>
                                </div>
                                <p class="text-color-theme size-12 small">50th Anniversary</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide" data-bs-toggle="modal" data-bs-target="#staticBackdrop3">
                        <a class="card text-center">
                            <div class="card-body">
                                <div class="avatar avatar-50 shadow-sm mb-2 rounded-10 theme-bg text-white">
                                    <i class="bi bi-tools"></i>
                                </div>
                                <p class="text-color-theme size-12 small">TCO All model</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- modal-->
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">GPS Tracker</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="carouselExampleIndicators1" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="../resources/assets_loginv2/img/news4.jpg" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                  <h5>First slide label</h5>
                                  <p>Some representative placeholder content for the first slide.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="../resources/assets_loginv2/img/news5.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="../resources/assets_loginv2/img/news3.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <p align="center">
                        Model : Sienta, Innova, Avanza, Rush, Agya
                    </p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Download</button>
                <button type="button" class="btn btn-primary">Buy</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">50 Anniversary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="carouselExampleIndicators1" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="../resources/assets_loginv2/img/news4.jpg" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                  <h5>First slide label</h5>
                                  <p>Some representative placeholder content for the first slide.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="../resources/assets_loginv2/img/news5.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="../resources/assets_loginv2/img/news3.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators1" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Download</button>
                <button type="button" class="btn btn-primary">Buy</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">TCO All Model</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="swiper-container connectionwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" data-bs-toggle="modal">
                                <a class="card text-center" href="../storage/app/public/files/dokumen/aksesoris/FA_REVISI_TCO_Flyer_CALYA_A4_RH (2) (1).pdf" target="_blank">
                                    <div class="card-body">
                                        <div class="avatar avatar-50 shadow-sm mb-2 rounded-50 theme-bg text-white">
                                            Calya
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide" data-bs-toggle="modal">
                                <a class="card text-center" href="../storage/app/public/files/dokumen/aksesoris/preview_R12_TCO_Flyer_A4_BMPV-V (1).pdf" target="_blank">
                                    <div class="card-body">
                                        <div class="avatar avatar-50 shadow-sm mb-2 rounded-50 theme-bg text-white">
                                            Veloz
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a class="card text-center" href="../storage/app/public/files/dokumen/aksesoris/CS AVANZA TCO3f OK (1).pdf" target="_blank">
                                    <div class="card-body">
                                        <div class="avatar avatar-50 shadow-sm mb-2 rounded-50 theme-bg text-white">
                                            Avanza
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Buy</button>
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
<script>
    $(document).ready( function () {
        var oTable = $('#myTable').DataTable({
            responsive: true,
            dom: '<"html5buttons">Brtlip',
        });

    } );
</script>
@endsection


