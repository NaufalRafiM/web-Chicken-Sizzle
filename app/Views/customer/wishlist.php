<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/svg+xml" href="assets/cs.png" />
    <title>Wishlist Saya - ChickenSizzle</title>
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
                        <a class="nav-link <?= (uri_string() == '') ? 'active fw-bold' : '' ?>"
                            href="/customer/account/profile">profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == '') ? 'active fw-bold' : '' ?>"
                            href="/customer/account/change-password">password</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == '') ? 'active fw-bold' : '' ?>"
                            href="/customer/account/notifications">notifikasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == '') ? 'active fw-bold' : '' ?>"
                            href="/customer/wishlist">Wishlist</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == '') ? 'active fw-bold' : '' ?>"
                            href="/customer/orders">Riwayat order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == '') ? 'active fw-bold' : '' ?>"
                            href="/customer/cart">Keranjang</a>
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
        <h2 class="mb-4">💖 Wishlist Saya</h2>

        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php if (!empty($items)): ?>
        <div class="row">
            <?php foreach ($items as $it): ?>
            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm">
                    <img src="<?= $it['image'] ? '/assets/produk/'.$it['image'] : 'https://placehold.co/600x400' ?>"
                        class="card-img-top" style="height:200px;object-fit:cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= esc($it['product_name'] ?? $it['name']) ?></h5>
                        <p class="text-muted mb-2">Rp <?= number_format($it['price'] ?? $it['price'],0,',','.') ?></p>
                        <div class="mt-auto d-flex gap-2">
                            <a href="/customer/cart/add/<?= $it['product_id'] ?? $it['id'] ?>"
                                class="btn btn-danger btn-sm w-100">Tambah ke Keranjang</a>
                            <a href="/customer/wishlist/toggle/<?= $it['product_id'] ?? $it['id'] ?>"
                                class="btn btn-outline-danger btn-sm w-100">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="alert alert-info">Wishlist kosong. Simpan produk favoritmu untuk dibeli nanti!</div>
        <?php endif; ?>

        <a href="/customer/home" class="btn btn-secondary mt-3">Lihat Menu</a>
    </div>
</body>

</html>