@extends('adminlte::page')

@section('title', 'Sosial Media Data')

@section('content_header')
    <h1 class="m-0 text-dark">Sosial Media</h1>
@stop

@section('content')
<div class="row">
<div class="col-md-12">
    <div class="card card-primary">
        <form id="sample_form">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" autocomplete="off" class="form-control" name="search_nama" placeholder="Nama Sosial Media">
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <button type="submit" id="filter_button" class="btn btn-primary percent"><i class="fas fa-search"></i> Cari</button>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
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
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Link</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="modal_catatan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="sample_form2" class="form-horizontal" enctype="multipart/form-data">
                <span id="form_result"></span>
                @csrf
                <input type="hidden" name="hidden_id" id="hidden_id" />
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="formFile"  class="col-sm-5 col-form-label">Ketegori File</label>
                        <div class="col-sm-7">
                            <select class="form-control select2" name="kategori_upload" id="kategori_upload" style="width: 100%;">
                                <option value=0 selected>Pilih Kategori</option>
                                <option value="1">Data Customer Lama</option>
                                <option value="2">Data DO</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="formFile"  class="col-sm-5 col-form-label">Upload File Customer</label>
                        <div class="col-sm-7">
                            <span id="lampiran"></span>
                            <input class="form-control" type="file" name="file" id="formFile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="action" id="action" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="action_button" value="Add" id="action_button" class="btn btn-primary">Save Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="modaleditcustomer">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="edit_form" class="form-horizontal" enctype="multipart/form-data">
                <span id="form_result"></span>
                @csrf
                <input type="hidden" name="hidden_id2" id="hidden_id2" />
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nama :</label>
                                <input type="text" autocomplete="off" name="nama" id="nama" class="form-control" readonly/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Link :</label>
                                <input type="text" autocomplete="off" class="form-control" name="link" id="link" placeholder="Link Sosial Media">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="action2" id="action2" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="action_button2" value="Add" id="action_button2" class="btn btn-primary">Save Data</button>
                </div>
            </form>
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
                    {extend: 'pdf', title:'Data Customer Tunas Toyota Cimindi', "action": newexportaction},
                    {extend: 'excel', title: 'Data Customer Tunas Toyota Cimindi', "action": newexportaction},
                    {extend:'print',title: 'Data Customer Tunas Toyota Cimindi'},
        ],
        ajax:{
            url: "{{ route('sosialmedia.index') }}",
            data: function (d) {
                d.nama_sosmed = $('input[name=search_nama]').val();
            }
        },
        columns: [
            { "data": null,"sortable": false,
                render: function (data, type, row, meta) {
                 return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {"data":"nama"},
            {"data":"link"},
            {"data":"action",orderable: false},
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
            url: "customer/tosales",
            method:"POST",
            data: new FormData(this),
            contentType: false,
            cache:false,
            processData: false,
            dataType:"json",
            success: function (data) {
                oTable.draw();
                Swal.fire('Data berhasil dihapus', '', 'success')
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

    $(document).on('click', '.edit', function(){
        var id = $(this).attr('id');
        console.log('edit')
        $.ajax({
            url:"sosialmedia/"+id,
            dataType:"json",
            success:function(html)
            {
                $('#edit_form')[0].reset();
                $('#nama').val(html.data.nama);
                $('#link').val(html.data.link);
                $('#hidden_id2').val(html.data.id);
                $('.modal-title').text("Edit Sosial Media");
                $('#action_button2').val("Edit");
                $('#action2').val("Edit");
                $('#modaleditcustomer').modal('show');
            }
        })
    });

    $('#edit_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:"{{ route('sosialmedia.updatedata') }}",
            method:"POST",
            data: new FormData(this),
            contentType: false,
            cache:false,
            processData: false,
            dataType:"json",
            beforeSend:function(){
                $('#action_button2').html('<i disable class="fa fa-spinner fa-spin"></i>').attr('disabled', true);
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

                    $('#action_button2').html('Save changes').attr('disabled', false);
                }
                if(data.duplicate)
                {
                    swal.fire({
                        icon: 'warning',
                        title: 'Data gagal disimpan',
                        text: html
                    })

                    $('#action_button2').html('Save changes').attr('disabled', false);
                }
                if(data.success)
                {
                    $('#modaleditcustomer').modal('hide');
                    $('#edit_form')[0].reset();
                    oTable.draw();
                    $('#action_button2').html('Save changes').attr('disabled', false);
                    $('#user_table').DataTable().ajax.reload();
                    swal.fire({
                        icon: 'success',
                        title: 'Data berhasil disimpan',
                        text: data.success
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

                $('#action_button2').html('Save changes').attr('disabled', false);
            }
        })
    });
    $('#sample_form2').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:"{{ route('customer.store') }}",
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
                    $('#modal_catatan').modal('hide');
                    $('#sample_form2')[0].reset();
                    oTable.draw();
                    $('#action_button').html('Save changes').attr('disabled', false);
                    $('#user_table').DataTable().ajax.reload();
                    swal.fire({
                        icon: 'success',
                        title: 'Data berhasil disimpan',
                        text: data.success
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

    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        var idd = $(this).data('id');
        Swal.fire({
            title: "Apakah anda yakin akan menghapus data ini ?. Customer tidak akan bisa login jika tidak memiliki data disini",
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
                    url: "customer/"+id,
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
