<?= $this->extend('admin/layout/template') ?>

<?= $this->section('styles') ?>

<!-- Custom styles for this page -->
<link href="<?= base_url() ?>/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">User</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold tr-text-primary"><?= isset($user) ? 'Edit' : 'Tambah' ?> Data User</h6>
        </div>
        <form action="<?= isset($user) ? base_url('admin/user/update/' . $user['id']) : base_url('admin/user/create') ?>" method="POST">
            <?= csrf_field() ?>
            <?php
            if (isset($user)) {
            ?>
                <input type="hidden" name="_method" value="PATCH">
            <?php
            }
            ?>
            <div class="card-body">

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif ?>

                <div class="form-group">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="name" placeholder="Nama" value="<?= isset($user) ? $user['name'] : old('name') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" value="<?= isset($user) ? $user['name'] : old('username') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" value="<?= isset($user) ? $user['name'] : old('password') ?>">
                </div>
                <div class="form-group">
                    <label for="">Role</label>
                    <select name="role" id="" class="form-control">
                        <option value="superadmin">Superadmin</option>
                        <option value="admin">admin</option>
                    </select>
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