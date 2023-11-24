<?= $this->extend('auth/app') ?>

<?= $this->section('content') ?>

<div class="col-md-6 col-12 p-5">
    <div class="row justify-content-center  ">
        <div class="col-md-8 mb-5 ">
            <div class="col-lg-12 col-md-5 text-center mb-4 fw-bold"> <img src="<?= base_url('images/logo.png') ?>"
                    alt=""> SIMS PPOB</div>
            <div class="col-lg-12 col-md-8 text-center mb-5">
                <h3>Lengkapi data untuk <br>membuat akun</h3>
            </div>

            <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success">
                <?php echo session()->getFlashdata('success'); ?>
            </div>
            <?php endif; ?>

            <form action="/registration/store" method="POST">

                <?= csrf_field() ?>
                <div class="col-12 border mb-4">
                    <span class="d-flex"><i class="fs-3 bi bi-at m-1"></i><input type="text" name="email"
                            class="form-control-plaintext  " placeholder="Masukan email anda" aria-label="Username"
                            aria-describedby="addon-wrapping"></span>


                </div>
                <div class="col-12 border mb-4">
                    <span class="d-flex"><i class="fs-3 bi bi-person-fill m-1"></i><input type="text" name="first_name"
                            class="form-control-plaintext " placeholder="nama depan" aria-label="Username"
                            aria-describedby="addon-wrapping"></span>
                </div>
                <div class="col-12 border mb-4">
                    <span class="d-flex"><i class="fs-3 bi bi-person-fill m-1"></i><input type="text" name="last_name"
                            class="form-control-plaintext" placeholder="nama belakang" aria-label="Username"
                            aria-describedby="addon-wrapping"></span>
                </div>
                <div class="col-12 border mb-4">
                    <span class="d-flex"><i class="fs-3 bi bi-lock-fill m-1"></i><input type="password" name="password"
                            class="form-control-plaintext" placeholder="buat password" id="passwordInput1"
                            aria-label="Username" aria-describedby="addon-wrapping"> <span class="m-1"
                            id="togglePassword1">
                            <i class="fs-4 bi bi-eye"></i>
                        </span></span>
                </div>
                <div class="col-12 border mb-5">
                    <span class="d-flex"><i class="fs-3 bi bi-lock-fill m-1"></i><input type="password"
                            class="form-control-plaintext" id="passwordInput2" placeholder="konfirmasi password"
                            aria-label="Username" aria-describedby="addon-wrapping"> <span class="m-1"
                            id="togglePassword2">
                            <i class="fs-4 bi bi-eye"></i>
                        </span></span>
                </div>

                <!-- Tambahkan field lain sesuai kebutuhan -->

                <!-- Alert Status Registrasi -->


                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-danger ">Registrasi</button>
                </div>
            </form>
            <p class="text-center mt-3">Belum punya akun? login <a href="\"
                    class="link-offset-2 link-underline link-underline-opacity-0 link-danger fw-bold"> di
                    sini</a></p>
        </div>
    </div>
    <?php if (!empty($errors)) : ?>

    <?php foreach ($errors as $error) : ?>
    <div class="alert alert-danger" role="alert">
        <?= $error; ?> </div>
    <?php endforeach; ?>

    <?php endif; ?>


</div>

<?= $this->endSection() ?>