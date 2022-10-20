<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<?php
$prov = [];
foreach ($provinsi as $key => $row) {
    $data = [
        'id' => $key,
        'provinsi' => $row,
    ];
    array_push($prov, $data);
}
usort($prov, function ($a, $b) {
    return $a['provinsi'] <=> $b['provinsi'];
});
?>

<div class="container py-sm-5 py-3">
    <div class="row justify-content-center">
        <div class="col-xxl-7 col-lg-8 col-md-10 col-sm-12">
            <?= view('supplier/information') ?>
            <form action="<?= base_url('save/second_step') ?>" method="post" enctype="multipart/form-data" id="supplierForm">
                <?= csrf_field() ?>
                <div class="shadow mt-sm-5 mt-3 p-sm-5 p-3 bg-body rounded border border-light rounded-3">

                    <?= view('supplier/step_indicator') ?>

                    <h5 class="fw-bolder">Alamat Lengkap</h5>
                    <p>
                        Tolong isi informasi dengan benar, agar team kami
                        dapat menghubungi anda.
                    </p>
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Alamat Perusahaan</label>
                                <input type="text" class="form-control p-2 shadow-sm " placeholder="Alamat Lengkap" name="address" value="<?= old('address') ?>" required />
                                <div class="invalid-feedback">
                                    Alamat tidak boleh kosong.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-lg-0 mt-4">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Provinsi</label>
                                <select name="province" id="province" class="form-select p-2 select2 shadow-sm " aria-label="Default select" onchange="getCity()" required>
                                    <option value="" selected>Provinsi</option>
                                    <?php foreach ($prov as $key => $row) : ?>
                                        <option value="<?= $row['provinsi'] ?>" provId="<?= $row['id'] ?>" <?= $row['provinsi'] == old('province') ? 'selected' : '' ?>><?= $row['provinsi'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">
                                    Silahkan pilih provinsi.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Kota</label>
                                <select name="city" id="city" class="form-select p-2 shadow-sm" aria-label="Default select" onchange="getZipCode()" required>
                                    <option value="" selected>Kota</option>
                                </select>
                                <div class="invalid-feedback">
                                    Silahkan pilih kota.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Kode Pos</label>
                                <input type="text" name="zip_code" class="form-control p-2 shadow-sm" placeholder="Kode Pos" list="zip_code" value="<?= old('zip_code') ?>">
                                <datalist id="zip_code" id="zip_code" required>
                                </datalist>
                                <div class="invalid-feedback">
                                    Kode Pos tidak boleh kosong.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex button-container justify-content-between mt-sm-5 mt-4" id="buttonContainer">
                    <a href="<?= base_url('') ?>" class="btn btn-secondary shadow rounded-3 px-3 py-2" id="nextButton">
                        Kembali
                    </a>
                    <!-- <a href="<?= base_url('third_step') ?>" class="btn btn-danger tr-bg-primary shadow rounded-3 px-3 py-2" id="nextButton">
                        Selanjutnya
                    </a> -->
                    <button type="submit" class="btn btn-danger tr-bg-primary shadow rounded-3 px-3 py-2">
                        Selanjutnya
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
    getCity();
    async function getCity() {
        provinsi = document.getElementById("province");
        d = provinsi.options[provinsi.selectedIndex].getAttribute('provId');
        const url = 'https://kodepos-2d475.firebaseio.com/list_kotakab/' + d + '.json?print=pretty';
        const data = await getApi(url);

        provinsi.classList.remove('is-invalid')
        document.getElementById('city').innerHTML = "";

        // console.log(data);

        var x = document.getElementById('city');
        var option = new Option('Kota', '');
        option.setAttribute('disabled', 'true')
        option.setAttribute('selected', 'true')
        x.appendChild(option);

        Object.keys(data).forEach(key => {
            var x = document.getElementById('city');
            var option = new Option(data[key], data[key]);
            option.setAttribute('cityId', key)
            x.appendChild(option);
            x.classList.remove('is-invalid')
        })

        getZipCode()

    }

    async function getZipCode() {
        city = document.getElementById("city");
        d = city.options[city.selectedIndex].getAttribute('cityId');
        const url = 'https://kodepos-2d475.firebaseio.com/kota_kab/' + d + '.json?print=pretty';
        const data = await getApi(url);

        provinsi.classList.remove('is-invalid')
        document.getElementById('zip_code').innerHTML = "";

        let zipcode = []

        const unique = data.filter(element => {
            const isDuplicate = zipcode.includes(element.kodepos)

            if (!isDuplicate) {
                zipcode.push(element.kodepos)
                return true
            }
            return false
        })

        console.log(zipcode)

        for (let i = 0; i < zipcode.length; i++) {
            var x = document.getElementById('zip_code');
            var option = new Option(zipcode[i], zipcode[i]);
            x.appendChild(option);
            x.classList.remove('is-invalid')
        }
    }
    async function getApi(url) {
        const response = await fetch(url);
        var data = await response.json();

        return data;
    }
</script>

<?= $this->endSection() ?>