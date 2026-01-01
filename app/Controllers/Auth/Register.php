<?php
namespace App\Controllers\Auth;
use App\Controllers\BaseController;
use App\Models\UserModel;

class Register extends BaseController
{
    public function index()
    {
        return view('auth/register');
    }

    public function store()
    {
        $model = new UserModel();

        $data = [
            'username'  => $this->request->getPost('username'),
            'email'     => $this->request->getPost('email'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'full_name' => $this->request->getPost('full_name'),
            'phone'     => $this->request->getPost('phone'),
            'role'      => 'customer'
        ];

        $model->insert($data);
        return redirect()->to('/login')->with('success', 'Registrasi berhasil, silakan login!');
    }
}
