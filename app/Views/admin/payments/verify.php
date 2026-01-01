<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Pembayaran - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">
<div class="container">
    <h2 class="mb-4 text-center">Verifikasi Pembayaran 💳</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5>Invoice: <?= esc($payment['invoice_number']) ?></h5>
            <p><strong>Nama Pelanggan:</strong> <?= esc($payment['full_name']) ?></p>
            <p><strong>Email:</strong> <?= esc($payment['email']) ?></p>
            <p><strong>No. Telp:</strong> <?= esc($payment['phone']) ?></p>
            <p><strong>Jumlah:</strong> Rp <?= number_format($payment['amount'], 0, ',', '.') ?></p>
            <p><strong>Metode Pembayaran:</strong> <?= ucfirst($payment['payment_method']) ?></p>

            <?php if ($payment['proof_image']): ?>
                <p><strong>Bukti Pembayaran:</strong></p>
                <img src="/uploads/<?= esc($payment['proof_image']) ?>" class="img-fluid rounded" alt="Bukti Pembayaran" style="max-height:300px;">
            <?php else: ?>
                <p class="text-muted">Belum ada bukti pembayaran.</p>
            <?php endif; ?>
        </div>
    </div>

    <form action="/admin/payments/processVerification/<?= $payment['payment_id'] ?>" method="post">
        <div class="mb-3">
            <label for="status" class="form-label">Status Verifikasi</label>
            <select name="status" class="form-select" required>
                <option value="pending" <?= $payment['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="verified" <?= $payment['status'] == 'verified' ? 'selected' : '' ?>>Verified</option>
                <option value="rejected" <?= $payment['status'] == 'rejected' ? 'selected' : '' ?>>Rejected</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Catatan Admin</label>
            <textarea name="notes" class="form-control" rows="3"><?= esc($payment['notes']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-success w-100">Simpan Verifikasi</button>
        <a href="/admin/payments" class="btn btn-secondary w-100 mt-2">Kembali</a>
    </form>
</div>
</body>
</html>
