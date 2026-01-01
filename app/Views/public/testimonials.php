<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="assets/cs.png" />
    <title>Testimoni Pelanggan - ChickenSizzle</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <style>
        /* NAVBAR */
        .navbar {
            padding: 10px 0;
        }

        .navbar-brand {
            font-size: 1.5rem;
            margin-left: 2px;
        }

        .navbar-nav .nav-link {
            color: #fff !important;
            transition: 0.3s;
            padding: 8px 14px !important;
        }

        .navbar-nav .nav-link:hover {
            color: #ffeb3b !important;
            transform: scale(1.06);
        }

        .navbar .dropdown-menu {
            background-color: #ffffff;
            border: none;
            border-radius: 8px;
        }
         .navbar .dropdown-item:hover {
     background-color: rgb(220 53 69);
     color: #fff;
 }

        /* FIX BODY BACKGROUND PUTIH */
        body {
            background: #1a1a1a !important;
        }

        /* FIX GAP PUTIH DI BAWAH HEADER */
        .page-header {
            background-size: cover !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            margin-bottom: 0 !important;
            padding-bottom: 80px !important;
        }

        /* FOOTER */
        footer {
            background: linear-gradient(180deg, #1a1a1a 0%, #000000ff 100%);
            padding-top: 40px;
        }

        footer a:hover {
            color: #ffc107 !important;
        }

        /* TESTIMONI */
        .testimonial-item {
            background: #fff;
            padding: 25px;
            border-radius: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: .2s;
        }

        .testimonial-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .testimonial-item img {
            padding: 5px;
            width: 25px;
            height: 180px;
            border-radius: 5px;
            object-fit: cover;
            border: 5px solid #ffffffff;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm sticky-top">
        <div class="container">

            <a class="d-flex align-items-center text-decoration-none" href="/">
                <img src="<?= base_url('assets/cs.png') ?>" alt="ChickenSizzle Logo"
                     style="width:60px;height:60px;object-fit:cover;">
                <span class="navbar-brand fw-bold ms-2">ChickenSizzle</span>
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

    <!-- HEADER + TESTIMONI -->
    <div class="container-fluid page-header position-relative"
         style="background-image: url('<?= base_url('assets/bg1.png') ?>'); padding: 60px 0;">

        <div class="container py-5 mt-4">

            <div class="text-center mb-5">
                <h1 class="display-5 text-white">Apa Kata Pelanggan</h1>
            </div>

            <div class="owl-carousel testimonial-carousel">

                        <?php 
$testi = [
    [
        "nama" => "Dinda",
        "kota" => "Jakarta",
        "foto" => "https://randomuser.me/api/portraits/women/12.jpg",
        "pesan" => "Ayamnya enak banget, bikin nagih! Makasih ya, Dinda suka banget 😍"
    ],
    [
        "nama" => "Bima",
        "kota" => "Bekasi",
        "foto" => "https://randomuser.me/api/portraits/men/11.jpg",
        "pesan" => "Rasa pedasnya pas! Bima bakal order lagi nih. 🔥"
    ],
    [
        "nama" => "Rika",
        "kota" => "Depok",
        "foto" => "https://randomuser.me/api/portraits/women/44.jpg",
        "pesan" => "Chicken-nya lembut dan juicy. Mantap banget, Rika recommended! ⭐"
    ],
    [
        "nama" => "Maya",
        "kota" => "Bandung",
        "foto" => "https://randomuser.me/api/portraits/women/65.jpg",
        "pesan" => "Porsinya banyak, rasanya top! Maya puas banget! 🍗"
    ],
    [
        "nama" => "Rangga",
        "kota" => "Bogor",
        "foto" => "https://randomuser.me/api/portraits/men/33.jpg",
        "pesan" => "Harga ramah, rasa juara. Rangga kasih ⭐⭐⭐⭐⭐!"
    ],
];
?>

<?php foreach ($testi as $t): ?>
<div class="testimonial-item">
    <div class="d-flex align-items-center mb-3">
        <img src="<?= $t['foto'] ?>" alt="<?= $t['nama'] ?>">
        <div class="ms-3">
            <h4><?= $t['nama'] ?></h4>
            <i><?= $t['kota'] ?></i>
            <div class="text-warning mt-1" style="font-size: 18px;">
                ⭐⭐⭐⭐⭐
            </div>
        </div>
    </div>

    <p>"<?= $t['pesan'] ?>"</p>
</div>
<?php endforeach; ?>

            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <?= view('public/shared/footer') ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        $('.testimonial-carousel').owlCarousel({
            loop: true,
            margin: 20,
            autoplay: true,
            smartSpeed: 400,
            autoplayTimeout: 4000,
            responsive: {
                0: { items: 1 },
                768: { items: 2 },
                992: { items: 3 }
            }
        });
    </script>

</body>
</html>
