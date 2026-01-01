<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Profil Saya - ChickenSizzle</title>
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
        <h3>Pengaturan Profil</h3>
        <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="/customer/account/update-profile" method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Foto Profil</label>
                <div>
                    <?php if(!empty($user['profile_image']) && file_exists(FCPATH.'assets/image_user/'.$user['profile_image'])): ?>
                    <img src="/assets/image_user/<?= esc($user['profile_image']) ?>" alt="avatar"
                        class="img-thumbnail mb-2" style="width:150px;height:150px;object-fit:cover;">
                    <?php else: ?>
                    <img src="https://placehold.co/150x150" class="img-thumbnail mb-2"
                        style="width:150px;height:150px;object-fit:cover;">
                    <?php endif; ?>
                </div>
                <input type="file" name="profile_image" class="form-control">
            </div>

            <div class="col-md-8">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="full_name" class="form-control" value="<?= esc($user['full_name']) ?>"
                    required>

                <label class="form-label mt-3">Email (tidak bisa diubah)</label>
                <input type="email" class="form-control" value="<?= esc($user['email']) ?>" disabled>

                <label class="form-label mt-3">No. HP</label>
                <input type="text" name="phone" class="form-control" value="<?= esc($user['phone']) ?>">

                <label class="form-label mt-3">Alamat</label>
                <textarea name="address" class="form-control"><?= esc($user['address']) ?></textarea>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-danger">Simpan Profil</button>
                    <a href="/customer/account/change-password" class="btn btn-outline-secondary">Ganti Password</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>