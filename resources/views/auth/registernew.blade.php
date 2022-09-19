<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <link rel="canonical" href="https://tunastoyotacipondoh.co.id" />
    <title>Tunas Toyota Cimindi - Mobile Web Apps</title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="assets/img/logo_tunas.png" sizes="180x180">
    <link rel="icon" href="assets/img/logo_tunas.png" sizes="32x32" type="image/png">
    <link rel="icon" href="assets/img/logo_tunas.png" sizes="16x16" type="image/png">

    <!-- Google fonts-->

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&amp;display=swap" rel="stylesheet">

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- style css for this template -->
    <link href="assets_loginv2/css/style.css" rel="stylesheet" id="style">
</head>

<body class="body-scroll d-flex flex-column h-100" data-page="signup">

    <!-- Begin page content -->
    <main class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-12 text-center mb-auto px-0">
                <header class="header">
                    <div class="row">
                        <div class="col-auto">
                            <a href="login" target="_self" class="btn btn-light btn-44">
                                <i class="bi bi-arrow-left"></i>
                            </a>
                        </div>
                        <div class="col align-self-center">
                            <h5>Pendaftaran Aplikasi Tunas Toyota Cimindi</h5>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-light btn-44 invisible"></a>
                        </div>
                    </div>
                </header>
            </div>
            <div class="col-10 col-md-6 col-lg-5 col-xl-3 mx-auto align-self-center text-center py-4">
                <form id="register">
                    @csrf
                    <div class="form-floating is-valid mb-3">
                        <input type="text" class="form-control" autofocus placeholder="nama" name="nama"
                            id="nama">
                        <label for="nama">Nama</label>
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-floating is-valid mb-3">
                        <select class="form-control" id="country">
                            <option selected>Indonesia (+62)</option>
                        </select>
                        <label for="country">Negara</label>
                    </div>
                    <div class="form-floating is-valid mb-3">
                        <input type="text" maxlength="13" class="form-control" name="phone"
                            placeholder="Nomor HP" id="phone" onkeypress="return hanyaAngka(event)">
                        <label for="phone">Nomor HP (contoh : 0812xxx,021585xx)</label>
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-floating is-valid mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email"
                            id="email">
                        <label for="email">Email</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-floating is-valid mb-3">
                        <input type="text" class="form-control" placeholder="Nomor Rangka" name="nomor_rangka"
                            id="nomor_rangka">
                        <label for="nomor_rangka">Nomor Rangka Kendaraan</label>
                        @error('nomor_rangka')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-floating is-valid mb-3">
                        <input type="password" class="form-control" placeholder="Password"
                            id="password" name="password">
                        <label for="password">Password</label>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-floating is-invalid mb-3">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" id="confirmpassword">
                        <label for="confirmpassword">Confirm Password</label>
                        <button type="button" class="btn btn-link text-danger tooltip-btn" data-bs-toggle="tooltip"
                            data-bs-placement="left" title="Enter valid Password" id="passworderror">
                            <i class="bi bi-info-circle"></i>
                        </button>
                    </div>
                    <button type="submit" class="btn btn-lg btn-default w-100 mb-4 shadow">
                        Daftar
                    </button>
                </form>
            </div>
            <div class="col-12 text-center mt-auto text-light">
                <div class="row justify-content-center footer-info">
                    <div class="col-auto">
                        <p class="text-muted">&copy; Tunas Toyota Cipondoh - 2022 All right Reserved </p>
                    </div>
                </div>
            </div>
        </div>
    </main>


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
    {{-- <script src="assets_loginv2/js/pwa-services.js"></script> --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- page level custom script -->
    <script src="assets_loginv2/js/app.js"></script>
    <script>
        function hanyaAngka(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
          return false;
        return true;
      }

    $('#register').on('submit', function(event){
        event.preventDefault();
            $.ajax({
                url:"{{ route('pendaftaran.store') }}",
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
                    if(data.tidakada)
                    {
                        swal.fire({
                            icon: 'warning',
                            title: 'Data gagal disimpan',
                            text: data.tidakada
                        })

                        $('#action_button').html('Save changes').attr('disabled', false);
                    }
                    if(data.duplicate)
                    {
                        swal.fire({
                            icon: 'warning',
                            title: 'Data gagal disimpan',
                            text: data.tidakada
                        })

                        $('#action_button').html('Save changes').attr('disabled', false);
                    }
                    if(data.success)
                    {
                        swal.fire({
                            icon: 'success',
                            title: 'Data berhasil disimpan',
                            text: data.success
                        })
                        window.location.href='login'
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
    });
    </script>
</body>

</html>
