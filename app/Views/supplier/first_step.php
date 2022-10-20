<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container py-sm-5 py-3">
    <div class="row justify-content-center">
        <div class="col-xxl-7 col-lg-8 col-md-10 col-sm-12">
            <?= view('supplier/information') ?>
            <form action="<?= base_url('save/first_step') ?>" method="post" id="supplierForm">
                <?= csrf_field() ?>
                <div class="shadow mt-sm-5 mt-3 p-sm-5 p-3 bg-body rounded border border-light rounded-3">

                    <?= view('supplier/step_indicator') ?>
                    <h5 class="fw-bolder">Informasi Kontak</h5>
                    <p>
                        Tolong isi informasi dengan benar, agar team kami
                        dapat menghubungi anda.
                    </p>
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Nama</label>
                                <input type="text" class="form-control p-2 shadow-sm <?= $validation->hasError('name') ? 'is-invalid' : '' ?>" placeholder="Nama" name="name" value="<?= old('name') ?>" required />
                                <div class="invalid-feedback">
                                    <?= $validation->getError('name') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-lg-0 mt-4">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Email</label>
                                <input type="email" class="form-control p-2 shadow-sm <?= $validation->hasError('email') ? 'is-invalid' : '' ?>" placeholder="Email" name="email" value="<?= old('email') ?>" required />
                                <div class="invalid-feedback" id="invalidEmail">
                                    <?= $validation->getError('email') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Nomor Telepon</label>
                                <input type="number" class="form-control p-2 shadow-sm " placeholder="(+62) 456 - 7890" name="phone_number" value="<?= old('phone_number') ?>" required />
                                <div class="invalid-feedback" id="invalidEmail">
                                    Nomor Telepon tidak boleh kosong.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Perusahaan</label>
                                <input type="text" class="form-control p-2 shadow-sm " placeholder="Perusahaan" name="company" value="<?= old('company') ?>" required />
                                <div class="invalid-feedback" id="invalidEmail">
                                    Nama perusahaan tidak boleh kosong.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <div class="form-group">
                                <label class="form-label fw-bolder">WhatsApp
                                </label>
                                <input type="text" class="form-control p-2 shadow-sm" placeholder="WhatsApp" name="whatsapp" value="<?= old('company_website') ?>" required />
                                <div class="invalid-feedback" id="invalidEmail">
                                    WhatsApp tidak boleh kosong.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Facebook
                                    <span class="tr-text-primary shadow-sm">*</span></label>
                                <input type="text" class="form-control p-2 shadow-sm" placeholder="Facebook" name="facebook" value="<?= old('company_website') ?>" />
                                <div class="form-text tr-text-primary">
                                    *Opsional.
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <div class="form-group">
                                <label class="form-label fw-bolder">Instagram
                                    <span class="tr-text-primary shadow-sm">*</span></label>
                                <input type="text" class="form-control p-2 shadow-sm" placeholder="Instagram" name="instagram" value="<?= old('company_website') ?>" />
                                <div class="form-text tr-text-primary">
                                    *Opsional.
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="d-flex button-container justify-content-end mt-sm-5 mt-4" id="buttonContainer">
                    <!-- <a href="<?= base_url('second_step') ?>" class="btn btn-danger tr-bg-primary shadow rounded-3 px-3 py-2" id="nextButton">
                        Selanjutnya
                    </a> -->
                    <button type="submit" class="btn btn-danger tr-bg-primary shadow rounded-3 px-3 py-2">
                        Selanjutnya
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>