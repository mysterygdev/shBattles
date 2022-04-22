<?php

namespace Utils;

class Auth
{

    // similar to laravels auth class
    public function check()
    {
        // Check if user is logged in
        if (Session::has('User')) {
            return true;
        }
    }

    public function guest()
    {
        // Check if user is not logged in
        if (!Session::has('User')) {
            return true;
        }
    }

    public function attempt($credentials)
    {
        // Authentication passed
    }

    public function login($user, $remember = false)
    {
        // Log user in
    }

    public function loginUsingId($user, $remember = false)
    {
        // Log user in using their primary id
    }

    public function logout(): void
    {
        $user = new User;
        // Log user out
        if (Session::has('User')) {
            $user->updateLoginStatus(0);
            Session::regenerate();
            Session::forget('User');
            //$referrer = $_SERVER['HTTP_REFERER'];
            redirect(Session::getReferer());
        }
    }

    public function viaRemember()
    {
        // was authenticated from remember me cookie
    }

    public function get()
    {
        return get_class_methods(get_called_class());
    }
}
