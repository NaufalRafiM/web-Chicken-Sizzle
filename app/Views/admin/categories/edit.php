<!DOCTYPE html>
<html>
<head>
     <link rel="icon" type="image/svg+xml" href="assets/cs.png" />
    <title>Edit Kategori - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container">
    <h2 class="mb-4 text-center">Edit Kategori</h2>

    <form action="/admin/categories/update/<?= $category['category_id'] ?>" method="post">
        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="category_name" class="form-control" value="<?= esc($category['category_name']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3"><?= esc($category['description']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/admin/categories" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
