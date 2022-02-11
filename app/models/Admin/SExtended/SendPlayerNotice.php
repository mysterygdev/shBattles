<?php

namespace App\Models\Admin\SExtended;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class SendPlayerNotice
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->charName = isset($_POST['char']) ? $this->data->purify(trim($_POST['char'])) : false;
    }

    public function viewData()
    {
        // get faction too shumg join
        $res = DB::table(table('shCharData'))
            ->select('CharName', 'LoginStatus')
            ->where('LoginStatus', 1)
            ->orderBy('CharName', 'DESC')
            ->get();
        return $res;
    }

    public function searchData($charName)
    {
        $res = DB::table(table('shCharData'))
            ->select('CharName')
            ->where('CharName', 'LIKE', '%' . $charName . '%')
            ->where('LoginStatus', 1)
            ->orderBy('CharName', 'DESC')
            ->get();
        return $res;
    }
}
