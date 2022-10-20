<?= $this->extend('admin/layout/template') ?>

<?= $this->section('styles') ?>

<!-- Custom styles for this page -->
<!-- <link href="<?= base_url() ?>/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"> -->

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Supplier</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold tr-text-primary">Data Supplier</h6>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Export
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="<?= base_url('admin/supplier/export/excel') ?>">
                        Export to Excel
                    </a>
                </div>
                <a href="<?= base_url('admin/supplier/first_step') ?>" class="btn btn-danger tr-btn-primary">
                    <i class="fas fa-plus"></i> Tambah
                </a>
            </div>
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
                            <th>ID Supplier</th>
                            <th>Nama</th>
                            <th>Perusahaan</th>
                            <th>Bidang Usaha</th>
                            <th>Produk/Jasa</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>ID Supplier</th>
                            <th>Nama</th>
                            <th>Perusahaan</th>
                            <th>Bidang Usaha</th>
                            <th>Produk/Jasa</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        // dd($supplier);
                        $no = 1;
                        foreach ($supplier as $supplier) :
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $supplier->id_supplier ?></td>
                                <td><?= $supplier->name ?></td>
                                <td><?= $supplier->company ?></td>
                                <td><?= $supplier->business_major ?></td>
                                <td>
                                    <?php
                                    $db = db_connect();
                                    $query_product = $db->query("SELECT product_category.name FROM supplier_product JOIN product_category ON supplier_product.id_product = product_category.id WHERE supplier_product.id_supplier='$supplier->id_supplier'");
                                    $product = $query_product->getResultArray();
                                    $query_service = $db->query("SELECT service_category.name FROM supplier_service JOIN service_category ON supplier_service.id_service = service_category.id WHERE supplier_service.id_supplier='$supplier->id_supplier'");
                                    $service = $query_service->getResultArray();
                                    $temp = [];

                                    foreach ($product as $product) {
                                        array_push($temp, $product['name']);
                                    }
                                    foreach ($service as $service) {
                                        array_push($temp, $service['name']);
                                    }
                                    echo join(', ', $temp);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $s = strtotime($supplier->created_at);
                                    $date = date('Y-m-d', $s);
                                    $time = date('H:i:s', $s);
                                    echo indonesia_date($date) . ', ' . $time;
                                    ?>
                                </td>
                                <td>
                                    <span class="badge <?= $supplier->status == 2 ? 'badge-warning' : ($supplier->status == 1 ? 'badge-success' : 'badge-danger tr-bg-primary') ?>">
                                        <?= $supplier->status == 2 ? 'Proses Verifikasi' : ($supplier->status == 1 ? 'Verifikasi' : 'Belum Verifikasi') ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/supplier/' . base64_encode($supplier->id_supplier)) ?>" class="btn btn-primary">
                                        Lihat
                                    </a>

                                    <a href="<?= base_url('admin/supplier/edit/first/' . base64_encode($supplier->id_supplier)) ?>" class="btn btn-warning">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="#myModal" class="btn btn-danger tr-btn-primary" data-toggle="modal">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <!-- <button type="submit" class="btn btn-danger tr-btn-primary">
                                        <i class="fas fa-trash"></i>
                                    </button> -->
                                    <!-- </a> -->
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
                                            <form action="<?= base_url('admin/supplier/' . base64_encode($supplier->id_supplier)) ?>" method="POST">
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

<?php
function indonesia_date($date)
{

    $month = array(
        1 =>       'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

    $var = explode('-', $date);

    return $var[2] . ' ' . $month[(int)$var[1]] . ' ' . $var[0];
    // var 0 = tanggal
    // var 1 = bulan
    // var 2 = tahun
}
?>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<!-- Page level plugins -->
<script src="<?= base_url() ?>/assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url() ?>/assets/js/demo/datatables-demo.js"></script>
<!-- <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script> -->
<script>
    // Call the dataTables jQuery plugin
    // $(document).ready(function() {
    //     $("#dataTable").DataTable({
    //         dom: "Bfrtip",
    //         buttons: ["excelHtml5", "csvHtml5", "pdfHtml5"],
    //     });
    // });
</script>

<?= $this->endSection() ?>