<?php

namespace Models\User;

use Illuminate\Database\Capsule\Manager as DB;
use Utils;
use Utils\Session;

class Settings
{
    public $rowCount;
    public $res;
    public $errors = [];

    public function __construct($user)
    {
        $this->data = new Utils\Data;
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
