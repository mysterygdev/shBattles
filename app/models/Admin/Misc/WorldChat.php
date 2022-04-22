<?php

namespace Models\Admin\Misc;

use Illuminate\Database\Capsule\Manager as DB;
use Sys\LogSys;
use Utils;

class WorldChat
{

    public function getTimer()
    {
        return 30;
    }

    public function getChatData()
    {
        $chat = DB::table(table('shChatLog') . ' as cl')
            ->select()
            ->join(table('shCharData') . ' as  c', 'cl.CharID', '=', 'c.CharID')
            ->limit(1000)
            ->orderBy('cl.ChatTime', 'DESC')
            ->get();
        return $chat;
    }
}
