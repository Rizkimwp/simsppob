<?= $this->extend('auth/app') ?>

<?= $this->section('content') ?>

<div class="col-md-6 col-12 p-5">
    <div class="row justify-content-center mb-2 ">
        <div class="col-md-8 mb-5 ">
            <div class="col-lg-12 col-md-5 text-center mb-4 fw-bold"> <img src="<?= base_url('images/logo.png') ?>"
                    alt=""> SIMS PPOB</div>
            <div class="col-lg-12 col-md-8 text-center mb-5">
                <h3>Masuk atau buat akun <br>untuk memulai</h3>
            </div>

            <!-- Alert Pesan Berhasil Registrasi -->

            <form action="/login" method="post">
                <?= csrf_field() ?>
                <div
                    class="col-12 border <?php if (isset($validation) && $validation->hasError('email')) echo 'border-danger'; ?> mb-3">
                    <span class="d-flex"><i class="fs-3 bi bi-at m-1 text-secondary"></i><input type="text"
                            class="form-control-plaintext " id="email" name="email" placeholder="Masukan email anda"
                            aria-label="Username" aria-describedby="addon-wrapping"></span>
                    <!-- Menampilkan pesan error jika validasi gagal -->
                </div>

                <div
                    class="col-12 border mb-5  <?php if (isset($error)): ?> <?php echo 'border-danger'; ?> <?php endif; ?>">
                    <span class="d-flex"><i class="fs-3 bi bi-lock-fill m-1 text-secondary"></i><input type="password"
                            name="password" class="form-control-plaintext" id="passwordInput1"
                            placeholder="Masukan Password anda" aria-label="Username" aria-describedby="addon-wrapping">
                        <span class="m-2" id="togglePassword1">
                            <i class="fs-4 bi bi-eye text-secondary"></i>
                        </span></span>
                    <!-- Menampilkan pesan error jika validasi gagal -->
                </div>



                <!-- Tambahkan field lain sesuai kebutuhan -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-danger ">Masuk</button>
                </div>
            </form>

            <p class="text-center mt-3">Belum punya akun? registrasi <a href="\registration"
                    class="link-offset-2 link-underline link-underline-opacity-0 link-danger fw-bold"> di
                    sini</a></p>
        </div>

    </div>





    <?php if (isset($error)) : ?>
    <div class="row justify-content-center">
        <div class="col-9 text-center">
            <div class="alert alert-danger" role="alert">
                <button type="button" class="btn-close me-5" aria-label="Close" onclick="closeAlert()"></button>
                <?php echo $error; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>




<?= $this->endSection() ?>