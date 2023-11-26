<?= $this->extend('homepage/homepage') ?>

<?= $this->section('content') ?>

<!-- Main Content -->
<div class="container mt-4">
    <div class="row"> 
        <div class="col-md-6 col-lg-6">
            <div class="row p-3"> 
                <div class="col-12 mb-3"><img src="<?= base_url('images/profile_photo.png') ?>" alt="userprofile" class="rounded-circle" ></div>
                <div class="col-3">Selamat datang,</div>
                <div class="col-12"><h2><?= mb_convert_case($profileData['data']['first_name'], MB_CASE_TITLE) . ' ' . mb_convert_case($profileData['data']['last_name'], MB_CASE_TITLE); ?></h2></div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 bg-danger rounded">
        <div class="row p-4 text-white"> 
                <div class="col-12"><p class="fw-medium">Saldo Anda</p></div>
                <div class="col-12">
                    <span id="amountBalance" class="fs-2 fw-bold" style="cursor: pointer;">Rp <?= $balanceData?></span>
                </div>
                <div class="col-4">
                    <span class="fs-5 me-2">Lihat Saldo</span> <span id="toggleVisibilityIcon" class="fs-5 bi bi-eye "
                        onclick="toggleVisibility()" style="cursor: pointer;"> </span>
                </div>
        </div>
    </div>
</div>

<div class="lh-1 mt-5 mb-5">
    <h4 class="ps-3">Semua Transaksi</h4>
</div>

<?php foreach ($transaksi['data']['records'] as $transaksiHistory): ?>
    <div class="row border border-2 p-2 rounded  m-3">
        <div class="col-md-6">  
            <?php if ($transaksiHistory['description'] === 'Top Up Balance'): ?>
                <h3 class="text-success">+ Rp<?= number_format($transaksiHistory['total_amount'], 0, ',', '.') ?> </h3>
                <?php else: ?>
                    <h3 class="text-danger">- Rp<?= number_format($transaksiHistory['total_amount'], 0, ',', '.') ?> </h3>
                <?php endif; ?>
            <p><?= date('d F Y H.i', strtotime($transaksiHistory['created_on'])) ?> wib</p>
        </div>
        <div class="col-md-6 text-end">
                <p><?= $transaksiHistory['description'] ?></p>
        </div>
    </div>
<?php endforeach; ?>


<div class="text-center">
    <button id="show-more-btn" class="btn border-danger mt-3 mb-4" id="showMoreButton">Show More</button>
</div>

<div id="transactionHistory"> </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        amountBalance.innerText = 'Rp  <?= $balanceData ?>';
        toggleVisibilityIcon.classList.remove('bi-eye-slash');
        toggleVisibilityIcon.classList.add('bi-eye');
        isVisible = true;
    }
}
</script>
   


 
<?= $this->endSection() ?>