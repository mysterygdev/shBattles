<?php

namespace App\Models\Game;

use Illuminate\Database\Capsule\Manager as DB;

class Promotions
{
    public $Code;
    public $NumOfUses;
    public $MaxUses;
    public $Points;
    public $fet;

    public function __construct($user, $session)
    {
        $this->data = new \Classes\Utils\Data;
        $this->session = $session;
        $this->user = $user;
        //$this->getPromotions();
    }

    public function getPromotions($code)
    {
        $Code = $code;
        $this->Code = $Code;

        $res = DB::table(table('promos'))
            ->select()
            ->where('Code', $Code)
            ->get();

        foreach ($res as $data) {
            $this->fet = $data;
            $this->NumOfUses = $data->NumOfUses;
            $this->MaxUses = $data->MaxUses;
            $this->Points = $data->Points;
        }
    }

    public function doesCodeExist($code)
    {
        $res = DB::table(table('promos'))
            ->where('Code', $code)
            ->value('Code');

        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public function isCodeMaxed($code)
    {
        $res = DB::table(table('promos'))
            ->select('Code', 'NumOfUses', 'MaxUses')
            ->where('Code', $code)
            ->get();

        if (count($res) > 0) {
            foreach ($res as $data) {
                $numOfUses = $data->NumOfUses;
                $maxUses = $data->MaxUses;
                if ($numOfUses == $maxUses || $numOfUses > $maxUses) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    public function isCodeUsed()
    {
        //
    }

    public function getCodePoints($code)
    {
        $res = DB::table(table('promos'))
            ->where('Code', $code)
            ->value('Points');
        return $res;
    }

    public function getNumOfUses($code)
    {
        $res = DB::table(table('promos'))
            ->where('Code', $code)
            ->value('NumOfUses');
        return $res;
    }

    public function getUserPoints()
    {
        $points = DB::table(table('shUserData'))
            ->where('UserUID', $this->user->UserUID)
            ->value('Point');
        return $points;
    }

    public function updateUserPoints($code)
    {
        $newPoints = $this->getUserPoints() + $this->getCodePoints($code);
        $update = DB::table(table('shUserData'))
            ->where('UserUID', $this->user->UserUID)
            ->update(['Point' => $newPoints]);
    }

    public function updatePromos($code)
    {
        $NewNumOfUses = $this->getNumOfUses($code) + 1;

        $update2 = DB::table(table('promos'))
            ->where('Code', $code)
            ->update(['Used' => 1, 'NumOfUses' => $NewNumOfUses]);
    }

    public function addPromoLog($code)
    {
        $log = DB::table(table('promoLogs'))
            ->insert([
                'Code' => $code,
                'UserUID' => $this->user->UserUID,
                'UserID' => $this->user->UserID
            ]);
    }

    public function validations()
    {
        $NewPoints = DB::table(table('shUserData'))
            ->where('UserUID', $this->user->UserUID)
            ->value('Point');
        $NewPoints = $NewPoints + $this->Points;

        $update = DB::table(table('shUserData'))
            ->where('UserUID', $this->user->UserUID)
            ->update(['Point' => $NewPoints]);

        $NewNumOfUses = $this->NumOfUses + 1;

        $update2 = DB::table(table('promos'))
            ->where('Code', $this->Code)
            ->update(['Used' => 1, 'NumOfUses' => $NewNumOfUses]);

        // insert log
        $log = DB::table(table('promoLogs'))
              ->insert([
                  'Code' => $this->Code,
                  'UserUID' => $this->user->UserUID,
                  'UserID' => $this->user->UserID
              ]);
    }
}
