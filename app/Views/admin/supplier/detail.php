<?= $this->extend('admin/layout/template') ?>

<?= $this->section('styles') ?>

<!-- Custom styles for this page -->
<link href="<?= base_url() ?>/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Supplier</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold">
                <span class="tr-text-primary">Data Supplier</span> - <?= $supplier[0]->id_supplier ?>
                <span class="badge <?= $supplier[0]->status == 2 ? 'badge-warning' : ($supplier[0]->status == 1 ? 'badge-success' : 'badge-danger') ?>">
                    <?= $supplier[0]->status == 2 ? 'Proses Verifikasi' : ($supplier[0]->status == 1 ? 'Verifikasi' : 'Belum Verifikasi') ?>
                </span>
            </h6>

        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('message_set_active')) : ?>
                <script>
                    toastr.info('<?= session()->getFlashdata('message_set_active') ?>');
                </script>
            <?php endif; ?>
            <?php if (session()->getFlashdata('message')) : ?>
                <script>
                    toastr.success('<?= session()->getFlashdata('message') ?>');
                </script>
            <?php endif; ?>
            <section id="contact-information">
                <h4>Informasi Kontak</h4>
                <table class="table table-borderless">
                    <tr>
                        <td>Nama</td>
                        <td>: <?= $supplier[0]->name ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>: <?= $supplier[0]->email ?></td>
                    </tr>
                    <tr>
                        <td>No Telepon</td>
                        <td>: <?= $supplier[0]->phone_number ?></td>
                    </tr>
                    <tr>
                        <td>Perusahaan</td>
                        <td>: <?= $supplier[0]->company ?></td>
                    </tr>
                    <tr>
                        <td>Whatsapp</td>
                        <td>: <?= $supplier[0]->whatsapp ?></td>
                    </tr>
                    <tr>
                        <td>Facebook</td>
                        <td>: <?= $supplier[0]->facebook ?></td>
                    </tr>
                    <tr>
                        <td>Instagram</td>
                        <td>: <?= $supplier[0]->instagram ?></td>
                    </tr>
                    <tr>
                        <td>Bidang Usaha</td>
                        <td>: <?= $supplier[0]->business_major ?></td>
                    </tr>
                </table>
            </section>

            <section id="address" class="mt-3">
                <h4>Alamat</h4>
                <table class="table table-borderless">
                    <tr>
                        <td>Alamat Perusahaan</td>
                        <td>: <?= $supplier[0]->address ?></td>
                    </tr>
                    <tr>
                        <td>Provinsi</td>
                        <td>: <?= $supplier[0]->province ?></td>
                    </tr>
                    <tr>
                        <td>Kota</td>
                        <td>: <?= $supplier[0]->city ?></td>
                    </tr>
                    <tr>
                        <td>Kode POS</td>
                        <td>: <?= $supplier[0]->zip_code ?></td>
                    </tr>
                </table>
            </section>

            <?php
            if (count($product) != 0) {
            ?>
                <section id="product" class="mt-3">
                    <h4>Informasi Produk</h4>
                    <div id="accordion">
                        <?php
                        foreach ($product as $key => $res) {
                        ?>
                            <div class="card">
                                <div class="card-header" id="heading<?= $key ?>">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?= $key ?>" aria-expanded="true" aria-controls="collapse<?= $key ?>">
                                            Produk - <?= $res->name ?>
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapse<?= $key ?>" class="collapse" aria-labelledby="heading<?= $key ?>" data-parent="#accordion">
                                    <div class="card-body">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>Nama Produk</td>
                                                <td>: <?= $res->product_name ?></td>
                                            </tr>
                                            <tr>
                                                <td>Deskripsi Produk</td>
                                                <td>: <?= $res->product_description ?></td>
                                            </tr>
                                            <tr>
                                                <td>Harga</td>
                                                <td>: <?= 'Rp.' . number_format($res->price, 0, ',', '.') . '/' . $res->unit ?></td>
                                            </tr>
                                            <tr>
                                                <td>Termasuk Ongkor Kirim</td>
                                                <td>: <?= $res->with_shipping_cost == 'true' ? 'Ya' : 'Tidak' ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kapasitas</td>
                                                <td>: <?= $res->capacity ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kualitas</td>
                                                <td>: <?= $res->quality ?></td>
                                            </tr>
                                            <tr>
                                                <td>Term of Payment</td>
                                                <td>: <?= $res->termin ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </section>
            <?php } ?>

            <?php
            if (count($service) != 0) {
            ?>
                <section id="service" class="mt-3">
                    <h4>Informasi Jasa</h4>
                    <div id="accordion">
                        <?php
                        foreach ($service as $key => $res) {
                        ?>
                            <div class="card">
                                <div class="card-header" id="heading<?= $key ?>">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?= $key ?>" aria-expanded="true" aria-controls="collapse<?= $key ?>">
                                            Jasa - <?= $res->name ?>
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapse<?= $key ?>" class="collapse" aria-labelledby="heading<?= $key ?>" data-parent="#accordion">
                                    <div class="card-body">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>Nama Jasa</td>
                                                <td>: <?= $res->service_name ?></td>
                                            </tr>
                                            <tr>
                                                <td>Deskripsi Jasa</td>
                                                <td>: <?= $res->service_description ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </section>
            <?php } ?>

            <section id="document" class="mt-3">
                <h4>Dokumen</h4>
                <table class="table table-borderless">
                    <?php
                    foreach ($document as $key => $element) {
                    ?>
                        <tr>
                            <td>
                                <a href="<?= base_url('document/' . $element->document) ?>" target="_blank">
                                    <?= $element->document ?>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </section>

        </div>
        <div class="card-footer d-flex justify-content-between">
            <p class="my-auto">Verifikasi</p>
            <div>
                <form action="<?= base_url('admin/supplier/verification/' . base64_encode($supplier[0]->id_supplier) . '/0') ?>" method="POST" class="d-inline">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PATCH">
                    <button class="btn btn-danger mr-1"><i class="fas fa-times"></i> Tidak</button>
                </form>
                <form action="<?= base_url('admin/supplier/verification/' . base64_encode($supplier[0]->id_supplier) . '/1') ?>" method="POST" class="d-inline">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PATCH">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Verifikasi</button>
                </form>
            </div>
        </div>
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

<?= $this->endSection() ?>