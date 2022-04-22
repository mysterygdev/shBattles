<?php

namespace Models\Admin;

use Illuminate\Database\Capsule\Manager as DB;

class CommandLogs
{
    public $count = 1;

    public function getCommandLogs()
    {
        $logs = DB::table(table('logGmCommands'))
            ->select()
            ->orderBy('ActionTime', 'DESC')
            ->get();
        return $logs;
    }
}
