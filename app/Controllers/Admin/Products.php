<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class Products extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $data['products'] = $productModel->getAllWithCategory();
        return view('admin/products/index', $data);
    }

    public function create()
    {
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->findAll();
        return view('admin/products/create', $data);
    }

    public function store()
{
    $productModel = new ProductModel();

    // Ambil file gambar
    $image = $this->request->getFile('image');

    $imageName = null;

    if ($image && $image->isValid() && !$image->hasMoved()) {
        // Bikin nama unik biar ga tabrakan
        $imageName = $image->getRandomName();

        // Pindahkan file ke folder public/assets/produk/
        $image->move('assets/produk', $imageName);
    }

    // Simpan data ke database
    $productModel->save([
        'category_id'   => $this->request->getPost('category_id'),
        'product_name'  => $this->request->getPost('product_name'),
        'description'   => $this->request->getPost('description'),
        'price'         => $this->request->getPost('price'),
        'stock'         => $this->request->getPost('stock'),
        'status'        => 'active',

        // Tambahkan path gambar
        'image'         => $imageName
    ]);

    return redirect()->to('/admin/products')->with('success', 'Produk berhasil ditambahkan!');
}


    public function edit($id)
    {
        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();
        $data['product'] = $productModel->find($id);
        $data['categories'] = $categoryModel->findAll();
        return view('admin/products/edit', $data);
    }

    public function update($id)
{
    $productModel = new ProductModel();
    $product = $productModel->find($id);

    if (!$product) {
        return redirect()->back()->with('error', 'Produk tidak ditemukan.');
    }

    // Ambil file gambar baru
    $image = $this->request->getFile('image');
    $imageName = $product['image']; // default: gambar lama

    // Jika user upload gambar baru
    if ($image && $image->isValid() && !$image->hasMoved()) {
        // Generate nama baru
        $newImageName = $image->getRandomName();

        // Simpan file baru
        $image->move('assets/produk', $newImageName);

        // Hapus file lama (jika ada)
        if (!empty($product['image']) && file_exists('assets/produk/' . $product['image'])) {
            unlink('assets/produk/' . $product['image']);
        }

        $imageName = $newImageName;
    }

    // Update semua data + gambar
    $productModel->update($id, [
        'category_id'   => $this->request->getPost('category_id'),
        'product_name'  => $this->request->getPost('product_name'),
        'description'   => $this->request->getPost('description'),
        'price'         => $this->request->getPost('price'),
        'stock'         => $this->request->getPost('stock'),
        'status'        => $this->request->getPost('status'),
        'image'         => $imageName
    ]);

    return redirect()->to('/admin/products')->with('success', 'Produk berhasil diperbarui!');
}


    public function delete($id)
{
    $productModel = new ProductModel();

    // Cari produk dulu
    $product = $productModel->find($id);

    if (!$product) {
        return redirect()->back()->with('error', 'Produk tidak ditemukan.');
    }

    // Hapus gambar kalau ada
    if (!empty($product['image']) && file_exists('assets/produk/' . $product['image'])) {
        unlink('assets/produk/' . $product['image']);
    }

    // Hapus data dari database
    $productModel->delete($id);

    return redirect()->to('/admin/products')->with('success', 'Produk berhasil dihapus!');
}


}
