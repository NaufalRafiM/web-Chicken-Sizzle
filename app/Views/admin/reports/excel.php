<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Keuangan (Preview) - ChickenSizzle</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    table {
      border-collapse: collapse;
      width: 100%;
      background: white;
    }
    th, td {
      border: 1px solid #dee2e6;
      padding: 8px;
      text-align: center;
    }
    th {
      background-color: #dc3545;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f8f9fa;
    }
  </style>
</head>
<body class="p-4">
  <div class="container">
    <h2 class="text-center mb-4">📊 Preview Laporan Keuangan ChickenSizzle</h2>

    <div class="text-end mb-3">
      <a href="/admin/reports/exportExcel" class="btn btn-success me-2">
        <i class="bi bi-file-earmark-excel"></i> Download Excel
      </a>
      <a href="/admin/reports/exportPdf" class="btn btn-danger">
        <i class="bi bi-file-earmark-pdf"></i> Download PDF
      </a>
    </div>

    <table class="table table-bordered table-hover align-middle">
      <thead>
        <tr>
          <th>No</th>
          <th>Tanggal Transaksi</th>
          <th>Invoice</th>
          <th>Total (Rp)</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($transactions)): ?>
          <?php $no=1; foreach ($transactions as $t): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= date('d-m-Y', strtotime($t['transaction_date'])) ?></td>
            <td><?= esc($t['invoice_number']) ?></td>
            <td>Rp <?= number_format($t['total_amount'], 0, ',', '.') ?></td>
            <td>
              <span class="badge 
                <?= $t['status'] == 'completed' ? 'bg-success' :
                   ($t['status'] == 'paid' ? 'bg-info' : 'bg-secondary') ?>">
                <?= ucfirst($t['status']) ?>
              </span>
            </td>
          </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5" class="text-center text-muted">Belum ada data transaksi.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>

    <div class="text-end mt-4">
      <a href="/admin/dashboard" class="btn btn-secondary">⬅ Kembali ke Dashboard</a>
    </div>
  </div>
</body>
</html>
