@extends('layouts.master')

@section('content')
    @php
        $jam = date('H:i');
        if ($jam >= '05:00' && $jam < '10:00')
        {
            $salam = 'Pagi';
        } elseif ($jam >= '10:00' && $jam < '15:00')
        {
            $salam = 'Siang';
        } elseif ($jam >= '15:00' && $jam < '18:00')
        {
            $salam = 'Sore';
        } else {
        $salam = 'Malam';
        }
    @endphp
    <!-- welcome user -->
    <div class="row mb-4">
        <div class="col-auto">
            <div class="avatar avatar-50 shadow rounded-10">
                @if (Auth::user()->fotoprofilpath)
                    <img src="../{{ Auth::user()->fotoprofilpath }}" alt="">
                @else
                    <img src="assets_loginv2/img/logo_tunas.png" alt="">
                @endif
            </div>
        </div>
        <div class="col align-self-center ps-0">
            <h4 class="text-color-theme"><span class="fw-normal">Selamat {{ $salam }} </span>,</h4>
            <span class="text-color-theme">{{ auth::user()->name }} {{ $profil->unit }} - {{ $profil->no_polisi }}</span>
            @if($profil->masa_berlaku_stnk != "0000-00-00")<p class="text-muted">Masa berlaku Pajak STNK hingga tanggal {{ $profil->berlakustnk }} </p>@endif
        </div>
    </div>

    <!-- Dark mode switch -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="darkmodeswitch">
                        <label class="form-check-label text-muted px-2 " for="darkmodeswitch">Activate Dark
                            Mode</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- swiper credit cards -->
    <div class="row mb-3">
        <div class="col">
            <h6 class="title">Informasi</h6>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            <div class="swiper-container cardswiper">
                <div class="swiper-wrapper">
                    @if($profil->terlibat_ssc != "")
                        <div class="swiper-slide">
                            <div class="card bg-danger bg-gradient">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-auto align-self-center">
                                            <h2>Perhatian :</h2>
                                        </div>
                                        <div class="col align-self-center text-end">
                                            <h2>Segera</h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h2 class="fw-normal mb-2">
                                                Terlibat SSC {{ $profil->terlibat_ssc }}
                                            </h2>
                                            <h2>Batas perbaikan : {{ $profil->pengerjaanssc }}</h2>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col align-self-center text-end daftarssc">
                                            <p class="small">
                                                <button class="btn btn-success">Book Now</button>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($nextserv)
                        <div class="swiper-slide">
                            <div class="card theme-bg bg-gradient">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-auto align-self-center">
                                            <h2>Next Service :</h2>
                                        </div>
                                        <div class="col align-self-center text-end">
                                            <h2></h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h2 class="fw-normal mb-2">
                                                Service Berkala {{ number_format($nextserv->km,0) }} KM
                                            </h2>
                                            @php
                                                $date = date_create($lastservice->pkb_date);
                                                date_add($date, date_interval_create_from_date_string('+6 months'));
                                                $datea= date_format($date, 'd F Y');
                                            @endphp
                                            <p class="mb-0 text-muted size-7">Job : {{ $nextserv->job }}</p>
                                            <p class="mb-0 text-muted size-7">Service sebelum : {{ $datea }}</p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-auto align-self-center">
                                            @if ($profil->gbsb == 1)
                                                <h4>GBSB</h4>
                                            @elseif ($profil->tcare == 1)
                                                <h4>T-Care</h4>
                                            @else

                                            @endif
                                        </div>
                                        <div class="col align-self-center text-end">
                                            <p class="small">
                                                @if($nextserv->segmen == 3)
                                                    <a href="#" class="booked btn btn-success" disabled>Booked</a>
                                                @else
                                                    <a href="#" class="booknow btn btn-success">Book Now</a>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- menu -->
    <div class="row mb-3">
        <div class="col">
            <h6 class="title">Menu</h6>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 px-0">
            <!-- swiper users connections -->
            <div class="swiper-container connectionwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="history" class="card text-center">
                            <div class="card-body">
                                <div class="avatar avatar-50 shadow-sm mb-2 rounded-10 theme-bg text-white">
                                    <i class="bi bi bi-clock-history"></i>
                                </div>
                                <p class="text-color-theme size-12 small">Service</p>
                            </div>
                        </a>
                    </div>

                    <div class="swiper-slide">
                        <a href="ecatalog" class="card text-center">
                            <div class="card-body">
                                <div class="avatar avatar-50 shadow-sm mb-2 rounded-10 btn-danger text-white">
                                    <i class="bi bi-card-list"></i>
                                </div>
                                <p class="text-color-theme size-12 small">New Car Sales</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="tradein" class="card text-center">
                            <div class="card-body">
                                <div class="avatar avatar-50 shadow-sm mb-2 rounded-10 btn-success text-white">
                                    <i class="bi bi-journal-code"></i>
                                </div>
                                <p class="text-color-theme size-12 small">Trade-in</p>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="media_edukasi" class="card text-center">
                            <div class="card-body">
                                <div class="avatar avatar-50 shadow-sm mb-2 rounded-10 btn-warning text-white">
                                    <i class="bi bi-collection-play-fill"></i>
                                </div>
                                <p class="text-color-theme size-12 small">Media Edukasi</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- swiper credit cards -->
    {{-- <div class="row mb-3">
        <div class="col">
            <h6 class="title">Servis Berkala</h6>
        </div>
    </div> --}}
    <div class="row mb-3">
        <div class="col-12">
            <div class="slider">
                @php
                    $i = 0;
                    $i2 = 0;
                    $i3 = 0;
                    $c = 0;
                    $c2 = 0;
                    $c3 = 0;
                @endphp
                @foreach ($sb as $a)
                    @php
                        $i = $i+1;
                    @endphp
                    <div>
                        <a class="popup" id="../{{ $a->img_src }}">
                           <img src="../{{ $a->img_src }}" class="d-block w-100" alt="...">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="">
        <h2 class="color-blue" align="center"><b>MENGAPA TUNAS TOYOTA ?</b></h2>
    </div>
    <div class="row py-3 mb-5">
        <div class="col-md-1 col-12 py-1">
            <div class="card form-style p-3 h-100 bg-white">
                <img class="align-self-center img-fluid" src="https://tunastoyotacimindi.com/assets/img/Group 15@2x.png" alt="" >
                <br>
                <center>
                <h4><b>GRATIS CEK HARGA AWAL</b></h4>
                <p>Masukan data mobil dan dapatkan perkiraan harga terjangkau.</p>
                </center>
            </div>
        </div>
        <div class="col-md-4 col-12 py-3">
        <div class="card form-style p-3 h-100 bg-white">
                <img class="align-self-center img-fluid" src="https://tunastoyotacimindi.com/assets/img/Group 6@2x.png" alt="" >
                <br>
                <center>
                <h4><b>PEMBAYARAN INSTAN</b></h4>
                <p>Setelah deal dengan Harga penawaran, pembayaran langsung ditransfer.</p>
                </center>
            </div>
        </div>
        <div class="col-md-4 col-12 py-3">
        <div class="card form-style p-3 h-100 bg-white">
                <img class="align-self-center img-fluid" src="https://tunastoyotacimindi.com/assets/img/undraw_by_my_car_ttge@2x.png" alt="" >
                <br>
                <center>
                <h4><b>GRATIS INSPEKSI</b></h4>
                <p>Book Jadwal inspeksi di lokasi kami atau pilih home inspection.</p>
                </center>
            </div>
        </div>
    </div>
{{--
    <!-- swiper credit cards -->
    <div class="row mb-3">
        <div class="col">
            <h6 class="title">General Repair</h6>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <div class="slider">
                @foreach ($gr as $b)
                    @php
                        $i2 = $i2+1;
                    @endphp
                    <div>
                        <a class="popup" id="../{{ $b->img_src }}">
                           <img src="../{{ $b->img_src }}" class="d-block w-100" alt="...">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- swiper credit cards -->
    <div class="row mb-3">
        <div class="col">
            <h6 class="title">Body & Paint</h6>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <div class="slider">
                @foreach ($bp as $c)
                    @php
                        $i3 = $i3+1;
                    @endphp
                    <div>
                        <a class="popup" id="../{{ $c->img_src }}">
                           <img src="../{{ $c->img_src }}" class="d-block w-100" alt="...">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div> --}}

    <!-- modal -->
    <div class="modal fade" id="popupslider" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="popupsliderlabel">Zoom Slider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid" id="sliderimage" style="max-height:250px;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="booknowmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="popupsliderlabel">Book Now</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="formbooknow" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="hidden_id" id="hidden_id" value="{{ $nextserv->ID }}" />
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="perihal" class="col-sm-5 col-form-label">Job :<span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control-plaintext" name="job_bn" id="job_bn" placeholder="Nama" value="{{ number_format($nextserv->km,0) }} KM - {{ $nextserv->job }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="perihal" class="col-sm-5 col-form-label">Tanggal :<span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="date" class="form-control" name="tanggal_bn" id="tanggal_bn">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="perihal" class="col-sm-5 col-form-label">Time :<span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="time" class="form-control" name="time_bn" id="time_bn">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="perihal" class="col-sm-5 col-form-label">Catatan :</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="keterangan_bn" id="keterangan_bn" placeholder="Catatan tambahan">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <input type="hidden" name="action" id="action" />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="action_button" value="Add" id="action_button" class="btn btn-primary">Kirim data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')

<div class="bg-red">
    <div class="container">
        <center>
            <h2 class="text-white py-3 mb-0">IKUTI KAMI</h2>
            <div class="py-1">
                <a href="#"><img class="img-fluid mx-3" src="https://tunastoyotacimindi.com/assets/img/instagram.png" alt="instagram.png" width="35"></a>
                <a href="#"><img class="img-fluid mx-3" src="https://tunastoyotacimindi.com/assets/img/twitter-sign.png" alt="twitter.png" width="35"></a>
            </div>
            <div class="py-1"><div class="hr-white"></div></div>
            <h4 class="text-white mb-0 py-3">
                <img class="img-fluid mx-3" src="https://tunastoyotacimindi.com/assets/img/ic_copyright_24px@2x.png" alt="copyright.png" width="25">
                Copyright 2022
            </h4>
        </center>
    </div>
  </div>
@endsection

@section('js')
<script src="{{ asset('/sw.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript" src="http://afarkas.github.io/lazysizes/lazysizes.min.js"></script>
<script>
$(document).ready(function(){
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
    $('.comingsoon').click(function(){
        Swal.fire(
            'Coming Soon',
            'Menu untuk pemesanan makanan akan segera hadir',
            'info'
        )
    })
    $('.slider').slick({
        lazyLoad: 'ondemand',
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight: true,
        autoplay: true,
        autoplaySpeed: 3500,
        dots: true,
        arrows: false,
        pauseOnHover:true
    });
    $('.popup').click(function(){
        var id = $(this).attr('id');
        $('#sliderimage').attr("src",id);
        $('#popupslider').modal('show');
    })
    $('.booknow').click(function(){
        $('#formbooknow')[0].reset();
        $('.referensi-title').text("Book Now Form");
        $('#action_button').val("Add");
        $('#action').val("Add");
        $('#booknowmodal').modal('show');
    });
    $('.booked').click(function(){
        swal.fire({
            icon: 'info',
            title: 'Reservasi anda sudah disimpan',
            text: 'Data reservasi anda sudah disimpan, petugas kami akan menghubungi anda segera. Terima kasih'
        })
    });
    $('#formbooknow').on('submit', function(event){
        event.preventDefault();
        if($('#action').val() == 'Add')
        {

            $.ajax({
                url:"{{ route('home.booknow') }}",
                method:"POST",
                data: new FormData(this),
                contentType: false,
                cache:false,
                processData: false,
                dataType:"json",
                beforeSend:function(){
                    $('#action_button').html('<i disable class="fa fa-spinner fa-spin"></i>').attr('disabled', true);
                },
                success:function(data)
                {
                    var html = '';
                    if(data.errors)
                    {
                        html = '';
                        for(var count = 0; count < data.errors.length; count++)
                        {
                            html += data.errors[count] + ', ';
                        }
                        swal.fire({
                            icon: 'warning',
                            title: 'Data gagal disimpan',
                            text: html
                        })
                        $('#action_button').html('Save changes').attr('disabled', false);
                    }
                    if(data.duplicate)
                    {
                        swal.fire({
                            icon: 'warning',
                            title: 'Data gagal disimpan',
                            text: html
                        })
                        $('#action_button').html('Save changes').attr('disabled', false);
                    }
                    if(data.success)
                    {
                        $('#booknowmodal').modal('hide');
                        $('#formbooknow')[0].reset();
                        $('#action_button').html('Save changes').attr('disabled', false);
                        swal.fire({
                            icon: 'success',
                            title: 'Data berhasil disimpan',
                            text: 'Data referensi anda akan diteruskan petugas kami untuk dihubungi. Terima kasih'
                        })
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    swal.fire({
                        icon: 'error',
                        title: 'Data gagal disimpan',
                        text: errorMessage
                    })
                    $('#action_button').html('Save changes').attr('disabled', false);
                }
            })
        }
    });
});
</script>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
<style>
    .slider .slick-slide {
    border: solid 1px #000;
    }
    .slider .slick-slide img {
        width: 100%;
    }
    .slick-prev, .slick-next {
        width: 50px;
        height: 50px;
        z-index: 1;
    }
    .slick-prev {
    left: 5px;
    }
    .slick-next {
        right: 5px;
    }
    .slick-prev:before,
    .slick-next:before {
        font-size: 40px;
        text-shadow: 0 0 10px rgba(0,0,0,0.5);
    }
    .slick-dots {
    bottom: 15px;
    }
    .slick-dots li button:before {
    font-size: 12px;
    color: #fff;
    text-shadow: 0 0 10px rgba(0,0,0,0.5);
    opacity: 1;
    }
    .slick-dots li.slick-active button:before {
        color: #dedede;
    }
    .slider:not(:hover) .slick-arrow,
    .slider:not(:hover) .slick-dots {
        opacity: 0;
    }
    .slick-arrow,
    .slick-dots {
        transition: opacity 0.5s ease-out;
    }

</style>
@endsection
