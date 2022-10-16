@extends('adminlte::page')

@section('title', 'Data Trade-in')

@section('content_header')
    <h1 class="m-0 text-dark">Trade in Data</h1>
@stop

@section('content')
<div class="row">
<div class="col-md-12">
    <div class="card card-primary">
        <form id="sample_form">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" autocomplete="off" class="form-control" name="search_nama" placeholder="Nama Pelanggan">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" autocomplete="off" class="form-control" name="search_nomorrangka" placeholder="Nomor Rangka">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="date" autocomplete="off" class="form-control" name="search_tanggal" placeholder="tanggal">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <button type="submit" id="filter_button" class="btn btn-primary percent"><i class="fas fa-search"></i> Cari</button>
                            <button type="button" id="reset_filter_button" class="btn percent"><i class="fas fa-undo"></i> Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div align="right">
                    <!-- <button type="button" name="create_barang" id="create_barang" class="btn btn-info btn-sm">Tambah Nama Barang</button> -->
                    {{-- <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah Data</button> --}}
                </div>
                <div class="card-body table-responsive p-0">
                <span id="form_result_save"></span>
                    <br>
                    <form method="post" class="form-horizontal" enctype="multipart/form-data" id="updatesalesform">
                        @csrf
                        <input type="hidden" name="hidden_id" id="idcheck">
                        <table id="user_table" class="table table-bordered table-hover table-striped table-hover ajaxTable datatable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Nomor HP</th>
                                    <th>Kendaraan</th>
                                    <th>Penghitungan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                        <br>
                        @if($user->admin == 1)
                            <div class="row">
                                <div class="col-sm-2">
                                    <label>Update Status :</label>
                                    <div class="form-group">
                                        <select class="form-control select2" name="statustradein">
                                            <option>Pilih status</option>
                                            <option value="2">Dihubungi</option>
                                            <option value="3">Done</option>
                                            <option value="4">Cancel</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <label>Submit data</label>
                                    <div class="form-group">
                                        <button type="submit" id="update_button" class="btn btn-primary percent">Update Data</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />
@stop

