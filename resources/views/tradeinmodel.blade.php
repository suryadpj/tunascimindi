<div id="form-1" class="">
    <center>
    <h4 class="py-3">Model Mobil</h4>
        <div class="m-3 ">
            <div class="input-group">
                <input name="keywords" class="search-form" type="text"
                    placeholder="Cari Model Mobil" id="search" onkeyup="OnChangeSearchCarModel(this)" />
                    <div>

                    </div>
                <button type="button"
                    onclick="SearchCarModel(this)"
                    class="btn-style search-btn"><img
                        src="https://tunastoyotacimindi.com/assets/img/ic_search_24px@2x.png"
                        class="img img-center" alt=""  height="19">
                </button>
            </div>
        </div>

        <div class="row py-3 px-4 px-lg-3 justify-content-center">
                        <div class="col-md-3 col-4 py-2 px-xl-3 px-lg-1 px-3 car-model-options">
                <button id="form-1-agya" onclick="OnOptionClick(this)" data-model="1" type="button" class="btn btn-primary btn-style btn-frm-2 btn-form-2"><b>AVANZA</b></button>
            </div>
                        <div class="col-md-3 col-4 py-2 px-xl-3 px-lg-1 px-3 car-model-options">
                <button id="form-1-agya" onclick="OnOptionClick(this)" data-model="2" type="button" class="btn btn-primary btn-style btn-frm-2 btn-form-2"><b>VELOZ</b></button>
            </div>
                        <div class="col-md-3 col-4 py-2 px-xl-3 px-lg-1 px-3 car-model-options">
                <button id="form-1-agya" onclick="OnOptionClick(this)" data-model="3" type="button" class="btn btn-primary btn-style btn-frm-2 btn-form-2"><b>CALYA</b></button>
            </div>
                        <div class="col-md-3 col-4 py-2 px-xl-3 px-lg-1 px-3 car-model-options">
                <button id="form-1-agya" onclick="OnOptionClick(this)" data-model="4" type="button" class="btn btn-primary btn-style btn-frm-2 btn-form-2"><b>AGYA</b></button>
            </div>
                        <div class="col-md-3 col-4 py-2 px-xl-3 px-lg-1 px-3 car-model-options">
                <button id="form-1-agya" onclick="OnOptionClick(this)" data-model="5" type="button" class="btn btn-primary btn-style btn-frm-2 btn-form-2"><b>RUSH</b></button>
            </div>
                        <div class="col-md-3 col-4 py-2 px-xl-3 px-lg-1 px-3 car-model-options">
                <button id="form-1-agya" onclick="OnOptionClick(this)" data-model="6" type="button" class="btn btn-primary btn-style btn-frm-2 btn-form-2"><b>INNOVA</b></button>
            </div>
                        <div class="col-md-3 col-4 py-2 px-xl-3 px-lg-1 px-3 car-model-options">
                <button id="form-1-agya" onclick="OnOptionClick(this)" data-model="7" type="button" class="btn btn-primary btn-style btn-frm-2 btn-form-2"><b>FORTUNER</b></button>
            </div>
                        <div class="col-md-3 col-4 py-2 px-xl-3 px-lg-1 px-3 car-model-options">
                <button id="form-1-agya" onclick="OnOptionClick(this)" data-model="8" type="button" class="btn btn-primary btn-style btn-frm-2 btn-form-2"><b>YARIS</b></button>
            </div>
                        <div class="col-md-3 col-4 py-2 px-xl-3 px-lg-1 px-3 car-model-options">
                <button id="form-1-agya" onclick="OnOptionClick(this)" data-model="9" type="button" class="btn btn-primary btn-style btn-frm-2 btn-form-2"><b>SIENTA</b></button>
            </div>
                    </div>
    </center>
</div>

<script>
    function SearchCarModel(el) {
        OnChangeSearchCarModel(document.getElementById('search'));
    };

    function OnChangeSearchCarModel(el) {
        var searchCarModelValue = el.value;
        var carModelOptions = document.querySelectorAll('.car-model-options');

        if(searchCarModelValue != null) {
            for (let index = 0; index < carModelOptions.length; index++) {
                const element = carModelOptions[index];

                var regex = new RegExp(searchCarModelValue, 'i');

                if(element.textContent.match(regex)) {
                    element;
                } else {
                    element.classList.add('hide');
                }

            }
        }

        if(searchCarModelValue == '') {
            for (let index = 0; index < carModelOptions.length; index++) {
                const element = carModelOptions[index];

                element.classList.remove('hide');

            }
        }
    }
</script>
