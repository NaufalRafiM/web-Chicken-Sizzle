<!DOCTYPE html>
<html>
<head>
    <title>Keranjang - ChickenSizzle</title>
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
<div class="container py-5">
    <h2 class="mb-4 text-center">Keranjang Belanja 🛒</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (!empty($cart)): ?>
        <table class="table table-bordered text-center">
            <thead class="table-danger">
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php foreach ($cart as $item): 
                    $subtotal = $item['price'] * $item['qty'];
                    $total += $subtotal;
                ?>
                <tr>
                    <td><?= esc($item['name']) ?></td>
                    <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                    <td><?= $item['qty'] ?></td>
                    <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                    <td><a href="/customer/cart/remove/<?= $item['id'] ?>" class="btn btn-danger btn-sm">Hapus</a></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <h4 class="text-end mt-3">Total: <span class="text-danger fw-bold">Rp <?= number_format($total, 0, ',', '.') ?></span></h4>

        <div class="text-end mt-3">
            <a href="/customer/cart/clear" class="btn btn-secondary">Kosongkan</a>
            <a href="/customer/payment" class="btn btn-danger">Lanjut Checkout</a>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">Keranjang masih kosong 😅</div>
    <?php endif; ?>
</div>
</body>
</html>
