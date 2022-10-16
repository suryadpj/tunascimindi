@extends('layouts.master')

@section('content')
<!-- Contact us form -->
<div class="row mb-4">
    <form id="formdata">
        @csrf
    <div class="col-12 col-md-6 col-lg-4 mx-auto">
        <h3 class="mb-2 text-center text-color-theme">Kritik & Saran</h3>
        {{-- <p class="text-muted mb-4 text-center">Get in touch with us, We give you exact and right
            information to you!</p> --}}

        <div class="form-floating mb-3">
            <select class="form-control" id="country" required name="jasa">
                <option selected value=0>Pilih salah satu</option>
                <option value="1">Sales</option>
                <option value="2">Service</option>
            </select>
            <label for="country">Pilih Sales / Service</label>
        </div>
        <div class="form-floating  mb-3">
            <textarea class="form-control h-auto" name="kritik" placeholder="Your Query" id="kritik">Silahkan masukkan kritik anda</textarea>
            <label for="kritik">kritik</label>
        </div>
        <div class="form-floating  mb-3">
            <textarea class="form-control h-auto" name="saran" placeholder="Your Query" id="confirmpassword">Silahkan masukkan saran anda</textarea>
            <label for="confirmpassword">Saran</label>
        </div>
        <button type="submit" id="action_button" class="btn btn-default btn-lg w-100">Submit</button>
    </div>
    </form>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('js')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready( function () {
        var oTable = $('#myTable').DataTable({
            responsive: true,
            dom: '<"html5buttons">Brtlip',
        });
        var oTable2 = $('#myTable2').DataTable({
            responsive: true,
        });
        $('.referensi').click(function(){
            $('#formreferensi')[0].reset();
            $('.referensi-title').text("Referensi Baru");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#referensiform').modal('show');
            bsCustomFileInput.init();
        });
    $('.slider').slick({
        lazyLoad: 'ondemand',
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight: true,
        autoplay: true,
        autoplaySpeed: 3500,
        dots: true,
        arrows: false,
        pauseOnHover:true
    });

        $('#formdata').on('submit', function(event){
            event.preventDefault();
                $.ajax({
                    url:"{{ route('kritiksaran.store') }}",
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
                            $('#action_button').html('Save changes').attr('disabled', false);
                            swal.fire({
                                icon: 'success',
                                title: 'Data berhasil disimpan',
                                text: 'Kritik dan saran anda sangat membangun kami, Terima kasih'
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


