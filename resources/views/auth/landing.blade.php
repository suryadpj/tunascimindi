<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Tunas Toyota Cimindi</title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="manifest" href="manifest.json" />

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

    <!-- swiper carousel css -->
    <link rel="stylesheet" href="assets/vendor/swiperjs-6.6.2/swiper-bundle.min.css">

    <!-- style css for this template -->
    <link href="assets/css/style.css" rel="stylesheet" id="style">
    <style>
        .cont{
        margin-top: 30px;
        height: 20px;
        width: 100%;
        background: rgba(0, 200, 0, .3);
        border-radius: 50px;
    }
    .cont .loader{
        height: 20px;
        position: relative;
        box-sizing: border-box;
        width: 0%;
        background: rgba(0, 200, 0, .8);
        border-radius: 50px;
        transition: width 1.5s linear
    }
    .cont .loader:before{
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        border-radius: 50px;
        width: 100%;
        background: linear-gradient(to  right, rgba(0, 200, 0, .3), rgba(0, 100, 0, .8));
        animation: purge 4s infinite ease-out
    }

    @keyframes purge{
        0%{
            opacity: 0;
            width: 0%;

        }
        50%{
            opacity: .5
        }
        100%{
            opacity: 0;
            width: 100%;
        }
    }
    .cont .loader label{
        font-size: 12px;
        position: absolute;
        right: -10px;
        text-align: center;
        top: -25px;
        font-weight: 600;
        transition: .3s;
    }
    .cont .loader:after{
        content: "";
        position: absolute;
        top: -10px;
        right: 0px;
        height: 50%;
        width: 2px;
        background: rgba(0, 200, 0, .8);
    }
    .cont:hover .loader label{
        transform: scale(1.5);
        transition: .3s;
    }
    </style>
</head>

<body class="body-scroll d-flex flex-column h-100" data-page="landing">

    <!-- Begin page content -->
    <main class="container-fluid h-100">

        <!-- Swiper -->
        <div class="swiper-container introswiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="row h-100">
                        <div class="col-11 col-md-8 col-lg-6 col-xl-4 mx-auto align-self-center text-center">
                            <div class="row">
                                <div class="col-ld-6">
                                    <br>
                                    <br>
                                    <br>
                                    <h1 class="text-color-theme mb-4">Wilujeng Sumping</h1>
                                    <img src="assets/img/bdg.png" alt="" class="mw-100 mx-auto mb-5">
                                </div>
                                <div class="col-ld-6">
                                    <h1 class="text-color-theme mb-4">Tunas Toyota Cimindi</h1>
                                    {{-- <p class="size-18 text-muted">Tunas Toyota Cimindi</p> --}}
                                </div>
                                <div class="cont">
                                    <div class="loader">
                                        <label class="counter"><span>0%</span> complete</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="swiper-slide">
                    <div class="row h-100">
                        <div class="col-11 col-md-8 col-lg-6 col-xl-4 mx-auto align-self-center text-center">
                            <div class="row">
                                <div class="col-ld-6">
                                    <br>
                                    <br>
                                    <br>
                                    <img src="assets/img/vector_service.png" alt="" class="mw-100 mx-auto mb-5">
                                </div>
                                <div class="col-ld-6">
                                    <h1 class="text-color-theme mb-4">Fasilitas dalam genggaman </h1>
                                    <p class="size-18 text-muted">Nikmati beragam fasilitas Tunas Toyota langsung dari genggaman anda</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="row h-100">
                        <div class="col-11 col-md-8 col-lg-6 col-xl-4 mx-auto align-self-center text-center">
                            <div class="row">
                                <div class="col-ld-6">
                                    <br>
                                    <br>
                                    <br>
                                    <img src="assets/img/agency-kecil.png" alt="" class="mw-100 mx-auto mb-5">
                                </div>
                                <div class="col-ld-6">
                                    <h1 class="text-color-theme mb-4">Kami siap membantu</h1>
                                    <p class="size-18 text-muted">Dengan beragam fasilitas lengkap yang ada di Tunas Toyota Cimindi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>

    </main>
    <!-- Page content ends-->

    <!-- Required jquery and libraries -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/vendor/bootstrap-5/js/bootstrap.bundle.min.js"></script>

    <!-- cookie js -->
    <script src="assets/js/jquery.cookie.js"></script>

    <!-- Customized jquery file  -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/color-scheme.js"></script>

    <!-- PWA app service registration and works -->
    <script src="assets/js/pwa-services.js"></script>

    <!-- swiper js script -->
    <script src="assets/vendor/swiperjs-6.6.2/swiper-bundle.min.js"></script>

    <!-- page level custom script -->
    <script src="assets/js/app2.js"></script>
    <script>
        setTimeout(function () {
                    window.location.replace("login");
                }, 2000);
                window.addEventListener("load", loadProgress)

  function loadProgress(){

    // Get DOM element
    const target = document.querySelector(".loader")
    const counter = target.querySelector("span");

    // Sample form data
    const details = {
        name: "Jefferson",
        age: 12,
        weight: 70,
        level: 30,
        relationship: "",
        contact: "",
        email: "",
     friends: 459
    }


    function getProgress(board){
        let maxLength = 100;
        // Put them into array to get length of form
        let lengthOfBoard = Object.values(board).length;

        // Get possible mark of each field
        let jumps = maxLength/lengthOfBoard;
        let progress = 0;
        for (let field in board){
            // If field is filled add it's mark to progress
            if (board[field]) {
                progress += jumps
            }
        }
        return progress
    }

    // Utilise value calculated from loader
    function implimentLoad(){
        // Simulate a delay
        setTimeout(()=>{
            let progress = Math.round(getProgress(details))
            counter.innerText = `${progress}% `;
            target.style.width = `${getProgress(details)}% `
        }, 200)

    }
    implimentLoad()
  }


    </script>

</body>

</html>
