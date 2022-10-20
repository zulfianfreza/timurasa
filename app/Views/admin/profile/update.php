<?= $this->extend('admin/layout/template') ?>

<?= $this->section('styles') ?>


<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Profile</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold tr-text-primary">Edit Profile</h6>
        </div>
        <form action="<?= base_url('admin/profile/update/' . $column) ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PATCH">
            <div class="card-body">
                <?php if (session()->getFlashdata('error')) : ?>
                    <script>
                        toastr.error('<?= session()->getFlashdata('error') ?>');
                    </script>
                <?php endif; ?>
                <?php
                if ($column == 'password') {
                ?>
                    <div class="form-group">
                        <label class="form-label">Password Sekarang</label>
                        <input type="password" name="old_password" class="form-control" placeholder="Password Sekarang" value="">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="new_password" class="form-control" placeholder="Password Baru" value="">
                    </div>
                <?php
                } else {
                ?>
                    <div class="form-group">
                        <label class="form-label"><?= $column == 'name' ? 'Nama' : 'Username' ?></label>
                        <input type="text" name="value" class="form-control" placeholder="Nama Kategori" value="<?= $user[0]->$column ?>">
                    </div>
                <?php } ?>
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