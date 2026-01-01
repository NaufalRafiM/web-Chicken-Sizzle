<!DOCTYPE html>
<html>
<head>
    <title>Checkout - ChickenSizzle</title>
    <link rel="icon" type="image/svg+xml" href="assets/cs.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="text-center mb-4">Checkout 🧾</h2>

    <form action="/customer/payment/process" method="post" class="shadow p-4 bg-white rounded">
        <h5>Alamat Pengiriman</h5>
        <textarea name="address" class="form-control mb-3" required><?= session()->get('address') ?? '' ?></textarea>

        <h5>Ringkasan Pesanan</h5>
        <ul class="list-group mb-3">
            <?php $total = 0; foreach ($cart as $item): $subtotal = $item['price'] * $item['qty']; $total += $subtotal; ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span><?= esc($item['name']) ?> x<?= $item['qty'] ?></span>
                    <strong>Rp <?= number_format($subtotal, 0, ',', '.') ?></strong>
                </li>
            <?php endforeach; ?>
        </ul>
        <h5 class="text-end mb-3">Total: Rp <?= number_format($total, 0, ',', '.') ?></h5>

        <button type="submit" class="btn btn-danger w-100">Buat Pesanan 🔥</button>
    </form>
</div>
</body>
</html>
