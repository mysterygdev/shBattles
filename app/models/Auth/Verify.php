<?php

namespace App\Models\Auth;

use Illuminate\Database\Capsule\Manager as DB;

class Verify
{
    public function __construct($user, $session)
    {
        $this->data = new \Classes\Utils\Data;
        $this->session = $session;
        $this->user = $user;
    }

    public function getActivationData($key)
    {
        $res = DB::table(table('webPresence'))
            ->select('UserID', 'ActivationKey', 'Verified')
            ->where('ActivationKey', $key)
            ->first();
        return $res;
    }

    public function getUserStatus($user)
    {
        $res = DB::table(table('shUserData'))
            ->where('UserID', $user)
            ->value('Status');
        return $res;
    }

    public function ifIsVerified($user = null)
    {
        $res = DB::table(table('webPresence'))
            ->where('UserID', $user)
            ->value('Verified');
        return $res;
    }

    public function verifyKey($recoveryKey)
    {
        //
    }

    public function updateUserStatus($user, $status)
    {
        $update = DB::table(table('shUserData'))
            ->where('UserID', $user)
            ->update(['Status' => $status]);
        if ($update) {
            return true;
        } else {
            return false;
        }
    }

    public function updateVerified($user, $verified)
    {
        $update = DB::table(table('webPresence'))
            ->where('UserID', $user)
            ->update(['Verified' => $verified]);
        if ($update) {
            return true;
        } else {
            return false;
        }
    }
}
