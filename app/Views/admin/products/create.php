<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container">
    <h2 class="mb-4 text-center">Tambah Produk Baru</h2>

    <form action="/admin/products/store" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select name="category_id" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['category_id'] ?>"><?= esc($cat['category_name']) ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="product_name" class="form-label">Nama Produk</label>
            <input type="text" name="product_name" class="form-control" placeholder="Contoh: Chicken Sizzle Original" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3" placeholder="Tuliskan deskripsi produk..."></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga (Rp)</label>
            <input type="number" name="price" class="form-control" min="0" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stok Awal</label>
            <input type="number" name="stock" class="form-control" min="0" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">upload gambar</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/admin/products" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
