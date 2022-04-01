<?php

namespace Controllers\Admin;

use Core\CoreController;
use Models;
use Utils;

class Auth extends CoreController
{
    public function __construct()
    {
        $this->auth = new Utils\Auth;
        $this->user = new Utils\User;
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
