<?php

namespace App\Models\User;

use Illuminate\Database\Capsule\Manager as DB;

class UserPanel
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

    public function getCharacterCount()
    {
        $res = DB::table(table('shCharData') . ' as c')
            ->select()
             ->join(table('shUserData') . ' as  um', 'um.UserUID', '=', 'c.UserUID')
            ->where('c.UserUID', $this->user->UserUID)
            ->where('c.Del', 0)
            ->get();
        return count($res);
    }

    public function getDeadCharacters()
    {
        $res = DB::table(table('shCharData') . ' as c')
            ->select()
             ->join(table('shUserData') . ' as  um', 'um.UserUID', '=', 'c.UserUID')
            ->where('c.UserUID', $this->user->UserUID)
            ->where('c.Del', 1)
            ->get();
        return $res;
    }

    public function getDeadCharacterCount()
    {
        $res = DB::table(table('shCharData') . ' as c')
            ->select()
             ->join(table('shUserData') . ' as  um', 'um.UserUID', '=', 'c.UserUID')
            ->where('c.UserUID', $this->user->UserUID)
            ->where('c.Del', 1)
            ->get();
        return count($res);
    }

    public function isCharacterDead($charID)
    {
        $res = DB::table(table('shCharData'))
            ->where('CharID', $charID)
            ->value('Del');
        if ($res == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getSlot($charID)
    {
        $slot = DB::select(DB::raw('SELECT MIN(Slots.Slot) AS OpenSlot FROM (SELECT 0 AS Slot UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) AS Slots LEFT JOIN (SELECT c.Slot FROM ' . table('shCharData') . ' AS c WHERE c.UserID = ? AND c.Del = ?) AS Chars ON Chars.Slot = Slots.Slot WHERE Chars.Slot IS NULL'), [$this->user->getUserIdFromCharId($charID), 0]);
        return $slot;
    }

    public function updateRestore($charID, $charName)
    {
        if ($this->getSlot($charID)[0]->OpenSlot > -1 && $this->getSlot($charID)[0]->OpenSlot < 5) {
            if ($this->isCharacterDead($charID)) {
                try {
                    $update = DB::table(table('shCharData'))
                    ->where('CharID', $charID)
                    ->update(['Del' => 0, 'Slot' => $this->getSlot($charID)[0]->OpenSlot, 'Map' => 42, 'PosX' => 63, 'PosZ' => 57, 'DeleteDate' => null, 'RemainTime' => 0]);
                    echo 'Resurrected character: ' . $charName . ' in slot: ' . $this->getSlot($charID)[0]->OpenSlot;
                    redirect_html('/userpanel', 2);
                } catch (\Illuminate\Database\QueryException $e) {
                    echo 'Could not resurrect character.';
                }
            } else {
                echo 'You don\'t have any dead characters to resurrect.';
            }
        } else {
            echo 'No slots available.';
        }
    }

    public function createVerificationKey()
    {
        $key = $this->data->randStr();
    }

    public function sendVerificationEmail()
    {
        /* $key = $this->data->randBytes(3);
        $stmt = DB::table(table('verificationKey'))
            ->insert([
                'Key' => $key,
                'Active' => 1
            ]); */
        // after insert key, send email

        // after email send verify key in db and time
        $res = DB::table(table('verificationKey'))
            ->select()
            ->where('Key', '11111')
            ->limit(1)
            ->get();
        $dbKey = 123456;
        $dateString = '2022-03-28 1:30:19.960';
        $timestamp = strtotime($dateString);
        $dbTime = $res[0]->Date;

        $dbtimestamp = strtotime($dbTime);
        if (time() - $dbtimestamp > 5 * 60) {
            echo '5 min past';
        } else {
            echo 'lets do some code';
        }
    }
}
