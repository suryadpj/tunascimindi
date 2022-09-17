<div id="form-5">
    <form action="#" method="POST">
        @csrf
        <input type="hidden" name="merk" value="1">
        <input type="hidden" name="model" value="1">
        <input type="hidden" name="year" value="2">
        <input type="hidden" name="variant" value="16">
        <input type="hidden" name="transmition" value="1">
        <h4 class="py-3">Masukan No Handphone Anda</h4>
        <h4 class="py-3">Toyota - AVANZA - 2015 - 1.3 G  BENSIN - AUTOMATIC</h4>
        <div class="p-3 text-left">
            <p><b>Nomor Handphone</b></p>
            <input name="phone_number" class="search-form" type="tel"
                        placeholder="08xx-xxxx-xxxx" id="hp" required />
                        <br>
                        <br>
            <p>Kami menghormati privasi, dan informasi Anda aman bersama Kami</p>

            <div class="tacbox d-flex">
                <input id="checkbox" type="checkbox" class="input-checkbox" onchange="policyOnChange(this)"/>
                <label for="checkbox"> Saya dengan ini mengakui bahwa telah membaca, mengerti dan setuju dengan <a href="https://tunastoyotacimindi.com/syarat-dan-ketentuan" target="_blank">Syarat dan Ketentuan</a> dan <a href="https://tunastoyotacimindi.com/kebijakan-privasi" target="_blank">Kebijakan Privasi</a> yang berlaku.</label>
            </div>

            <button type="submit" class="btn btn-primary btn-style btn-blue w-100" id="btn-submit"><b>CEK HARGA JUAL MOBIL</b></button>

        </div>
    </form>
</div>


    <script>
        $(document).ready(function(){
            $('#hp').mask('0000-0000-0000')
            $('#btn-submit').prop('disabled', true);
        })

        function policyOnChange(e) {
            var phoneNumber = $('#id').val();
            if(e.checked && phoneNumber !== '') {
                $('#btn-submit').prop('disabled', false);
            } else {
                $('#btn-submit').prop('disabled', true);
            }
        }
    </script>
