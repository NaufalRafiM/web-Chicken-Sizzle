<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk - Admin</title>
      <link rel="icon" type="image/svg+xml" href="assets/cs.png" />
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
<body class="">

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
    <h2 class="mb-4 text-center">Manajemen Produk - ChickenSizzle</h2>

    <a href="/admin/products/create" class="btn btn-success mb-3">+ Tambah Produk</a>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Kategori</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $p): ?>
                    <tr>
                        <td><?= $p['product_id'] ?></td>
                        <td><?= $p['category_name'] ?></td>
                        <td><?= esc($p['product_name']) ?></td>
                        <td>Rp <?= number_format($p['price'], 0, ',', '.') ?></td>
                        <td><?= $p['stock'] ?></td>
                        <td>
                            <span class="badge <?= $p['status'] == 'active' ? 'bg-success' : 'bg-secondary' ?>">
                                <?= ucfirst($p['status']) ?>
                            </span>
                        </td>
                        <td>
                            <a href="/admin/products/edit/<?= $p['product_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="/admin/products/delete/<?= $p['product_id'] ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin mau hapus produk ini?')">
                               Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <tr><td colspan="7" class="text-center">Belum ada produk</td></tr>
            <?php endif ?>
        </tbody>
    </table>
</div>
</body>
</html>
