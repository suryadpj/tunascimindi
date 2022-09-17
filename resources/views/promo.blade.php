@extends('layouts.master')

@section('content')
    <div class="row mb-3">
        <div class="col">
            <h6 class="title">{{ $profil->promo }}</h6>
        </div>
    </div>
    <div class="row">
        @foreach ($datapromo as $a)
            <div class="col-12 col-md-6 col-lg-4">
                <a class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                <div class="avatar avatar-60 shadow-sm rounded-10 coverimg">
                                    <img src="../{{ $a->img_src }}" alt="{{ $a->alt }}">
                                </div>
                            </div>
                            <div class="col align-self-center ps-0">
                                <p title="rekomendasi" class="text-color-theme mb-1">{{ $a->alt }}</p>
                                <p class="text-muted size-12">{{ $a->penjelasan }}</p>
                                <br>
                                <div class="row">
                                    <div class="col-auto align-self-center">
                                        @if ($a->jempol == 1)
                                            <button type="button" class="btn btn-primary" title="Rekomendasi" data-toggle="tooltip" data-placement="left" title="Tooltip on left"><i class="bi bi-hand-thumbs-up-fill" title="Rekomendasi"></i></button>
                                        @endif
                                        <button type="button" class="btn btn-primary like" id="{{ $a->ID }}"><i class="bi bi-heart-fill"></i>
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="jumlahlike{{ $a->ID }}">
                                            {{ $a->like }}
                                            </span>
                                        </button>
                                    </div>
                                    <div class="col align-self-center text-end">
                                        <button type="button" class="booknow btn btn-primary text-end" id="{{ $a->ID }}">Book Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
        @if ($datapromocount == 0)
            <br>
            <br>
            <br>
            <br>
            <h4 align="center"><br>Nantikan promo terbaik dari kami</h4>
        @endif

    <!-- modal-->
    <div class="modal fade" id="booknowmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formbooknow">
                    @csrf
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Book Now</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table width="100%">
                            <tr>
                                <th>Nama Promo</th>
                                <th>:</th>
                                <td><input type="text" readonly class="form-control-plaintext" id="nama_promo"></td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <th>:</th>
                                <td><input class="form-control" type="date" name="tanggal"></td>
                            </tr>
                            <tr>
                                <th>Time</th>
                                <th>:</th>
                                <td><input class="form-control" type="time" name="waktu"></td>
                            </tr>
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
                        <button type="submit" name="action_button" value="Add" id="action_button" class="btn btn-primary">Save Data</button>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready( function () {
        var oTable = $('#myTable').DataTable({
            responsive: true,
            dom: '<"html5buttons">Brtlip',
        });
        $(document).on('click', '.like', function(){
            var id = $(this).attr('id');
            $.ajax({
                type: "PATCH",
                url: "promo/"+id,
                dataType: 'JSON',
                data:{
                    'id': id,
                    '_token': '{{ csrf_token() }}',
                },
                success: function (data) {
                    if(data.duplicate)
                    {
                        console.log('sudah pernah like')
                    }
                    else if(data.success)
                    {
                    console.log(data.success);
                    $('#jumlahlike'+id).html(data.success);
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
        $('.booknow').click(function(){
            var id = $(this).attr('id');
            $('#formbooknow')[0].reset();
            $.ajax({
                url:"promo/"+id,
                dataType:"json",
                success:function(html)
                {
                    $('#nama_promo').val(html.data.alt);
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
                url:"{{ route('promo.store') }}",
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
                            text: 'Data booking anda akan diteruskan dan petugas kami akan menghubungi anda. Terima kasih'
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


