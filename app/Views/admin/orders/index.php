<!DOCTYPE html>
<html>
<head>
   <link rel="icon" type="image/svg+xml" href="assets/cs.png" />
  <title>Pesanan Pelanggan - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
          <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            transition: 0.3s;
            border: none;
            border-radius: 12px;
        }
        .card:hover {
            transform: scale(1.04);
            box-shadow: 0px 5px 15px rgba(0,0,0,0.1);
        }
        .icon {
            font-size: 2rem;
            color: #dc3545;
        }
         .navbar-nav .nav-link {
     color: #fff !important;
     transition: 0.3s;
 }
        .navbar {
            background-color: #dc3545 !important;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .navbar .dropdown-menu {
    background-color: #fff;
    border: none;
}
        .navbar .dropdown-item:hover {
    background-color: rgb(220 53 69);
    color: #fff;
}
         .navbar-nav .nav-link:hover {
     color: #ffeb3b !important;
     transform: scale(1.05);
 }
    </style>
</head>
<body class="bg-light">

<!-- 🔴 Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
     <a class="navbar-brand fw-bold d-flex align-items-center" href="/">
     <img src="<?= base_url('assets/cs.png') ?>" alt="ChickenSizzle Logo"
         style="width:50px;height:50px;object-fit:cover;" class="me-2">
     ChickenSizzle Admin
 </a>
 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
     <span class="navbar-toggler-icon"></span>
 </button>

    <div class="collapse navbar-collapse" id="navbarAdmin">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a href="/admin/dashboard" class="nav-link ">Dashboard</a></li>
        <li class="nav-item"><a href="/admin/products" class="nav-link">Produk</a></li>
        <li class="nav-item"><a href="/admin/categories" class="nav-link">Kategori</a></li>
        <li class="nav-item"><a href="/admin/orders" class="nav-link">Pesanan</a></li>
        <li class="nav-item"><a href="/admin/payments" class="nav-link">Pembayaran</a></li>
        <li class="nav-item"><a href="/admin/reports" class="nav-link">Laporan</a></li>
        <li class="nav-item"><a href="/admin/inventory" class="nav-link">Bahan Baku</a></li>
        <li class="nav-item"><a href="/logout" class="btn btn-light btn-sm ms-2">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container p-4">
  <h2 class="text-center mb-4">📦 Daftar Pesanan Pelanggan</h2>

  <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>

  <table class="table table-bordered table-hover align-middle">
    <thead class="table-danger text-center">
      <tr>
        <th>Invoice</th>
        <th>Nama Pelanggan</th>
        <th>Total</th>
        <th>Status</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($orders as $o): ?>
        <tr>
          <td><?= esc($o['invoice_number']) ?></td>
          <td><?= esc($o['full_name']) ?></td>
          <td>Rp <?= number_format($o['total_amount'], 0, ',', '.') ?></td>
          <td>
            <form action="/admin/orders/updateStatus/<?= $o['transaction_id'] ?>" method="post" class="d-flex">
              <select name="status" class="form-select form-select-sm me-2">
                <?php foreach (['pending','paid','processing','shipped','completed','cancelled'] as $status): ?>
                  <option value="<?= $status ?>" <?= $o['status'] == $status ? 'selected' : '' ?>><?= ucfirst($status) ?></option>
                <?php endforeach; ?>
              </select>
              <button type="submit" class="btn btn-sm btn-primary">✔</button>
            </form>
          </td>
          <td><?= date('d M Y', strtotime($o['transaction_date'])) ?></td>
          <td><a href="/admin/orders/detail/<?= $o['transaction_id'] ?>" class="btn btn-warning btn-sm">Detail</a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
</body>
</html>
