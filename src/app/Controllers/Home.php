<?php

namespace App\Controllers;
use CodeIgniter\Exceptions\PageNotFoundException;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
}