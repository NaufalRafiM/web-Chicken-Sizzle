<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Riwayat Pesanan - ChickenSizzle</title>
  <link rel="icon" type="image/svg+xml" href="assets/cs.png" />
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
  <h3 class="mb-4">Riwayat Pesanan Saya</h3>

  <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>
  <?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
  <?php endif; ?>

  <?php if (!empty($orders)): ?>
    <div class="table-responsive">
      <table class="table table-bordered align-middle">
        <thead class="table-danger text-center">
          <tr>
            <th>Invoice</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Shipping</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($orders as $o): ?>
            <tr>
              <td><?= esc($o['invoice_number']) ?></td>
              <td><?= date('d M Y H:i', strtotime($o['transaction_date'])) ?></td>
              <td>Rp <?= number_format($o['total_amount'],0,',','.') ?></td>
              <td><?= ucfirst($o['shipping_method'] ?? 'pickup') ?> <br> Rp <?= number_format($o['shipping_cost'] ?? 0,0,',','.') ?></td>
              <td>
                <span class="badge 
                  <?= $o['status'] == 'pending' ? 'bg-warning' : 
                     ($o['status'] == 'paid' ? 'bg-info' : 
                     ($o['status']=='processing'?'bg-primary':($o['status']=='shipped'?'bg-secondary':($o['status']=='completed'?'bg-success':'bg-danger')))) ?>">
                  <?= ucfirst($o['status']) ?>
                </span>
              </td>
              <td class="text-center">
                <a href="/customer/orders/detail/<?= $o['transaction_id'] ?>" class="btn btn-sm btn-primary mb-1">Lihat</a>
                <?php if ($o['status'] == 'pending'): ?>
                  <a href="/customer/orders/cancel/<?= $o['transaction_id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin batalkan pesanan?')">Batal</a>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="alert alert-info">Belum ada pesanan. Ayo belanja dulu! 🍗</div>
  <?php endif; ?>

  <a href="/customer/home" class="btn btn-secondary mt-3">Lihat Menu</a>
</div>
</body>
</html>
