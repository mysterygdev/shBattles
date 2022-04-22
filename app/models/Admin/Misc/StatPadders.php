<?php

namespace Models\Admin\Misc;

use Illuminate\Database\Capsule\Manager as DB;
use Sys\LogSys;
use Utils;

class StatPadders
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->logSys = new LogSys;
    }

    public function getStatPadders()
    {
        $stat = DB::table(table('statPadders'))
            ->select()
            ->get();
        return $stat;
    }
}
