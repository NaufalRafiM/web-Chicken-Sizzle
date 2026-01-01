<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Categories extends BaseController
{
    public function index()
    {
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->orderBy('category_id', 'DESC')->findAll();
        return view('admin/categories/index', $data);
    }

    public function create()
    {
        return view('admin/categories/create');
    }

    public function store()
    {
        $categoryModel = new CategoryModel();

        $categoryModel->save([
            'category_name' => $this->request->getPost('category_name'),
            'description'   => $this->request->getPost('description'),
        ]);

        return redirect()->to('/admin/categories')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $categoryModel = new CategoryModel();
        $data['category'] = $categoryModel->find($id);
        return view('admin/categories/edit', $data);
    }

    public function update($id)
    {
        $categoryModel = new CategoryModel();

        $categoryModel->update($id, [
            'category_name' => $this->request->getPost('category_name'),
            'description'   => $this->request->getPost('description'),
        ]);

        return redirect()->to('/admin/categories')->with('success', 'Kategori berhasil diupdate!');
    }

    public function delete($id)
    {
        $categoryModel = new CategoryModel();
        $categoryModel->delete($id);
        return redirect()->to('/admin/categories')->with('success', 'Kategori berhasil dihapus!');
    }
}
