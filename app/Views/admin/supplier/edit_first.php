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
        <form action="<?= base_url('admin/supplier/update/first/' . base64_encode($supplier[0]['id_supplier'])) ?>" method="POST">
            <div class="card-body">
                <!-- <div class="progress my-3">
                    <div class="progress-bar progress-bar-striped bg-danger tr-bg-primary" id="progressBar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div> -->
                <div class="mb-5"></div>
                <h5 class="fw-bolder">Informasi Kontak</h5>
                <p>
                    Tolong isi informasi dengan benar, agar team kami
                    dapat menghubungi anda.
                </p>
                <div class="row mb-4">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label fw-bolder">Nama</label>
                            <input type="text" class="form-control p-2 shadow-sm" placeholder="Nama" name="name" value="<?= $supplier[0]['name'] ?>" required />
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-lg-0 mt-4">
                        <div class="form-group">
                            <label class="form-label fw-bolder">Email</label>
                            <input type="email" class="form-control p-2 shadow-sm" placeholder="Email" name="email" value="<?= $supplier[0]['email'] ?>" required />
                            <div class="invalid-feedback" id="invalidEmail">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-4">
                        <div class="form-group">
                            <label class="form-label fw-bolder">Nomor Telepon</label>
                            <input type="number" class="form-control p-2 shadow-sm " placeholder="(+62) 456 - 7890" name="phone_number" value="<?= $supplier[0]['phone_number'] ?>" required />
                            <div class="invalid-feedback" id="invalidEmail">
                                Nomor Telepon tidak boleh kosong.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-4">
                        <div class="form-group">
                            <label class="form-label fw-bolder">Perusahaan</label>
                            <input type="text" class="form-control p-2 shadow-sm " placeholder="Perusahaan" name="company" value="<?= $supplier[0]['company'] ?>" required />
                            <div class="invalid-feedback" id="invalidEmail">
                                Nama perusahaan tidak boleh kosong.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-4">
                        <div class="form-group">
                            <label class="form-label fw-bolder">WhatsApp
                            </label>
                            <input type="text" class="form-control p-2 shadow-sm" placeholder="WhatsApp" name="whatsapp" value="<?= $supplier[0]['whatsapp'] ?>" required />
                            <div class="invalid-feedback" id="invalidEmail">
                                WhatsApp tidak boleh kosong.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-4">
                        <div class="form-group">
                            <label class="form-label fw-bolder">Facebook
                                <span class="tr-text-primary shadow-sm">*</span></label>
                            <input type="text" class="form-control p-2 shadow-sm" placeholder="Facebook" name="facebook" value="<?= $supplier[0]['facebook'] ?>" />
                            <div class="form-text tr-text-primary">
                                *Opsional.
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-12 mt-4">
                        <div class="form-group">
                            <label class="form-label fw-bolder">Instagram
                                <span class="tr-text-primary shadow-sm">*</span></label>
                            <input type="text" class="form-control p-2 shadow-sm" placeholder="Instagram" name="instagram" value="<?= $supplier[0]['instagram'] ?>" />
                            <div class="form-text tr-text-primary">
                                *Opsional.
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end" id="buttonContainer">
                <!-- <button type="button" class="btn btn-secondary shadow rounded-3 px-3 py-2" id="prevButton" onclick="nextPrev(-1)">
                Kembali
            </button> -->
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