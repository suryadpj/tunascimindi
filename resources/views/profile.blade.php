@extends('layouts.master')

@section('content')
<!-- user information -->
<div class="card shadow-sm mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-auto">
                <figure class="avatar avatar-60 rounded-10">
                    @if (Auth::user()->fotoprofilpath)
                        <img src="../{{ Auth::user()->fotoprofilpath }}" alt="">
                    @else
                        <img src="assets_loginv2/img/logo_tunas.png" alt="">
                    @endif
                </figure>
            </div>
            <div class="col px-0 align-self-center">
                <h3 class="mb-0 text-color-theme">{{ Auth::user()->name }}</h3>
                <p class="text-muted ">{{ Auth::user()->city }}</p>
            </div>
        </div>
    </div>
    <div class="card-body">
        <p class="text-muted mb-3">
            <table width="100%">
                <tr>
                    <th>Nomor Rangka</th>
                    <th>:</th>
                    <td>{{ $profil->vincode }}</td>
                </tr>
                <tr>
                    <th>Nomor HP</th>
                    <th>:</th>
                    <td>{{ Auth::user()->phone }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <th>:</th>
                    <td>{{ $profil->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <th>Hobi</th>
                    <th>:</th>
                    <td>{{ $profil->hobi }}</td>
                </tr>
                <tr>
                    <th>Makanan & Minuman</th>
                    <th>:</th>
                    <td>{{ $profil->food_drink }}</td>
                </tr>
            </table>
        </p>
        <div class="row">
            <div class="col d-grid">
                <button class="updateprofil btn btn-default btn-md shadow-sm" id="{{ $profil->vincode }}">Update Profil</button>
            </div>
            <div class="col d-grid">
                <button class="btn btn-default btn-md shadow-sm">Ganti Password</button>
            </div>
        </div>
    </div>
</div>

<!-- followers and connections -->
<div class="row mb-4 text-center py-4 bg-theme-light">
    <div class="col">
        <p class="text-muted small">Mobil</p>
        <h6 class="mb-0">{{ $profil->unit }}</h6>
    </div>
    <div class="col">
        <p class="text-muted small">Tahun</p>
        <h6 class="mb-0">{{ $profil->tahun }}</h6>
    </div>
    <div class="col">
        <p class="text-muted small">Nomor Polisi</p>
        <h6 class="mb-0">{{ $profil->no_polisi }}</h6>
    </div>
</div>

<!-- summary -->
<div class="row mb-3">
    <div class="col">
        <div class="card shadow-sm mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto px-0">
                        <div class="avatar avatar-40 bg-warning text-white shadow-sm rounded-10-end">
                            <i class="bi bi-credit-card"></i>
                        </div>
                    </div>
                    <div class="col">
                        <p class="text-muted size-12 mb-0">Membership</p>
                        <p>
                            @switch($profil->membership)
                                @case(1)
                                    Platinum
                                @break
                                @case(2)
                                    Gold Member
                                @break
                                @case(3)
                                    Silver Member
                                @break
                                @case(4)
                                    Bronze Member
                                @break
                                @case(5)
                                    New Member
                                @break
                                @default
                                    Member
                            @endswitch
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col">
        <div class="card shadow-sm mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto px-0">
                        <div class="avatar avatar-40 bg-warning text-white shadow-sm rounded-10-end">
                            <i class="bi bi-credit-card"></i>
                        </div>
                    </div>
                    <div class="col">
                        <p class="text-muted size-12 mb-0">Masa Berlaku STNK sampai</p>
                        <p>
                            @if ($profil->masa_berlaku_stnk == "0000-00-00")
                                Anda belum mengisi masa berlaku STNK, silahkan dilengkapi
                            @else
                                {{ $profil->berlakustnk }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="profilemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formprofil">
                @csrf
                <input type="hidden" name="hidden_id" id="hidden_id" />
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table width="100%">
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>:</th>
                            <td><input class="form-control" type="text" id="nama" name="nama"></td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <th>:</th>
                            <td><input class="form-control" type="date" name="tanggallahir" id="tanggallahir"></td>
                        </tr>
                        <tr>
                            <th>Nomor HP (contoh: 0812xxx)</th>
                            <th>:</th>
                            <td><input class="form-control" type="text" name="nomorhp" placeholder="Nomor HP" id="nomorhp"></td>
                        </tr>
                        <tr>
                            <th>Foto Profil</th>
                            <th>:</th>
                            <td><input class="form-control" type="file" name="file" id="formFile" accept="image/jpeg,image/png,image/jpg"></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th>:</th>
                            <td><input class="form-control" type="email" name="email" placeholder="Email" id="email"></td>
                        </tr>
                        <tr>
                            <th>Nomor Rangka</th>
                            <th>:</th>
                            <td><input type="text" readonly class="form-control-plaintext" id="nomor_rangka"></td>
                        </tr>
                        <tr>
                            <th>Nomor Polisi</th>
                            <th>:</th>
                            <td><input class="form-control" type="text" name="nopolisi" id="nopolisi" placeholder="Nomor Polisi"></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <th>:</th>
                            <td><input class="form-control" type="text" name="alamat" id="alamat" placeholder="Alamat tinggal"></td>
                        </tr>
                        <tr>
                            <th>Kota</th>
                            <th>:</th>
                            <td><input class="form-control" type="text" name="kota" id="kota" placeholder="Kota domisili"></td>
                        </tr>
                        <tr>
                            <th>Hobi</th>
                            <th>:</th>
                            <td><input class="form-control" type="text" name="hobi" id="hobi" placeholder="Hobi"></td>
                        </tr>
                        <tr>
                            <th>Makanan & Minuman Favorit</th>
                            <th>:</th>
                            <td><input class="form-control" type="text" name="fooddrink" id="fooddrink" placeholder="Makanan & minuman favorit"></td>
                        </tr>
                        <tr>
                            <th>Masa berlaku STNK</th>
                            <th>:</th>
                            <td><input class="form-control" type="date" name="masastnk" id="masastnk"></td>
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
@endsection

@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('js')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready( function () {
        $('.updateprofil').click(function(){
            var id = $(this).attr('id');
            $('#formprofil')[0].reset();
            $.ajax({
                url:"profile/"+id,
                dataType:"json",
                success:function(html)
                {
                    $('#nama').val(html.data.name);
                    if(html.data.tanggal_lahir != "0000-00-00")
                    {
                        $('#tanggallahir').val(html.data.tanggal_lahir);
                    }
                    $('#nomorhp').val(html.data.phone);
                    $('#email').val(html.data.email);
                    $('#nomor_rangka').val(html.data.nomor_rangka);
                    $('#alamat').val(html.data.address);
                    $('#nopolisi').val(html.data.no_polisi);
                    $('#kota').val(html.data.city);
                    $('#hobi').val(html.data.hobi);
                    $('#fooddrink').val(html.data.food_drink);
                    if(html.data.masa_berlaku_stnk != "0000-00-00")
                    {
                        $('#masastnk').val(html.data.masa_berlaku_stnk);
                    }
                    $('#hidden_id').val(html.data.nomor_rangka);
                    $('#action_button').val("Update Profil");
                    $('#action').val("book");
                    $('#profilemodal').modal('show');
                }
            })
        });

        $('#formprofil').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:"{{ route('profile.store') }}",
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
                        $('#profilemodal').modal('hide');
                        $('#formprofil')[0].reset();
                        $('#action_button').html('Save changes').attr('disabled', false);
                        swal.fire({
                            icon: 'success',
                            title: 'Data berhasil disimpan',
                            text: 'Data profil berhasil dirubah. Terima kasih'
                        })
                        location.reload();
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


