<?php
namespace App\Controllers\Auth;
use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function process()
    {
        $session = session();
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'user_id'   => $user['user_id'],
                'username'  => $user['username'],
                'email'     => $user['email'],
                'role'      => $user['role'],
                'isLoggedIn'=> true
            ]);

            // Redirect berdasarkan role
            return ($user['role'] === 'admin') 
                ? redirect()->to('/admin/dashboard')
                : redirect()->to('/customer/home');
        }

        return redirect()->back()->with('error', 'Email atau password salah!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
