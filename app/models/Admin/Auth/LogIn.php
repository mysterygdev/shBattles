<?php

namespace Models\Admin\Auth;

use Illuminate\Database\Capsule\Manager as DB;
use Utils\{
    Data,
    Session,
    User
};

class LogIn
{
    private $messages = [];

    public function __construct()
    {
        $this->data = new Data;
        $this->user = new User;
    }

    public function getUserData()
    {
        $fet = DB::table(table('webPresence') . ' as Web')
            ->select(['[User].UserUID', 'Web.UserID', 'Web.Pw', 'Web.Email', '[User].Status', 'Web.RestrictIP'])
            ->join(table('shUserData') . ' as  [User]', '[User].UserID', '=', 'Web.UserID')
            ->where('Web.UserID', $this->getUser())
            ->orWhere('Web.Email', $this->getUser())
            ->get();
        return $fet;
    }

    public function login($userInfo)
    {
        if ($userInfo->Status == 0 || $userInfo->Status == 16 || $userInfo->Status == 32 || $userInfo->Status == 48 || $userInfo->Status == 64 || $userInfo->Status == 80 || $userInfo->Status == 128) {
            Session::put('User', $userInfo->UserUID, 'UserUID');
            Session::put('User', $userInfo->UserID, 'UserID');
            Session::put('User', $userInfo->Status, 'Status');
            $this->user->updateLoginStatus(1);
            $this->messages[] .= 'Login successful.<br>Loading your homepage now...';
            redirect('/admin', 3);
        } else {
            $this->messages[] .= '6';
        }
    }

    public function getUser()
    {
        return isset($_POST['user']) ? $this->data->purify(trim($_POST['user'])) : false;
    }

    public function getPassword()
    {
        return isset($_POST['password']) ? $this->data->purify(trim($_POST['password'])) : false;
    }

    public function addMessage($message)
    {
        $this->messages[] .= $message;
    }

    public function getMessages()
    {
        return $this->messages;
    }
}
