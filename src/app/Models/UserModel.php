<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'users';
    protected $allowedFields = ['user_name','email', 'password'];
    public function getUser($email=null){
        if ($email)
            return $this->where(['email' => $email])->first();
        else
            return null;
    }
    public function getUserList(){
        return $this->select(['id','user_name'])->findAll();
    }
}
