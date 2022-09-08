@extends('adminlte::page')

@section('title', 'Dashboard - TCC Backend')

@section('content_header')
    <h1 class="m-0 text-dark">Slider Depan</h1>
@stop

@section('content')
<div class="row">
<div class="col-md-12">
    <div class="card card-primary">
        <form id="sample_form">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input type="text"autocomplete="off" id="search_tanggal" Name="search_tanggal" class="form-control form-control-solid w-250px datepickerrange" placeholder="Search tanggal"/>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input type="text" autocomplete="off" class="form-control" name="search_judul" placeholder="Filter data judul">
                        </div>
                    </div>
                    <div class="col-sm-4">
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
                <div class="card-body table-responsive p-0">
                <span id="form_result_save"></span>
                    <div align="right">
                        <!-- <button type="button" name="create_barang" id="create_barang" class="btn btn-info btn-sm">Tambah Nama Barang</button> -->
                        <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah Data</button>
                    </div>
                    <br>
                    <table id="user_table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Creator</th>
                                <th>Judul</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
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
                        <label for="perihal" class="col-sm-5 col-form-label">Segmen</label>
                        <div class="col-sm-7">
                            <select class="form-control select2" name="segmen" id="segmen"  style="width: 100%;">
                                <option value=''>Pilih Segmen</option>
                                    <option value="1">Service Berkala</option>
                                    <option value="2">General Repair</option>
                                    <option value="3">Body & Paint</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="perihal" class="col-sm-5 col-form-label">Judul Slide</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="judul" id="judul" placeholder="Perihal">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="formFile"  class="col-sm-5 col-form-label">Upload Gambar</label>
                        <div class="col-sm-7">
                            <span id="lampiran"></span>
                            <input class="form-control" type="file" name="file" id="formFile" accept="image/jpeg,image/png,image/jpg">
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
@stop

