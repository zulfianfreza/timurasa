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
            <h6 class="m-0 font-weight-bold tr-text-primary">Data Profile</h6>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('error')) : ?>
                <script>
                    toastr.error('<?= session()->getFlashdata('error') ?>');
                </script>
            <?php endif; ?>
            <?php if (session()->getFlashdata('message')) : ?>
                <script>
                    toastr.success('<?= session()->getFlashdata('message') ?>');
                </script>
            <?php endif; ?>

            <a href="<?= base_url('admin/profile/update/name') ?>" class="text-decoration-none text-dark">
                <div class="row d-flex align-items-center">
                    <div class="col-sm-6">
                        <p>
                            <span class="h5 font-weight-bold">Nama</span> <br>
                            <span class="text-secondary"><?= $user[0]->name ?></span>
                        </p>
                    </div>
                    <div class="col-sm-6 text-right">
                        <p>
                            <i class="fas fa-chevron-right"></i>
                        </p>
                    </div>
                </div>
            </a>
            <a href="<?= base_url('admin/profile/update/username') ?>" class="text-decoration-none text-dark">
                <div class="row d-flex align-items-center">
                    <div class="col-sm-6">
                        <p>
                            <span class="h5 font-weight-bold">Username</span> <br>
                            <span class="text-secondary"><?= $user[0]->username ?></span>
                        </p>
                    </div>
                    <div class="col-sm-6 text-right">
                        <p>
                            <i class="fas fa-chevron-right"></i>
                        </p>
                    </div>
                </div>
            </a>
            <a href="" class="text-decoration-none text-dark">
                <div class="row d-flex align-items-center">
                    <div class="col-sm-6">
                        <p>
                            <span class="h5 font-weight-bold">Role</span> <br>
                            <span class="text-secondary"><?= $user[0]->role ?></span>
                        </p>
                    </div>
                </div>
            </a>
            <a href="<?= base_url('admin/profile/update/password') ?>" class="text-decoration-none text-dark">
                <div class="row d-flex align-items-center">
                    <div class="col-sm-6">
                        <p>
                            <span class="h5 font-weight-bold">Password</span> <br>
                            <span class="text-secondary">********</span>
                        </p>
                    </div>
                    <div class="col-sm-6 text-right">
                        <p>
                            <i class="fas fa-chevron-right"></i>
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<?= $this->endSection() ?>