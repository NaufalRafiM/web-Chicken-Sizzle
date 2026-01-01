<!DOCTYPE html>
<html>
<head>
  <title>Detail Pesanan - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">
<div class="container">
  <h2 class="mb-3">Detail Pesanan: <?= esc($order['invoice_number']) ?></h2>

  <p><strong>Pelanggan:</strong> <?= esc($order['user_id']) ?></p>
  <p><strong>Status:</strong> <span class="badge bg-info"><?= esc($order['status']) ?></span></p>
  <p><strong>Alamat Pengiriman:</strong><br><?= nl2br(esc($order['shipping_address'])) ?></p>
  <hr>

  <h5>📦 Daftar Barang</h5>
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
      <?php foreach ($details as $d): ?>
        <tr>
          <td><?= esc($d['product_name']) ?></td>
          <td><?= $d['quantity'] ?></td>
          <td>Rp <?= number_format($d['price'], 0, ',', '.') ?></td>
          <td>Rp <?= number_format($d['subtotal'], 0, ',', '.') ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <h4 class="text-end mt-3">Total: Rp <?= number_format($order['total_amount'], 0, ',', '.') ?></h4>
  <a href="/admin/orders" class="btn btn-secondary mt-3">Kembali</a>
</div>
</body>
</html>
