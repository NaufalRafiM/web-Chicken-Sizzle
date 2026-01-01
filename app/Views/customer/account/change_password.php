<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/svg+xml" href="assets/cs.png"/>
  <title>Ganti Password - ChickenSizzle</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    .navbar-nav .nav-link {
    color: #fff !important;
    transition: 0.3s;
}
.navbar-nav .nav-link:hover {
    color: #ffeb3b !important;
    transform: scale(1.05);
}
.navbar .dropdown-menu {
    background-color: #ffffffff;
    border: none;
}
.navbar .dropdown-item {
    color: black;
}
.navbar .dropdown-item:hover {
    background-color: #ff8800ff;
}
</style>
</head>
<body class="bg-light">
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
                     <a class="nav-link <?= (uri_string() == '') ? 'active fw-bold' : '' ?>" href="/customer/account/profile">profile</a>
                 </li>
                  <li class="nav-item">
     <a class="nav-link <?= (uri_string() == '') ? 'active fw-bold' : '' ?>" href="/customer/account/change-password">password</a>
 </li>
 <li class="nav-item">
     <a class="nav-link <?= (uri_string() == '') ? 'active fw-bold' : '' ?>" href="/customer/account/notifications">notifikasi</a>
 </li> <li class="nav-item">
     <a class="nav-link <?= (uri_string() == '') ? 'active fw-bold' : '' ?>" href="/customer/wishlist">Wishlist</a>
 </li> <li class="nav-item">
     <a class="nav-link <?= (uri_string() == '') ? 'active fw-bold' : '' ?>" href="/customer/orders">Riwayat order</a>
 </li> <li class="nav-item">
     <a class="nav-link <?= (uri_string() == '') ? 'active fw-bold' : '' ?>" href="/customer/cart">Keranjang</a>
 </li>
            <?php if (session()->get('isLoggedIn')): ?>
                <a href="/logout" class="btn btn-light ms-2">Logout</a>
            <?php else: ?>
                <a href="/login" class="btn btn-light ms-2">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container">
  <h3>Ganti Password</h3>
  <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>
  <?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
  <?php endif; ?>

  <form action="/customer/account/update-password" method="post" class="mt-3 col-md-6">
    <div class="mb-3">
      <label>Password Lama</label>
      <input type="password" name="old_password" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Password Baru</label>
      <input type="password" name="new_password" class="form-control" required minlength="8">
    </div>
    <div class="mb-3">
      <label>Konfirmasi Password Baru</label>
      <input type="password" name="confirm_password" class="form-control" required minlength="8">
    </div>
    <button class="btn btn-danger">Update Password</button>
    <a href="/customer/account/profile" class="btn btn-secondary ms-2">Batal</a>
  </form>
</div>
</body>
</html>
