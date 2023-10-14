<?php

namespace App\Controllers;

use App\Models\RecipeModel;
use App\Models\UserModel;
class Users extends BaseController
{
    public function __construct(){
        helper(['form']);
    }
    public function index()
    {
        $data = ['title' => "User register"];
        return view('partials/header', $data)
            . view('users/register')
            . view('partials/footer');
    }

    public function register(){
        if (! $this->validate([
            'user_name' => 'min_length[4]|max_length[64]',
            'email' => 'required|min_length[4]|max_length[64]|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]|max_length[64]',
            'confirm_password'  => 'min_length[6]|max_length[64]|matches[password]'
        ])) {
            // The validation fails, so returns the form.
            return $this->index();
        }
        $model = new UserModel();
        $post = $this->validator->getValidated();
        $model->insert([
            'user_name' => $post['user_name'],
            'email' => $post['email'],
            'password'  => password_hash($post['password'], PASSWORD_DEFAULT)

        ]);
        $data = ['title' => "Registration was successful, you can login now"];
        return view('partials/header',$data)
            . view('users/login')
            . view('partials/footer');
    }
    public function loginForm(){
        $data = ['title' => "User login"];
        return view('partials/header', $data)
            . view('users/login')
            . view('partials/footer');
    }
    public function login(){
        $session = session();
        $userModel = new UserModel();
        if (! $this->validate([
            'email' => 'required|min_length[4]|max_length[64]|valid_email',
            'password' => 'required|min_length[6]|max_length[64]',
        ])) {
            // The validation fails, so returns the form.
            return $this->loginForm();
        }
        $post = $this->validator->getValidated();
        $email = $post['email'];
        $password = $post['password'];
        $user = $userModel->getUser($email);
        if(is_null($user)) {
            return redirect()->back()->withInput()->with('error', 'Invalid email.');
        }
        $pwd_verify = password_verify($password, $user['password']);
        if(!$pwd_verify) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        }
        $ses_data = [
            'id' => $user['id'],
            'email' => $user['email'],
            'isLoggedIn' => TRUE
        ];
        $session->set($ses_data);
        $data = ['title' => "Your recipes"];
        return redirect()->to(base_url('public/users/recipes/'. strval($user['id'])));
    }

    public function logout() {
        session_destroy();
        $data = ['title' => "Successful logout",'logReg'=>1];
        return view('partials/header', $data)
            . view('users/login')
            . view('partials/footer');
    }

    public function userList(){
        $userModel = new UserModel();
        $user=$userModel->getUserList();
        $data=[
            'user' => $user,
            'title' => "Používatelia"
        ];

        return view('partials/header', $data)
            . view('users/userList')
            . view('partials/footer');
    }
}
