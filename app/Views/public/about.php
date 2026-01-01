<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="assets/cs.png" />
    <title>Chicken Sizzle</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background: #0f1113 !important;
        margin: 0;
        padding: 0;
    }

    .page-header {
        background-color: transparent !important;
    }

    .container-fluid.page-header {
        margin: 0 !important;
        padding-top: 60px !important;
    }

    .container {
        background: transparent !important;
    }

    /* HERO */
    .hero {
        background: url('<?= base_url('assets/bg1.png') ?>') no-repeat center center/cover;
        color: white;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 0 20px;
    }

    .hero h1 {
        font-size: 3rem;
        font-weight: 700;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
    }

    .hero p {
        font-size: 1.2rem;
        max-width: 600px;
        margin: 10px auto 25px;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
    }

    /* NAVBAR */
    .navbar-nav .nav-link {
        color: #fff !important;
        transition: 0.3s;
    }

    .navbar-nav .nav-link:hover {
        color: #ffeb3b !important;
        transform: scale(1.05);
    }

    .navbar .dropdown-menu {
        background-color: #fff;
        border: none;
    }

    .navbar .dropdown-item:hover {
        background-color: rgb(220 53 69);
        color: #fff;
    }

    /* FOOTER */
    footer {
        background: linear-gradient(180deg, #212426ff 0%, #000000ff 100%);
    }

    footer h5 {
        font-size: 1.1rem;
        letter-spacing: 0.5px;
    }
</style>

</head>

<body class="bg-dark">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm sticky-top">
        <div class="container">

            <img src="<?= base_url('assets/cs.png') ?>" alt="ChickenSizzle Logo"
                 class="mt-1" style="width:50px;height:50px;object-fit:cover;">

            <a class="navbar-brand fw-bold" href="/">
                ChickenSizzle
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == '') ? 'active fw-bold' : '' ?>"
                           href="/">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/about">Tentang Kami</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="infoDropdown"
                           role="button" data-bs-toggle="dropdown">
                            Informasi
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/faq">FAQ</a></li>
                            <li><a class="dropdown-item" href="/terms">Syarat & Ketentuan</a></li>
                            <li><a class="dropdown-item" href="/privacy">Kebijakan Privasi</a></li>
                            <li><a class="dropdown-item" href="/testimonials">Testimoni</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="updateDropdown"
                           role="button" data-bs-toggle="dropdown">
                            Update
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/blog">Blog / Berita</a></li>
                            <li><a class="dropdown-item" href="/promo">Promo & Diskon</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Kontak</a>
                    </li>

                    <li class="nav-item ms-lg-3">
                        <a href="/home" class="btn btn-warning btn-sm">Lihat Menu 🍗</a>
                    </li>

                    <?php if (session()->get('isLoggedIn')): ?>
                        <li class="nav-item ms-lg-2">
                            <a href="/logout" class="btn btn-light btn-sm">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item ms-lg-2">
                            <a href="/login" class="btn btn-light btn-sm">Login</a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>

        </div>
    </nav>

    <!-- HEADER SECTION -->
    <div class="container-fluid page-header mb-2"
         style="
            background: url('<?= base_url('assets/bg1.png') ?>') center center/cover no-repeat;
            width: 100%;
            min-height: 500px;
            padding: 60px 0;
         ">

        <div class="container" style="background: transparent !important;">
            <div class="row">

                <div class="col-lg-4 py-0 py-lg-5">
                    <h1 class="mb-3">Cerita Kami</h1>
                    <h5 class="mb-3">
                        ChickenSizzle lahir dari sebuah mimpi sederhana: menghadirkan ayam goreng
                        dan grilled chicken yang bukan hanya enak, tapi juga menggugah selera
                        dengan cita rasa khas yang sulit dilupakan...
                    </h5>
                    <p>
                        Kami percaya bahwa setiap gigitan harus memberi sensasi hangat, gurih,
                        dan lezat — sebuah pengalaman yang membuat pelanggan ingin kembali lagi.
                    </p>
                </div>

                <div class="col-lg-4 py-5 py-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100"
                             src="<?= base_url('assets/cs.png') ?>"
                             style="object-fit: contain;">
                    </div>
                </div>

                <div class="col-lg-4 py-0 py-lg-5">
                    <h1 class="mb-3">Visi & Misi</h1>
                    <p>Menjadi brand kuliner ayam modern yang dikenal luas karena rasa...</p>
                    <h5 class="mb-3">Menyajikan makanan berkualitas tinggi</h5>
                    <h5 class="mb-3">Berinovasi pada menu dan varian</h5>
                    <h5 class="mb-3">Mengutamakan kepuasan pelanggan</h5>
                </div>

            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <?= view('public/shared/footer') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
