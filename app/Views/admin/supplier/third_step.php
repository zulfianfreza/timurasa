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
        <form action="<?= base_url('admin/supplier/save/third_step') ?>" method="POST">
            <div class="card-body">
                <div class="progress my-3">
                    <div class="progress-bar progress-bar-striped bg-danger tr-bg-primary" id="progressBar" role="progressbar" style="width: 40%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="mb-5"></div>
                <h5 class="fw-bolder">Bidang Usaha</h5>
                <p>
                    Isi bidang usaha dan pilih satu atau beberapa
                    kategory bidang usaha anda.
                </p>
                <div class="mt-4">
                    <div class="form-group">
                        <label class="form-label fw-bolder">Bidang Usaha</label>
                        <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="Bidang Usaha" name="business_major" value="<?= old('business_major') ?>" required />
                        <div class="invalid-feedback">
                            Bidang usaha tidak boleh kosong.
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <label class="form-label fw-bolder">Kategori Produk</label>
                    <div class="row">
                        <?php foreach ($product as $product) :  ?>
                            <div class="col-xxl-4 col-lg-6 col-sm-12">
                                <div class="form-check">
                                    <input class="form-check-input cb-product" type="checkbox" value="<?= $product['id'] ?>" id="product" name="product[]" />
                                    <label class="form-check-label">
                                        <?= $product['name'] ?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="mt-4">
                    <label class="form-label fw-bolder">Kategory Jasa</label>
                    <div class="row">
                        <?php foreach ($service as $service) :  ?>
                            <div class="col-xxl-4 col-lg-6 col-sm-12">
                                <div class="form-check">
                                    <input class="form-check-input cb-service" type="checkbox" value="<?= $service['id'] ?>" id="service" name="service[]" />
                                    <label class="form-check-label">
                                        <?= $service['name'] ?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between" id="buttonContainer">
                <a href="">
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