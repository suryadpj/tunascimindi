@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col">
<form id="formprofil">
    @csrf
    <input type="hidden" name="hidden_id" id="hidden_id" value="{{ $datae->nomor_rangka }}" />
    <div class="modal-header">
    <h5 class="modal-title" id="staticBackdropLabel">Lengkapi Profil Anda</h5>
    </div>
    <div class="modal-body">
        <table width="100%">
            <tr>
                <th>Nama Lengkap</th>
                <th>:</th>
                <td><input class="form-control" type="text" id="nama" name="nama" value="{{ $datae->name }}"></td>
            </tr>
            <tr>
                <th>Tanggal Lahir</th>
                <th>:</th>
                <td><input class="form-control" type="date" name="tanggallahir" id="tanggallahir" value="{{ $datae->tanggal_lahir }}"></td>
            </tr>
            <tr>
                <th>Nomor HP (contoh: 0812xxx)</th>
                <th>:</th>
                <td><input class="form-control" type="text" name="nomorhp" placeholder="Nomor HP" id="nomorhp" value="{{ $datae->phone }}"></td>
            </tr>
            <tr>
                <th>Foto Profil</th>
                <th>:</th>
                <td><input class="form-control" type="file" name="file" id="formFile" accept="image/jpeg,image/png,image/jpg"></td>
            </tr>
            <tr>
                <th>Email</th>
                <th>:</th>
                <td><input class="form-control" type="email" name="email" placeholder="Email" id="email" value="{{ $datae->email }}"></td>
            </tr>
            <tr>
                <th>Nomor Rangka</th>
                <th>:</th>
                <td><input type="text" readonly class="form-control" id="nomor_rangka" value="{{ $datae->nomor_rangka }}"></td>
            </tr>
            <tr>
                <th>Nomor Polisi</th>
                <th>:</th>
                <td><input class="form-control" type="text" name="nopolisi" id="nopolisi" placeholder="Nomor Polisi" value="{{ $datae->no_polisi }}"></td>
            </tr>
            <tr>
                <th>Alamat</th>
                <th>:</th>
                <td><input class="form-control" type="text" name="alamat" id="alamat" placeholder="Alamat tinggal" value="{{ $datae->address }}"></td>
            </tr>
            <tr>
                <th>Kota</th>
                <th>:</th>
                <td><input class="form-control" type="text" name="kota" id="kota" placeholder="Kota domisili" value="{{ $datae->city }}"></td>
            </tr>
            <tr>
                <th>Hobi</th>
                <th>:</th>
                <td><input class="form-control" type="text" name="hobi" id="hobi" placeholder="Hobi" value="{{ $datae->hobi }}"></td>
            </tr>
            <tr>
                <th>Makanan & Minuman Favorit</th>
                <th>:</th>
                <td><input class="form-control" type="text" name="fooddrink" id="fooddrink" placeholder="Makanan & minuman favorit" value="{{ $datae->food_drink }}"></td>
            </tr>
            <tr>
                <th>Masa berlaku STNK</th>
                <th>:</th>
                <td><input class="form-control" type="date" name="masastnk" id="masastnk" value="{{ $datae->masa_berlaku_stnk }}"></td>
            </tr>
        </table>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="action" id="action" />
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Skip</button>
        <button type="submit" name="action_button" value="Add" id="action_button" class="btn btn-primary">Save Data</button>
    </div>
</form>
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


