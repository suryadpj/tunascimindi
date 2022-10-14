<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Tunas Toyota Cimindi</title>

    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('logo_tunas.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="manifest" href="{{ asset('/manifest.json') }}" />

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="assets/img/logo_tunas.png" sizes="180x180">
    <link rel="icon" href="assets/img/logo_tunas.png" sizes="32x32" type="image/png">
    <link rel="icon" href="assets/img/logo_tunas.png" sizes="16x16" type="image/png">

    <!-- Google fonts-->

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&amp;display=swap" rel="stylesheet">

    <!-- bootstrap icons -->
    <!-- <link rel="stylesheet" href="../../../../cdn.jsdelivr.net/npm/bootstrap-icons%401.5.0/font/bootstrap-icons.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- swiper carousel css -->
    <link rel="stylesheet" href="assets_loginv2/vendor/swiperjs-6.6.2/swiper-bundle.min.css">

    <!-- style css for this template -->
    <link href="assets_loginv2/css/style.css" rel="stylesheet" id="style">
    @yield('css')
</head>

<body class="body-scroll" data-page="index">

    {{-- <!-- loader section -->
    <div class="container-fluid loader-wrap">
        <div class="row h-100">
            <div class="text-center align-self-center">
                <div class="loader-cube-wrap loader-cube-animate mx-auto">
                    <img src="assets/img/logo-toyota-jakarta-new-putih.png" alt="Logo">
                </div>
                <p class="mt-4">Melacak kondisi mobilmu di Tunas Toyota Cimindi<br><strong>Please wait...</strong></p>
            </div>
        </div>
    </div>
    <!-- loader section ends --> --}}

    <!-- Sidebar main menu -->
    <div class="sidebar-wrap  sidebar-pushcontent">
        <!-- Add overlay or fullmenu instead overlay -->
        <div class="closemenu text-muted">Close Menu</div>
        <div class="sidebar dark-bg">
            <!-- user information -->
            <div class="row my-3">
                <div class="col-12 ">
                    <div class="card shadow-sm bg-opac text-white border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <figure class="avatar avatar-44 rounded-15">
                                        @if (Auth::user()->fotoprofilpath)
                                            <img src="../{{ Auth::user()->fotoprofilpath }}" alt="">
                                        @else
                                            <img src="assets_loginv2/img/logo_tunas.png" alt="">
                                        @endif
                                    </figure>
                                </div>
                                <div class="col px-0 align-self-center">
                                    <p class="mb-1">{{ Auth::user()->name }}</p>
                                    <p class="text-muted size-12">{{ Auth::user()->city }}</p>
                                </div>
                                <div class="col-auto">
                                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-44 btn-light">
                                        <i class="bi bi-box-arrow-right"></i>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-white border-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-auto">
                                        @switch($profil->membership)
                                            @case(1)
                                                <p>
                                                    <figure class="avatar avatar-30 coverimg rounded-20">
                                                        <img  src="assets/img/platinum.png">
                                                    </figure>
                                                    <a class="text-dark" href="card" > Platinum Member</a>
                                                </p>
                                            @break
                                            @case(2)
                                                <p>
                                                    <figure class="avatar avatar-30 coverimg rounded-20">
                                                        <img  src="assets/img/gold.png">
                                                    </figure>
                                                    <a class="text-dark" href="card" > Gold Member</a>
                                                </p>
                                            @break
                                            @case(3)
                                                <p>
                                                    <figure class="avatar avatar-30 coverimg rounded-20">
                                                        <img  src="assets/img/silver.png">
                                                    </figure>
                                                    <a class="text-dark" href="card" > Silver Member</a>
                                                </p>
                                            @break
                                            @case(4)
                                                <p>
                                                    <figure class="avatar avatar-30 coverimg rounded-20">
                                                        <img  src="assets/img/bronze.png">
                                                    </figure>
                                                    <a class="text-dark" href="card" > Bronze Member</a>
                                                </p>
                                            @break
                                            @case(5)
                                                <p>
                                                    <figure class="avatar avatar-44">
                                                        <img  src="assets/img/new-member.png">
                                                    </figure>
                                                    <a class="text-dark" href="card" > NEW MEMBER</a>
                                                </p>
                                            @break
                                            @default
                                                <p>
                                                    <figure class="avatar avatar-44">
                                                        <img  src="assets/img/new-member.png">
                                                    </figure>
                                                    <a class="text-dark" href="card" > Member</a>
                                                </p>
                                        @endswitch
                                    </div>
                                    <div class="col-12">
                                        <h3 class="">{{ $profil->unit }}</h3>
                                    </div>
                                    <div class="col-12">
                                        <p>{{ $profil->no_polisi }}</p>
                                    </div>
                                    @if($lastservicecount > 0)
                                    <div class="col-auto">
                                        <p>KM {{ $lastservice->kilometer }}</p>
                                    </div>
                                    @endif
                                    @if($lastservicecount > 0)
                                    <div class="col-12">
                                        <p>LAST SERVICE: {{ $lastservice->operation_desc }}</p>
                                    </div>
                                    @endif
                                    @if($cr7count > 0)
                                    <div class="col-auto">
                                        <p>#SARAN PERBAIKAN : {{ $cr7data->keterangan }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- user emnu navigation -->
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-pills">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                                aria-expanded="false">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-tools"></i></div>
                                <div class="col">Service</div>
                                <div class="arrow"><i class="bi bi-plus plus"></i> <i class="bi bi-dash minus"></i>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item nav-link {{{ (Request::is('reservasi') ? 'active' : '') }}} " href="reservasi">
                                        <div class="avatar avatar-40 rounded icon"><i class="bi bi-play-fill"></i></div>
                                        <div class="col">Reservation</div>
                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                                    </a></li>
                                <li><a class="dropdown-item nav-link {{{ (Request::is('history') ? 'active' : '') }}} " href="history">
                                        <div class="avatar avatar-40 rounded icon"><i class="bi bi-play-fill"></i>
                                        </div>
                                        <div class="col">History</div>
                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                                    </a></li>
                                <li><a class="dropdown-item nav-link {{{ (Request::is('aksesoris') ? 'active' : '') }}} " href="aksesoris">
                                            <div class="avatar avatar-40 rounded icon"><i class="bi bi-play-fill"></i>
                                            </div>
                                            <div class="col">Accessories</div>
                                            <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                                        </a></li>
                                <li><a class="dropdown-item nav-link {{{ (Request::is('promo') ? 'active' : '') }}} " href="promo">
                                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-play-fill"></i>
                                                </div>
                                                <div class="col">Promo</div>
                                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                                            </a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                                aria-expanded="false">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-car-front"></i></div>
                                <div class="col">New Car Sales</div>
                                <div class="arrow"><i class="bi bi-plus plus"></i> <i class="bi bi-dash minus"></i>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link dropdown-item {{{ (Request::is('ecatalog') ? 'active' : '') }}} " href="ecatalog" role="button">
                                        <div class="avatar avatar-40 rounded icon"><i class="bi bi-play-fill"></i></div>
                                        <div class="col">E-Catalog</div>
                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                                    </a></li>
                                <li><a class="dropdown-item nav-link {{{ (Request::is('promosales') ? 'active' : '') }}} " href="promosales">
                                        <div class="avatar avatar-40 rounded icon"><i class="bi bi-play-fill"></i>
                                        </div>
                                        <div class="col">Promo</div>
                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                                    </a></li>
                                <li><a class="dropdown-item nav-link {{{ (Request::is('pagesalesconsultation') ? 'active' : '') }}} " href="pagesalesconsultation">
                                        <div class="avatar avatar-40 rounded icon"><i class="bi bi-play-fill"></i>
                                        </div>
                                        <div class="col">Sales Consultation</div>
                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                                    </a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{{ (Request::is('tradein') ? 'active' : '') }}} " href="tradein" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-journal-code"></i></div>
                                <div class="col">Trade-in</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{{ (Request::is('media_edukasi') ? 'active' : '') }}} " href="media_edukasi" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-collection-play-fill"></i></div>
                                <div class="col">Media Edukasi</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Sidebar main menu ends -->

    <!-- Begin page -->
    <main class="h-100">

        <!-- Header -->
        <header class="header position-fixed">
            <div class="row">
                <div class="col-auto">
                    <a href="javascript:void(0)" target="_self" class="btn btn-light btn-44 menu-btn">
                        <i class="bi bi-list"></i>
                    </a>
                    <img src="assets/img/gobeyondkecillgrev2.png" style="position: sticky;" class="responsive hide-low-md" alt="">
                </div>
                {{-- <div class="col align-self-center text-center">
                    <div class="logo-small">
                        <img src="assets/img/logo_tunas.png" alt="">
                        <h5>TTC - Mobile</h5>
                    </div>
                </div> --}}
                <div class="col align-self-center text-end">
                    <img src="assets/img/logo-cimindi-kecil-rev2.png" class="responsive" alt="">
                    {{-- <a href="card" target="_self" class="btn btn-light btn-44">
                        <i class="bi bi-credit-card-fill"></i>
                        {{-- <span class="count-indicator"></span>
                    </a> --}}
                </div>
            </div>
        </header>
        <!-- Header ends -->

        <!-- main page content -->
        <div class="main-container container">
            @yield('content')
        </div>
        <!-- main page content ends -->

        @yield('footer')
    </main>
    <!-- Page ends-->

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <ul class="nav nav-pills nav-justified">
                <li class="nav-item">
                    <a class="nav-link {{{ (Request::is('home') ? 'active' : '') }}}" href="home">
                        <span>
                            <i class="nav-icon bi bi-house"></i>
                            <span class="nav-text">Home</span>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{{ (Request::is('reservasi') ? 'active' : '') }}} " href="reservasi">
                        <span>
                            <i class="bi bi-chat-left-text"></i>
                            <span class="nav-text">Reservasi</span>
                        </span>
                    </a>
                </li>
                <li class="nav-item centerbutton">
                    <a class="nav-link {{{ (Request::is('hubungikami') ? 'active' : '') }}} " href="hubungikami">
                        <span class="theme-radial-gradient">
                            <i class="close bi bi-x"></i>
                            <i class="bi bi-telephone"></i>
                        </span>
                        {{-- <span>
                            <i class="nav-icon bi bi-laptop"></i>
                            <span class="nav-text">Call Me Now</span>
                        </span> --}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link comingsoon" href="#">
                        <span>
                            <i class="bi bi-envelope"></i>
                            <span class="nav-text">Kritik & Saran</span>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{{ (Request::is('profile') ? 'active' : '') }}} " href="profile">
                        <span>
                            <i class="bi bi-person"></i>
                            <span class="nav-text">profile</span>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </footer>

    <!-- Footer ends-->


    {{-- <div class="position-fixed bottom-0 start-50 translate-middle-x  z-index-10">
        <div class="toast mb-3" role="alert" aria-live="assertive" aria-atomic="true" id="toastinstall"
            data-bs-animation="true">
            <div class="toast-header">
                <img src="assets_loginv2/img/favicon32.png" class="rounded me-2" alt="...">
                <strong class="me-auto">Install TCC App</strong>
                <small>now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <div class="row">
                    <div class="col">
                        Click "Install" to install TCC app & experience indepedent.
                    </div>
                    <div class="col-auto align-self-center ps-0">
                        <button class="btn-default btn btn-sm" id="addtohome">Install</button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Required jquery and libraries -->
    <script src="assets_loginv2/js/jquery-3.3.1.min.js"></script>
    <script src="assets_loginv2/js/popper.min.js"></script>
    <script src="assets_loginv2/vendor/bootstrap-5/js/bootstrap.bundle.min.js"></script>

    <!-- cookie js -->
    <script src="assets_loginv2/js/jquery.cookie.js"></script>

    <!-- Customized jquery file  -->
    <script src="assets_loginv2/js/main.js"></script>
    <script src="assets_loginv2/js/color-scheme.js"></script>

    <!-- PWA app service registration and works -->
    {{-- <script src="assets_loginv2/js/pwa-services2.js"></script> --}}

    <!-- Chart js script -->
    <script src="assets_loginv2/vendor/chart-js-3.3.1/chart.min.js"></script>

    <!-- Progress circle js script -->
    <script src="assets_loginv2/vendor/progressbar-js/progressbar.min.js"></script>

    <!-- swiper js script -->
    <script src="assets_loginv2/vendor/swiperjs-6.6.2/swiper-bundle.min.js"></script>

    <!-- page level custom script -->
    <script src="assets/js/app2.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('.referensi').click(function(){
            $('#formreferensi')[0].reset();
            $('.referensi-title').text("Referensi Baru");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#referensiform').modal('show');
        });
        $('.comingsoon').click(function(){
            Swal.fire(
                'Coming Soon',
                'Menu untuk Kritik & Saran akan segera hadir',
                'info'
            )
        })
        $('#formreferensi').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == 'Add')
            {
                $.ajax({
                    url:"{{ route('ecatalog.referensistore') }}",
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
                            $('#referensiform').modal('hide');
                            $('#formreferensi')[0].reset();
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
        <!-- start webpushr code --> <script>(function(w,d, s, id) {if(typeof(w.webpushr)!=='undefined') return;w.webpushr=w.webpushr||function(){(w.webpushr.q=w.webpushr.q||[]).push(arguments)};var js, fjs = d.getElementsByTagName(s)[0];js = d.createElement(s); js.id = id;js.async=1;js.src = "https://cdn.webpushr.com/app.min.js";fjs.parentNode.appendChild(js);}(window,document, 'script', 'webpushr-jssdk'));webpushr('setup',{'key':'BMJ-ZyGue3dQxlmxChUe-tyVbrRfhh0ZbUlRWdDa9QMWF-DwQHeO4n4zneA2P63fUqvi2_Xac6W269d52he5j6E' });</script><!-- end webpushr code -->
    </script>
    @yield('js')
</body>

</html>
