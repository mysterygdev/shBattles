<?php

namespace App\Models\User;

use Illuminate\Database\Capsule\Manager as DB;

class ShareDP
{
    public function __construct($session)
    {
        $this->data = new \Classes\Utils\Data;
        $this->session = $session;
    }

    public function getSenderDp()
    {
        $res = DB::table(table('shUserData'))
            ->where('UserID', $_SESSION['User']['UserID'])
            ->value('Point');
        return $res;
    }

    public function getReceiverDp($receiver)
    {
        //
        $res = DB::table(table('shUserData'))
            ->where('UserID', $receiver)
            ->value('Point');
        return $res;
    }

    public function getReceiver($char)
    {
        // get receiver user id by char name
        $res = DB::table(table('shCharData'))
            ->where('CharName', $char)
            ->value('UserID');
        return $res;
    }

    public function sendDp($rp, $dp, $user)
    {
        // send dp to said player, take away dp from sender
        $senderOp = $this->getSenderDp();
        $senderNp = $senderOp - $dp;
        $receiverOp = $rp;
        $receiverNp = $rp + $dp;

        // Update Sender's points
        $update = DB::table(table('shUserData'))
        ->where('UserID', $_SESSION['User']['UserID'])
        ->update(['Point' => $senderNp]);

        // Update Receiver's points
        $update2 = DB::table(table('shUserData'))
        ->where('UserID', $user)
        ->update(['Point' => $receiverNp]);

        if ($update && $update2) {
            return true;
        } else {
            return false;
        }
    }
}
