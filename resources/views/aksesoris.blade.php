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
    <div class="row">
        @foreach ($dataakses as $a)
            <div class="col-12 col-md-6 col-lg-4">
                <a class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <div class="imgzoom avatar avatar-60 shadow-sm rounded-10 coverimg" id="../{{ $a->img_src }}">
                                    <img src="../{{ $a->img_src }}" alt="{{ $a->alt }}">
                                </div>
                            </div>
                            <div class="col align-self-center ps-0">
                                <p title="rekomendasi" class="text-color-theme mb-1">{{ $a->alt }}</p>
                                <p class="text-muted size-12">{{ $a->penjelasan }}</p>
                                <br>
                                <div class="row">
                                    <div class="col-auto align-self-center">
                                        {{-- @if ($a->jempol == 1)
                                            <button type="button" class="btn btn-primary" title="Rekomendasi" data-toggle="tooltip" data-placement="left" title="Tooltip on left"><i class="bi bi-star" title="Rekomendasi"></i></button>
                                        @endif
                                        <button type="button" class="btn btn-primary like" id="{{ $a->ID }}"><i class="bi bi-hand-thumbs-up-fill"></i>
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="jumlahlike{{ $a->ID }}">
                                            {{ $a->like }}
                                            </span>
                                        </button> --}}
                                        {{-- <button href="" class="download btn btn-primary text-end" title="Rekomendasi" data-toggle="tooltip" data-placement="left" title="Tooltip on left"><i class="bi bi-download" title="Rekomendasi"></i></butt> --}}
                                    </div>
                                    <div class="col align-self-center text-end">
                                        <button onclick="window.location.href='../{{ $a->link }}';target='_blank';" class="download btn btn-primary text-end" title="Rekomendasi" data-toggle="tooltip" data-placement="left" title="Tooltip on left"><i class="bi bi-download" title="Rekomendasi"></i></button>
                                        <button type="button" class="booknow btn btn-primary text-end" id="{{ $a->ID }}">Beli</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
        @if ($dataaksescount == 0)
            <br>
            <br>
            <br>
            <br>
            <h4 align="center"><br>Nantikan penawaran aksesoris terbaik dari kami</h4>
        @endif
    </div>

    {{-- <div class="row mb-3">
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
    </div> --}}


    <!-- modal-->
    <div class="modal fade" id="booknowmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formbooknow">
                    @csrf
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Beli Aksesoris</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table width="100%">
                            <tr>
                                <th>Nama Aksesoris</th>
                                <th>:</th>
                                <td><input type="text" readonly class="form-control-plaintext" id="nama_promo"></td>
                            </tr>
                            {{-- <tr>
                                <th>Tanggal</th>
                                <th>:</th>
                                <td><input class="form-control" type="date" name="tanggal"></td>
                            </tr>
                            <tr>
                                <th>Time</th>
                                <th>:</th>
                                <td><input class="form-control" type="time" name="waktu"></td>
                            </tr> --}}
                            <tr>
                                <th>Catatan</th>
                                <th>:</th>
                                <td><input class="form-control" type="text" name="catatan" placeholder="Catatan tambahan"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="action" />
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="action_button" value="Add" id="action_button" class="btn btn-primary">Beli</button>
                    </div>
                </form>
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
        $('.booknow').click(function(){
            var id = $(this).attr('id');
            $('#formbooknow')[0].reset();
            $.ajax({
                url:"aksesoris/"+id,
                dataType:"json",
                success:function(html)
                {
                    $('#nama_promo').val(html.data.alt);
                    console.log(html.data.ID)
                    $('#hidden_id').val(html.data.ID);
                    $('#action_button').val("Book now");
                    $('#action').val("book");
                    $('#booknowmodal').modal('show');
                }
            })
        });
        $('#formbooknow').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:"{{ route('aksesoris.store') }}",
                method:"POST",
                data: new FormData(this),
                contentType: false,
                cache:false,
                processData: false,
                dataType:"json",
                beforeSend:function(){
                    $('#action_button').html('loading...').attr('disabled', true);
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
                            text: 'Data pesanan anda akan diteruskan dan petugas kami akan menghubungi anda. Terima kasih'
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
        });

    } );
</script>
@endsection


