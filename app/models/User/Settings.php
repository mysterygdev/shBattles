<?php

namespace App\Models\User;

use Illuminate\Database\Capsule\Manager as DB;

class Settings
{
    public $rowCount;
    public $res;
    public $errors = [];

    public function __construct($user, $session)
    {
        $this->data = new \Classes\Utils\Data;
        $this->session = $session;
        $this->user = $user;
    }

    public function getData()
    {
        $res = DB::table(table('shCharData') . ' as c')
            ->select()
            ->join(table('shUserData') . ' as  um', 'um.UserUID', '=', 'c.UserUID')
            ->where('c.UserUID', $this->user->UserUID)
            ->where('c.Del', 0)
            ->get();
        return $res;
    }
}
