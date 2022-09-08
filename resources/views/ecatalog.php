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
                        <tr>
                            <td><i class="bi bi-card-checklist fs-4 mb-3 border rounded-3"></i></td>
                            <td>
                                <i>1,000 KM</i><br>
                                1 Januari 2022<br>
                                Bill Rp.0<br>
                                KM 600
                            </td>
                            <td>
                                <a href="#" title="Detail" id="1" class="detail btn btn-icon btn-bg-light btn-active-color-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"><i class="bi bi-search"></i></a>
                                <a href="#" title="Finding" id="1" class="finding btn btn-icon btn-bg-light btn-active-color-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop2"><i class="bi bi-ui-checks"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="bi bi-paint-bucket fs-4 mb-3 border rounded-3"></i></td>
                            <td>
                                <i>Engine Oil</i><br>
                                4 Maret 2022<br>
                                Bill Rp.0<br>
                                KM 960
                            </td>
                            <td>
                                <a href="#" title="Detail" id="1" class="detail btn btn-icon btn-bg-light btn-active-color-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"><i class="bi bi-search"></i></a>
                                <a href="#" title="Finding" id="1" class="finding btn btn-icon btn-bg-light btn-active-color-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop2"><i class="bi bi-ui-checks"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="bi bi-card-checklist fs-4 mb-3 border rounded-3"></i></td>
                            <td>
                                <i>10,000 KM</i><br>
                                18 Juni 2022<br>
                                Bill Rp. 400.000<br>
                                KM 11.809
                            </td>
                            <td>
                                <a href="#" title="Detail" id="1" class="detail btn btn-icon btn-bg-light btn-active-color-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop1"><i class="bi bi-search"></i></a>
                                <a href="#" title="Finding" id="1" class="finding btn btn-icon btn-bg-light btn-active-color-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop2"><i class="bi bi-ui-checks"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </p>
        </div>
    </div>

    <!-- modal-->
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
                <button type="button" class="btn btn-primary">Service Tambahan</button>
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
            dom: '<"html5buttons">Brtlip',
        });

    } );
</script>
@endsection


