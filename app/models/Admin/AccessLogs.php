<?php

namespace Models\Admin;

use Illuminate\Database\Capsule\Manager as DB;

class AccessLogs
{
    public $count = 1;

    public function getAccessLogs()
    {
        $logs = DB::table(table('logAccess'))
            ->select()
            ->orderBy('ActionTime', 'DESC')
            ->get();
        return $logs;
    }

    public function categorySwitch()
    {
    }
}
