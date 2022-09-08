@extends('layouts.master')

@section('content')
    <div class="row mb-3">
        <div class="col">
            <h6 class="title">History Service</h6>
        </div>
    </div>
    <!-- wallet balance -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <p class="text-muted mb-3">
                <table width="100%" id="myTable" class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr>
                            <th>Kategori</th>
                            <th>Pekerjaan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($pkb as $a)
                            <tr>
                                <td>
                                    @if($a->service_category == "SBI" || $a->service_category == "SBE")
                                        <img src="assets_loginv2/img/sbe.png" style="heigh: auto;" width="130" height="50" alt="{{ $a->service_category }}">
                                    @elseif ($a->service_category == "GR")
                                        <img src="assets_loginv2/img/gr.png" style="heigh: auto;" width="130" height="50" alt="{{ $a->service_category }}">
                                    @else
                                        <img src="assets_loginv2/img/sbe.png" style="heigh: auto;" width="130" height="50" alt="{{ $a->service_category }}">
                                    @endif
                                </td>
                                <td>{{ $a->pkbdate }} <br> Job : {{ $a->kilometer }}</td>
                                <td>
                                    <a href="#" title="Detail" id="{{ $a->ID }}" class="detail avatar avatar-50 shadow-sm mb-2 rounded-10 theme-bg text-white"><i class="bi bi-search"></i></a>
                                    {{-- <a href="#" title="Finding" id="{{ $a->ID }}" class="finding avatar avatar-50 shadow-sm mb-2 rounded-10 theme-bg text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop2"><i class="bi bi-ui-checks"></i></a> --}}
                                </td>
                            </tr>
                            @php $no = $no+1; @endphp
                        @endforeach
                    </tbody>
                </table>
            </p>
        </div>
    </div>

    <!-- modal-->
    <div class="modal fade" id="modalshow" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table width="100%">
                        <tr>
                            <th>Nomor PKB</th>
                            <th>:</th>
                            <td><span id="nomorpkb"></span></td>
                        </tr>
                        <tr>
                            <th>Tanggal PKB</th>
                            <th>:</th>
                            <td><span id="tanggalpkb"></span></td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <th>:</th>
                            <td><span id="kategoripkb"></span></td>
                        </tr>
                        <tr>
                            <th>Kilometer</th>
                            <th>:</th>
                            <td><span id="kilometerpkb"></span></td>
                        </tr>
                        <tr>
                            <th>Deksripsi Pekerjaan</th>
                            <th>:</th>
                            <td><span id="deskripsipkb"></span></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    1. Engine Components 6 item <br>
                    2. Chassis & Body 10 Item
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Finding</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    1. Ketebalan ban dibawah standar
                    2. Saluran air wiper bocor
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Saran Perbaikan</button>
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
        $(document).on('click', '.detail', function(){
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url:"history/"+id,
                dataType:"json",
                success:function(html)
                {
                    $('#nomorpkb').append(html.data.pkb_no);
                    $('#kategoripkb').append(html.data.service_category);
                    $('#kilometerpkb').append(html.data.kilometer);
                    $('#deskripsipkb').append(html.data.operation_desc);
                    $('#tanggalpkb').append(html.data.pkb_date);
                    $('.modal-title').text("Detail data");
                    $('#modalshow').modal('show');
                }
            })
        });

    } );

</script>
@endsection


