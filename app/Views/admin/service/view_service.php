<?= $this->extend('admin/layout/template') ?>

<?= $this->section('styles') ?>

<!-- Custom styles for this page -->
<link href="<?= base_url() ?>/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->

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

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Produk dan Jasa</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold tr-text-primary">Data Produk dan Jasa</h6>
            <a href="<?= base_url('admin/service/create') ?>" class="btn btn-danger tr-bg-primary">
                <i class="fas fa-plus"></i> Tambah
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk dan Jasa</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk dan Jasa</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($service as $service) :
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $service['name'] ?></td>
                                <td class="<?= $service['status'] == 1 ? 'text-success' : 'text-danger tr-text-primary' ?>"><?= $service['status'] == 1 ? 'Aktif' : 'Tidak Aktif' ?></td>
                                <td>

                                    <form action="<?= base_url() ?>/admin/service/<?= base64_encode($service['id']) ?>" method="POST" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="PATCH">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas <?= $service['status'] == 1 ? 'fa-eye-slash' : 'fa-eye' ?>"></i>
                                        </button>
                                    </form>
                                    <a href="<?= base_url('admin/service/update/' . base64_encode($service['id'])) ?>">
                                        <button class="btn btn-warning">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                    </a>

                                    <a href="#myModal" data-toggle="modal">
                                        <button class="btn btn-danger tr-btn-primary" type="submit">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            <div id="myModal" class="modal fade">
                                <div class="modal-dialog modal-confirm modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header flex-row">
                                            <h4 class="modal-title w-100">Apakah kamu yakin?</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah kamu yakin akan menghapus data ini?</p>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <form action="<?= base_url('admin/service/delete/' . base64_encode($service['id'])) ?>" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger tr-btn-primary">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

<?= $this->endSection() ?>