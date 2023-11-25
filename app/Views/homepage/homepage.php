<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap Icons CSS (versi terkini dari CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootsrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
</head>

<body class="bg-body-secondary">
    <!-- Navbar  -->
    <div class="container-fluid bg-body-secondary border-bottom ">
    <div class="container">
        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="/homepage"><img src="<?= base_url('images/logo.png') ?>" alt="logo"> SIMS PPOB
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    </ul>
                    <span class="navbar-text">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item me-4">
                                <a class="nav-link active" aria-current="page" href="/topup ">Top Up</a>
                            </li>
                            <li class="nav-item me-4">
                                <a class="nav-link" href="/transaksi">Transaction</a>
                            </li>
                            <li class="nav-item me-4">
                                <a class="nav-link" href="#">Akun</a>
                            </li>
                            <li class="nav-item me-4">
                                <a class="nav-link" href="/logout">Logout</a>
                            </li>
                        </ul>
                    </span>
                </div>
            </div>
        </nav>
    </div>
</div>


<?= $this->renderSection('content') ?>
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-XXX"
        crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/script.js') ?>"></script>
</body>

</html>