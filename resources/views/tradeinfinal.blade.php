@php
    $pricemin = number_format($price->harga_min,0);
    $pricemax = number_format($price->harga_max,0);
@endphp
<br>
<br>
<div class="col">
    <h2 class=""><b> {{ $price->merk }} {{ $price->model }}</b></h2>
    <h3 class="">
        {{ $price->type }} -
        @if ($price->transmisi == 1)
            MT
        @else
            AT
        @endif
         Tahun {{ $price->tahun }}
    </h3>
    <br>
    <div class="price-estimate pb-2 pt-3 px-3 mb-3">
        <h2 class="color-blue"><b>Rp {{ $pricemin }} - Rp {{ $pricemax }}</b></h2>
    </div>
    <h3 align="center" class="pb-2 text-left">* Harga penawaran final untuk mobil akan diberikan setelah proses inspeksi selesai. Petugas kami akan menghubungi anda. Terima kasih</h3>
    <h4 class="pb-2"><b>INSPEKSI MOBIL ANDA DI</b></h3>
    <div class="row">
        <div class="col-6">
            <div class="inspeksi p-3">
                <img class="img-fluid align-self-center px-3 px-md-5" src="https://tunastoyotacimindi.com/assets/img/rumah.png" alt="picture.png">
                <h4 class=""><b>Rumah</b></h4>
                <h6>Staf ahli Kami akan menginspeksi mobil Anda di rumah.</h6>
                    <button type="button" id="{{ $tradeinput->ID }}" class="bookingrumah btn btn-primary btn-style btn-blue btn-inspeksi p-3 "><b>BOOKING <br class="hide-sm"> JADWAL</b></button>
            </div>
        </div>
        <div class="col-6">
        <div class="inspeksi p-3">
                <img class="img-fluid align-self-center px-3 px-md-5" src="https://tunastoyotacimindi.com/assets/img/toko.png" alt="picture.png">
                <h4 class=""><b>Dealer</b></h4>
                <h6>Kunjungi Dealer terdekat Kamim untuk insoeksikan mobil Anda.</h6>
                    <button type="button" id="{{ $tradeinput->ID  }}" class="bookingdealer btn btn-primary btn-style btn-blue btn-inspeksi p-3 "><b>CARI STORE <br class="hide-sm"> TERDEKAT</b></button>
            </div>
        </div>
    </div>
</div>
