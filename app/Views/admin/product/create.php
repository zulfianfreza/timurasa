<?= $this->extend('admin/layout/template') ?>

<?= $this->section('styles') ?>

<!-- Custom styles for this page -->
<link href="<?= base_url() ?>/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Kategori</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold tr-text-primary"><?= isset($category) ? 'Edit' : 'Tambah' ?> Data Kategori</h6>
        </div>
        <form action="<?= isset($category) ? base_url('admin/product/update/' . $category['id']) : base_url('admin/product/create') ?>" method="POST">
            <?= csrf_field() ?>
            <?php
            if (isset($category)) {
            ?>
                <input type="hidden" name="_method" value="PATCH">
            <?php
            }
            ?>
            <div class="card-body">
                <div class="">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" name="product" placeholder="Nama Produk" value="<?= isset($product) ? $product['name'] : '' ?>">
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-danger tr-bg-primary">
                    Simpan
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

<?= $this->endSection() ?>