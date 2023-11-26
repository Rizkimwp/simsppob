<?= $this->extend('homepage/homepage') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center mb-5">

            <div class="profile-image-container">
                <img src="<?= base_url('images/profile_photo.png') ?>" alt="Profile Picture" class="profile-image">
                <div class="edit-icon">
                    <i class="bi bi-pencil"></i>
                </div>
            </div>

            <!-- Form Update Image -->
            <form id="imageUploadForm" action="/profile/image" method="post" enctype="multipart/form-data"
                style="display: none;">
                <input type="file" id="profileImageInput" name="file" accept="image/*">
            </form>

            <h2 class="fw-bold">
                <?= mb_convert_case($profileData['data']['first_name'], MB_CASE_TITLE) . ' ' . mb_convert_case($profileData['data']['last_name'], MB_CASE_TITLE); ?>
            </h2>
        </div>
        <!-- Tampilkan Pesan dari Sessi -->
        <?php if (session()->getFlashdata('success')) : ?>
        <div class="row justify-content-center mb-4">
            <div class="col-7">
                <div class="alert alert-success" role="alert">
                    <span class="text-start">
                        <button type="button" class="btn-close me-5" aria-label="Close" onclick="closeAlert()"></button>
                    </span>
                    <?= session()->getFlashdata('success') ?>
                </div> </div> </div>
                <?php endif; ?>

                <!-- Tampilkan pesan kesalahan jika ada -->
                <?php if (session()->getFlashdata('error')) : ?>
                <div class="row justify-content-center mb-4">
                    <div class="col-7">
                        <div class="alert alert-danger" role="alert">
                            <span class="text-start">
                                <button type="button" class="btn-close me-5" aria-label="Close"
                                    onclick="closeAlert()"></button>
                            </span>
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                
        <div class="col-md-6">
            <!-- Form Update Profile -->
            <form action="/profile/update" method="post">
                <?= csrf_field() ?>
                <label for="email" class="mb-2">Email</label>
                <div class="col-12 border  border-dark-subtle mb-3">
                    <span class="d-flex"><i class="fs-3 bi bi-at m-1 text-secondary"></i><input type="text"
                            class="form-control-plaintext " id="email" name="email"
                            value="<?= $profileData['data']['email'] ?>" disabled></span>
                        </div>
                        <?php if(session()->getFlashdata('validationErrors.email')): ?>
                        <div class="invalid-feedback"><?= session()->getFlashdata('validationErrors.email') ?></div>
                        <?php endif; ?>

                <label for="first_name" class="mb-2">Nama Depan</label>
                <div class="col-12 border  border-dark-subtle mb-3">
                    <span class="d-flex"><i class="fs-2 bi bi-person-fill m-1 text-secondary "></i><input type="text"
                            class="form-control-plaintext " id="first_name" name="first_name"
                            value="<?= $profileData['data']['first_name'] ?>" disabled></span>
                </div>
                <?php if(session()->getFlashdata('validationErrors.first')): ?>
                    <div class="invalid-feedback"><?= session()->getFlashdata('validationErrors.firstname') ?></div>
                    <?php endif; ?>
                <label for=" last_name" class="mb-2">Nama Belakang</label>
                <div class="col-12 border  border-dark-subtle mb-3">
                    <span class="d-flex"><i class="fs-3 bi bi-person-fill m-1 text-secondary"></i><input type="text"
                            class="form-control-plaintext " id="last_name" name="last_name"
                            value="<?= $profileData['data']['last_name'] ?>" disabled></span>
                </div>
                <?php if(session()->getFlashdata('validationErrors.lastname')): ?>
                    <div class="invalid-feedback"><?= session()->getFlashdata('validationErrors.lastname') ?></div>
                    <?php endif; ?>
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-danger " hidden="true">Simpan</button>
                </div>
            </form>
            <div class="d-grid gap-2 mb-4">
                <button onclick="editProfile()"
                    class="btn btn-danger link-offset-2 link-underline link-underline-opacity-0 edit-profile-btn">Edit
                    Profile</button>
            </div>
            <form action="/logout">
                <div class="d-grid gap-2 mb-5">
                    <button type="submit" class="btn btn-outline-danger logout-btn">Logout</button>
                </div>
            </form>
        </div>

       

                <?= $this->endSection() ?>