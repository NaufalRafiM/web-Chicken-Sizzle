<!DOCTYPE html>
<html>

<head>
    <title>Form Bahan Baku - ChickenSizzle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light p-5">
    <div class="container">
        <h2 class="text-center mb-4"><?= isset($ingredient) ? 'Edit' : 'Tambah' ?> Bahan Baku</h2>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Nama Bahan</label>
                <input type="text" name="ingredient_name" class="form-control"
                    value="<?= esc($ingredient['ingredient_name'] ?? '') ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Satuan</label>
                <input type="text" name="unit" class="form-control" value="<?= esc($ingredient['unit'] ?? '') ?>"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Stok Sekarang</label>
                <input type="number" name="current_stock" class="form-control"
                    value="<?= esc($ingredient['current_stock'] ?? 0) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Stok Minimum</label>
                <input type="number" name="minimum_stock" class="form-control"
                    value="<?= esc($ingredient['minimum_stock'] ?? 0) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Harga per Unit</label>
                <input type="number" name="price_per_unit" class="form-control"
                    value="<?= esc($ingredient['price_per_unit'] ?? 0) ?>">
            </div>

            <button type="submit" class="btn btn-danger w-100">Simpan</button>
            <a href="/admin/inventory" class="btn btn-secondary w-100 mt-2">Kembali</a>
        </form>
    </div>
</body>

</html>