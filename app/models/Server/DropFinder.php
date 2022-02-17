<?php

namespace App\Models\Server;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class DropFinder
{
    public $rowCount;
    public $res;
    public $errors = [];
    public $countDisplayed;

    public function __construct()
    {
        $this->data = new \Classes\Utils\Data;
        $this->session = new Utils\Session;
    }

    public function getItemName()
    {
        $content = trim(file_get_contents('php://input'));
        $decoded = json_decode($content, true);
        return isset($decoded['itemName']) ? $this->data->purify(trim($decoded['itemName'])) : false;
    }

    public function getFirstItemByQuery($itemName = null)
    {
        $itemName = $this->getItemName();
        $items = DB::table(table('shItems') . ' as [I]')
            ->select('[I].ItemName', '[I].ItemID', '[I].Grade', '[MI].DropRate', '[M].MobName')
            ->join(table('shMobItems') . ' as  [MI]', '[I].Grade', '=', '[MI].Grade')
            ->join(table('shMobs') . ' as  [M]', '[MI].MobID', '=', '[M].MobID')
            ->limit(1)
            ->where('[I].ItemName', 'LIKE', '%' . $itemName . '%')
            ->get();
        return $items;
    }

    public function getItemsByQuery($itemName = null)
    {
        $itemName = $this->getItemName();
        $items = DB::table(table('shItems') . ' as [I]')
            ->select('[I].ItemName', '[I].ItemID', '[I].Grade', '[MI].DropRate', '[M].MobName')
            ->join(table('shMobItems') . ' as  [MI]', '[I].Grade', '=', '[MI].Grade')
            ->join(table('shMobs') . ' as  [M]', '[MI].MobID', '=', '[M].MobID')
            ->where('[I].ItemName', 'LIKE', '%' . $itemName . '%')
            ->get();
        return $items;
    }

    public function countItemQuery($query = null)
    {
        $this->countDisplayed = true;
        return count($this->getItemsByQuery());
    }

    public function isCountDisplayed()
    {
        if ($this->countDisplayed == true) {
            return true;
        } else {
            return false;
        }
    }

    public function getMobName()
    {
        //
    }
}
