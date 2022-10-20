<?= $this->extend('admin/layout/template') ?>

<?= $this->section('styles') ?>

<style>
    .tab-step {
        display: none;
    }
</style>
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
        <form action="<?= base_url('admin/supplier/update/' . base64_encode($supplier[0]->id_supplier)) ?>" method="post" enctype="multipart/form-data" id="supplierform">
            <input type="hidden" name="_method" value="PATCH">
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

                <div class="progress my-3">
                    <div class="progress-bar progress-bar-striped bg-danger tr-bg-primary" id="progressBar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="mb-5"></div>

                <div class="tab-step">

                    <h5 class="fw-bolder">Informasi Kontak</h5>
                    <p>
                        Tolong isi informasi dengan benar, agar team kami
                        dapat menghubungi anda.
                    </p>
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Nama</label>
                                <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="Nama" name="name" onkeyup="removeInvalid(this)" value="<?= old('name') ?? $supplier[0]->name ?>" />
                                <div class=" invalid-feedback">
                                    Nama tidak boleh kosong.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-lg-0 mt-4">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Email</label>
                                <input type="email" class="form-control p-2 shadow-sm email-required" placeholder="Email" name="email" onkeyup="removeInvalid(this)" value="<?= old('email') ?? $supplier[0]->email ?>" />
                                <div class="invalid-feedback" id="invalidEmail">
                                    Email tidak boleh kosong.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Nomor Telepon</label>
                                <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="(+62) 456 - 7890" name="phone_number" onkeyup="removeInvalid(this)" value="<?= old('phone_number') ?? $supplier[0]->phone_number ?>" />
                                <div class="invalid-feedback" id="invalidEmail">
                                    Nomor Telepon tidak boleh kosong.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Perusahaan</label>
                                <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="Perusahaan" name="company" onkeyup="removeInvalid(this)" value="<?= old('company') ?? $supplier[0]->company ?>" />
                                <div class="invalid-feedback" id="invalidEmail">
                                    Nama perusahaan tidak boleh kosong.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <div class="form-group">
                                <label class="form-label fw-bolder">WhatsApp
                                </label>
                                <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="WhatsApp" name="whatsapp" value="<?= old('whatsapp') ?? $supplier[0]->whatsapp ?>" />
                                <div class="invalid-feedback" id="invalidEmail">
                                    Nama perusahaan tidak boleh kosong.
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Facebook
                                    <span class="tr-text-primary shadow-sm">*</span></label>
                                <input type="text" class="form-control p-2 shadow-sm" placeholder="Facebook" name="facebook" value="<?= old('facebook') ?? $supplier[0]->facebook ?>" />
                                <div class="form-text tr-text-primary">
                                    *Opsional.
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Instagram
                                    <span class="tr-text-primary shadow-sm">*</span></label>
                                <input type="text" class="form-control p-2 shadow-sm" placeholder="Instagram" name="instagram" value="<?= old('instagram') ?? $supplier[0]->instagram ?>" />
                                <div class="form-text tr-text-primary">
                                    *Opsional.
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="tab-step">
                    <h5 class="fw-bolder">Alamat Lengkap</h5>
                    <p>
                        Tolong isi informasi dengan benar, agar team kami
                        dapat menghubungi anda.
                    </p>
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Alamat Perusahaan</label>
                                <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="Alamat Lengkap" name="address" onkeyup="removeInvalid(this)" value="<?= old('address') ?? $supplier[0]->address ?>" />
                                <div class="invalid-feedback">
                                    Alamat tidak boleh kosong.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-lg-0 mt-4">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Provinsi</label>
                                <select name="province" id="province" class="form-control p-2 select2 shadow-sm input-required" aria-label="Default select" onchange="getCity()">
                                    <option value="" selected>Provinsi</option>
                                    <?php foreach ($prov as $key => $row) : ?>
                                        <option value="<?= $row['provinsi'] ?>" <?= $supplier[0]->province == $row['provinsi'] ? 'selected' : '' ?> provId="<?= $row['id'] ?>"><?= $row['provinsi'] ?></option>
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
                                <select name="city" id="city" class="form-control p-2 shadow-sm input-required" aria-label="Default select" onchange="getZipCode()">
                                    <option value="<?= $supplier[0]->city ?>" selected><?= $supplier[0]->city ?></option>
                                </select>
                                <div class="invalid-feedback">
                                    Silahkan pilih kota.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Kode Pos</label>
                                <select name="zip_code" id="zip_code" class="form-control p-2 shadow-sm input-required" aria-label="Default select">
                                    <option value="<?= $supplier[0]->zip_code ?>" selected><?= $supplier[0]->zip_code ?></option>
                                </select>
                                <!-- <input type="number" class="form-control p-2 shadow-sm input-required" placeholder="Zip" name="zip_code" onkeyup="removeInvalid(this)" value="<?= old('zip_code') ?>" /> -->
                                <div class="invalid-feedback">
                                    Kode Pos tidak boleh kosong.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-step">
                    <h5 class="fw-bolder">Bidang Usaha</h5>
                    <p>
                        Isi bidang usaha dan pilih satu atau beberapa
                        kategory bidang usaha anda.
                    </p>
                    <div class="mt-4">
                        <div class="form-group">
                            <label class="form-label fw-bolder">Bidang Usaha</label>
                            <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="Bidang Usaha" name="business_major" valueonkeyup="removeInvalid(this)" value="<?= old('business_major') ?? $supplier[0]->business_major ?>" />
                            <div class="invalid-feedback">
                                Bidang usaha tidak boleh kosong.
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="form-label fw-bolder">Kategori</label>
                        <div class="row">
                            <?php foreach ($category as $category) :  ?>
                                <div class="col-xxl-4 col-lg-6 col-sm-12">
                                    <div class="form-check">
                                        <?php
                                        $sup_category = [];
                                        foreach ($supplier_category as $row) {
                                            array_push($sup_category, $row->id);
                                        }
                                        ?>
                                        <input class="form-check-input" type="checkbox" value="<?= $category['id'] ?>" <?= in_array($category['id'], $sup_category) ? 'checked' : '' ?> id="<?= $category['name'] ?>" name="category[]" />
                                        <label class="form-check-label" for="<?= $category['name'] ?>">
                                            <?= $category['name'] ?>
                                        </label>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="form-label fw-bolder">Produk dan Jasa</label>
                        <div class="row">
                            <?php foreach ($product_and_service as $pas) :  ?>
                                <div class="col-xxl-4 col-lg-6 col-sm-12">
                                    <div class="form-check">
                                        <?php
                                        $sup_pas = [];
                                        foreach ($supplier_product_and_service as $row) {
                                            array_push($sup_pas, $row->id);
                                        }
                                        ?>
                                        <input class="form-check-input" type="checkbox" value="<?= $pas['id'] ?>" <?= in_array($pas['id'], $sup_pas) ? 'checked' : '' ?> id="<?= $pas['name'] ?>" name="product_and_service[]" />
                                        <label class="form-check-label" for="<?= $pas['name'] ?>">
                                            <?= $pas['name'] ?>
                                        </label>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>

                <div class="tab-step">
                    <h5 class="fw-bolder">Identitas Produk</h5>
                    <p>
                        Tolong isi informasi dengan benar, agar team kami
                        dapat menghubungi anda.
                    </p>
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Nama Produk</label>
                                <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="Nama Produk" name="product_name" onkeyup="removeInvalid(this)" value="<?= old('product_name') ?? $supplier[0]->product_name ?>" />
                                <div class="invalid-feedback">
                                    Nama produk tidak boleh kosong.
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mt-4">
                            <div class="form-group">
                                <label for="" class="form-label fw-bolder">Deskripsi Produk</label>
                                <textarea name="product_description" id="" cols="30" rows="3" class="form-control p-2 shadow-sm" placeholder="Deskripsi Produk"><?= old('product_description') ?? $supplier[0]->product_description ?></textarea>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <label class="form-label fw-bolder">Harga per Satuan</label>
                            <div class="input-group">
                                <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="Harga" name="price" onkeyup="removeInvalid(this)" value="<?= old('price') ?? $supplier[0]->price ?>" />
                                <div class="input-group-append">
                                    <span class="input-group-text">/</span>
                                </div>
                                <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="Satuan" list="unit" name="unit" onkeyup="removeInvalid(this)" value="<?= old('unit') ?? $supplier[0]->unit  ?>" />
                                <datalist id="unit">
                                    <option value="kg"></option>
                                    <option value="cm"></option>
                                </datalist>
                                <div class="invalid-feedback">
                                    Harga per Satuan tidak boleh kosong.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Kapasitas</label>
                                <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="Kapasitas" name="capacity" onkeyup="removeInvalid(this)" value="<?= old('capacity') ?? $supplier[0]->capacity ?>" />
                                <div class="invalid-feedback">
                                    Kapasitas tidak boleh kosong.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Kualitas Produk</label>
                                <input type="text" name="quality" class="form-control p-2 shadow-sm input-required" placeholder="Kualitas" list="quality" onkeyup="removeInvalid(this)" value="<?= old('quality') ?? $supplier[0]->quality ?>">
                                <datalist id="quality">
                                    <option value="Super">Super</option>
                                    <option value="Bagus">Bagus</option>
                                </datalist>
                                <div class="invalid-feedback">
                                    Silahkan pilih atau isi kualitas produk.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Ongkos Kirim</label>
                                <input type="text" class="form-control p-2 shadow-sm input-required" placeholder="Ongkos Kirim" name="shipping_cost" onkeyup="removeInvalid(this)" value="<?= old('shipping_cost') ?? $supplier[0]->shipping_cost ?>" />
                                <div class="invalid-feedback">
                                    Silahkan isi ongkos kirim.
                                </div>
                                <div class="form-text">
                                    *Untuk ongkos kirim, silahkan cek di <a class="text-decoration-none" href="https://cek-ongkir.com/">cek-ongkir.com</a>.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Termin Pembayaran</label>
                                <input type="text" name="termin" class="form-control p-2 shadow-sm input-required" placeholder="Termin Pembayaran" list="termin" onkeyup="removeInvalid(this)" value="<?= old('termin') ?? $supplier[0]->termin ?>">
                                <datalist id="termin">
                                    <?php foreach ($termin as $row) : ?>
                                        <option value="<?= $row['termin'] ?>"></option>
                                    <?php endforeach ?>
                                </datalist>
                                <div class="invalid-feedback">
                                    Silahkan pilih atau isi termin pembayaran.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-step">
                    <h5 class="fw-bolder">Data Pendukung</h5>
                    <p>
                        Tolong isi informasi dengan benar, agar team kami
                        dapat menghubungi anda.
                    </p>
                    <div class="mt-4">
                        <label class="form-label fw-bolder">Upload company profile / portfolio
                            disini
                        </label>
                        <input type="file" name="company_profile" id="" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf" class="form-control p-2 shadow-sm">
                        <div class="invalid-feedback">
                            Dokumen pendukung tidak boleh kosong.
                        </div>
                        <small class="form-text text-muted">
                            <?php
                            foreach ($supplier_document as $doc) {
                                echo $doc->document_type == 'Profil Perusahaan' ? $doc->document : '';
                            }
                            ?>
                        </small>
                    </div>
                    <div class="mt-4">
                        <label class="form-label fw-bolder">Perizinan
                        </label>
                        <input type="file" name="permit" id="" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf" class="form-control p-2 shadow-sm">
                        <div class="invalid-feedback">
                            Dokumen pendukung tidak boleh kosong.
                        </div>
                        <small class="form-text text-muted">
                            <?php
                            foreach ($supplier_document as $doc) {
                                echo $doc->document_type == 'Perizinan' ? $doc->document : '';
                            }
                            ?>
                        </small>
                    </div>
                    <div class="mt-4">
                        <label class="form-label fw-bolder">Katalog
                        </label>
                        <input type="file" name="catalog" id="" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf" class="form-control p-2 shadow-sm">
                        <div class="invalid-feedback">
                            Dokumen pendukung tidak boleh kosong.
                        </div>
                        <small class="form-text text-muted">
                            <?php
                            foreach ($supplier_document as $doc) {
                                echo $doc->document_type == 'Katalog' ? $doc->document : '';
                            }
                            ?>
                        </small>
                    </div>
                    <div class="mt-4">
                        <label class="form-label fw-bolder">Ujilab
                        </label>
                        <input type="file" name="lab_test" id="" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf" class="form-control p-2 shadow-sm">
                        <div class="invalid-feedback">
                            Dokumen pendukung tidak boleh kosong.
                        </div>
                        <small class="form-text text-muted">
                            <?php
                            foreach ($supplier_document as $doc) {
                                echo $doc->document_type == 'Ujilab' ? $doc->document : '';
                            }
                            ?>
                        </small>
                    </div>
                    <div class="mt-4 form-check">
                        <input type="checkbox" class="form-check-input check-required" id="exampleCheck1" onclick="checkValidate(this)" />
                        <label class="form-check-label" for="exampleCheck1">
                            Saya sudah mengisi informasi secara jujur &
                            tidak merubah informasi pihak lain.
                        </label>
                        <!-- <div id="invalidCheck3Feedback" class="invalid-feedback">
                                You must agree before submitting.
                            </div> -->
                    </div>
                </div>

                <div class="tab-step">
                    <div class="d-flex align-items-center flex-column px-5">
                        <!-- <div class="col"> -->
                        <img src="<?= base_url("assets/images/check.png") ?>" alt="" height="100" />
                        <p class="fw-bolder fs-4 mt-5">
                            Kirim Data Perusahaan
                        </p>
                        <p>
                            Harap tinjai semua informasi yang anda ketik
                            sebelumnya di langkah sebelumnya, dan jika
                            semuanya baik-baik saja, kirimkan pesan anda
                            untuk menerima penawaran proyek dalam 24 - 48
                            jam.
                        </p>
                        <a href="<?= base_url("supplier/list") ?>" class="m-sm-3 m-3">
                            <button class="btn btn-danger tr-bg-primary px-4 py-2 rounded-pill">
                                Submit
                            </button>
                        </a>
                        <!-- </div> -->
                    </div>
                </div>

            </div>
            <div class="card-footer d-flex justify-content-between" id="buttonContainer">
                <button type="button" class="btn btn-secondary shadow rounded-3 px-3 py-2" id="prevButton" onclick="nextPrev(-1)">
                    Kembali
                </button>
                <button type="button" class="btn btn-danger tr-bg-primary shadow rounded-3 px-3 py-2" id="nextButton" onclick="nextPrev(1)">
                    Selanjutnya
                </button>
            </div>
        </form>
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

