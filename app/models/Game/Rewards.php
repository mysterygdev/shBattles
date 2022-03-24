<?php

namespace App\Models\Game;

use Illuminate\Database\Capsule\Manager as DB;

class Rewards
{
    public $fet;
    public $row;
    public $rowCount;
    public $k1;

    public function __construct($user, $session)
    {
        $this->data = new \Classes\Utils\Data;
        $this->session = $session;
        $this->user = $user;
    }

    public function getPvPRewards()
    {
        $getKills = DB::table(table('shCharData'))
        ->where('UserUID', $this->user->UserUID)
        ->where('Del', 0)
        ->orderBy('K1', 'DESC')
        ->value('K1');
        $this->k1 = $getKills;
    }

    public function validateKills($id)
    {
        $res = DB::table(table('logPvpRewards'))
        ->select()
        ->where('UserUID', $this->user->UserUID)
        ->where('PrizeID', $id)
        ->get();
        //$this->rowCount = count($res);
        return $res;
    }

    public function getUserKills()
    {
        $res = DB::table(table('shCharData'))
            ->where('UserUID', $this->user->UserUID)
            ->where('Del', 0)
            ->orderBy('K1', 'DESC')
            ->value('K1');
        return $res;
    }

    public function getKillsReq($id)
    {
        /* if (array_key_exists('K' . $id, $this->Rewards)) {
            return true;
        } else {
            return false;
        } */
        $res = DB::table(table('pvpRewards'))
            ->where('RewardID', $id)
            ->value('K1Req');
        return $res;
    }

    public function checkIfRewardRedeemed()
    {
        //
    }

    public function setRewardCookie()
    {
        $hour = time() + 10 * 365 * 24 * 60 * 60;
        setcookie('secureWeb', true, $hour, '/', null, null, true);
    }

    public function checkRewardCookie()
    {
        //
    }

    public function getRewards()
    {
        $res = DB::table(table('pvpRewards'))
            ->select()
            ->get();
        return $res;
    }

    public function getReward($id)
    {
        $res = DB::table(table('pvpRewards'))
            ->select()
            ->where('RewardID', $id)
            ->get();
        return $res;
    }
}
