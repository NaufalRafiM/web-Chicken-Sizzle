<!DOCTYPE html>
<html>
<head>
     <link rel="icon" type="image/svg+xml" href="assets/cs.png" />
    <title>Tambah Kategori - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container">
    <h2 class="mb-4 text-center">Tambah Kategori Baru</h2>

    <form action="/admin/categories/store" method="post">
        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="category_name" class="form-control" placeholder="Contoh: Menu Ayam" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3" placeholder="Keterangan kategori..."></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/admin/categories" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
