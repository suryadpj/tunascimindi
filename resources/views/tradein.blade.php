@extends('layouts.master')

@section('content')


<script type="text/javascript">(function() {    var rootScript = 'https://cdn.jsdelivr.net/npm/@flasher/flasher@1.1.0/dist/flasher.min.js';    var FLASHER_FLASH_BAG_PLACE_HOLDER = {};    var options = mergeOptions([], FLASHER_FLASH_BAG_PLACE_HOLDER);    function mergeOptions(first, second) {        return {            context: merge(first.context || {}, second.context || {}),            envelopes: merge(first.envelopes || [], second.envelopes || []),            options: merge(first.options || {}, second.options || {}),            scripts: merge(first.scripts || [], second.scripts || []),            styles: merge(first.styles || [], second.styles || []),        };    }    function merge(first, second) {        if (Array.isArray(first) && Array.isArray(second)) {            return first.concat(second).filter(function(item, index, array) {                return array.indexOf(item) === index;            });        }        return Object.assign({}, first, second);    }    function renderOptions(options) {        if(!window.hasOwnProperty('flasher')) {            console.error('Flasher is not loaded');            return;        }        window.flasher.render(options);    }    function render(options) {        if ('loading' !== document.readyState) {            renderOptions(options);            return;        }        document.addEventListener('DOMContentLoaded', function() {            renderOptions(options);        });    }    document.addEventListener('flasher:render', function (event) {        render(event.detail);    });    if (window.hasOwnProperty('flasher') || !rootScript || document.querySelector('script[src="' + rootScript + '"]')) {        render(options);    } else {        var tag = document.createElement('script');        tag.setAttribute('src', rootScript);        tag.setAttribute('type', 'text/javascript');        tag.onload = function () {            render(options);        };        document.head.appendChild(tag);    }})();</script>
    <div class="row mb-3">
        <div class="col">
            <h6 class="title">Trade-in</h6>
        </div>
    </div>
    <!-- wallet balance -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="col-12">
                <div class="slider">
                    <div>
                        <a class="popup">
                            <img src="assets_loginv2/img/tradeinimg.jpg" class="d-block w-100" alt="...">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 "  >
                <center>
                    <div class="p-3 form-style" style="background-color:white;">
                        <!-- delete class hide -->
                        <center id="main-form" class="show">
                            <!-- delete class hide -->
                            <h4 class="py-3">Isi Detail Mobil Anda</h4>
                            <table width="100%">
                                <tr align="center">
                                    <td><button id="btn-1" type="button" class="disable btn btn-primary btn-style btn-frm btn-form-active" onclick="OnMenuClick(this)"><b>MODEL</b></button></td>
                                    <td><button id="btn-2" type="button" class="btn btn-primary btn-style btn-frm btn-form-readonly" onclick="OnMenuClick(this)"><b>TAHUN</b></button></td>
                                </tr>
                                <tr align="center">
                                    <td><button id="btn-3" type="button" class="btn btn-primary btn-style btn-frm btn-form-readonly" onclick="OnMenuClick(this)"><b>VARIAN</b></button></td>
                                    <td><button id="btn-4" type="button" class="btn btn-primary btn-style btn-frm btn-form-readonly" onclick="OnMenuClick(this)"><b>TRANSMISI</b></button></td>
                                </tr>
                            </table>
                        </center>
                    <div id="rootComponent"></div>
                </center>
            </div>
        </div>
    </div>
@endsection

@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
<link rel="stylesheet" type="text/css" href="assets/css/custom_cimindi3.css" >
<style>
    ._3fL0U {
    display: inline-block;
    overflow-x: scroll;
    width: 100%;
    white-space: nowrap;
    overflow-y: hidden;
    vertical-align: middle;
    background-color: #fff;
}._3fL0U .b_bNc {
    display: inline-block;
    height: 31px;
    min-width: 58px;
    margin: 12px;
    padding: 6px 8px;
    border-radius: 8px;
    text-align: center;
    box-sizing: border-box;
    flex-shrink: 0;
    cursor: pointer;
    background-color: #c8f8f6;
}._3fL0U .b_bNc._3Sk-P {
    background-color: #002f34;
}
</style>
@endsection

