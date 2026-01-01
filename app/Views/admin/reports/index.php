<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="assets/cs.png" />
  <title>Laporan Keuangan - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            transition: 0.3s;
            border: none;
            border-radius: 12px;
        }
        .card:hover {
            transform: scale(1.04);
            box-shadow: 0px 5px 15px rgba(0,0,0,0.1);
        }
        .icon {
            font-size: 2rem;
            color: #dc3545;
        }
         .navbar-nav .nav-link {
     color: #fff !important;
     transition: 0.3s;
 }
        .navbar {
            background-color: #dc3545 !important;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .navbar .dropdown-menu {
    background-color: #fff;
    border: none;
}
        .navbar .dropdown-item:hover {
    background-color: rgb(220 53 69);
    color: #fff;
}
         .navbar-nav .nav-link:hover {
     color: #ffeb3b !important;
     transform: scale(1.05);
 }
    </style>
</head>
<body class="bg-light">

<!-- 🔴 Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
         <a class="navbar-brand fw-bold d-flex align-items-center" href="/">
     <img src="<?= base_url('assets/cs.png') ?>" alt="ChickenSizzle Logo"
         style="width:50px;height:50px;object-fit:cover;" class="me-2">
     ChickenSizzle Admin
 </a>
 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
     <span class="navbar-toggler-icon"></span>
 </button>

    <div class="collapse navbar-collapse" id="navbarAdmin">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a href="/admin/dashboard" class="nav-link">Dashboard</a></li>
        <li class="nav-item"><a href="/admin/products" class="nav-link">Produk</a></li>
        <li class="nav-item"><a href="/admin/categories" class="nav-link">Kategori</a></li>
        <li class="nav-item"><a href="/admin/orders" class="nav-link">Pesanan</a></li>
        <li class="nav-item"><a href="/admin/payments" class="nav-link">Pembayaran</a></li>
        <li class="nav-item"><a href="/admin/reports" class="nav-link">Laporan</a></li>
        <li class="nav-item"><a href="/admin/inventory" class="nav-link">Bahan Baku</a></li>
        <li class="nav-item"><a href="/logout" class="btn btn-light btn-sm ms-2">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container p-4">
  <h2 class="text-center mb-4">📊 Laporan Keuangan ChickenSizzle</h2>

  <div class="row text-center mb-4">
    <div class="col-md-4">
      <div class="card p-4 bg-success text-light">
        <h5>Pemasukan</h5>
        <h3>Rp <?= number_format($income, 0, ',', '.') ?></h3>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-4 bg-danger text-light">
        <h5>Pengeluaran</h5>
        <h3>Rp <?= number_format($expense, 0, ',', '.') ?></h3>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-4 bg-warning text-dark">
        <h5>Keuntungan Bersih</h5>
        <h3>Rp <?= number_format($profit, 0, ',', '.') ?></h3>
      </div>
    </div>
  </div>

  <form method="get" class="row mb-4">
  <div class="col-md-4">
    <label for="start_date" class="form-label">Dari Tanggal:</label>
    <input type="date" name="start_date" class="form-control" value="<?= esc($start) ?>">
  </div>
  <div class="col-md-4">
    <label for="end_date" class="form-label">Sampai Tanggal:</label>
    <input type="date" name="end_date" class="form-control" value="<?= esc($end) ?>">
  </div>
  <div class="col-md-4 d-flex align-items-end">
    <button type="submit" class="btn btn-danger w-100">Filter 🔍</button>
  </div>
</form>

<div class="text-end mb-3">
  <a href="/admin/reports/exportPdf" class="btn btn-outline-danger me-2">
    <i class="bi bi-file-earmark-pdf"></i> Download PDF
  </a>
  <a href="/admin/reports/exportExcel" class="btn btn-outline-success">
    <i class="bi bi-file-earmark-excel"></i> Download Excel
  </a>
</div>


  <!-- Grafik Transaksi -->
  <div class="card shadow-sm p-4">
    <h5 class="text-center mb-4">Grafik Pemasukan per Hari</h5>
    <canvas id="incomeChart" height="100"></canvas>
  </div>

  <div class="text-center mt-4">
    <a href="/admin/dashboard" class="btn btn-secondary">⬅ Kembali ke Dashboard</a>
  </div>
</div>

<script>
const ctx = document.getElementById('incomeChart');
const chartData = <?= json_encode($chartData) ?>;

new Chart(ctx, {
    type: 'line',
    data: {
        labels: chartData.map(d => d.tgl),
        datasets: [{
            label: 'Pemasukan (Rp)',
            data: chartData.map(d => d.total),
            borderColor: '#dc3545',
            borderWidth: 2,
            fill: false,
            tension: 0.3
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true }
        },
        plugins: {
            legend: { display: true },
            tooltip: { enabled: true }
        }
    }
});
</script>
</body>
</html>
