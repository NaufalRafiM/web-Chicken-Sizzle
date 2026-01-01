<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Chicken Sizzle</title>
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
    <h2 class="text-center mb-4">Menu Spesial ChickenSizzle 🔥</h2>

    <div class="row">
        <?php foreach ($products as $p): ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?= $p['image'] ? '/assets/produk/'.$p['image'] : 'https://placehold.co/300x200' ?>" class="card-img-top">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= esc($p['product_name']) ?></h5>
                        <p class="text-muted">Rp <?= number_format($p['price'], 0, ',', '.') ?></p>
                        <?php
                            $user_id = session()->get('user_id');
                            $inWishlist = false;
                            if ($user_id) {
                                $wm = new \App\Models\WishlistModel();
                                $inWishlist = $wm->isSaved($user_id, $p['product_id']);
                            } else {
                                $sw = session()->get('wishlist') ?? [];
                                $inWishlist = isset($sw[$p['product_id']]);
                            }
                        ?>
                            <div class="d-flex gap-2 mt-2">
                                <a href="/customer/cart/add/<?= $p['product_id'] ?>" class="btn btn-danger w-100">Tambah ke Keranjang</a>

                                <a href="/customer/wishlist/toggle/<?= $p['product_id'] ?>" 
                                    class="btn <?= $inWishlist ? 'btn-warning' : 'btn-outline-warning' ?> ms-1"
                                    title="<?= $inWishlist ? 'Hapus dari Wishlist' : 'Simpan ke Wishlist' ?>">
                                    <i class="bi bi-heart<?= $inWishlist ? '-fill' : '' ?>">wishlist</i>
                                </a>
                            </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
</body>
</html>
