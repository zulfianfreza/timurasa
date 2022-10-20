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
        <form action="<?= base_url('admin/supplier/save/fifth_step') ?>" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <div class="progress my-3">
                    <div class="progress-bar progress-bar-striped bg-danger tr-bg-primary" id="progressBar" role="progressbar" style="width: 80%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="mb-5"></div>
                <h5 class="fw-bolder">Informasi Jasa</h5>
                <p>
                    Tolong isi informasi dengan benar, agar team kami
                    dapat menghubungi anda.
                </p>
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-label fw-bolder">Surat Penawaran Produk/Jasa</label>
                            <!-- <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="Surat Penawaran" name="offering_letter" value="<?= old('offering_letter') ?>" required /> -->
                            <textarea name="offering_letter" id="" cols="30" rows="5" class="form-control p-2 shadow-sm" required></textarea>
                            <div class=" invalid-feedback">
                                Nama produk tidak boleh kosong.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-4">
                        <div class="form-group mb-3">
                            <label class="form-label fw-bolder">Upload Dokumen Penawaran Anda</label>
                            <input type="file" class="form-control p-2 shadow-sm" name="document[]" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf" required />
                            <div class=" invalid-feedback">
                                Nama produk tidak boleh kosong.
                            </div>
                        </div>
                        <div id="newDocument" class="">
                        </div>
                        <div class="form-text">
                            *Untuk dokumen, anda dapat menambahkan dokumen Katalog, Perizinan dan Ujilab
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-primary" id="addDocument">
                                <i class="fas fa-plus"></i> Tambah Dokumen
                            </button>
                        </div>
                    </div>
                    <div class="mt-4 form-check">
                        <input type="checkbox" class="form-check-input check-required" id="exampleCheck1" onclick="checkValidate(this)" required />
                        <label class="form-check-label" for="exampleCheck1">
                            Saya sudah mengisi informasi secara jujur &
                            tidak merubah informasi pihak lain.
                        </label>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    // add row
    $("#addDocument").click(function() {
        var html = '';
        html += '<div class="input-group mb-3" id="rowDocument">';
        html += '<input type="file" class="form-control" name="document[]" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf">';
        html += '<button class="btn btn-danger tr-bg-primary" id="removeDocument">Hapus</button>';
        html += '</div>';

        $('#newDocument').append(html);
    });

    // remove row
    $(document).on('click', '#removeDocument', function() {
        $(this).closest('#rowDocument').remove();
    });
</script>

<?= $this->endSection() ?>