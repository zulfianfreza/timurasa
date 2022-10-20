<?= $this->extend('admin/layout/template') ?>

<?= $this->section('styles') ?>

<!-- Custom styles for this page -->
<!-- <link href="<?= base_url() ?>/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"> -->

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
$prov = [];
foreach ($provinsi as $key => $row) {
    $data = [
        'id' => $key,
        'provinsi' => $row,
    ];
    array_push($prov, $data);
}
usort($prov, function ($a, $b) {
    return $a['provinsi'] <=> $b['provinsi'];
});
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Supplier</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold tr-text-primary">Tambah Supplier</h6>

        </div>
        <form action="<?= base_url('admin/supplier/update/second/' . base64_encode($supplier[0]['id_supplier'])) ?>" method="POST">
            <div class="card-body">
                <!-- <div class="progress my-3">
                    <div class="progress-bar progress-bar-striped bg-danger tr-bg-primary" id="progressBar" role="progressbar" style="width: 20%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div> -->
                <div class="mb-5"></div>
                <h5 class="fw-bolder">Alamat Lengkap</h5>
                <p>
                    Tolong isi informasi dengan benar, agar team kami
                    dapat menghubungi anda.
                </p>
                <div class="row mb-4">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label fw-bolder">Alamat Perusahaan</label>
                            <input type="text" class="form-control p-2 shadow-sm " placeholder="Alamat Lengkap" name="address" value="<?= $supplier[0]['address'] ?>" required />
                            <div class="invalid-feedback">
                                Alamat tidak boleh kosong.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-lg-0 mt-4">
                        <div class="form-group">
                            <label class="form-label fw-bolder">Provinsi</label>
                            <select name="province" id="province" class="form-control p-2 select2 shadow-sm " aria-label="Default select" onchange="getCity()" required>
                                <option value="" selected>Provinsi</option>
                                <?php foreach ($prov as $key => $row) : ?>
                                    <option value="<?= $row['provinsi'] ?>" provId="<?= $row['id'] ?>" <?= $row['provinsi'] == $supplier[0]['province'] ? 'selected' : '' ?>><?= $row['provinsi'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">
                                Silahkan pilih provinsi.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-4">
                        <div class="form-group">
                            <label class="form-label fw-bolder">Kota</label>
                            <select name="city" id="city" class="form-control p-2 shadow-sm" aria-label="Default select" onchange="getZipCode()" required>
                                <option value="" selected>Kota</option>
                            </select>
                            <div class="invalid-feedback">
                                Silahkan pilih kota.
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-4">
                        <div class="form-group">
                            <label class="form-label fw-bolder">Kode Pos</label>
                            <input type="text" name="zip_code" class="form-control p-2 shadow-sm" placeholder="Kode Pos" list="zip_code" value="<?= $supplier[0]['zip_code'] ?>">
                            <datalist id="zip_code" id="zip_code" required>
                            </datalist>
                            <div class="invalid-feedback">
                                Kode Pos tidak boleh kosong.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between" id="buttonContainer">
                <a href="<?= base_url('admin/supplier/edit/first/' . base64_encode($supplier[0]['id_supplier'])) ?>">
                    <button type="button" class="btn btn-secondary shadow rounded-3 px-3 py-2" id="prevButton" onclick="nextPrev(-1)">
                        Kembali
                    </button>
                </a>
                <button type="submit" class="btn btn-danger tr-bg-primary shadow rounded-3 px-3 py-2" id="nextButton" onclick="nextPrev(1)">
                    Selanjutnya
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

<script>
    getCity();
    async function getCity() {
        provinsi = document.getElementById("province");
        d = provinsi.options[provinsi.selectedIndex].getAttribute('provId');
        const url = 'https://kodepos-2d475.firebaseio.com/list_kotakab/' + d + '.json?print=pretty';
        const data = await getApi(url);

        provinsi.classList.remove('is-invalid')
        document.getElementById('city').innerHTML = "";

        // console.log(data);

        var x = document.getElementById('city');
        // var option = new Option('<?= $supplier[0]['city'] ?>', '');
        // option.setAttribute('disabled', 'true')
        // option.setAttribute('selected', 'true')
        // x.appendChild(option);

        Object.keys(data).forEach(key => {
            var x = document.getElementById('city');
            var option = new Option(data[key], data[key]);
            option.setAttribute('cityId', key)
            if (data[key] == '<?= $supplier[0]['city'] ?>') {
                option.setAttribute('selected', true)
            }
            x.appendChild(option);
            x.classList.remove('is-invalid')
        })

        getZipCode()

    }

    async function getZipCode() {
        city = document.getElementById("city");
        d = city.options[city.selectedIndex].getAttribute('cityId');
        const url = 'https://kodepos-2d475.firebaseio.com/kota_kab/' + d + '.json?print=pretty';
        const data = await getApi(url);

        provinsi.classList.remove('is-invalid')
        document.getElementById('zip_code').innerHTML = "";

        let zipcode = []

        const unique = data.filter(element => {
            const isDuplicate = zipcode.includes(element.kodepos)

            if (!isDuplicate) {
                zipcode.push(element.kodepos)
                return true
            }
            return false
        })

        console.log(zipcode)

        for (let i = 0; i < zipcode.length; i++) {
            var x = document.getElementById('zip_code');
            var option = new Option(zipcode[i], zipcode[i]);
            x.appendChild(option);
            x.classList.remove('is-invalid')
        }
    }
    async function getApi(url) {
        const response = await fetch(url);
        var data = await response.json();

        return data;
    }
</script>

<?= $this->endSection() ?>