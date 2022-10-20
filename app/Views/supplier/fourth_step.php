<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container py-sm-5 py-3">
    <div class="row justify-content-center">
        <div class="col-xxl-7 col-lg-8 col-md-10 col-sm-12">
            <?= view('supplier/information') ?>
            <form action="<?= base_url('save/fourth_step') ?>" method="post" enctype="multipart/form-data" id="supplierForm">
                <?= csrf_field() ?>
                <div class="shadow mt-sm-5 mt-3 p-sm-5 p-3 bg-body rounded border border-light rounded-3">

                    <?= view('supplier/step_indicator') ?>

                    <?php if ($product != null) {
                    ?>

                        <h5 class="fw-bolder">Informasi Produk</h5>
                        <p>
                            Tolong isi informasi dengan benar, agar team kami
                            dapat menghubungi anda.
                        </p>
                        <div class="row mb-4">
                            <div class="accordion" id="accordionExample">
                                <?php
                                for ($i = 1; $i <= count($product); $i++) {
                                ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading<?= $i ?>">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i ?>" aria-expanded="true" aria-controls="collapse<?= $i ?>">
                                                Produk - <?= $product[$i - 1]['name'] ?>
                                            </button>
                                        </h2>
                                        <div id="collapse<?= $i ?>" class="accordion-collapse collapse <?= $i == 1 ? 'show' : '' ?>" aria-labelledby="heading<?= $i ?>" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label fw-bolder">Nama Produk</label>
                                                            <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="Nama Produk" name="product_name[]" value="<?= old('product_name') ?>" required />
                                                            <div class=" invalid-feedback">
                                                                Nama produk tidak boleh kosong.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12 mt-4">
                                                        <div class="form-group">
                                                            <label class="form-label fw-bolder">Deskripsi Produk</label>
                                                            <textarea name="product_description[]" id="" cols="30" rows="5" class="form-control p-2 shadow-sm" required></textarea>
                                                            <div class=" invalid-feedback">
                                                                Nama produk tidak boleh kosong.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 mt-4">
                                                        <label class="form-label fw-bolder">Harga per Satuan</label>
                                                        <div class="input-group mb-2">
                                                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                            <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="Harga" name="price[]" onkeyup="removeInvalid(this)" value="<?= old('product_type') ?>" />
                                                            <div class="col-3">
                                                                <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="Satuan" list="unit" name="unit[]" value="<?= old('product_type') ?>" required />
                                                                <datalist id="unit">
                                                                    <option value="kg"></option>
                                                                    <option value="gr"></option>
                                                                    <option value="cm"></option>
                                                                    <option value="liter"></option>
                                                                    <option value="ml"></option>
                                                                </datalist>
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                Harga per Satuan tidak boleh kosong.
                                                            </div>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="with_shipping_cost[]" id="inlineRadio1" value="true" required>
                                                            <label class="form-check-label" for="inlineRadio1">Sudah Termasuk Ongkir</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="with_shipping_cost[]" id="inlineRadio2" value="false" required>
                                                            <label class="form-check-label" for="inlineRadio2">Belum Termasuk Ongkir</label>
                                                        </div>
                                                        <div class="form-text">
                                                            *Untuk ongkos kirim dari lokasi ke <a href="https://www.google.com/maps/dir/-6.8973322,107.6096949/Timurasa+warehouse,+Jalan+Prigi+No.43,+RT.5%2FRW.5,+Bedahan,+Kec.+Sawangan,+Kota+Depok,+Jawa+Barat+16519/@-6.5618449,106.6097881,9z/data=!3m1!4b1!4m9!4m8!1m1!4e1!1m5!1m1!1s0x2e69e96d4abc11c9:0x4977c2c40dbb33c2!2m2!1d106.7688781!2d-6.4368764" target="_blank" class="tr-text-primary text-decoration-none">Timurasa</a>, silahkan cek di <a class="text-decoration-none" href="https://cek-ongkir.com/">cek-ongkir.com</a>.
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 mt-4">
                                                        <div class="form-group">
                                                            <label class="form-label fw-bolder">Kapasitas per Bulan</label>
                                                            <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="Kapasitas" name="capacity[]" value="<?= old('price') ?>" required />
                                                            <div class="invalid-feedback">
                                                                Kapasitas tidak boleh kosong.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mt-4">
                                                        <div class="form-group">
                                                            <label class="form-label fw-bolder">Kualitas Produk</label>
                                                            <input type="text" name="quality[]" class="form-control p-2 shadow-sm input-required" placeholder="Kualitas" value="<?= old('quality') ?>" required>
                                                            <div class="invalid-feedback">
                                                                Silahkan pilih atau isi kualitas produk.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 mt-4">
                                                        <div class="form-group">
                                                            <label class="form-label fw-bolder">Term of Payment</label>
                                                            <select name="termin[]" id="" class="form-select p-2 shadow-sm input-required" required>
                                                                <option value="3 hari">3 hari</option>
                                                                <option value="10 hari">10 hari</option>
                                                                <option value="15 hari">15 hari</option>
                                                                <option value="30 hari">30 hari</option>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                Silahkan pilih atau isi termin pembayaran.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($service != null) {
                    ?>

                        <div class="mt-5"></div>
                        <h5 class="fw-bolder">Informasi Jasa</h5>
                        <p>
                            Tolong isi informasi dengan benar, agar team kami
                            dapat menghubungi anda.
                        </p>
                        <div class="accordion" id="accordionExample">
                            <?php
                            for ($i = 1; $i <= count($service); $i++) {
                            ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading<?= $i ?>">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#service<?= $i ?>" aria-expanded="true" aria-controls="service<?= $i ?>">
                                            Jasa - <?= $service[$i - 1]['name'] ?>
                                        </button>
                                    </h2>
                                    <div id="service<?= $i ?>" class="accordion-collapse collapse <?= $i == 1 ? 'show' : '' ?>" aria-labelledby="heading<?= $i ?>" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row mb-4">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bolder">Nama Jasa</label>
                                                        <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="Nama Jasa" name="service_name[]" value="<?= old('product_name') ?>" />
                                                        <div class=" invalid-feedback">
                                                            Nama jasa tidak boleh kosong.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 mt-4">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bolder">Deskripsi Jasa</label>
                                                        <textarea name="service_description[]" id="" cols="30" rows="5" class="form-control p-2 shadow-sm"></textarea>
                                                        <div class=" invalid-feedback">
                                                            Deskripsi jasa tidak boleh kosong.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>

                </div>
                <div class="d-flex button-container justify-content-between mt-sm-5 mt-4" id="buttonContainer">
                    <a href="<?= base_url('third_step') ?>" class="btn btn-secondary shadow rounded-3 px-3 py-2" id="nextButton">
                        Kembali
                    </a>
                    <!-- <a href="<?= base_url('fifth_step') ?>" class="btn btn-danger tr-bg-primary shadow rounded-3 px-3 py-2" id="nextButton">
                        Selanjutnya
                    </a> -->
                    <button type="submit" class="btn btn-danger tr-bg-primary shadow rounded-3 px-3 py-2" id="nextButton">
                        Selanjutnya
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>