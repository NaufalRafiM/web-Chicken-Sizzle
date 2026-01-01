<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="assets/cs.png" />
    <title>FAQ - ChickenSizzle</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .hero {
            background: url('<?= base_url('assets/bg1.png') ?>') no-repeat center center/cover;
            color: white;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 0 20px;
        }

        .hero h1 {
            font-size: 3rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
        }

        .hero p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 10px auto 25px;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
        }

        .navbar-nav .nav-link {
            color: #fff !important;
            transition: 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #ffeb3b !important;
            transform: scale(1.05);
        }

        .navbar .dropdown-menu {
            background-color: #ffffff;
            border: none;
        }

        .navbar .dropdown-item:hover {
            background-color: rgb(220, 53, 69);
            color: #fff;
        }

        footer {
            background: linear-gradient(180deg, #1a1a1a 0%, #000000ff 100%);
        }

        footer h5 {
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }

        footer a:hover {
            color: #ffc107 !important;
        }
    </style>
</head>

<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="/">
            <img src="<?= base_url('assets/cs.png') ?>" style="width:50px;height:50px;object-fit:cover;" class="me-2">
            ChickenSizzle
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
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


<!-- CONTENT -->
<div class="container py-5">

    <h2 class="text-center mb-4">Syarat dan Ketentuan Penggunaan Website 🤔</h2>
    <p class="text-center mb-5">
        Dengan mengakses situs ini, Anda setuju untuk mematuhi syarat dan ketentuan yang berlaku,
        termasuk kebijakan privasi kami.
    </p>

    <div class="accordion" id="faqAccordion">

        <!-- ACCORDION TEMPLATE -->
        <?php 
        $items = [
            "Ketentuan Umum" => [
                "Website ini dikelola oleh UMKM ChickenSizzle sebagai media informasi produk, menu, pemesanan, promosi, dan komunikasi pelanggan.",
                "Syarat & ketentuan dapat berubah sewaktu-waktu tanpa pemberitahuan.",
                "Dengan terus menggunakan website, Anda dianggap menerima perubahan tersebut."
            ],
            "Informasi Produk" => [
                "Foto menu dan deskripsi bersifat ilustratif. Wujud asli dapat berbeda.",
                "Harga dapat berubah sewaktu-waktu.",
                "Ketersediaan menu tergantung lokasi dan stok harian."
            ],
            "Pemesanan" => [
                "Pesanan hanya diproses setelah pembayaran dikonfirmasi.",
                "Pemesanan yang belum dibayar dapat dibatalkan otomatis.",
                "Pelanggan wajib memastikan data pesanan sudah benar."
            ],
            "Pembayaran" => [
                "Metode pembayaran hanya yang tertera di halaman checkout.",
                "Bukti pembayaran tidak valid dapat dianggap tidak sah.",
                "Jika pembayaran gagal, pesanan tidak diproses."
            ],
            "Pengiriman & Pengambilan" => [
                "Estimasi pengiriman hanya perkiraan.",
                "Lokasi sulit dijangkau dapat dikenakan biaya tambahan.",
                "Untuk ambil di tempat, pelanggan wajib mengikuti jam operasional."
            ],
            "Pembatalan & Pengembalian Dana" => [
                "Pesanan yang diproses tidak dapat dibatalkan.",
                "Pelanggan wajib memastikan data sudah benar.",
                "Refund hanya berlaku jika pembayaran ganda / menu tidak tersedia / kesalahan pihak ChickenSizzle."
            ],
            "Penggunaan Situs" => [
                "ChickenSizzle berhak memblokir pengguna yang melanggar.",
                "Dilarang penggunaan ilegal & penyalahgunaan sistem.",
                "Dilarang meretas, memodifikasi, atau merusak website."
            ],
            "Privasi Pengguna" => [
                "ChickenSizzle melindungi data pribadi pelanggan.",
                "Data tidak dijual atau dibagikan kecuali diwajibkan hukum.",
                "Data digunakan untuk pesanan, layanan pelanggan, dan promo."
            ],
            "Hak Kekayaan Intelektual" => [
                "Seluruh konten adalah milik ChickenSizzle.",
                "Dilarang menyalin atau mendistribusikan tanpa izin tertulis."
            ],
            "Pembatasan Tanggung Jawab" => [
                "Website mungkin tidak selalu berfungsi tanpa gangguan.",
                "ChickenSizzle tidak bertanggung jawab atas kerusakan perangkat atau kesalahan pihak ketiga."
            ],
            "Kontak & Layanan Pelanggan" => [
                "Email: chickensizzle@gmail.com",
                "Instagram: @chickensizzle",
                "WhatsApp: 087855770953"
            ]
        ];

        $i = 1;
        foreach ($items as $title => $list): 
        ?>
        
        <div class="accordion-item">
            <h2 class="accordion-header" id="q<?= $i ?>">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#a<?= $i ?>">
                    <?= $i . ". " . $title ?>
                </button>
            </h2>
            <div id="a<?= $i ?>" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <?php foreach ($list as $text): ?>
                    <div class="accordion-body"><?= $text ?></div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php $i++; endforeach; ?>

    </div>
</div>

<!-- FOOTER -->
<?= view('public/shared/footer') ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
