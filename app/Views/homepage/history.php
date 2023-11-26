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
                <div class="col-12"><h2>Rp <?= $balanceData?> </div>
                <div class="col-12"><p class="fw-light">Lihat Saldo </p></div>
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
    let offset = <?php echo count($transaksiHistory); ?>; // Hitung offset untuk item-item berikutnya
    const showMoreButton = document.getElementById('showMoreButton');

    showMoreButton.addEventListener('click', function () {
        fetch('HistoryController/showMore', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                offset: offset // Kirim offset ke controller saat tombol "Show More" ditekan
            })
        })
        .then(response => response.json())
        .then(data => {
            // Tambahkan data transaksi berikutnya ke dalam tampilan
            const transactionHistoryDiv = document.getElementById('transactionHistory');
            data.forEach(transaction => {
                const transactionDiv = document.createElement('div');
                transactionDiv.textContent = transaction['transaction_data'];
                transactionHistoryDiv.appendChild(transactionDiv);
            });

            offset += data.length; // Update offset
        })
        .catch(error => {
            console.error('Error fetching more data:', error);
        });
    });
</script>
   


 
<?= $this->endSection() ?>