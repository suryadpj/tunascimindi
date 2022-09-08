@extends('layouts.master')

@section('content')
    <div class="row mb-3">
        <div class="col">
            <h6 class="title">Trade-in</h6>
        </div>
    </div>
    <!-- wallet balance -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="col-12">
                <div class="slider">
                    <div>
                        <a class="popup">
                            <img src="assets_loginv2/img/tradeinimg.jpg" class="d-block w-100" alt="...">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 "  >
                <center>
                    <div class="p-3 form-style" style="background-color:white;">
                        <!-- delete class hide -->
                        <center id="main-form" class="show">
                            <!-- delete class hide -->
                            <h4 class="py-3">Isi Detail Mobil Anda</h4>
                            <div class="_3fL0U"><div class="b_bNc _3Sk-P"><span data-aut-id="make_header-val">Merek</span></div><div class="b_bNc _1v_Mu"><span data-aut-id="m_tipe_header-val">Model</span></div><div class="b_bNc _1v_Mu"><span data-aut-id="m_year_header-val">Tahun</span></div><div class="b_bNc _1v_Mu"><span data-aut-id="m_tipe_variant_header-val">Varian</span></div><div class="b_bNc _1v_Mu"><span data-aut-id="m_transmission_header-val">Transmisi</span></div><div class="b_bNc _1v_Mu"><span data-aut-id="phone_header-val">Detail</span></div></div>

                            <table width="100%">
                                <tr>
                                    <td><button id="btn-1" type="button" class="btn btn-primary btn-style btn-frm btn-form-active" onclick="OnMenuClick(this)"><b>MODEL</b></button></td>
                                    <td><button id="btn-2" type="button" class="disable btn btn-primary btn-style btn-frm btn-form-readonly" onclick="OnMenuClick(this)"><b>TAHUN</b></button></td>
                                    <td><button id="btn-3" type="button" class="btn btn-primary btn-style btn-frm btn-form-readonly" onclick="OnMenuClick(this)"><b>VARIAN</b></button></td>
                                </tr>
                                <tr>
                                    <td><button id="btn-4" type="button" class="btn btn-primary btn-style btn-frm btn-form-readonly" onclick="OnMenuClick(this)"><b>TRANSMISI</b></button></td>
                                    <td><button id="btn-5" type="button" class="btn btn-primary btn-style btn-frm btn-form-readonly" onclick="OnMenuClick(this)"><b>DETAIL</b></button></td>
                                    <td></td>
                                </tr>
                            </table>
                        </center>
                    <div id="rootComponent"></div>
                </center>
                <p class="text-muted mb-3">
                    <table width="100%" id="myTable" class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr>
                                <th>Kendaraan</th>
                                {{-- <th>Jadwal Inspeksi</th> --}}
                                <th>Estimasi Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <i>Avanza Tipe G  AT</i><br>
                                    Tahun 2018<br>
                                    KM 20.000
                                </td>
                                {{-- <td>
                                    30 Agustus 2022<br>
                                    Jam 10.00<br>
                                </td> --}}
                                <td>
                                    Rp. 98.000.000 - Rp. 115.000.000
                                </td>
                                <td><button class="minat btn btn-primary btn-style btn-frm">Saya minat</button></td>
                            </tr>
                            <tr>
                                <td>
                                    <i>Avanza Tipe G  AT</i><br>
                                    Tahun 2018<br>
                                    KM 20.000
                                </td>
                                {{-- <td>
                                    30 Agustus 2022<br>
                                    Jam 10.00<br>
                                </td> --}}
                                <td>
                                    Rp. 98.000.000 - Rp. 115.000.000
                                </td>
                                <td><button class="minat btn btn-primary btn-style btn-frm">Saya minat</button></td>
                            </tr>
                            <tr>
                                <td>
                                    <i>Avanza Tipe G  AT</i><br>
                                    Tahun 2018<br>
                                    KM 20.000
                                </td>
                                {{-- <td>
                                    30 Agustus 2022<br>
                                    Jam 10.00<br>
                                </td> --}}
                                <td>
                                    Rp. 98.000.000 - Rp. 115.000.000
                                </td>
                                <td><button class="minat btn btn-primary btn-style btn-frm">Saya minat</button></td>
                            </tr>
                        </tbody>
                    </table>
                </p>
            </div>
        </div>
    </div>
@endsection

@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
<style>
    ._3fL0U {
    display: inline-block;
    overflow-x: scroll;
    width: 100%;
    white-space: nowrap;
    overflow-y: hidden;
    vertical-align: middle;
    background-color: #fff;
}._3fL0U .b_bNc {
    display: inline-block;
    height: 31px;
    min-width: 58px;
    margin: 12px;
    padding: 6px 8px;
    border-radius: 8px;
    text-align: center;
    box-sizing: border-box;
    flex-shrink: 0;
    cursor: pointer;
    background-color: #c8f8f6;
}._3fL0U .b_bNc._3Sk-P {
    background-color: #002f34;
}
</style>
@endsection

@section('js')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript" src="http://afarkas.github.io/lazysizes/lazysizes.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready( function () {
        var oTable = $('#myTable').DataTable({
            responsive: true,
        });
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
        $('#rootComponent').load('tradein/model/list', function() {
            console.log('HAPPY');
        });

    $('.minat').click(function(){
            Swal.fire(
                'Data tersimpan',
                'Petugas kami akan menghubungi anda. Terima kasih',
                'info'
            )
        })

    } );
</script>
@endsection


