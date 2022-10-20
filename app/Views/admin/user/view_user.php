<?= $this->extend('admin/layout/template') ?>

<?= $this->section('styles') ?>

<!-- Custom styles for this page -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"> -->

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">User</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold tr-text-primary">Data User</h6>
            <a href="<?= base_url('admin/user/create') ?>">
                <button class="btn btn-danger tr-btn-primary" <?= session()->get('role') == 'superadmin' ? '' : 'disabled' ?>>
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </a>
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

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($user as $row) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row->name ?></td>
                                <td><?= $row->username ?></td>
                                <td><?= $row->role ?></td>
                                <td>
                                    <?php
                                    if ($row->role == 'superadmin') {
                                    } else {
                                    ?>
                                        <form action="<?= base_url('admin/user/delete/' . base64_encode($row->username)) ?>" method="POST">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger tr-btn-primary" <?= session()->get('role') == 'superadmin' ? '' : 'disabled' ?>>
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

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
<!-- DataTables with Button Export -->
<!-- <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script> -->

<?= $this->endSection() ?>