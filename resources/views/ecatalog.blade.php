@extends('layouts.master')

@section('content')
    <div class="row mb-3">
        <div class="col">
            <h6 class="title">E-Catalog</h6>
        </div>
    </div>
    <!-- swiper credit cards -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="slider">
                @php $i2 = 0; @endphp
                @foreach ($slidere as $b)
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
            <div class="d-grid gap-2 d-md-block">
                <a target="_blank" href="../storage/app/public/files/dokumen/pricelist/Pricelist_Kendaraan_Toyota_OTR_Bandung.pdf" class="btn btn-primary" type="button">Pricelist</a>
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">E-catalog</button>
                {{-- <button class="referensi btn btn-primary" type="button">Referensi</button> --}}
            </div>
        </div>
    </div>
    {{-- <div class="card shadow-sm mb-4">
        <div class="card-body">
            <p class="text-muted mb-3">
                <table width="100%" id="myTable" class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr>
                            <th>Kendaraan</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Avanza G A/T</td>
                            <td>Rp. 250.000.000</td>
                            <td><button class="btn btn-default btn-sm shadow-sm">Saya tertarik</button></td>
                        </tr>
                        <tr>
                            <td>Avanza G A/T</td>
                            <td>Rp. 250.000.000</td>
                            <td><button class="btn btn-default btn-sm shadow-sm">Saya tertarik</button></td>
                        </tr>
                        <tr>
                            <td>Avanza G A/T</td>
                            <td>Rp. 250.000.000</td>
                            <td><button class="btn btn-default btn-sm shadow-sm">Saya tertarik</button></td>
                        </tr>
                    </tbody>
                </table>
            </p>
        </div>
    </div> --}}


    <!-- modal-->
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table width="100%" id="myTable2" class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr>
                                <th>Kendaraan</th>
                                <th>Brosur</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no2 = 1; @endphp
                            @foreach ($brosur as $br)
                            <tr>
                                <td>{{ $br->alt }}</td>
                                <td><a class="btn btn-default btn-sm shadow-sm" href="../{{ $br->img_src }}">Download Brosur</a></td>
                            </tr>
                            @php $no2 = $no2+1; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="referensiform" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title referensi-title" id="staticBackdropLabel">Finding</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="formreferensi" class="form-horizontal" enctype="multipart/form-data">
                    <span id="form_result"></span>
                    @csrf
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="perihal" class="col-sm-5 col-form-label">Nama yang direferensikan :<span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="nama_referensi" id="nama_referensi" placeholder="Nama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="perihal" class="col-sm-5 col-form-label">Nomor HP :<span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control" name="nomorhp_referensi" id="nomorhp_referensi" placeholder="Nomor HP referensi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="perihal" class="col-sm-5 col-form-label required">Kendaraan :<span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <select class="form-control" name="kendaraan" width="100%">
                                    <option>Pilih kendaraan yang direferensikan</option>
                                    @foreach ($brosur as $brr)
                                        <option value="{{ $brr->ID }}">{{ $brr->alt }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="perihal" class="col-sm-5 col-form-label">Rekomendasi Sales Anda :</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="sales_referensi" id="sales_referensi" placeholder="Isi nama sales">
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

@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

@section('js')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready( function () {
        var oTable = $('#myTable').DataTable({
            responsive: true,
            dom: '<"html5buttons">Brtlip',
        });
        var oTable2 = $('#myTable2').DataTable({
            responsive: true,
        });
        $('.referensi').click(function(){
            $('#formreferensi')[0].reset();
            $('.referensi-title').text("Referensi Baru");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#referensiform').modal('show');
            bsCustomFileInput.init();
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

    } );
</script>
@endsection
