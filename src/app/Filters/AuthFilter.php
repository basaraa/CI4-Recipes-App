<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface{

    public function before(RequestInterface $request, $arguments = null){
        if (!session()->get('isLoggedIn')) {
            helper(['form']);
            $data = ['title' => "Your are not logged in yet",'error'=>''];
            return view('partials/header', $data)
                . view('users/login')
                . view('partials/footer');
        }
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){

    }
}