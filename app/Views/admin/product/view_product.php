<?= $this->extend('admin/layout/template') ?>

<?= $this->section('styles') ?>

<!-- Custom styles for this page -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Produk</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold tr-text-primary">Data Produk</h6>
            <a href="<?= base_url('admin/product/create') ?>" class="btn btn-danger tr-btn-primary">
                <i class="fas fa-plus"></i> Tambah
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
                            <th>Nama Produk</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($product as $product) :
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $product['name'] ?></td>
                                <td class="<?= $product['status'] == 1 ? 'text-success' : 'text-danger tr-text-primary' ?>"><?= $product['status'] == 1 ? 'Aktif' : 'Tidak Aktif' ?></td>
                                <td>

                                    <form action="<?= base_url() ?>/admin/product/<?= base64_encode($product['id']) ?>" method="POST" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="PATCH">
                                        <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $product['status'] == 1 ? 'Non-aktifkan' : 'Aktifkan' ?> Data">
                                            <i class="fas <?= $product['status'] == 1 ? 'fa-eye-slash' : 'fa-eye' ?>"></i>
                                        </button>
                                    </form>
                                    <a href="<?= base_url('admin/product/update/' . base64_encode($product['id'])) ?>">
                                        <button class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                    </a>
                                    <a href="#myModal" data-toggle="modal">
                                        <button type="submit" class="btn btn-danger tr-btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data">
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
                                            <form action="<?= base_url('admin/product/delete/' . base64_encode($product['id'])) ?>" method="POST">
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
<!-- DataTables with Button Export -->
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

<?= $this->endSection() ?>