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
</head>

<body>

    <div class="min-vw-100 min-vh-100 tr-bg-login d-flex align-items-center">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-4">
                    <div class="card my-3 p-4">
                        <div class="card-body">
                            <div class="justify-content-center text-center">
                                <img src="<?= base_url('assets/images/logo.png') ?>" height="100" alt="">
                                <p class="fs-4 my-3 mt-5 fw-bold">Admin Area</p>
                            </div>
                            <?php if (session()->getFlashdata('message')) : ?>
                                <div class="alert alert-danger"><?= session()->getFlashdata('message') ?></div>
                            <?php endif; ?>
                            <form action="<?= base_url('login/auth') ?>" method="POST">
                                <?= csrf_field() ?>
                                <div class="mb-3">
                                    <input type="text" class="form-control py-2" placeholder="Username" name="username" value="<?= old('username') ?>">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control py-2 border-end-0" placeholder="Password" name="password" id="password">
                                    <span class="input-group-text bg-transparent border-start-0">
                                        <i class="far fa-eye" id="toggle" onclick="togglePassword()" style="cursor: pointer"></i>
                                    </span>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label text-secondary" for="exampleCheck1">Keep me logged in</label>
                                </div>
                                <button type="submit" class="btn btn-danger tr-bg-primary w-100">Submit</button>
                            </form>
                            <div class="mt-3">
                                <p class="text-secondary">Belum punya akun? Hubungin <span class="tr-text-primary">Master Admin</span></p>
                            </div>
                        </div>
                    </div>
                    <a href="<?= base_url('supplier/list') ?>" class="text-decoration-none text-white">
                        <p><i class="fas fa-chevron-left"></i> Kembali ke halaman supplier.</p>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <script>
        function togglePassword() {


            const toggle = document.getElementById("toggle");
            const password = document.getElementById("password");

            // toggle.addEventListener("click", function() {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            // toggle the eye icon
            toggle.classList.toggle('fa-eye');
            toggle.classList.toggle('fa-eye-slash');
            // });
        }
    </script>

</body>

</html>