<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/svg+xml" href="assets/cs.png" />
    <title>Inventory Bahan Baku - Admin</title>
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
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
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
        <h2 class="text-center mb-4">📦 Inventory Bahan Baku ChickenSizzle</h2>

        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php if (!empty($lowStock)): ?>
        <div class="alert alert-warning">
            ⚠️ <strong>Stok Menipis!</strong> Berikut bahan yang perlu di-restock:
            <ul class="mb-0">
                <?php foreach ($lowStock as $i): ?>
                <li><strong><?= esc($i['ingredient_name']) ?></strong> — stok: <?= $iad['current_stock'] ?>
                    <?= $i['unit'] ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <div class="text-end mb-3">
            <a href="/admin/inventory/add" class="btn btn-danger">+ Tambah Bahan Baru</a>
        </div>

        <table class="table table-bordered align-middle text-center">
            <thead class="table-danger">
                <tr>
                    <th>Nama Bahan</th>
                    <th>Stok Sekarang</th>
                    <th>Stok Minimum</th>
                    <th>Satuan</th>
                    <th>Harga / Unit</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ingredients as $i): ?>
                <tr>
                    <td><?= esc($i['ingredient_name']) ?></td>
                    <td><?= $i['current_stock'] ?></td>
                    <td><?= $i['minimum_stock'] ?></td>
                    <td><?= $i['unit'] ?></td>
                    <td>Rp <?= number_format($i['price_per_unit'], 0, ',', '.') ?></td>
                    <td>
                        <span class="badge <?= $i['status'] == 'active' ? 'bg-success' : 'bg-secondary' ?>">
                            <?= ucfirst($i['status']) ?>
                        </span>
                    </td>
                    <td>
                        <a href="/admin/inventory/form/<?= $i['ingredient_id'] ?>"
                            class="btn btn-sm btn-warning">Edit</a>
                        <a href="/admin/inventory/history/<?= $i['ingredient_id'] ?>"
                            class="btn btn-sm btn-info">Riwayat</a>
                        <a href="/admin/inventory/delete/<?= $i['ingredient_id'] ?>" class="btn btn-sm btn-danger"
                            onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>

</html>