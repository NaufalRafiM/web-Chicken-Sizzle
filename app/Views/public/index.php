<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="assets/cs.png" />
    <title>Chicken Sizzle</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
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
        background: linear-gradient(180deg, #000000ff 0%, #1a1a1a 100%);
    }

    footer h5 {
        font-size: 1.1rem;
        letter-spacing: 0.5px;
    }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm sticky-top">
        <div class="container">

            <a class="navbar-brand fw-bold d-flex align-items-center" href="/">
                <img src="<?= base_url('assets/cs.png') ?>" alt="ChickenSizzle Logo"
                    style="width:50px;height:50px;object-fit:cover;" class="me-2">
                ChickenSizzle
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == '') ? 'active fw-bold' : '' ?>" href="/">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/about">Tentang Kami</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Informasi</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/faq">FAQ</a></li>
                            <li><a class="dropdown-item" href="/terms">Syarat & Ketentuan</a></li>
                            <li><a class="dropdown-item" href="/privacy">Kebijakan Privasi</a></li>
                            <li><a class="dropdown-item" href="/testimonials">Testimoni</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Update</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/blog">Blog / Berita</a></li>
                            <li><a class="dropdown-item" href="/promo">Promo & Diskon</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Kontak</a>
                    </li>

                    <li class="nav-item ms-lg-3">
                        <a href="home" class="btn btn-warning btn-sm">Lihat Menu 🍗</a>
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


    <!-- HERO -->
    <section class="hero">
        <img src="<?= base_url('assets/cs.png') ?>" alt="ChickenSizzle Logo" class="mb-3"
            style="width:180px;height:180px;object-fit:cover;">

        <h1>Rasakan Ayam Sizzle dengan Sensasi 🔥</h1>
        <p>Kelezatan ayam panas dengan bumbu khas ChickenSizzle!</p>

        <a href="/customer/home" class="btn btn-warning btn-lg fw-bold">Lihat Menu 🍗</a>
    </section>


    <!-- MENU SECTION -->
    <div class="container py-5" id="menu">
        <h2 class="text-center mb-4">Menu Terbaru Kami 🍴</h2>

        <div class="row">
            <?php foreach ($products as $p): ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?= $p['image'] 
                                ? base_url('assets/produk/' . $p['image']) 
                                : 'https://placehold.co/300x200' ?>" class="card-img-top"
                        alt="<?= esc($p['product_name']) ?>">

                    <div class="card-body text-center">
                        <h5 class="card-title"><?= esc($p['product_name']) ?></h5>
                        <p class="card-text"><?= esc($p['description']) ?></p>
                        <p class="text-muted mb-1">Rp <?= number_format($p['price'], 0, ',', '.') ?></p>
                        <a href="/login" class="btn btn-danger w-100">Pesan Sekarang 🔥</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-3">
            <a href="/customer/home" class="btn btn-outline-danger">Lihat Semua Menu</a>
        </div>
    </div>


    <!-- FOOTER -->
    <?= view('public/shared/footer') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>