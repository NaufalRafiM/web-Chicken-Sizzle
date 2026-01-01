<!DOCTYPE html>
<html>
<head>
     <link rel="icon" type="image/svg+xml" href="assets/cs.png" />
    <title>Promo & Diskon - ChickenSizzle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style> 
   body{
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
       <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm sticky-top">
       <div class="container">
           <img src="<?= base_url('assets/cs.png') ?>" alt="ChickenSizzle Logo" class="mt-1"
               style="width:50px;height:50px;object-fit:cover;">
           <a class="navbar-brand fw-bold" href="/">
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
                       <a class="nav-link dropdown-toggle" href="#" id="infoDropdown" role="button"
                           data-bs-toggle="dropdown">
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
                       <a class="nav-link dropdown-toggle" href="#" id="updateDropdown" role="button"
                           data-bs-toggle="dropdown">
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
<div class="container text-center">
    <h2 class="mb-4">Promo & Diskon Spesial 🎉</h2>
    <div class="row justify-content-center">
        <div class="col-md-4 mb-5">
            <div class="card border-danger">
                <div class="card-body">
                    <h4>🔥 Diskon 30% Menu Best Seller</h4>
                    <h5>Berlaku hingga 22 Desember 2025</h5>
                    <p>Nikmati potongan harga spesial untuk menu ayam sizzling favorit pelanggan ChickenSizzle.</p>
                </div>
            </div>
        </div>
         <div class="col-md-4 mb-5">
     <div class="card border-danger">
         <div class="card-body">
             <h4>🍱 Paket Hemat Berdua</h4>
             <h5>Berlaku hingga 31 Desember 2025</h5>
             <p>Dapatkan 2 porsi ayam sizzling + 2 nasi + 2 minuman dengan harga lebih hemat.</p>
         </div>
     </div>
 </div>
         <div class="col-md-4 mb-5">
     <div class="card border-danger">
         <div class="card-body">
             <h4>🌶️ Gratis Upgrade Level Pedas</h4>
             <p>Berlaku hingga 31 Desember 2025</p>
             <p>Buat kamu pecinta pedas, nikmati upgrade level pedas tanpa biaya tambahan.</p>
         </div>
     </div>
 </div>
        <div class="col-md-4 mb-5">
            <div class="card border-warning">
                <div class="card-body">
                    <h4>🕒 Happy Hour ChickenSizzle</h4>
                    <h5>Berlaku setiap hari pukul 10.00 – 22.00 WIB hingga 31 Desember 2025</h5>
                    <p>Diskon khusus untuk pembelian langsung di jam santai.</p>
                </div>
            </div>
        </div>
         <div class="col-md-4 mb-5">
     <div class="card border-warning">
         <div class="card-body">
             <h4>⭐ Promo Pelanggan Setia</h4>
             <h5>Berlaku setiap hari</h5>
             <p>Kumpulkan pembelian dan dapatkan diskon spesial untuk transaksi berikutnya.</p>
         </div>
     </div>
 </div>
  <div class="col-md-4 mb-5">
     <div class="card border-warning">
         <div class="card-body">
             <h4>📱 Promo Follow & Share</h4>
             <h5>Berlaku hingga 31 Desember 2025</h5>
             <p>Follow Instagram ChickenSizzle & share postingan promo, dapatkan potongan harga langsung.</p>
         </div>
     </div>
 </div>
    </div>
</div>
 <?= view('public/shared/footer') ?>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
