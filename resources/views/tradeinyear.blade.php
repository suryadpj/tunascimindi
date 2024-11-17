
<div id="form-2">
    <h4 class="py-3">Pilih Tahun</h4>
    <h4 class="py-3">{{ $yearone->merk }} {{ $yearone->model }}</h4>
    <div class="row py-3 justify-content-center mx-0">
        @foreach ($year as $m)
        <div class="col-md-3 col-4 py-2">
            <button id="form-3-{{ $m->tahun }}" onclick="OnOptionClick(this)" data-merk="{{ $m->merk }}" data-year="{{ $m->tahun }}" data-model="{{ $m->model }}" type="button" class="btn btn-primary btn-style btn-form-2 btn-frm-2"><b>{{ $m->tahun }}</b></button>
        </div>
        @endforeach
</div>
