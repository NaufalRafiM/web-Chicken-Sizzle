<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/svg+xml" href="assets/cs.png" />
  <title>Detail Pesanan - <?= esc($order['invoice_number']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container">
  <h3>Detail Pesanan: <?= esc($order['invoice_number']) ?></h3>
  <p>Status: <strong><?= ucfirst($order['status']) ?></strong></p>
  <p>Tanggal: <?= date('d M Y H:i', strtotime($order['transaction_date'])) ?></p>

  <div class="card mb-3">
    <div class="card-body">
      <h5>Info Pengiriman</h5>
      <p><strong>Metode:</strong> <?= ucfirst($order['shipping_method'] ?? 'pickup') ?></p>
      <p><strong>Alamat:</strong><br><?= nl2br(esc($order['shipping_address'])) ?></p>
      <p><strong>Biaya Pengiriman:</strong> Rp <?= number_format($order['shipping_cost'] ?? 0,0,',','.') ?></p>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-body">
      <h5>Daftar Produk</h5>
      <table class="table table-bordered">
        <thead class="table-danger text-center">
          <tr>
            <th>Produk</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php $grand = 0; foreach ($details as $d): $grand += $d['subtotal']; ?>
            <tr>
              <td><?= esc($d['product_name']) ?></td>
              <td class="text-center"><?= $d['quantity'] ?></td>
              <td class="text-end">Rp <?= number_format($d['price'],0,',','.') ?></td>
              <td class="text-end">Rp <?= number_format($d['subtotal'],0,',','.') ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div class="text-end">
        <p>Subtotal Produk: <strong>Rp <?= number_format($grand,0,',','.') ?></strong></p>
        <p>Ongkir: <strong>Rp <?= number_format($order['shipping_cost'] ?? 0,0,',','.') ?></strong></p>
        <h5>Total: Rp <?= number_format($order['total_amount'],0,',','.') ?></h5>
      </div>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-body">
      <h5>Pembayaran</h5>
      <?php if ($payment): ?>
        <p><strong>Metode:</strong> <?= ucfirst($payment['payment_method']) ?></p>
        <p><strong>Jumlah:</strong> Rp <?= number_format($payment['amount'],0,',','.') ?></p>
        <p><strong>Status:</strong> <?= ucfirst($payment['status']) ?></p>

        <?php if (!empty($payment['proof_image'])): ?>
          <p><strong>Bukti Pembayaran:</strong></p>
          <img src="/uploads/<?= esc($payment['proof_image']) ?>" alt="bukti" class="img-fluid" style="max-height:300px;">
        <?php else: ?>
          <?php if (in_array($payment['payment_method'], ['transfer','ewallet']) && $payment['status'] == 'pending'): ?>
            <a href="/customer/payment/invoice/<?= $order['transaction_id'] ?>" class="btn btn-primary">Unggah Bukti Pembayaran</a>
          <?php else: ?>
            <p class="text-muted">Belum ada bukti pembayaran.</p>
          <?php endif; ?>
        <?php endif; ?>

      <?php else: ?>
        <p class="text-muted">Informasi pembayaran belum tersedia.</p>
      <?php endif; ?>
    </div>
  </div>

  <a href="/customer/orders" class="btn btn-secondary">Kembali</a>
</div>
</body>
</html>
