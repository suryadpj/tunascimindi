
<div id="form-3">
    <h4 class="py-3">Pilih Varian</h4>
    <h4 class="py-3">{{ $variantsone->merk }} {{ $variantsone->model }} - {{ $variantsone->tahun }}</h4>
    <div class="row py-3 justify-content-center mx-0">
        @foreach ($variants as $m)
        <div class="col-md-3 col-4 py-2">
            <button id="form-4-{{ $m->type }}" onclick="OnOptionClick(this)" data-merk="{{ $m->merk }}" data-variant="{{ $m->type }}" data-year="{{ $m->tahun }}" data-model="{{ $m->model }}" type="button" class="btn btn-primary btn-style btn-form-2 btn-frm-2"><b>{{ $m->type }}</b></button>
        </div>
        @endforeach
</div>
