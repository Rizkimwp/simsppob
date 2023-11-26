<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMS PPOB - Rizky Maulana</title>

    <!-- Bootstrap Icons CSS (versi terkini dari CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootsrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
</head>

<body>

    <div class="container-fluid h-100">
        <div class="row vh-100">
            <!-- Grid bagian kiri untuk form -->
            
            <?= $this->renderSection('content') ?>
            <!-- Grid bagian kanan untuk gambar latar belakang -->
            <div class="col-md-6 "
                style="background-image: url('<?= base_url('images/ilustrasi_login.png') ?>'); background-size: cover;">
                <!-- Tidak ada konten di sini karena digunakan sebagai gambar latar belakang -->
         </div>
        </div>
    </div>


   
    <!-- Bootstrap JS -->
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/script.js') ?>"></script>
</body>

</html>