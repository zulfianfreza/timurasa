<?= $this->extend('admin/layout/template') ?>

<?= $this->section('styles') ?>

<!-- Custom styles for this page -->
<!-- <link href="<?= base_url() ?>/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"> -->

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Supplier</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold tr-text-primary">Tambah Supplier</h6>

        </div>
        <form action="<?= base_url('admin/supplier/update/fourth/' . base64_encode($supplier[0]['id_supplier'])) ?>" method="POST">
            <div class="card-body">
                <!-- <div class="progress my-3">
                    <div class="progress-bar progress-bar-striped bg-danger tr-bg-primary" id="progressBar" role="progressbar" style="width: 60%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div> -->
                <div class="mb-5"></div>
                <?php if ($supplier_product != null) {
                ?>

                    <h5 class="fw-bolder">Informasi Produk</h5>
                    <p>
                        Tolong isi informasi dengan benar, agar team kami
                        dapat menghubungi anda.
                    </p>
                    <div class="mb-4">
                        <div class="accordion" id="accordion">
                            <?php
                            for ($i = 1; $i <= count($supplier_product); $i++) {
                            ?>
                                <div class="card">
                                    <div class="card-header" id="heading<?= $i ?>">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?= $i ?>" aria-expanded="true" aria-controls="collapse<?= $i ?>">
                                                Produk - <?= $supplier_product[$i - 1]['name'] ?>
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapse<?= $i ?>" class="collapse <?= $i == 1 ? 'show' : '' ?>" aria-labelledby="heading<?= $i ?>" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <input type="hidden" name="id_supplier_product[]" value="<?= $supplier_product[$i - 1]['id'] ?>">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bolder">Nama Produk</label>
                                                        <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="Nama Produk" name="product_name[]" value="<?= $supplier_product[$i - 1]['product_name'] ?>" required />
                                                        <div class=" invalid-feedback">
                                                            Nama produk tidak boleh kosong.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 mt-4">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bolder">Deskripsi Produk</label>
                                                        <textarea name="product_description[]" id="" cols="30" rows="5" class="form-control p-2 shadow-sm" required><?= $supplier_product[$i - 1]['product_description'] ?></textarea>
                                                        <div class=" invalid-feedback">
                                                            Nama produk tidak boleh kosong.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-4">
                                                    <label class="form-label fw-bolder">Harga per Satuan</label>
                                                    <div class="input-group mb-2">
                                                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                        <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="Harga" name="price[]" onkeyup="removeInvalid(this)" value="<?= $supplier_product[$i - 1]['price'] ?>" />
                                                        <div class="col-3">
                                                            <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="Satuan" list="unit" name="unit[]" value="<?= $supplier_product[$i - 1]['unit'] ?>" required />
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
                                                        <input class="form-check-input" type="radio" name="with_shipping_cost[]" id="inlineRadio1" value="true" <?= $supplier_product[$i - 1]['with_shipping_cost'] == 'true' ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="inlineRadio1">Sudah Termasuk Ongkir</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="with_shipping_cost[]" id="inlineRadio2" value="true" <?= $supplier_product[$i - 1]['with_shipping_cost'] == 'false' ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="inlineRadio2">Belum Termasuk Ongkir</label>
                                                    </div>
                                                    <div class="form-text">
                                                        *Untuk ongkos kirim dari lokasi ke <a href="https://www.google.com/maps/dir/-6.8973322,107.6096949/Timurasa+warehouse,+Jalan+Prigi+No.43,+RT.5%2FRW.5,+Bedahan,+Kec.+Sawangan,+Kota+Depok,+Jawa+Barat+16519/@-6.5618449,106.6097881,9z/data=!3m1!4b1!4m9!4m8!1m1!4e1!1m5!1m1!1s0x2e69e96d4abc11c9:0x4977c2c40dbb33c2!2m2!1d106.7688781!2d-6.4368764" target="_blank" class="tr-text-primary text-decoration-none">Timurasa</a>, silahkan cek di <a class="text-decoration-none" href="https://cek-ongkir.com/">cek-ongkir.com</a>.
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 mt-4">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bolder">Kapasitas per Bulan</label>
                                                        <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="Kapasitas" name="capacity[]" value="<?= $supplier_product[$i - 1]['capacity'] ?>" required />
                                                        <div class="invalid-feedback">
                                                            Kapasitas tidak boleh kosong.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mt-4">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bolder">Kualitas Produk</label>
                                                        <input type="text" name="quality[]" class="form-control p-2 shadow-sm input-required" placeholder="Kualitas" value="<?= $supplier_product[$i - 1]['quality'] ?>" required>
                                                        <div class="invalid-feedback">
                                                            Silahkan pilih atau isi kualitas produk.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mt-4">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bolder">Term of Payment</label>
                                                        <select name="termin[]" id="" class="form-control p-2 shadow-sm input-required" required>
                                                            <option value="3 hari" <?= $supplier_product[$i - 1]['termin'] == '3 hari' ? 'selected' : '' ?>>3 hari</option>
                                                            <option value="10 hari" <?= $supplier_product[$i - 1]['termin'] == '10 hari' ? 'selected' : '' ?>>10 hari</option>
                                                            <option value="15 hari" <?= $supplier_product[$i - 1]['termin'] == '15 hari' ? 'selected' : '' ?>>15 hari</option>
                                                            <option value="30 hari" <?= $supplier_product[$i - 1]['termin'] == '30 hari' ? 'selected' : '' ?>>30 hari</option>
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

                <?php if ($supplier_service != null) {
                ?>

                    <div class="mt-5"></div>
                    <h5 class="fw-bolder">Informasi Jasa</h5>
                    <p>
                        Tolong isi informasi dengan benar, agar team kami
                        dapat menghubungi anda.
                    </p>
                    <div class="accordion" id="accordion">
                        <?php
                        for ($i = 1; $i <= count($supplier_service); $i++) {
                        ?>
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Jasa - <?= $supplier_service[$i - 1]['name'] ?>
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <input type="hidden" name="id_supplier_service[]" value="<?= $supplier_service[$i - 1]['id'] ?>">
                                        <div class="row mb-4">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label fw-bolder">Nama Jasa</label>
                                                    <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="Nama Jasa" name="service_name[]" value="<?= $supplier_service[$i - 1]['service_name'] ?>" />
                                                    <div class=" invalid-feedback">
                                                        Nama jasa tidak boleh kosong.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 mt-4">
                                                <div class="form-group">
                                                    <label class="form-label fw-bolder">Deskripsi Jasa</label>
                                                    <textarea name="service_description[]" id="" cols="30" rows="5" class="form-control p-2 shadow-sm"><?= $supplier_service[$i - 1]['service_description'] ?></textarea>
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
            <div class="card-footer d-flex justify-content-between" id="buttonContainer">
                <a href="<?= base_url('admin/supplier/edit/third/' . base64_encode($supplier[0]['id_supplier'])) ?>">
                    <button type="button" class="btn btn-secondary shadow rounded-3 px-3 py-2" id="prevButton" onclick="nextPrev(-1)">
                        Kembali
                    </button>
                </a>
                <button type="submit" class="btn btn-danger tr-bg-primary shadow rounded-3 px-3 py-2" id="nextButton" onclick="nextPrev(1)">
                    Selanjutnya
                </button>
            </div>
        </form>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<!-- Page level plugins -->
<script src="<?= base_url() ?>/assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url() ?>/assets/js/demo/datatables-demo.js"></script>
<!-- <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script> -->
<script>
    // Call the dataTables jQuery plugin
    // $(document).ready(function() {
    //     $("#dataTable").DataTable({
    //         dom: "Bfrtip",
    //         buttons: ["excelHtml5", "csvHtml5", "pdfHtml5"],
    //     });
    // });
</script>

<?= $this->endSection() ?>