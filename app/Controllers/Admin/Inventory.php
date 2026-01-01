<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\IngredientModel;
use App\Models\IngredientStockModel;

class Inventory extends BaseController
{
    public function index()
    {
        $ingredientModel = new IngredientModel();
        $data['ingredients'] = $ingredientModel->findAll();
        $data['lowStock'] = $ingredientModel->getLowStock();
        return view('admin/inventory/index', $data);
    }

    // Method baru untuk tambah bahan baku
    public function addIngredient()
{
    $ingredientModel = new IngredientModel();
    $stockModel = new IngredientStockModel();

    if ($this->request->getMethod() === 'post') {

        $rules = [
            'ingredient_name' => 'required|min_length[3]',
            'unit'            => 'required',
            'current_stock'   => 'required|numeric',
            'minimum_stock'   => 'required|numeric',
            'price_per_unit'  => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return view('admin/inventory/add', [
                'validation' => $this->validator
            ]);
        }

        // 1️⃣ Simpan bahan baku (MASTER)
        $ingredientData = [
            'ingredient_name' => $this->request->getPost('ingredient_name'),
            'unit'            => $this->request->getPost('unit'),
            'current_stock'   => $this->request->getPost('current_stock'),
            'minimum_stock'   => $this->request->getPost('minimum_stock'),
            'price_per_unit'  => $this->request->getPost('price_per_unit'),
            'status'          => 'active'
        ];

        $ingredientId = $ingredientModel->insert($ingredientData);

        // 2️⃣ Catat stok awal (HISTORY)
        $stokAwal = (int) $this->request->getPost('current_stock');

        if ($stokAwal > 0) {
            $stockModel->insert([
                'ingredient_id' => $ingredientId,
                'quantity'      => $stokAwal,
                'type'          => 'in',
                'note'          => 'Stok awal bahan baku'
            ]);
        }

        return redirect()->to('/admin/inventory')
            ->with('success', 'Bahan baku baru berhasil ditambahkan!');
    }

    return view('admin/inventory/add');
}


    public function form($id = null)
    {
        $ingredientModel = new IngredientModel();

        if ($this->request->getMethod() === 'post') {
            $data = [
                'ingredient_name' => $this->request->getPost('ingredient_name'),
                'unit' => $this->request->getPost('unit'),
                'current_stock' => $this->request->getPost('current_stock'),
                'minimum_stock' => $this->request->getPost('minimum_stock'),
                'price_per_unit' => $this->request->getPost('price_per_unit'),
                'status' => 'active'
            ];

            if ($id) {
                $ingredientModel->update($id, $data);
                $msg = 'Data bahan berhasil diperbarui!';
            } else {
                $ingredientModel->insert($data);
                $msg = 'Bahan baru berhasil ditambahkan!';
            }

            return redirect()->to('/admin/inventory')->with('success', $msg);
        }

        $data['ingredient'] = $id ? $ingredientModel->find($id) : null;
        return view('admin/inventory/form', $data);
    }

    public function delete($id)
    {
        $ingredientModel = new IngredientModel();
        $ingredientModel->delete($id);
        return redirect()->to('/admin/inventory')->with('success', 'Bahan berhasil dihapus!');
    }

    public function history($id)
    {
        $stockModel = new IngredientStockModel();
        $data['history'] = $stockModel->getHistory($id);
        return view('admin/inventory/history', $data);
    }
}