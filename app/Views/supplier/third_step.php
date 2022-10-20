<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container py-sm-5 py-3">
    <div class="row justify-content-center">
        <div class="col-xxl-7 col-lg-8 col-md-10 col-sm-12">
            <?= view('supplier/information') ?>
            <form action="<?= base_url('save/third_step') ?>" method="post" enctype="multipart/form-data" id="supplierForm">
                <?= csrf_field() ?>
                <div class="shadow mt-sm-5 mt-3 p-sm-5 p-3 bg-body rounded border border-light rounded-3">

                    <?= view('supplier/step_indicator') ?>

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
                <div class="d-flex button-container justify-content-between mt-sm-5 mt-4" id="buttonContainer">
                    <a href="<?= base_url('second_step') ?>" class="btn btn-secondary shadow rounded-3 px-3 py-2" id="nextButton">
                        Kembali
                    </a>
                    <!-- <a href="<?= base_url('fourth_step') ?>" class="btn btn-danger tr-bg-primary shadow rounded-3 px-3 py-2" id="nextButton">
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
<!-- <script>
    productChange()
    serviceChange()

    function productChange() {
        var productName = document.getElementsByClassName('cb-product')
        var serviceName = document.getElementsByClassName('cb-service')
        var productId = document.getElementById('product')
        var serviceId = document.getElementById('service')

        var count = 0;
        for (var i = 0; i < productName.length; i++) {
            if (productName[i].checked) {
                count++
            }
        }

        if (count > 0) {

            for (var i = 0; i < serviceName.length; i++) {
                serviceName[i].disabled = true
            }

        } else {
            for (var i = 0; i < serviceName.length; i++) {
                serviceName[i].disabled = false
            }
        }
    }
</script>
<script>
    function serviceChange() {
        var productName = document.getElementsByClassName('cb-product')
        var serviceName = document.getElementsByClassName('cb-service')
        var productId = document.getElementById('product')
        var serviceId = document.getElementById('service')

        var count = 0;
        for (var i = 0; i < serviceName.length; i++) {
            if (serviceName[i].checked) {
                count++
            }
        }

        if (count > 0) {

            for (var i = 0; i < productName.length; i++) {
                productName[i].disabled = true
            }

        } else {
            for (var i = 0; i < productName.length; i++) {
                productName[i].disabled = false
            }
        }
    }
</script> -->
<?= $this->endSection() ?>