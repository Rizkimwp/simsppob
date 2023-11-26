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


            <form action="/registration/store" method="POST">

                <?= csrf_field() ?>
                <div
                    class="col-12 border <?php if (isset($validation) && $validation->hasError('email')) : echo 'border-danger' ?>  <?php endif; ?>">
                    <span class="d-flex"><i
                            class="fs-3 bi bi-at m-1 text-secondary <?php if (isset($validation) && $validation->hasError('email')): echo 'text-danger'; ?>  <?php endif; ?> "></i><input
                            type="text" name="email" class="form-control-plaintext" placeholder="Masukan email anda"
                            value="<?= old('email') ?>"></span>
                </div>
                <?php if(isset($validation) && $validation->hasError('email')): ?>
                <p class="text-danger text-end"><?= $validation->getError('email') ?></p>
                <?php endif; ?>
                <div
                    class="col-12 border mt-3 <?php if (isset($validation) && $validation->hasError('first_name')) : echo 'border-danger' ?>  <?php endif; ?>">
                    <span class="d-flex"><i
                            class="fs-3 bi bi-person-fill m-1 text-secondary <?php if (isset($validation) && $validation->hasError('first_name')): echo 'text-danger'; ?>  <?php endif; ?>"></i><input
                            type="text" id="first_name" name="first_name" class="form-control-plaintext "
                            placeholder="nama depan" value="<?= old('first_name') ?>"></span>
                </div>
                <?php if(isset($validation) && $validation->hasError('first_name')): ?>
                <p class="text-danger text-end"><?= $validation->getError('first_name') ?></p>
                <?php endif; ?>
                <div
                    class="col-12 border mt-3 <?php if (isset($validation) && $validation->hasError('last_name')): echo 'border-danger' ?> <?php endif; ?>">
                    <span class="d-flex"><i
                            class="fs-3 bi bi-person-fill m-1 text-secondary <?php if (isset($validation) && $validation->hasError('last_name')): echo 'text-danger'; ?>  <?php endif; ?>"></i><input
                            type="text" id="last_name" name="last_name" class="form-control-plaintext"
                            placeholder="nama belakang" value="<?= old('last_name') ?>"></span>
                </div>
                <?php if(isset($validation) && $validation->hasError('last_name')): ?>
                <p class="text-danger text-end"><?= $validation->getError('last_name') ?></p>
                <?php endif; ?>
                <div
                    class="col-12 border mt-3 <?php if (isset($validation) && $validation->hasError('password')):  echo 'border-danger' ?>  <?php endif; ?>">
                    <span class="d-flex"><i
                            class="fs-3 bi bi-lock-fill m-1 text-secondary <?php if (isset($validation) && $validation->hasError('password')): echo 'text-danger'; ?>  <?php endif; ?>"></i><input
                            type="password" name="password" class="form-control-plaintext" placeholder="buat password"
                            id="passwordInput1"> <span class="m-2" id="togglePassword1">
                            <i class="fs-5 bi bi-eye"></i>
                        </span></span>
                </div>
                <?php if(isset($validation) && $validation->hasError('password')): ?>
                <p class="text-danger text-end"><?= $validation->getError('password') ?></p>
                <?php endif; ?>
                <div
                    class="col-12 border mt-3 <?php if (isset($validation) && $validation->hasError('password_confirmation')) : echo 'border-danger'; ?> <?php endif; ?>">
                    <span class="d-flex"><i
                            class="fs-3 bi bi-lock-fill m-1 text-secondary <?php if (isset($validation) && $validation->hasError('password_confirmation')):  echo 'text-danger'; ?> <?php endif; ?>"></i><input
                            type="password" class="form-control-plaintext" id="passwordInput2"
                            placeholder="konfirmasi password" name="password_confirmation"> <span class="m-2"
                            id="togglePassword2">
                            <i class="fs-5 bi bi-eye"></i>
                        </span></span>
                </div>
                <?php if(isset($validation) && $validation->hasError('password_confirmation')): ?>
                <p class="text-danger text-end"><?= $validation->getError('password_confirmation') ?></p>
                <?php endif; ?>

                <!-- Tambahkan field lain sesuai kebutuhan -->

                

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-danger ">Registrasi</button>
                </div>
            </form>
            <p class="text-center mt-3">Sudah punya akun? login <a href="\"
                    class="link-offset-2 link-underline link-underline-opacity-0 link-danger fw-bold"> di
                    sini</a></p>

        </div> 
        <!-- Alert Status Registrasi -->
        <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error?>
                </div>
                <?php endif; ?>
        <?php if (isset($successMessage)): ?>
                <div class="alert alert-success" role="alert">
                    <?= $successMessage?>
                </div>
                <?php endif; ?>
    </div>




</div>

<?= $this->endSection() ?>