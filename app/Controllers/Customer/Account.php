<?php
namespace App\Controllers\Customer;
use App\Controllers\BaseController;
use App\Models\UserModel;

class Account extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    protected function protect()
    {
        if (!session()->get('isLoggedIn')) {
            session()->set('redirect_after_login', current_url());
            return redirect()->to('/login')->with('error','Silakan login dulu.');
        }
    }

    public function profile()
    {
        if (!session()->get('isLoggedIn')) return redirect()->to('/login');
        $user = $this->userModel->find(session()->get('user_id'));
        return view('customer/account/profile', ['user' => $user]);
    }

    public function updateProfile()
    {
        if (!session()->get('isLoggedIn')) return redirect()->to('/login');

        $id = session()->get('user_id');
        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'phone'     => $this->request->getPost('phone'),
            'address'   => $this->request->getPost('address'),
        ];

        // handle profile image upload (optional)
        $file = $this->request->getFile('profile_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // basic validation
            if (! in_array($file->getMimeType(), ['image/jpeg','image/png','image/webp'])) {
                return redirect()->back()->with('error','Format gambar tidak didukung (jpg/png/webp).')->withInput();
            }
            if ($file->getSize() > 2 * 1024 * 1024) { // 2MB
                return redirect()->back()->with('error','Ukuran gambar maksimal 2MB.')->withInput();
            }

            $newName = $file->getRandomName();
            $file->move(FCPATH . 'assets/image_user', $newName);
            $data['profile_image'] = $newName;

            // hapus file lama jika ada
            $user = $this->userModel->find($id);
            if (!empty($user['profile_image']) && file_exists(WRITEPATH.'uploads/'.$user['profile_image'])) {
                @unlink(WRITEPATH.'uploads/'.$user['profile_image']);
            }
        }

        $this->userModel->update($id, $data);

        // update session values
        session()->set('username', $data['full_name']);
        return redirect()->to('/customer/account/profile')->with('success','Profil berhasil diperbarui!');
    }

    public function changePassword()
    {
        if (!session()->get('isLoggedIn')) return redirect()->to('/login');
        return view('customer/account/change_password');
    }

    public function updatePassword()
    {
        if (!session()->get('isLoggedIn')) return redirect()->to('/login');

        $id = session()->get('user_id');
        $old = $this->request->getPost('old_password');
        $new = $this->request->getPost('new_password');
        $confirm = $this->request->getPost('confirm_password');

        if ($new !== $confirm) return redirect()->back()->with('error','Konfirmasi password tidak cocok.');

        $user = $this->userModel->find($id);
        if (!$user || !password_verify($old, $user['password'])) {
            return redirect()->back()->with('error','Password lama salah.');
        }

        $this->userModel->update($id, [
            'password' => password_hash($new, PASSWORD_BCRYPT)
        ]);

        return redirect()->to('/customer/account/change-password')->with('success','Password berhasil diubah!');
    }

    public function notifications()
    {
        if (!session()->get('isLoggedIn')) return redirect()->to('/login');
        $user = $this->userModel->find(session()->get('user_id'));
        return view('customer/account/notifications', ['user' => $user]);
    }

    public function updateNotifications()
    {
        if (!session()->get('isLoggedIn')) return redirect()->to('/login');

        $id = session()->get('user_id');
        $notify_email = $this->request->getPost('notify_email') ? 1 : 0;
        $notify_sms = $this->request->getPost('notify_sms') ? 1 : 0;

        $this->userModel->update($id, [
            'notify_email' => $notify_email,
            'notify_sms' => $notify_sms
        ]);

        return redirect()->to('/customer/account/notifications')->with('success','Preferensi notifikasi tersimpan!');
    }
}
