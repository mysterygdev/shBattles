<?php

namespace App\Models\User;

use Illuminate\Database\Capsule\Manager as DB;

class MoveTerra
{
    public $charId;
    public function __construct($user, $session)
    {
        $this->data = new \Classes\Utils\Data;
        $this->session = $session;
        $this->user = $user;
    }

    public function getAliveCharacters()
    {
        $res = DB::table(table('shCharData'))
            ->select()
            ->where('UserUID', $this->user->UserUID)
            ->where('Del', 0)
            ->get();
        return $res;
    }

    public function checkIfUserHasItem($itemId, $slot)
    {
        $res = DB::table(table('shUserWh'))
            ->select()
            ->where('UserUID', $this->user->UserUID)
            ->where('ItemID', $itemId)
            ->where('Slot', $slot)
            ->where('Del', 0)
            ->get();
        return $res;
    }

    public function checkIfCharNotSelected()
    {
        $this->charId = isset($_POST['CharID']) ? $this->data->purify(trim($_POST['CharID'])) : false;
        if (!$this->charId || empty($this->charId)) {
            return true;
        } else {
            $this->session->put('Terra', $this->charId, 'CharID');
        }
    }

    public function getCharId()
    {
        return $this->session->get('Terra', 'CharID');
    }

    public function removeSpecialItem($itemId, $slot)
    {
        $del = DB::table(table('shUserWh'))
            ->where('UserUID', $this->user->UserUID)
            ->where('ItemID', $itemId)
            ->where('Slot', $slot)
            ->where('Del', 0)
            ->delete();
        if ($del) {
            return true;
        } else {
            return false;
        }
    }

    public function movePlayerToMap()
    {
        if ($this->user->updateCharMap($this->getCharId(), TERRA['Map'], TERRA['X'], TERRA['Y'], TERRA['Z']) && $this->removeSpecialItem(TERRA['ItemId'], TERRA['Slot'])) {
            return true;
        } else {
            return false;
        }
        $this->session->forget('Terra');
    }
}
