<?= $this->extend('homepage/homepage') ?>

<?= $this->section('content') ?>

<!-- Main Content -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="row p-3">
                <div class="col-12 mb-3"><img src="<?= $profileData['data']['profile_image'] ?>s" alt="userprofile"
                        class="rounded-circle"></div>
                <div class="col-3">Selamat datang,</div>
                <div class="col-12">
                    <h2><?= $profileData['data']['first_name'] ?> <?= $profileData['data']['last_name'] ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 bg-danger rounded">
            <div class="row p-4 text-white">
                <div class="col-12">
                    <p class="fw-medium">Saldo Anda</p>
                </div>
                <div class="col-12">
                    <h2>Rp  <?= number_format($balanceData['data']['balance'], 0, ',', '.')?></h2>
                </div>
                <div class="col-12">
                    <p class="fw-light">Lihat Saldo </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row text-center">
        <?php foreach ($servicesData['data'] as $service) : ?>
            <div class="col-1"><a href="" class="link-offset-2 link-underline link-underline-opacity-0 link-dark "><img
                        class="mb-1" src="<?= $service['service_icon'] ?>" alt=""> <span
                        class="fw-light "><?= $service['service_name'] ?></span></a></div>
                        <?php endforeach ?>
            
    </div>

    <p class="fw-bold mt-5"> Temukan promo menarik</p>
    <div class="mt-2 overflow-x-scroll w-100  text-nowrap me-5">
    <?php foreach ($bannerData['data'] as $banner) : ?>
        <img src="<?= $banner['banner_image']?>" alt="" class="me-4">
        <?php endforeach ?>
    </div>
    <?= $this->endSection() ?>