<?= $this->extend('homepage/homepage') ?>

<?= $this->section('content') ?>

<!-- Main Content -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="row p-3">
                <div class="col-12 mb-3"><img src="<?= base_url('images/profile_photo.png') ?>" alt="userprofile" class="rounded-circle"></div>
                <div class="col-3">Selamat datang,</div>
                <div class="col-12">
                    <h2><?= mb_convert_case($profileData['data']['first_name'], MB_CASE_TITLE) . ' ' . mb_convert_case($profileData['data']['last_name'], MB_CASE_TITLE); ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 bg-danger rounded">
            <div class="row p-4 text-white">
                <div class="col-12">
                    <p class="fw-medium">Saldo Anda</p>
                </div>
                <div class="col-12">
                <span id="amountBalance" class="fs-2 fw-bold" style="cursor: pointer;">Rp <?= $balanceData?></span>
                </div>
                <div class="col-4">
                <span class="fs-5 me-2">Lihat Saldo</span> <span id="toggleVisibilityIcon" class="fs-5 bi bi-eye " onclick="toggleVisibility()" style="cursor: pointer;"> </span>
                </div>
            </div>
        </div>
    </div>

    <div class="lh-1 mt-5 mb-5">
        <p class="fw-light fs-5 ps-3"> Silahkan masukan</p>
        <h2 class="ps-3">Nominal Top Up</h2>
    </div>

    <div class="container text-center mt-5">
        <div class="row">
            <div class="col-7">

                <div class="col-12 border border-2 border-dark-subtle mb-3">
                    <span class="d-flex"><i class="fs-5 text-secondary bi bi-cash m-2"></i>
                        <input type="number" class="form-control-plaintext" id="amount" name="top_up_amount" placeholder="Masukkan Nominal Top Up" aria-label="Amount" aria-describedby="addon-wrapping"></span>
                </div>

                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-danger btn-lg" id="topUpBtn" data-bs-toggle="modal" data-bs-target="#confirmModal" disabled>Top Up</button>
                </div>

            </div>
            <div class="col-1 me-4">
                <button class="btn btn-lg btn-outline-secondary mb-3" onclick="setAmount(10000)">Rp10.000</button>
                <button class="btn btn-lg btn-outline-secondary" onclick="setAmount(20000)">Rp20.000</button>
            </div>
            <div class="col-1 me-4">
                <button class="btn btn-lg btn-outline-secondary mb-3" onclick="setAmount(30000)">Rp30.000</button>
                <button class="btn btn-lg btn-outline-secondary" onclick="setAmount(40000)">Rp40.000</button>
            </div>
            <div class="col-1">
                <button class="btn btn-lg btn-outline-secondary mb-3" onclick="setAmount(50000)">Rp50.000</button>
                <button class="btn btn-lg btn-outline-secondary" onclick="setAmount(60000)">Rp60.000</button>
            </div>

        </div>
    </div>



    <!-- Modal Confirm -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="<?= base_url('images/logo.png') ?>" alt="logo" height="50px" width="50px">
                    <h5 class="mt-3">Anda yakin untuk Top Up sebesar</h5>
                    <h2 class="mb-4" id="displayAmount"></h2>
                    <form action="/topup/store" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="top_up_amount" id="amountInput">
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
                    <p class="mt-3">Top up sebesar </p>
                    <h2 class="mb-1" id="displayAmount1"> Rp <?= session()->getFlashdata('amount'); ?></h2>
                    <p>berhasil!.</p>
                    <a href="<?= base_url('/homepage') ?>" class="link-offset-2 link-underline link-underline-opacity-0 danger mb-2"> Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Error -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="display-3 text-danger"><i class="bi bi-x-circle-fill"></i></span>
                    <p class="mt-3">Top Up sebesar </p>
                    
                    <h2 class="mb-1" id="displayAmount1">Rp <?= session()->getFlashdata('amount'); ?></h2>
                    <p>Gagal!</p>
                    <a href="<?= base_url('/homepage') ?>" class="link-offset-2 link-underline link-underline-opacity-0 danger mb-2"> Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>




</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
 function formatCurrency(amount) {
        return `RP ${new Intl.NumberFormat().format(amount)}`;
    }

    // Mendapatkan referensi ke elemen input di luar modal
    const amountInput = document.getElementById('amount');
    // Mendapatkan referensi ke elemen di dalam modal
    const amountInputModal = document.getElementById('amountInput');
    const displayAmount = document.getElementById('displayAmount');
    
    const topUpBtn = document.getElementById('topUpBtn');


    function setAmount(amount) {
    const inputAmount = document.getElementById('amount');
    const topUpBtn = document.getElementById('topUpBtn');
    // Menetapkan nilai ke input
    inputAmount.value = amount;
    // Mengisi nilai input di dalam modal dan mengubah tampilan nilai
    amountInputModal.value = amount;
    // Merubah ke bentuk Rupiah
    displayAmount.innerText = formatCurrency(amount);
    // Menonaktifkan tombol Top Up 
        topUpBtn.removeAttribute('disabled');
}

amountInput.addEventListener('input', function() {
    const amountValue = this.value;
    // Panggil fungsi setAmountAndCheckButton dengan nilai amountValue
    setAmount(amountValue);
});

    // Modal Sukses dan Error Tampilkan
    $(document).ready(function() {
        <?php if (session()->getFlashdata('success')) : ?>
            $('#successModal').modal('show');
        <?php endif; ?>

        <?php if (session()->getFlashdata('errorMessage')) : ?>
            $('#errorModal').modal('show');
        <?php endif; ?>
    });
   
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