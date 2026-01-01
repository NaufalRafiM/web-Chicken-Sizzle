<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = [
        'username', 'email', 'password', 'full_name', 'phone', 'address', 'role','profile_image','notify_email','notify_sms'
    ];

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}
