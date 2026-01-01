<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container">
    <h2 class="mb-4 text-center">Edit Produk</h2>

    <form action="/admin/products/update/<?= $product['product_id'] ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="category_id" class="form-select" required>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['category_id'] ?>" <?= $cat['category_id'] == $product['category_id'] ? 'selected' : '' ?>>
                        <?= esc($cat['category_name']) ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="product_name" class="form-control" value="<?= esc($product['product_name']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3"><?= esc($product['description']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga (Rp)</label>
            <input type="number" name="price" class="form-control" value="<?= $product['price'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" name="stock" class="form-control" value="<?= $product['stock'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">gambar baru</label>
            <input type="file" name="image" class="form-control">
            
            <!-- preview gambar lama -->
            <label class="form-label">gambar lama</label>
            <img src="/assets/produk/<?= $product['image'] ?>" width="120">
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="active" <?= $product['status'] == 'active' ? 'selected' : '' ?>>Aktif</option>
                <option value="inactive" <?= $product['status'] == 'inactive' ? 'selected' : '' ?>>Nonaktif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/admin/products" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
