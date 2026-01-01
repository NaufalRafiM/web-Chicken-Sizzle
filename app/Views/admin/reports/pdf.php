<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Laporan Keuangan ChickenSizzle</title>
  <style>
    body { font-family: DejaVu Sans; font-size: 12px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #444; padding: 8px; text-align: center; }
    th { background: #f2f2f2; }
  </style>
</head>
<body>
  <h2 style="text-align:center;">Laporan Keuangan ChickenSizzle</h2>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Invoice</th>
        <th>Total (Rp)</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php $no=1; foreach ($transactions as $t): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= date('d-m-Y', strtotime($t['transaction_date'])) ?></td>
          <td><?= esc($t['invoice_number']) ?></td>
          <td><?= number_format($t['total_amount'], 0, ',', '.') ?></td>
          <td><?= ucfirst($t['status']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <p style="margin-top:30px;text-align:right;">Dicetak pada: <?= date('d-m-Y H:i') ?></p>
</body>
</html>
