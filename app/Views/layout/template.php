<!DOCTYPE html>
<html lang="en">

<head>
    <title>TIMURASA</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url("assets/css/style.css") ?>" />
    <link rel="shortcut icon" href="<?= base_url("assets/images/logo.png") ?>">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?= $this->renderSection('styles') ?>

</head>

<body>
    <?php if (session()->getFlashdata('success')) : ?>
        <script>
            Swal.fire({
                title: '<strong>Pengajuan Berhasil.</strong>',
                icon: 'success',
                html: `
            <div class="input-group mb-3"> 
                <input type="text" id="copyText" class="form-control form-control-lg tr-bg-gray border-0" value="<?= session()->getFlashdata('id_supplier') ?>" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <button id="copyButton" class="btn btn-lg tr-bg-gray" type="button" id="button-addon2"><span class="text-secondary">Copy</span></button>
            </div> 
            <p class="mt-3">Silahkan tunggu 2x24 jam untuk proses verifikasi.</p>
            `,
                showCloseButton: true,
                focusConfirm: false,
                confirmButtonText: 'Ok',
                confirmButtonAriaLabel: 'Thumbs up, great!',
                cancelButtonAriaLabel: 'Thumbs down'
            })

            const copyText = document.getElementById('copyText').value
            const copyButton = document.getElementById('copyButton')
            copyButton.onclick = () => {
                navigator.clipboard.writeText(copyText)
            }
        </script>
    <?php endif ?>
    <?php if (session()->getFlashdata('found')) : ?>
        <script>
            Swal.fire({
                title: '<strong><?= session()->getFlashdata('id_supplier') ?></strong>',
                icon: 'success',
                html: 'Status : <span><?= session()->getFlashdata('status') == 2 ? 'Proses Verifikasi' : (session()->getFlashdata('status') == 1 ? 'Verifikasi' : 'Belum Verifikasi') ?></span>',
                showCloseButton: true,
                focusConfirm: false,
                confirmButtonText: 'Ok',
                confirmButtonAriaLabel: 'Thumbs up, great!',
                cancelButtonAriaLabel: 'Thumbs down'
            })
        </script>
    <?php endif ?>
    <?php if (session()->getFlashdata('not_found')) : ?>
        <script>
            Swal.fire({
                title: '<strong><?= session()->getFlashdata('id_supplier') ?></strong>',
                icon: 'error',
                html: 'Silahkan masukan ID Supplier yang valid.',
                showCloseButton: true,
                focusConfirm: false,
                confirmButtonText: 'Ok',
                confirmButtonAriaLabel: 'Thumbs up, great!',
                cancelButtonAriaLabel: 'Thumbs down'
            })
        </script>
    <?php endif ?>

    <nav class="navbar navbar-expand-sm navbar-light bg-white py-sm-4 shadow-sm">
        <div class="container d-flex align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="<?= base_url("assets/images/logo.png") ?>" alt="" height="75" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- <ul class="navbar-nav ms-3 me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active fs-5" aria-current="page" href="<?= base_url() ?>">Supplier</a>
                    </li>
                </ul> -->
                <form class="ms-auto d-flex" action="<?= base_url('supplier') ?>">
                    <input class="form-control me-2" type="search" placeholder="ID Supplier" name="id_supplier" aria-label="Search">
                    <button class="btn btn-danger tr-btn-primary" type="submit">Cek</button>
                </form>
            </div>
        </div>
    </nav>

    <?= $this->renderSection('content') ?>

    <div class="w-100 py-sm-5 py-3 tr-bg-primary text-white">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto me-auto">
                    <p class="fs-6 fw-bold">PT. ASA ANTARA NUSA</p>
                    <p>Accelerice Indonesia
                        <br>3rd Floor | Jl. H.R. Rasuna Said No. 5
                        <br>(Ariobimo Sentral Area) - Kuningan Timur
                        <br>Jakarta Selatan 12950
                    </p>
                </div>
                <div class="col-auto">
                    <a href="https://www.facebook.com/Timurasa-Indonesia-198085200714368" class="text-decoration-none" target="_blank">
                        <i class="fab fa-facebook text-white fs-2 mx-2"></i>
                    </a>
                    <a href="https://www.instagram.com/timurasaindonesia/" class="text-decoration-none" target="_blank">
                        <i class="fab fa-instagram text-white fs-2 mx-2"></i>
                    </a>
                    <a href="https://twitter.com/timurasaid" class="text-decoration-none" target="_blank">
                        <i class="fab fa-twitter text-white fs-2 mx-2"></i>
                    </a>
                    <a href="https://www.youtube.com/channel/UCemXKvPaH-BCzzkHlpijd7Q" class="text-decoration-none" target="_blank">
                        <i class="fab fa-youtube text-white fs-2 mx-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?= $this->renderSection('scripts') ?>

</body>

</html>