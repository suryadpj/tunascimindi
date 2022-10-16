<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <link rel="canonical" href="https://tunastoyotacipondoh.co.id" />
    {{-- <link rel="shortcut icon" href="../resources/assets/img/logo_tunas.png" /> --}}
    <title>Tunas Toyota Cimindi - Mobile Web Apps</title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="manifest" href="../resources/assets_loginv2/json/manifest3.json" />

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../resources/assets/img/logo_tunas.png" sizes="180x180">
    <link rel="icon" href="../resources/assets/img/logo_tunas.png" sizes="32x32" type="image/png">
    <link rel="icon" href="../resources/assets/img/logo_tunas.png" sizes="16x16" type="image/png">

    <!-- Google fonts-->

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&amp;display=swap" rel="stylesheet">

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- style css for this template -->
    <link href="assets_loginv2/css/style.css" rel="stylesheet" id="style">
</head>

<body class="body-scroll d-flex flex-column h-100" data-page="signin">

    <!-- loader section -->
    {{-- <div class="container-fluid loader-wrap">
        <div class="row h-100">
            <div class="col-10 col-md-6 col-lg-5 col-xl-3 mx-auto text-center align-self-center">
                <div class="loader-cube-wrap loader-cube-animate mx-auto">
                    <img src="../resources/assets/img/logo_tunas.png" alt="Logo">
                </div>
                <p class="mt-4">Waktunya melacak kondisi mobilmu di Tunas Toyota Cipondoh<br><strong>Please wait...</strong></p>
            </div>
        </div>
    </div> --}}
    <!-- loader section ends -->

    <!-- Begin page content -->
    <main class="container-fluid h-100">
        <div class="row h-100 overflow-auto">
            <div class="col-12 text-center mb-auto px-0">
                <header class="header bg-white" style="justify-content: space-between;align-items: center;">
                    <div class="row">
                        <div class="col-auto">
                            <div class="logo-medium">
                                <img src="assets/img/gobeyondkecillgrev2.png" style="position: sticky;" class="responsive hide-low-md" alt="">
                            </div></div>
                        <div class="col align-self-center text-end">
                            <div class="logo-medium text-end">
                                <img src="assets/img/logo-cimindi-kecil-rev2.png" class="responsive" alt="">
                            </div>
                        </div>
                    </div>
                </header>
            </div>
            <div class="col-10 col-md-6 col-lg-5 col-xl-3 mx-auto align-self-center text-center py-4">
                <h1 class="mb-4 text-color-theme">Log in untuk melanjutkan</h1>
                <form method="POST" action="{{ route('login') }}" class="was-validated needs-validation" novalidate>
                    @csrf
                    <div class="form-group form-floating mb-3 is-valid">
                        <input type="text" id="username" placeholder="nomor HP / nomor rangka / email" name="username" autocomplete="off" class="form-control @error('username') is-invalid @enderror" required autofocus value="{{ old('username') }}"/>
                        <label class="form-control-label" for="email">Nomor HP / Nomor Rangka / Email</label>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group form-floating is-valid mb-3">
                        <input id="password" placeholder="Password" autocomplete="off" type="password" class="password-field form-control" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        <label class="form-control-label" for="password">Password</label>
                        <button type="button" toggle=".password-field" class="tooltip-btn toggle-password" data-bs-toggle="tooltip"
                            data-bs-placement="left" title="Lihat password" id="passworderror">
                            <i class="bi bi-eye" id="mata"></i>
                        </button>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <p class="mb-3 text-center">
                        <a href="lupapassword" class="">
                            Lupa password anda ?
                        </a>
                    </p>

                    <button type="submit" class="btn btn-lg btn-default w-100 mb-4 shadow">
                        {{ __('Sign in') }}
                    </button>
                </form>
                <p class="mb-2 text-muted">Belum punya akun ?</p>
                <a href="pendaftaran" target="_self" class="">
                    Daftar disini <i class="bi bi-arrow-right"></i>
                </a>

            </div>
            <div class="col-12 text-center mt-auto">
                <div class="row justify-content-center footer-info">
                    <div class="col-auto">
                        <p class="text-muted">&copy; Tunas Toyota Cimindi - 2022 All right Reserved </p>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!-- Required jquery and libraries -->
    <script src="../resources/assets_loginv2/js/jquery-3.3.1.min.js"></script>
    <script src="../resources/assets_loginv2/js/popper.min.js"></script>
    <script src="../resources/assets_loginv2/vendor/bootstrap-5/js/bootstrap.bundle.min.js"></script>

    <!-- cookie js -->
    <script src="../resources/assets_loginv2/js/jquery.cookie.js"></script>

    <!-- Customized jquery file  -->
    <script src="../resources/assets_loginv2/js/main.js"></script>
    <script src="../resources/assets_loginv2/js/color-scheme.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- PWA app service registration and works -->
    <script src="../resources/assets_loginv2/js/pwa-services.js"></script>

    <!-- page level custom script -->
    <script src="../resources/assets_loginv2/js/app.js"></script>
    <script>
        $(".toggle-password").click(function() {
        console.log('cek')
        // $(this).toggleClass("bi bi-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
        $('#mata').removeClass('bi-eye');
        $('#mata').addClass('bi-eye-slash');
        input.attr("type", "text");
        } else {
        input.attr("type", "password");
        $('#mata').removeClass('bi-eye-slash');
        $('#mata').addClass('bi-eye');
        }
        });
    </script>

</body>

</html>
