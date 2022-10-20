<!DOCTYPE html>
<html>

<head>
    <title>Export Data Ke Excel Dengan PHP - www.malasngoding.com</title>
</head>

<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;

        }

        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>

    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Supplier.xls");
    ?>
    <table border="1">
        <thead>

            <tr>
                <th>No</th>
                <th>ID Supplier</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Perusahaan</th>
                <th>Alamat</th>
                <th>Provinsi</th>
                <th>Kota</th>
                <th>Kode Pos</th>
                <th>Bidang Usaha</th>
                <th>Produk/Jasa</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($supplier as $row) :
                $db = db_connect();
                $query_product = $db->query("SELECT product_category.name, supplier_product.product_name, supplier_product.product_description, supplier_product.price, supplier_product.unit, supplier_product.capacity, supplier_product.quality, supplier_product.termin FROM supplier_product JOIN product_category ON supplier_product.id_product = product_category.id WHERE supplier_product.id_supplier='$row->id_supplier'");
                $product = $query_product->getResultArray();
                $query_service = $db->query("SELECT service_category.name, supplier_service.service_name, supplier_service.service_description FROM supplier_service JOIN service_category ON supplier_service.id_service = service_category.id WHERE supplier_service.id_supplier='$row->id_supplier'");
                $service = $query_service->getResultArray();
                $count = count($product) + count($service);
            ?>
                <tr>
                    <td rowspan="<?= $count ?>"><?= $no++ ?></td>
                    <td rowspan="<?= $count ?>"><?= $row->id_supplier ?></td>
                    <td rowspan="<?= $count ?>"><?= $row->name ?></td>
                    <td rowspan="<?= $count ?>"><?= $row->email ?></td>
                    <td rowspan="<?= $count ?>"><?= $row->phone_number ?></td>
                    <td rowspan="<?= $count ?>"><?= $row->company ?></td>
                    <td rowspan="<?= $count ?>"><?= $row->address ?></td>
                    <td rowspan="<?= $count ?>"><?= $row->province ?></td>
                    <td rowspan="<?= $count ?>"><?= $row->city ?></td>
                    <td rowspan="<?= $count ?>"><?= $row->zip_code ?></td>
                    <td rowspan="<?= $count ?>"><?= $row->business_major ?></td>
                    <?php

                    $product_temp = [];
                    $service_temp = [];
                    $product_name = [];
                    $product_description = [];
                    $price = [];
                    $unit = [];
                    $capacity = [];
                    $quality = [];
                    $term = [];
                    $service_name = [];
                    $service_description = [];

                    foreach ($product as $product) {
                        array_push($product_temp, $product['name']);
                        array_push($product_name, $product['product_name']);
                        array_push($product_description, $product['product_description']);
                        array_push($price, $product['price']);
                        array_push($unit, $product['unit']);
                        array_push($capacity, $product['capacity']);
                        array_push($quality, $product['quality']);
                        array_push($term, $product['termin']);
                    }
                    foreach ($service as $service) {
                        array_push($service_temp, $service['name']);
                        array_push($service_name, $service['service_name']);
                        array_push($service_description, $service['service_description']);
                    }

                    if (count($product_temp) != 0) {
                        foreach ($product_temp as $key => $element) {
                            if ($key == 0) {
                    ?>
                                <td>
                                    Kategori : <?= $element ?> <br>
                                    Nama Produk : <?= $product_name[$key] ?> <br>
                                    Deskripsi Produk : <?= $product_description[$key] ?> <br>
                                    Harga : <?= $price[$key] . '/' . $unit[$key] ?> <br>
                                    Kapasitas : <?= $capacity[$key] ?> <br>
                                    Kualitas : <?= $quality[$key] ?> <br>
                                    Term of Payment : <?= $term[$key] ?> <br>
                                </td>
                            <?php
                            }
                            ?>
                            <?php
                        }
                    } else {
                        foreach ($service_temp as $key => $element) {
                            if ($key == 0) {
                            ?>
                                <td>
                                    Kategori : <?= $element ?> <br>
                                    Nama Jasa : <?= $service_name[$key] ?> <br>
                                    Deskripsi Jasa : <?= $service_description[$key] ?> <br>
                                </td>
                    <?php
                            }
                        }
                    }
                    ?>
                    <td rowspan="<?= $count ?>">
                        <?php
                        $s = strtotime($row->created_at);
                        $date = date('Y-m-d', $s);
                        $time = date('H:i:s', $s);
                        echo indonesia_date($date) . ', ' . $time;
                        ?>
                    </td>
                    <td rowspan="<?= $count ?>"><?= $row->status == '2' ? 'Proses Verifikasi' : ($row->status == '1' ? 'Verifikasi' : 'Belum Verifikasi') ?></td>
                </tr>
                <?php
                if (count($product_temp) != 0) {
                    foreach ($product_temp as $key => $element) {
                        if ($key != 0) {
                ?>
                            <tr>
                                <td>
                                    Kategori : <?= $element ?> <br>
                                    Nama Produk : <?= $product_name[$key] ?> <br>
                                    Deskripsi Produk : <?= $product_description[$key] ?> <br>
                                    Harga : <?= $price[$key] . '/' . $unit[$key] ?> <br>
                                    Kapasitas : <?= $capacity[$key] ?> <br>
                                    Kualitas : <?= $quality[$key] ?> <br>
                                    Term of Payment : <?= $term[$key] ?> <br>
                                </td>
                            </tr>
                <?php
                        }
                    }
                }
                ?>
                <?php
                if (count($product_temp) != 0) {

                    foreach ($service_temp as $key => $element) {
                ?>
                        <tr>
                            <td>
                                Kategori : <?= $element ?> <br>
                                Nama Jasa : <?= $service_name[$key] ?> <br>
                                Deskripsi Jasa : <?= $service_description[$key] ?> <br>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    foreach ($service_temp as $key => $element) {
                        if ($key != 0) {


                        ?>
                            <tr>
                                <td>
                                    Kategori : <?= $element ?> <br>
                                    Nama Jasa : <?= $service_name[$key] ?> <br>
                                    Deskripsi Jasa : <?= $service_description[$key] ?> <br>
                                </td>
                            </tr>
                <?php
                        }
                    }
                }
                ?>
            <?php endforeach ?>
        </tbody>
    </table>
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
</body>

</html>