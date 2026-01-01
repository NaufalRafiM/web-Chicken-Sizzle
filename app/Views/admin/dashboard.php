<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - ChickenSizzle</title>
    <link rel="icon" type="image/svg+xml" href="assets/cs.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
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

    .navbar {
        background-color: #dc3545 !important;
    }

    .navbar-brand {
        font-weight: bold;
    }

    .navbar-nav .nav-link {
        color: #fff !important;
        transition: 0.3s;
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
                ChickenSizzle Admin
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarAdmin">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="/admin/dashboard" class="nav-link active">Dashboard</a></li>
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

    <!-- 🧠 Dashboard Content -->
    <div class="container py-5">
        <h2 class="text-center mb-3">Selamat Datang, <span class="text-danger"><?= session()->get('username') ?></span>
            👋</h2>
        <p class="text-center mb-5 text-muted">Role: <strong><?= session()->get('role') ?></strong></p>

        <div class="row g-4">
            <!-- Produk -->
            <div class="col-md-4">
                <a href="/admin/products" class="text-decoration-none text-dark">
                    <div class="card p-4 text-center shadow-sm">
                        <i class="bi bi-box-seam icon"></i>
                        <h5 class="mt-3">Kelola Produk</h5>
                        <p class="text-muted">Tambah, ubah, atau hapus produk.</p>
                    </div>
                </a>
            </div>

            <!-- Kategori -->
            <div class="col-md-4">
                <a href="/admin/categories" class="text-decoration-none text-dark">
                    <div class="card p-4 text-center shadow-sm">
                        <i class="bi bi-tags icon"></i>
                        <h5 class="mt-3">Kategori</h5>
                        <p class="text-muted">Atur kategori produk dengan mudah.</p>
                    </div>
                </a>
            </div>

            <!-- Pesanan -->
            <div class="col-md-4">
                <a href="/admin/orders" class="text-decoration-none text-dark">
                    <div class="card p-4 text-center shadow-sm">
                        <i class="bi bi-cart-check icon"></i>
                        <h5 class="mt-3">Pesanan</h5>
                        <p class="text-muted">Lihat dan kelola semua pesanan.</p>
                    </div>
                </a>
            </div>

            <!-- Pembayaran -->
            <div class="col-md-4">
                <a href="/admin/payments" class="text-decoration-none text-dark">
                    <div class="card p-4 text-center shadow-sm">
                        <i class="bi bi-cash-coin icon"></i>
                        <h5 class="mt-3">Pembayaran</h5>
                        <p class="text-muted">Verifikasi bukti pembayaran pelanggan.</p>
                    </div>
                </a>
            </div>

            <!-- Laporan -->
            <div class="col-md-4">
                <a href="/admin/reports" class="text-decoration-none text-dark">
                    <div class="card p-4 text-center shadow-sm">
                        <i class="bi bi-bar-chart-line icon"></i>
                        <h5 class="mt-3">Laporan</h5>
                        <p class="text-muted">Pantau penjualan & keuangan bisnis.</p>
                    </div>
                </a>
            </div>

            <!-- Bahan Baku -->
            <div class="col-md-4">
                <a href="/admin/inventory" class="text-decoration-none text-dark">
                    <div class="card p-4 text-center shadow-sm">
                        <i class="bi bi-bar-chart-line icon"></i>
                        <h5 class="mt-3">Bahan Baku</h5>
                        <p class="text-muted">Pantau Bahan Baku bisnis.</p>
                    </div>
                </a>
            </div>

            <!-- Logout -->
            <div class="col-md-4">
                <a href="/logout" class="text-decoration-none text-dark">
                    <div class="card p-4 text-center shadow-sm">
                        <i class="bi bi-door-closed icon"></i>
                        <h5 class="mt-3">Logout</h5>
                        <p class="text-muted">Keluar dari sistem admin.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>