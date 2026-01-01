<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <link rel="icon" type="image/svg+xml" href="assets/cs.png"/>
  <title>Invoice - <?= esc($tx['invoice_number']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">
<div class="container">
  <h3>Invoice: <?= esc($tx['invoice_number']) ?></h3>
  <p>Status: <strong><?= esc($tx['status']) ?></strong></p>

  <h5>Detail</h5>
  <ul>
    <?php foreach ($details as $d): ?>
      <li><?= esc($d['product_name']) ?> x<?= $d['quantity'] ?> — Rp <?= number_format($d['subtotal'],0,',','.') ?></li>
    <?php endforeach; ?>
  </ul>

  <p><strong>Shipping:</strong> <?= ucfirst($tx['shipping_method']) ?> — Rp <?= number_format($tx['shipping_cost'],0,',','.') ?></p>
  <p><strong>Total:</strong> Rp <?= number_format($tx['total_amount'],0,',','.') ?></p>

  <?php if ($payment && in_array($payment['payment_method'], ['transfer','ewallet'])): ?>
    <h5 class="mt-4">Unggah Bukti Pembayaran</h5>
    <form action="/customer/payment/uploadProof/<?= $payment['payment_id'] ?>" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <input type="file" name="proof_image" class="form-control" accept="image/*" required>
      </div>
      <button class="btn btn-primary">Unggah & Kirim</button>
    </form>
  <?php else: ?>
    <div class="alert alert-info">Tidak diperlukan upload bukti untuk metode ini.</div>
  <?php endif; ?>

  <a href="/customer/orders" class="btn btn-secondary mt-3">Ke Riwayat Pesanan</a>
</div>
</body>
</html>
