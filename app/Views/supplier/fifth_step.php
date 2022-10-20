<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container py-sm-5 py-3">
    <div class="row justify-content-center">
        <div class="col-xxl-7 col-lg-8 col-md-10 col-sm-12">
            <?= view('supplier/information') ?>
            <form action="<?= base_url('save/fifth_step') ?>" method="post" enctype="multipart/form-data" id="supplierForm">
                <?= csrf_field() ?>
                <div class="shadow mt-sm-5 mt-3 p-sm-5 p-3 bg-body rounded border border-light rounded-3">

                    <?= view('supplier/step_indicator') ?>
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
                <div class="d-flex button-container justify-content-between mt-sm-5 mt-4" id="buttonContainer">
                    <a href="<?= base_url('fourth_step') ?>" class="btn btn-secondary shadow rounded-3 px-3 py-2" id="nextButton">
                        Kembali
                    </a>
                    <!-- <a href="<?= base_url('finish_step') ?>" class="btn btn-danger tr-bg-primary shadow rounded-3 px-3 py-2" id="nextButton">
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