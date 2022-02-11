<?php

namespace App\Controllers\Admin;

use Framework\Core\CoreController as Controller;
use App\Models;
use Classes\Utils;

class Auth extends Controller
{
    public function __construct()
    {
        $this->session = new Utils\Session;
        $this->auth = new Utils\Auth($this->session);
        $this->data = new Utils\Data;
        $this->user = new Utils\User($this->session);
    }

    public function login()
    {
        $logIn = $this->model(Models\Admin\Auth\LogIn::class);

        $data = [
            'user' => $this->user,
            'login' => $logIn
        ];

        $this->view('pages/ap/auth/login', $data);
    }

    public function logout()
    {
        $this->auth->logout();
    }

    public function signup()
    {
        $signUp = $this->model(Models\Admin\Auth\SignUp::class);

        $data = [
            'user' => $this->user,
            'select' => $this->select,
            'sign' => $signUp
        ];

        $this->view('pages/ap/auth/signup', $data);
    }
}
