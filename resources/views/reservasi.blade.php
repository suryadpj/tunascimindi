@extends('layouts.master')

@section('content')
    <div class="row mb-3">
        <div class="col">
            <h6 class="title">Data Reservasi</h6>
        </div>
    </div>
    <div class="row">
        @foreach ($reservasi as $a)
        <div class="col-12 col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            @switch($a->segmen)
                                @case(1)<div class="avatar avatar-40 alert-success text-success rounded-circle"><i class="bi bi-percent size-20"></i></div> @break
                                @case(2)<div class="avatar avatar-40 alert-danger text-danger rounded-circle"><i class="bi bi-car-front size-20"></i></div> @break
                                @case(3)<div class="avatar avatar-40 alert-info text-info rounded-circle"><i class="bi bi-bookmark-check size-20"></i></div> @break
                                @case(4)<div class="avatar avatar-40 alert-info text-info rounded-circle"><i class="bi bi-bookmark-check size-20"></i></div> @break
                                @case(7)<div class="avatar avatar-40 alert-success text-success rounded-circle"><i class="bi bi-percent size-20"></i></div> @break
                                @case(8)<div class="avatar avatar-40 alert-info text-info rounded-circle"><i class="bi bi-bookmark-check size-20"></i></div> @break
                            @endswitch
                        </div>
                        <div class="col align-self-center ps-0">
                            <p class="mb-0">
                                @switch($a->segmen)
                                    @case(1) Promo @break
                                    @case(2) Tes Drive @break
                                    @case(3) Booking Service @break
                                    @case(4) Pembelian Aksesoris @break
                                    @case(7) Promo @break
                                    @case(8) Booking CR7 @break
                                    @default
                                @endswitch
                            </p>
                            <p class="text-muted size-12">
                                @switch($a->segmen)
                                    @case(1) {{ $a->tgl }} - {{ $a->waktu }} @break
                                    @case(2) {{ $a->tgl }} @break
                                    @case(3) {{ $a->tgl }} - {{ $a->waktu }} @break
                                    @case(7) {{ $a->tgl }} - {{ $a->waktu }} @break
                                    @case(8) {{ $a->tgl }} - {{ $a->waktu }} @break
                                    @default
                                @endswitch
                            </p>
                            <p class="small text-muted">
                                @switch($a->segmen)
                                    @case(1) {{ $a->alt }} @break
                                    @case(2) {{ $a->keterangan }} @break
                                    @case(3) {{ number_format($a->km,0) }} KM - {{ $a->job }} <br> Catatan : {{ $a->keterangan }} @break
                                    @case(4) {{ $a->aksesorisp }} @break
                                    @case(7) {{ $a->alt }} @break
                                    @case(8) {{ $a->cr71 }} - {{ $a->cr72 }} @break
                                    @default
                                @endswitch
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-auto align-self-center">
                            Status :
                            @switch($a->status)
                                @case(1)
                                    Menunggu respon petugas
                                @break
                                @case(2)
                                    Dihubungi
                                @break
                                @case(3)
                                    Done
                                @break
                                @case(4)
                                    Cancel
                                @break

                                @default

                            @endswitch
                        </div>
                        <div class="col align-self-center text-end">
                            <p class="small">
                                @switch($a->segmen)
                                    @case(1) <a href="#" title="Detail" id="{{ $a->ID }}" class="promo btn btn-info shadow-sm mb-1 rounded-10 theme-bg text-white">Detail</a> @break
                                    @case(2) <a href="#" title="Detail" id="{{ $a->ID }}" class="tesdrive btn btn btn-info shadow-sm mb-1 rounded-10 theme-bg text-white">Detail</a> @break
                                    @case(3) <a href="#" title="Detail" id="{{ $a->ID }}" class="bookingservice btn btn-info shadow-sm mb-1 rounded-10 theme-bg text-white">Detail</a> @break
                                    @case(4) <a href="#" title="Detail" id="{{ $a->ID }}" class="aksesoris btn btn-info shadow-sm mb-1 rounded-10 theme-bg text-white">Detail</a> @break
                                    @case(7) <a href="#" title="Detail" id="{{ $a->ID }}" class="promo btn btn-info shadow-sm mb-1 rounded-10 theme-bg text-white">Detail</a> @break
                                    @default
                                @endswitch

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- modal-->
    <div class="modal fade" id="modalservice" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table width="100%">
                        <tr>
                            <th>Nomor reservasi</th>
                            <th>:</th>
                            <td><span id="nomorreserv"></span></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <th>:</th>
                            <td><span id="tanggalreserv"></span></td>
                        </tr>
                        <tr>
                            <th>Waktu</th>
                            <th>:</th>
                            <td><span id="waktureserv"></span></td>
                        </tr>
                        <tr>
                            <th>Job</th>
                            <th>:</th>
                            <td><span id="kmreserv"></span></td>
                        </tr>
                        <tr>
                            <th>Deksripsi Pekerjaan</th>
                            <th>:</th>
                            <td><span id="deskripsireserv"></span></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <th>:</th>
                            <td><span id="statusreserv"></span></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modaltesdrive" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table width="100%">
                        <tr>
                            <th>Unit</th>
                            <th>:</th>
                            <td><span id="unittesdrive"></span></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <th>:</th>
                            <td><span id="tanggaltesdrive"></span></td>
                        </tr>
                        <tr>
                            <th>Nama / Nomor HP</th>
                            <th>:</th>
                            <td><span id="kontaktesdrive"></span></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <th>:</th>
                            <td><span id="statustesdrive"></span></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalpromo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Finding</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table width="100%">
                        <tr>
                            <th>Promo</th>
                            <th>:</th>
                            <td><span id="promo"></span></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <th>:</th>
                            <td><span id="tanggalpromo"></span></td>
                        </tr>
                        <tr>
                            <th>Waktu</th>
                            <th>:</th>
                            <td><span id="waktupromo"></span></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <th>:</th>
                            <td><span id="statuspromo"></span></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalaksesoris" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Finding</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table width="100%">
                        <tr>
                            <th>Aksesoris</th>
                            <th>:</th>
                            <td><span id="aksesoris"></span></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <th>:</th>
                            <td><span id="statusaksesoris"></span></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        });
        $(document).on('click', '.bookingservice', function(){
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url:"reservasi/"+id,
                dataType:"json",
                success:function(html)
                {
                    $('#nomorreserv').html('RSV00' + html.data.ID);
                    $('#tanggalreserv').html(html.data.tgl);
                    $('#waktureserv').html(html.data.waktu);
                    $('#kmreserv').html(html.data.km + ' KM');
                    $('#deskripsireserv').html(html.data.job);
                    if(html.data.status == 1)
                    {
                        $('#statusreserv').html('Menunggu respon petugas');
                    }
                    else if(html.data.status == 2)
                    {
                        $('#statusreserv').html('Dihubungi');
                    }
                    else if(html.data.status == 3)
                    {
                        $('#statusreserv').html('Done');
                    }
                    else if(html.data.status == 4)
                    {
                        $('#statusreserv').html('Cancel');
                    }
                    else
                    {
                        $('#statusreserv').html('-');
                    }
                    $('.modal-title').text("Detail data");
                    $('#modalservice').modal('show');
                }
            })
        });
        $(document).on('click', '.promo', function(){
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url:"reservasi/"+id,
                dataType:"json",
                success:function(html)
                {
                    $('#promo').html(html.data.alt);
                    $('#tanggalpromo').html(html.data.tgl);
                    $('#waktupromo').html(html.data.waktu);
                    if(html.data.status == 1)
                    {
                        $('#statuspromo').html('Menunggu respon petugas');
                    }
                    else if(html.data.status == 1)
                    {
                        $('#statuspromo').html('Dihubungi');
                    }
                    else if(html.data.status == 3)
                    {
                        $('#statuspromo').html('Done');
                    }
                    else if(html.data.status == 4)
                    {
                        $('#statuspromo').html('Cancel');
                    }
                    else
                    {
                        $('#statuspromo').html('-');
                    }
                    $('.modal-title').text("Detail data");
                    $('#modalpromo').modal('show');
                }
            })
        });
        $(document).on('click', '.aksesoris', function(){
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url:"reservasi/"+id,
                dataType:"json",
                success:function(html)
                {
                    $('#aksesoris').html(html.data.aksesorisp);
                    if(html.data.status == 1)
                    {
                        $('#statusaksesoris').html('Menunggu respon petugas');
                    }
                    else if(html.data.status == 1)
                    {
                        $('#statusaksesoris').html('Dihubungi');
                    }
                    else if(html.data.status == 3)
                    {
                        $('#statusaksesoris').html('Done');
                    }
                    else if(html.data.status == 4)
                    {
                        $('#statusaksesoris').html('Cancel');
                    }
                    else
                    {
                        $('#statusaksesoris').html('-');
                    }
                    $('.modal-title').text("Detail data");
                    $('#modalaksesoris').modal('show');
                }
            })
        });
        $(document).on('click', '.tesdrive', function(){
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url:"reservasi/"+id,
                dataType:"json",
                success:function(html)
                {
                    $('#unittesdrive').html(html.data.keterangan);
                    $('#tanggaltesdrive').html(html.data.tgl);
                    $('#kontaktesdrive').html(html.data.nama + ' / ' + html.data.nomorhp);
                    if(html.data.status == 1)
                    {
                        $('#statustesdrive').html('Menunggu respon petugas');
                    }
                    else if(html.data.status == 1)
                    {
                        $('#statustesdrive').html('Dihubungi');
                    }
                    else if(html.data.status == 3)
                    {
                        $('#statustesdrive').html('Done');
                    }
                    else if(html.data.status == 4)
                    {
                        $('#statustesdrive').html('Cancel');
                    }
                    else
                    {
                        $('#statuspromo').html('-');
                    }
                    $('.modal-title').text("Detail data");
                    $('#modaltesdrive').modal('show');
                }
            })
        });

    } );

</script>
@endsection


