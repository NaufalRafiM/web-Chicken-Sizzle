<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Bahan Baku</title>
    <style>
    body {
        font-family: Arial, sans-serif;
    }

    .form-group {
        margin-bottom: 12px;
    }

    label {
        display: block;
        margin-bottom: 4px;
    }

    input {
        width: 100%;
        padding: 8px;
    }

    .error {
        color: red;
        font-size: 13px;
    }

    button {
        padding: 8px 16px;
    }
    </style>
</head>

<body>


    <h2>Tambah Bahan Baku Baru</h2>


    <?php if (isset($validation)) : ?>
    <div class="error">
        <?= $validation->listErrors(); ?>
    </div>
    <?php endif; ?>


    <form method="post" action="admin/inventory/add">


        <div class="form-group">
            <label>Nama Bahan</label>
            <input type="text" name="ingredient_name" value="<?= old('ingredient_name'); ?>" required>
        </div>


        <div class="form-group">
            <label>Satuan</label>
            <input type="text" name="unit" value="<?= old('unit'); ?>" placeholder="kg / pcs / liter" required>
        </div>


        <div class="form-group">
            <label>Stok Awal</label>
            <input type="number" name="current_stock" value="<?= old('current_stock', 0); ?>" min="0" required>
        </div>


        <div class="form-group">
            <label>Stok Minimum</label>
            <input type="number" name="minimum_stock" value="<?= old('minimum_stock'); ?>" min="0" required>
        </div>


        <div class="form-group">
            <label>Harga per Satuan</label>
            <input type="number" name="price_per_unit" value="<?= old('price_per_unit'); ?>" min="0" required>
        </div>


        <button type="submit">Simpan Bahan</button>
        <a href="<?= base_url('admin/inventory'); ?>">Batal</a>


    </form>


</body>

</html>