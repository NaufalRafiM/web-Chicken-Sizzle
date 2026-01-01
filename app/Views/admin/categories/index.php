<!DOCTYPE html>
<html>
<head>
     <link rel="icon" type="image/svg+xml" href="assets/cs.png" />
    <title>Daftar Kategori - Admin</title>
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
<body>

<!-- 🔴 Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
      <a class="navbar-brand fw-bold d-flex align-items-center" href="/">
      <img src="<?= base_url('assets/cs.png') ?>" alt="ChickenSizzle Logo"
          style="width:50px;height:50px;object-fit:cover;" class="me-2">
      ChickenSizzle
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

<div class="p-4">
    <h2 class="mb-4 text-center">Manajemen Kategori</h2>

    <a href="/admin/categories/create" class="btn btn-success mb-3">+ Tambah Kategori</a>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $c): ?>
                    <tr>
                        <td><?= $c['category_id'] ?></td>
                        <td><?= esc($c['category_name']) ?></td>
                        <td><?= esc($c['description']) ?></td>
                        <td><?= $c['created_at'] ?></td>
                        <td>
                            <a href="/admin/categories/edit/<?= $c['category_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="/admin/categories/delete/<?= $c['category_id'] ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin mau hapus kategori ini?')">
                               Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <tr><td colspan="5" class="text-center">Belum ada kategori</td></tr>
            <?php endif ?>
        </tbody>
    </table>
</div>
</body>
</html>