@section('js')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript" src="http://afarkas.github.io/lazysizes/lazysizes.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script>
    $(document).ready( function () {
        var oTable = $('#myTable').DataTable({
            responsive: true,
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
        var temp1 = document.getElementById("btn-1");
        var temp2 = document.getElementById("form-1");
        var str1, str2;
        var selectedCarModel = null;
        var selectedCarYear = null;
        var selectedCarVariant = null;
        var selectedCarTransmition = null;
        $('#rootComponent').load('tradein/models/list', function() {
            console.log('HAPPY');
        });
    });

        function OnMenuClick(ele){
            countform = ele.id.split('-')[1] - 1;

            if(countform == 1) {
                $('#rootComponent').load('tradein/models/'+selectedCarModel+'/years');
            } else if(countform == 2) {
                $('#rootComponent').load('tradein/models/'+selectedCarModel+'/years/'+selectedCarYear+'/variants');
            } else if(countform == 3) {
                $('#rootComponent').load('tradein/models/'+selectedCarModel+'/years/'+selectedCarYear+'/variants/'+selectedCarVariant+'/transmisi');
            } else if(countform == 4) {
                $('#rootComponent').load('/cars/models/'+selectedCarModel+'/years/'+selectedCarYear+'/variants/'+selectedCarVariant+'/transmitions/'+selectedCarTransmition+'/detail');
            } else {
                $('#rootComponent').load('/cars/models');
            }

            // temp2.classList.add("hide");
            temp1.classList.remove("btn-form-active");
            temp1.classList.add("btn-form-readonly");
            temp1 =  ele;
            // temp2 = document.getElementById("form-"+countform);
            temp1.classList.add("btn-form-active");
            // temp2.classList.remove("hide");
            console.log(countform);

            // for(x=4;x>countform;x--){
            //     document.getElementById("btn-"+x).disabled = true;
            // }
        }

        function setupHttpHeaders() {
            $.ajaxSetup({
                'headers':{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }

        function OnOptionClick(ele){
            setupHttpHeaders();

            // data-* is an ID of every car's part
            selectedCarModel = ele.getAttribute('data-model');
            selectedCarYear = ele.getAttribute('data-year');
            selectedCarVariant = ele.getAttribute('data-variant');
            selectedCarTransmition = ele.getAttribute('data-transmition');

            var countform;
            countform = ele.id.split('-')[1];

            //load komponen berdasarkan step/langkah
            if(countform == 1) {
                $('#rootComponent').load('tradein/models/'+selectedCarModel+'/years');
                // temp2  = document.getElementById("form-"+countform);
                temp1  = document.getElementById("btn-"+countform);
                // temp2.classList.add("hide");
                temp1.classList.remove("btn-form-active");
                temp1.classList.add("btn-form-readonly");
                var nextcount = countform++;
                temp1 = document.getElementById("btn-"+countform);
                // temp2 = document.getElementById("form-"+countform);
                temp1.classList.remove("btn-form-readonly");
                temp1.classList.add("btn-form-active");
                // temp2.classList.remove("hide");
                temp1.disabled = false;
            } else if(countform == 2) {
                $('#rootComponent').load('tradein/models/'+selectedCarModel+'/years/'+selectedCarYear+'/variants');
                // temp2  = document.getElementById("form-"+countform);
                temp1  = document.getElementById("btn-"+countform);
                // temp2.classList.add("hide");
                temp1.classList.remove("btn-form-active");
                temp1.classList.add("btn-form-readonly");
                var nextcount = countform++;
                temp1 = document.getElementById("btn-"+countform);
                // temp2 = document.getElementById("form-"+countform);
                temp1.classList.remove("btn-form-readonly");
                temp1.classList.add("btn-form-active");
                // temp2.classList.remove("hide");
                temp1.disabled = false;
            } else if(countform == 3) {
                $('#rootComponent').load('tradein/models/'+selectedCarModel+'/years/'+selectedCarYear+'/variants/'+selectedCarVariant+'/transmisi');
                // temp2  = document.getElementById("form-"+countform);
                temp1  = document.getElementById("btn-"+countform);
                // temp2.classList.add("hide");
                temp1.classList.remove("btn-form-active");
                temp1.classList.add("btn-form-readonly");
                var nextcount = countform++;
                temp1 = document.getElementById("btn-"+countform);
                // temp2 = document.getElementById("form-"+countform);
                temp1.classList.remove("btn-form-readonly");
                temp1.classList.add("btn-form-active");
                // temp2.classList.remove("hide");
                temp1.disabled = false;
            } else if(countform == 4)
            {
                $('#formbooknow').on('submit', function(event){
                    event.preventDefault();
                    console.log('load-tarif');
                    var id = $(this).attr('id');
                    $.ajax({
                        url:"{{ route('tradein.store') }}",
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
                                $('#booknowmodal').modal('hide');
                                $('#formbooknow')[0].reset();
                                $('#action_button').html('Save changes').attr('disabled', false);
                                swal.fire({
                                    icon: 'success',
                                    title: 'Data berhasil disimpan',
                                    text: 'Data referensi anda akan diteruskan petugas kami untuk dihubungi. Terima kasih'
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
            }
        }
</script>
@endsection