<script type="text/javascript">
    window.addEventListener('keydown', function(e) {
        if (e.keyIdentifier == 'U+000A' || e.keyIdentifier == 'Enter' || e.keyCode == 13) {
            if (e.target.nodeName == 'INPUT' && e.target.type == 'text') {
                e.preventDefault();
                return false;
            }
        }
    }, true);
</script>

<script>
    var currentTab = 0;
    showTab(currentTab);

    function showTab(n) {
        var x = document.getElementsByClassName('tab-step');

        x[n].style.display = 'block';

        if (n == 0) {
            document.getElementById('prevButton').style.display = 'none';
            document.getElementById('nextButton').style.display = 'block';
            var buttonContainer = document.getElementById('buttonContainer');
            buttonContainer.classList.remove('justify-content-between')
            buttonContainer.classList.add('justify-content-end')
        } else {
            document.getElementById('prevButton').style.display = 'block';
            document.getElementById('nextButton').style.display = 'block';
            var buttonContainer = document.getElementById('buttonContainer');
            buttonContainer.classList.remove('justify-content-end')
            buttonContainer.classList.add('justify-content-between')
        }

        if (n == (x.length - 1)) {
            document.getElementById('nextButton').style.display = 'none';
        }
        fixStepIndicator(n);
    }

    function nextPrev(n) {
        var x = document.getElementsByClassName('tab-step');

        if (n == 1 && !validateForm()) return false;

        x[currentTab].style.display = 'none';


        currentTab = currentTab + n;


        if (currentTab >= x.length) {
            document.getElementById('supplierForm').submit();
            return false;
        }

        showTab(currentTab);
    }

    function validateForm() {
        var x, y, z, valid = true;
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

        x = document.getElementsByClassName('tab-step');
        y = x[currentTab].getElementsByClassName('input-required');
        z = document.getElementsByClassName('check-required');

        emailRequired = x[currentTab].getElementsByClassName('email-required');

        for (i = 0; i < y.length; i++) {
            if (y[i].value == "") {
                y[i].classList.add('is-invalid')
                valid = false;
            } else {
                y[i].classList.remove('is-invalid')
            }
        }

        if (currentTab == 0) {
            // Validate email
            if (emailRequired[0].value == '') {
                emailRequired[0].classList.add('is-invalid')
                document.getElementById('invalidEmail').textContent = 'Email tidak boleh kosong.'
                valid = false
            } else {
                if (!emailRequired[0].value.match(mailformat)) {
                    emailRequired[0].classList.add('is-invalid')
                    document.getElementById('invalidEmail').textContent = 'Email tidak valid.'
                    valid = false;
                }
                // console.log('email')
            }
        }

        c = document.getElementById('exampleCheck1');
        if (currentTab == 4) {
            if (!c.checked) {
                valid = false;
                c.classList.add('is-invalid')
            } else {
                c.classList.remove('is-invalid')

            }
        }

        if (valid) {

            // var z = document.getElementsByClassName("step-indicator")[currentTab];
            // z.className = z.className.replace(" btn-light", " btn-secondary");
        }

        return valid;
    }

    function fixStepIndicator(n) {

        var w;

        if (n == 0) {
            w = '0%'
        } else if (n == 1) {
            w = '25%'
        } else if (n == 2) {
            w = '50%'
        } else if (n == 3) {
            w = '75%'
        } else {
            w = '100%'
        }
        var x = document.getElementById('progressBar');
        x.style.width = w

    }

    function removeInvalid(e) {
        if (e.value == '') return
        e.classList.remove('is-invalid')
    }

    function checkValidate(e) {
        if (e.checked == true) {
            e.classList.remove('is-invalid')
        }
    }
</script>

<script>
    async function getCity() {
        provinsi = document.getElementById("province");
        d = provinsi.options[provinsi.selectedIndex].getAttribute('provId');
        const url = 'https://kodepos-2d475.firebaseio.com/list_kotakab/' + d + '.json?print=pretty';
        const data = await getApi(url);

        provinsi.classList.remove('is-invalid')
        document.getElementById('city').innerHTML = "";

        // console.log(data);

        Object.keys(data).forEach(key => {
            var x = document.getElementById('city');
            var option = new Option(data[key], data[key]);
            option.setAttribute('cityId', key)
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

        for (var i = 0; i < data.length; i++) {
            if (i == 0) {
                zipcode.push(data[i])
            } else {
                if (data[i]['kodepos'] != data[i - 1]['kodepos']) zipcode.push(data[i])
            }
        }

        for (let data of zipcode) {
            var x = document.getElementById('zip_code');
            var option = new Option(data['kodepos'], data['kodepos']);
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