@section('js')
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.select2').select2();

    $(".datepicker").daterangepicker({
        singleDatePicker: true,
        autoApply: true,
        autoUpdateInput: true,
        showDropdowns: true,
        minYear: 2016,
        "locale": {
            "format": "YYYY-MM-DD",
            "separator": " - ",
            "daysOfWeek": [
                "Mg",
                "Sn",
                "Sl",
                "Rb",
                "Km",
                "Jm",
                "Sa"
            ],
            "monthNames": [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Agustus",
                "September",
                "Oktober",
                "November",
                "Desember"
            ],
        }
    });
    $('input[name="search_tanggal"]').attr("placeholder","Tanggal Input");

    $(".datepickerrange").daterangepicker({
        autoApply: true,
        showDropdowns: true,
        minYear: 2016,
        "locale": {
            "format": "YYYY-MM-DD",
            "separator": " sd ",
            "daysOfWeek": [
                "Mg",
                "Sn",
                "Sl",
                "Rb",
                "Km",
                "Jm",
                "Sa"
            ],
            "monthNames": [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Agustus",
                "September",
                "Oktober",
                "November",
                "Desember"
            ],
        }
    });
    $('input[name="search_tanggal"]').attr("placeholder","Tanggal Periode Input");

    var oTable = $('#user_table').DataTable({
        processing: true,
        lengthMenu : [[10, 25, 50, -1], [10, 25, 50, "All"]],
        serverSide: true,
        retrieve: true,
        dom: '<"html5buttons">Brtipl',
        "order": [[ 1, "desc" ]],
        buttons : [
                    {extend: 'pdf', title:'Data Trade-in Tunas Toyota Cimindi', "action": newexportaction},
                    {extend: 'excel', title: 'Data Trade-in Tunas Toyota Cimindi', "action": newexportaction},
                    {extend:'print',title: 'Data Trade-in Tunas Toyota Cimindi'},
        ],
        ajax:{
            url: "{{ route('tradein.index') }}",
            data: function (d) {
                d.namapelanggan = $('input[name=search_nama]').val();
                d.nomorrangka = $('input[name=search_nomorrangka]').val();
                d.domisili = $('input[name=search_domisili]').val();
                d.tanggalreservasi = $('input[name=search_tanggal]').val();
                d.membership = $("#search_membership option:selected").val();
            }
        },
        columns: [
            {"data":"ID"},
            { "data": null,"sortable": false,
                render: function (data, type, row, meta) {
                 return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {"data":"name"},
            {"data":"phone"},
            {"data":"kolom_kedua"},
            {"data":"hitung"},
            {"data":"action",orderable: false},
        ],
      'columnDefs': [
         {
            'targets': 0,
            'checkboxes': {
               'selectRow': true
            }
         }
      ],
      'select': {
         'style': 'multi'
      },
    });

    function newexportaction(e, dt, button, config) {
        var self = this;
        var oldStart = dt.settings()[0]._iDisplayStart;
        dt.one('preXhr', function (e, s, data) {
            // Just this once, load all data from the server...
            data.start = 0;
            data.length = 2147483647;
            dt.one('preDraw', function (e, settings) {
                // Call the original action function
                if (button[0].className.indexOf('buttons-copy') >= 0) {
                    $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                    $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                    $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                    $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-print') >= 0) {
                    $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                }
                dt.one('preXhr', function (e, s, data) {
                    // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                    // Set the property to what it was before exporting.
                    settings._iDisplayStart = oldStart;
                    data.start = oldStart;
                });
                // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                setTimeout(dt.ajax.reload, 0);
                // Prevent rendering of the full data to the DOM
                return false;
            });
        });
        // Requery the server with the new one-time export settings
        dt.ajax.reload();
    }


   $('#updatesalesform').on('submit', function(e){
        var form = this;
        e.preventDefault();
        var id = "";

        var rows_selected = oTable.column(0).checkboxes.selected();
        console.log(rows_selected[0])

        // Iterate over all selected checkboxes
        $.each(rows_selected, function(index, rowId){
            id = id + rowId + ',';
        });
        $('#idcheck').val(id);

        $.ajax({
            url: "tradein",
            method:"POST",
            data: new FormData(this),
            contentType: false,
            cache:false,
            processData: false,
            dataType:"json",
            success: function (data) {
                oTable.draw();
                Swal.fire('Data berhasil diperbarui', '', 'success')
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
   });

    $('#sample_form').on('submit', function(e) {
        oTable.draw();
        e.preventDefault();
            $.ajax({
                beforeSend:function(){
                    $('#filter_button').html('<i disable class="fa fa-spinner fa-spin"></i>').attr('disabled', true);
                },
                success:function(){
                        $('#filter_button').html('<i class="fas fa-search"></i> Cari').attr('disabled', false);
                    }
                });
    });
    $('#reset_filter_button').click(function(){
        $('#sample_form')[0].reset();
        $('.select2').val(null).trigger('change');
        oTable.draw();
        $.ajax({
            beforeSend:function(){
                $('#reset_filter_button').html('<i class="fas fa-spinner fa-spin"></i>').attr('disabled', true);
            },
            success:function(){
                    $('#reset_filter_button').html('<i class="fas fa-undo"></i> Reset').attr('disabled', false);
                }
            });
    });

    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        var idd = $(this).data('id');
        Swal.fire({
            title: "Apakah anda yakin akan menghapus data ini ?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak jadi',
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                var id = $(this).attr('id');
                $.ajax({
                    type: "DELETE",
                    url: "tradein/"+id,
                    dataType: 'JSON',
                    data:{
                        'id': id,
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (data) {
                        oTable.draw();
                        Swal.fire('Data berhasil dihapus', '', 'success')
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        })
    });

});
</script>
@stop
