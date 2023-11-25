<?= $this->extend('homepage/homepage') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center mb-5">

            <div class="profile-image-container">
                <img src="<?= $profileData['data']['profile_image'] ?>" alt="Profile Picture" class="profile-image">
                <div class="edit-icon">
                    <i class="bi bi-pencil"></i>
                </div>
            </div>
            <!-- Form Update Image -->
            <form id="imageUploadForm" action="/profile/update" method="post" enctype="multipart/form-data"
                style="display: none;">
                <input type="file" id="profileImageInput" name="profile_image" accept="image/*">
                <input type="submit" value="Upload" style="display: none;">
            </form>
            <h2 class="fw-bold">
                <?= mb_convert_case($profileData['data']['first_name'], MB_CASE_TITLE) . ' ' . mb_convert_case($profileData['data']['last_name'], MB_CASE_TITLE); ?>
            </h2>
        </div>
        <div class="col-md-6">
<!-- Form Update Profile -->
            <form action="/profile/update" method="post">
                <?= csrf_field() ?>
                <label for="email" class="mb-2">Email</label>
                <div class="col-12 border  border-dark-subtle mb-3">
                    <span class="d-flex"><i class="fs-3 bi bi-at m-1 text-secondary"></i><input type="text"
                            class="form-control-plaintext " id="email" name="email"
                            value="<?= $profileData['data']['email']?>" disabled></span>
                </div>

                <label for="first_name" class="mb-2">Nama Depan</label>
                <div class="col-12 border  border-dark-subtle mb-3">
                    <span class="d-flex"><i class="fs-2 bi bi-person-fill m-1 text-secondary "></i><input type="text"
                            class="form-control-plaintext " id="first_name" name="first_name"
                            value="<?= $profileData['data']['first_name']?>" disabled></span>
                </div>

                <label for=" last_name" class="mb-2">Nama Belakang</label>
                <div class="col-12 border  border-dark-subtle mb-3">
                    <span class="d-flex"><i class="fs-3 bi bi-person-fill m-1 text-secondary"></i><input type="text"
                            class="form-control-plaintext " id="last_name" name="last_name"
                            value="<?= $profileData['data']['last_name']?>" disabled></span>
                </div>

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
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-outline-danger logout-btn">Logout</button>
                </div>
            </form>
        </div>

        <!-- Tampilkan pesan kesuksesan jika ada -->
        <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('success') ?>
        </div>
        <?php endif; ?>

        <!-- Tampilkan pesan kesalahan jika ada -->
        <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('error') ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
function editProfile() {
    // Mengaktifkan input dan tombol Simpan
    document.getElementById('email').removeAttribute('disabled');
    document.getElementById('first_name').removeAttribute('disabled');
    document.getElementById('last_name').removeAttribute('disabled');
    document.querySelector('button[type="submit"]').removeAttribute('hidden');

    // Menghilangkan tombol "Edit Profile"
    document.querySelector('.edit-profile-btn').style.display = 'none';

    // Menghilangkan tombol "Logout"
    document.querySelector('.logout-btn').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function() {
    const editIcon = document.querySelector('.edit-icon');
    const profileImageInput = document.getElementById('profileImageInput');

    // Ketika ikon edit diklik
    editIcon.addEventListener('click', function() {
        // Munculkan jendela untuk memilih gambar saat ikon edit diklik
        profileImageInput.click();
    });

    // Ketika gambar dipilih
    profileImageInput.addEventListener('change', function() {
        // Simpan gambar yang dipilih dengan melakukan submit pada form
        document.getElementById('imageUploadForm').submit();
    });
});

</script>

<?= $this->endSection() ?>