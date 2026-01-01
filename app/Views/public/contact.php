<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="assets/cs.png" />
    <title>Contact - Chicken Sizzle</title>

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
        background: linear-gradient(180deg, #1a1a1a 0%, #000000ff 100%);
    }

    footer h5 {
        font-size: 1.1rem;
        letter-spacing: 0.5px;
    }
</style>

</head>
<body class="bg-light">

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

<div class="container py-5">
    <h2 class="text-center mb-4">Hubungi Kami 📞</h2>

    <div class="row">
        <div class="col-md-6">
            <h5>Form Kontak</h5>
            <form>
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" class="form-control" placeholder="Nama Anda">
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Email Anda">
                </div>
                <div class="mb-3">
                    <label>Pesan</label>
                    <textarea class="form-control" rows="4" placeholder="Tuliskan pesan Anda..."></textarea>
                </div>
                <button type="submit" class="btn btn-danger w-100">Kirim Pesan</button>
            </form>
        </div>

        <div class="col-md-6">
            <h5>Informasi Kontak</h5>
            <ul class="list-unstyled">
                <li><strong>Alamat:</strong> Jl. Palakali No.56, Kukusan, Kecamatan Beji, Kota Depok, Jawa Barat</li>
                <li><strong>Telepon:</strong> 087855770953</li>
                <li><strong>Email:</strong> chickensizzle@gmail.com</li>
            </ul>
            <h5 class="mt-4">Peta Lokasi</h5>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.2019271924482!2d106.81639277355661!3d-6.367908662289617!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed001d8d3da1%3A0x1d5885b12fbe575a!2sCHICKEN%20SIZZLE!5e0!3m2!1sid!2sid!4v1764757709284!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>
 <!-- FOOTER -->
 <?= view('public/shared/footer') ?>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
