<form id="formtradein" method="post" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="merk" value="{{ $transmisione->merk }}">
        <input type="hidden" name="model" value="{{ $transmisione->model }}">
        <input type="hidden" name="year" value="{{ $transmisione->tahun }}">
        <input type="hidden" name="variant" value="{{ $transmisione->type }}">
        <input type="hidden" name="transmition" value="">
<div id="form-4">
    <h4 class="py-3">Pilih Transmisi</h4>
    <h4 class="py-3">{{ $transmisione->merk }} {{ $transmisione->model }} - {{ $transmisione->tahun }} - {{ $transmisione->type }}</h4>
    <div class="row py-3 justify-content-center mx-0">
        @foreach ($transmisi as $m)
        <div class="col-md-3 col-4 py-2">
            <button id="form-5-{{ $m->transmisi }}" onclick="OnOptionClick(this)" data-merk="{{ $m->merk }}" data-transmition="{{ $m->transmisi }}" data-variant="{{ $m->type }}" data-year="{{ $m->tahun }}" data-model="{{ $m->model }}" type="button" class="btn btn-primary btn-style btn-form-2 btn-frm-2"><b>@if($m->transmisi == 1) MT @else AT @endif</b></button>
        </div>
        @endforeach
    </div>
</div>
</form>