@section('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@stop

@section('js')
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

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
        dom: '<"html5buttons">Brtipl',
        "order": [[ 1, "desc" ]],
        buttons : [
                    {extend: 'pdf', title:'Data Cost Control DISA ', "action": newexportaction},
                    {extend: 'excel', title: 'Data Cost Control DISA', "action": newexportaction},
                    {extend:'print',title: 'Contoh Print Datatables'},
        ],
        ajax:{
            url: "{{ route('halamandepan.index') }}",
            data: function (d) {
                d.judul = $('input[name=judul]').val();
                d.search_tanggal = $('input[name=search_tanggal]').val();
                d.kategori = $("#kategori option:selected").val();
            }
        },
        columns: [
            { "data": null,"sortable": false,
                render: function (data, type, row, meta) {
                 return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {"data":"kolom_kedua"},
            {"data":"kolom_ketiga"},
            {"data":"action",orderable: false},
        ],
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

    $('#sample_form').on('submit', function(e) {
        oTable.draw();
        e.preventDefault();
            $.ajax({
                beforeSend:function(){
                    $('#filter_button').html('<i disable class="fa fa-spinner fa-spin"></i>').attr('disabled', true);
                },
                success:function(){
                        $('#filter_button').html('<i class="fas fa-search"></i>').attr('disabled', false);
                    }
                });
    });
    $('#reset_filter_button').click(function(){
        $('#sample_form')[0].reset();
        $('.select2').val(null).trigger('change');
        oTable.draw();
        $.ajax({
            beforeSend:function(){
                $('#reset_filter_button').html('<i class="fas fa-undo"></i>').attr('disabled', true);
            },
            success:function(){
                    $('#reset_filter_button').html('<i class="fas fa-undo"></i>').attr('disabled', false);
                }
            });
    });

//data catatan
    $('#create_record').click(function(){
        $('#sample_form2')[0].reset();
        $('.select2').val(null).trigger('change');
        $('.select2').select2();
        $('#lampiran').html('');
        // $('#cari').val(null).trigger('change');
        // $('#area').val(null).trigger('change');
        $('.modal-title').text("Data Slider Halaman Depan Baru");
        $('#action_button').val("Add");
        $('#action').val("Add");
        $('#modal_catatan').modal('show');
    });

    $('#sample_form2').on('submit', function(event){
        event.preventDefault();
        if($('#action').val() == 'Add')
        {

            $.ajax({
                url:"{{ route('halamandepan.store') }}",
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
        }

        if($('#action').val() == "Edit")
        {

            $.ajax({
                url:"{{ route('halamandepan.updated') }}",
                method:"POST",
                data:new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType:"json",
                beforeSend:function(){
                    $('#action_button').html('<i class="fa fa-spinner fa-spin"></i>').attr('disabled', true);
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
                        html += '</div>';
                        iziToast.error({
                            title: 'Gagal',
                            // timeout: 20000,
                            message: html,
                            animateInside: true,
                            pauseOnHover: true,
                            close: true,
                            position: 'topCenter',
                        });

                        $('#action_button').html('Save Data').attr('disabled', false);
                    }
                    if(data.success)
                    {
                        $('#modal_catatan').modal('hide');
                        $('#sample_form2')[0].reset();
                        $('.textarea').summernote('reset');
                        $('#action_button').html('Save Data').attr('disabled', false);

                        $('#user_table').DataTable().ajax.reload();
                        iziToast.success({
                            title: 'Berhasil',
                            // timeout: 20000,
                            message: data.success,
                            animateInside: true,
                            pauseOnHover: true,
                            close: true,
                            position: 'topCenter',
                        });
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    toastr["error"](errorMessage);
                    $('#action_button').html('Simpan Data').attr('disabled', false);
                }
            });
        }
    });

    $(document).on('click', '.edit', function(){
        var id = $(this).attr('id');
        $('#form_result').html('');
        $.ajax({
            url:"slider/halamandepan/"+id,
            dataType:"json",
            success:function(html)
            {
                $('#datepicker').val(html.data.tanggal_pengajuan);
                $('#datepicker2').val(html.data.periode_penggunaan);
                $('#nota_dinas').val(html.data.nota_dinas);
                $('#tanggal_email').val(html.data.tanggal_email);
                $('#nomor_nd_cabang').val(html.data.nomor_nd_cabang);
                $('#nilai_po').val(html.data.nota_dinas);
                $('#nilai_pengiriman').val(html.data.nota_dinas);
                $('#perihal').val(html.data.perihal);

                $('#nilai').val(html.data.nilai);
                $('#select2').select2();
                if(html.data.kategori == 1)
                {
                    var newOption = new Option('Nota Dinas', html.data.kategori, true, true);
                    $('#kategorii').append(newOption).trigger('change');
                }else if(html.data.kategori == 2)
                {
                    var newOption = new Option('Purchase Request', html.data.kategori, true, true);
                    $('#kategorii').append(newOption).trigger('change');
                }else if(html.data.kategori == 3)
                {
                    var newOption = new Option('Invoice', html.data.kategori, true, true);
                    $('#kategorii').append(newOption).trigger('change');
                }
                if(html.data.IDSegmen > 0)
                {
                    var newOption2 = new Option(html.data.namasegmen, html.data.IDSegmen, true, true);
                    $('#segmen').append(newOption2).trigger('change');
                }
                var newOption = new Option(html.data.inisial + ' - ' + html.data.nama_area, html.data.IDArea, true, true);
                $('#area').append(newOption).trigger('change');
                if(html.data.IDKontrak > 0)
                {
                    if(html.data.nomor_kontrak == "")
                    {
                        var newOption = new Option(html.data.project_number + '- Tidak ada nomor kontrak - ' + html.data.keterangan, html.data.IDKontrak, true, true);
                    }
                    else
                    {
                        var newOption = new Option(html.data.project_number + ' - ' + html.data.nomor_kontrak + ' - ' + html.data.keterangan, html.data.IDKontrak, true, true);
                    }
                    $('#kontrak').append(newOption).trigger('change');
                }
                if(html.data.nama_file != "")
                {
                    $('#lampiran').append('<a href="data_file/cost/' + html.data.nama_file + '">' + html.data.nama_file + '</a>');
                }
                else
                {
                    $('#lampiran').html('');
                }
                $('#hidden_id').val(html.data.ID);
                $('.modal-title').text("Edit Cost Data");
                $('#action_button').val("Edit");
                $('#action').val("Edit");
                $('#modal_catatan').modal('show');
            }
        })
    });

    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        var idd = $(this).data('id');
        Swal.fire({
            title: "Apakah anda yakin akan menghapus gambar ini ?",
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
                    url: "halamandepan/"+id,
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
