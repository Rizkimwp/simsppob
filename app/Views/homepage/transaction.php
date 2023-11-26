<?= $this->extend('homepage/homepage') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="container mt-4">
    <div class="row"> 
        <div class="col-md-6 col-lg-6">
            <div class="row p-3"> 
                <div class="col-12 mb-3"><img src="<?= $profileData['data']['profile_image'] ?>" alt="userprofile" class="rounded-circle" ></div>
                <div class="col-3">Selamat datang,</div>
                <div class="col-12"><h2><?= mb_convert_case($profileData['data']['first_name'], MB_CASE_TITLE) . ' ' . mb_convert_case($profileData['data']['last_name'], MB_CASE_TITLE); ?></h2></div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 bg-danger rounded">
        <div class="row p-4 text-white"> 
                <div class="col-12"><p class="fw-medium">Saldo Anda</p></div>
                <div class="col-12"><h2>Rp <?= $balanceData?> </div>
                <div class="col-12"><p class="fw-light">Lihat Saldo </p></div>
        </div>
    </div>
</div>


<div class="col-3 p-3"> 
<p class="fs-6 ">PemBayaran</p>
    <img src="<?= $transaksiData['service_icon'] ?>" alt="service icon" height="30px" width="30px">
    <span class="fw-bold fs-5 ms-3"> <?= $transaksiData['service_name'] ?></span> 
</div>
<div class="row p-3"> 
    <div class="col-11">
        

    <div class="col-12 border border-2 border-dark-subtle mb-3">
    <span class="d-flex"><i class="fs-5 text-secondary bi bi-cash m-2"></i>
    <input type="text" class="form-control-plaintext" id="amount" name="service_code" placeholder="<?= $transaksiData['service_tariff'] ?>" aria-label="Amount" aria-describedby="addon-wrapping" disabled ></span>
</div>

<div class="d-grid gap-2">
    <button type="button" class="btn btn-danger btn-lg" id="topUpBtn" data-bs-toggle="modal" data-bs-target="#confirmModal" >Top Up</button>
</div>

</div>
</div>

<!-- Confirm Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="<?= base_url('images/logo.png') ?>" alt="logo" height="50px" width="50px">
                <h5 class="mt-3">Anda yakin untuk Top Up sebesar</h5>
                <h2 class="mb-4" id="displayAmount">Rp <?= number_format($transaksiData['service_tariff'] , 0, ',', '.') ?></h2>
            
                <form action="/transaksi "  id="transactionForm" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="service_code" value="<?= $transaksiData['service_code'] ?>">
                    <input type="hidden" name="service_tarif" value="<?= $transaksiData['service_tariff'] ?>">
                    <button type="submit" class="text-danger">Ya, Lanjutkan Top Up</button>
                </form>
                <a type="button" class="link-offset-2 link-underline link-underline-opacity-0 link-secondary" data-bs-dismiss="modal">Batal</a>
            </div>
        </div>
    </div>
</div>


<!-- Modal Succsess -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
            <span class="display-3 text-success"><i class="bi bi-check-circle-fill"></i></span>
                <p class="mt-3">Pembayaran <?= $transaksiData['service_name'] ?> sebesar </p>
                <h2 class="mb-1" id="displayAmount">Rp <?= number_format($transaksiData['service_tariff'] , 0, ',', '.') ?></h2>
                <p >berhasil!.</p>
                <a href="<?= base_url('/homepage') ?>" class="link-offset-2 link-underline link-underline-opacity-0 danger mb-2"> Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
            <span class="display-3 text-danger"><i class="bi bi-x-circle-fill"></i></span>
                <p class="mt-3">Pembayaran <?= $transaksiData['service_name'] ?> sebesar </p>
                <h2 class="mb-1" >Rp <?= number_format($transaksiData['service_tariff'] , 0, ',', '.') ?></h2>
                <p >Gagal!</p>
                <a href="<?= base_url('/homepage') ?>" class="link-offset-2 link-underline link-underline-opacity-0 danger mb-2"> Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>
</div>
</div>




<script>
    // Mendapatkan referensi ke elemen input di luar modal
const amountInput = document.getElementById('amount');
// Mendapatkan referensi ke elemen di dalam modal
const amountInputModal = document.getElementById('amountInput');
const displayAmount = document.getElementById('displayAmount');
const topUpBtn = document.getElementById('topUpBtn');
// Menambahkan event listener untuk perubahan input
amountInput.addEventListener('input', function() {
    const amountValue = this.value;
    // Mengisi nilai input di dalam modal
    amountInputModal.value = amountValue;
    // Mengubah tampilan nilai dalam modal sesuai format mata uang
    displayAmount.innerText = formatCurrency(amountValue);
});
</script>


<!-- Pesan Success -->
<?php if(session()->getFlashdata('success')): ?>
    <script>
        var successMessage = "<?= session()->getFlashdata('success'); ?>";
    </script>
<?php endif; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Tampilkan Modal-->
<script>
    $(document).ready(function() {
        if(successMessage !== '') {
            $('#successModal').modal('show'); // Menampilkan modal
        }
    });
</script>
<!-- Pesan Error -->
<?php if(session()->getFlashdata('errorMessage')): ?>
    <script>
        var errorMessage = "<?= session()->getFlashdata('errorMessage'); ?>";
    </script>
<?php endif; ?>
<!-- Tampilkan Error -->
<script>
    $(document).ready(function() {
        if(errorMessage !== '') {
            $('#errorModal').modal('show'); // Menampilkan modal error
        }
    });
</script>

<?= $this->endSection() ?>