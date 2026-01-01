<!DOCTYPE html>
<html>
<head>
    <title>Register - ChickenSizzle</title>
    <link rel="icon" type="image/svg+xml" href="assets/cs.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="">
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

<div class="bg-light d-flex justify-content-center align-items-center vh-100">
<div class="card shadow-lg p-4" style="width: 400px;">
    <h3 class="text-center mb-3">Buat Akun Baru</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <form action="/register/store" method="post">
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="full_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>No. HP</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Daftar</button>
        <p class="mt-3 text-center">Sudah punya akun? <a href="/login">Login</a></p>
    </form>
</div>
</div>
</body>
</html>
