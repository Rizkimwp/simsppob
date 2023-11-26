<?= $this->extend('homepage/homepage') ?>

<?= $this->section('content') ?>

<!-- Main Content -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="row p-3">
                <div class="col-12 mb-3"><img src="<?= base_url('images/profile_photo.png') ?>" alt="userprofile"
                        class="rounded-circle"></div>
                <div class="col-3">Selamat datang,</div>
                <div class="col-12">
                    <h2><?= mb_convert_case($profileData['data']['first_name'], MB_CASE_TITLE) . ' ' . mb_convert_case($profileData['data']['last_name'], MB_CASE_TITLE);?>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 bg-danger rounded">
            <div class="row p-4 text-white">
                <div class="col-12">
                    <p class="fw-medium">Saldo Anda</p>
                </div>
                <div class="col-12">
                <span id="amountBalance" class="fs-2 fw-bold" style="cursor: pointer;">Rp <?= number_format($balanceData['data']['balance'], 0, ',', '.')?></span>
                </div>
                <div class="col-4">
                <span class="fs-5 me-2">Lihat Saldo</span> <span id="toggleVisibilityIcon" class="fs-5 bi bi-eye " onclick="toggleVisibility()" style="cursor: pointer;"> </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row text-center">
        <?php foreach ($servicesData['data'] as $service) : ?>

        <div class="col-1"><a href="" class="link-offset-2 link-underline link-underline-opacity-0 link-dark ">
                <a href="/transaksi/<?php echo $service['service_code']; ?>"
                    class="link-offset-2 link-underline link-underline-opacity-0">
                    <img class="mb-1" src="<?= $service['service_icon'] ?>" alt="services icon"> </a>
                <span class="fw-light "><?= $service['service_name'] ?></span></a></div>

        <?php endforeach ?>

    </div>

    <p class="fw-bold mt-5"> Temukan promo menarik</p>
    <div class="mt-2 overflow-x-scroll w-100  text-nowrap me-5">
        <?php foreach ($bannerData['data'] as $banner) : ?>
        <img src="<?= $banner['banner_image']?>" alt="" class="me-4">
        <?php endforeach ?>
    </div>


    <script>
let isVisible = true;

function toggleVisibility() {
    const amountBalance = document.getElementById('amountBalance');
    const toggleVisibilityIcon = document.getElementById('toggleVisibilityIcon');

    if (isVisible) {
        amountBalance.innerText = 'Rp ******';
        toggleVisibilityIcon.classList.remove('bi-eye');
        toggleVisibilityIcon.classList.add('bi-eye-slash');
        isVisible = false;
    } else {
        amountBalance.innerText = 'Rp  <?= number_format($balanceData['data']['balance'], 0, ',', '.')?>';
        toggleVisibilityIcon.classList.remove('bi-eye-slash');
        toggleVisibilityIcon.classList.add('bi-eye');
        isVisible = true;
    }
}


    </script>
    <?= $this->endSection() ?>