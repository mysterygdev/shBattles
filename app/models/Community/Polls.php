<?php

namespace App\Models\Community;

use Illuminate\Database\Capsule\Manager as DB;

class Polls
{
    public function __construct()
    {
        $this->db = new \Classes\DB\MSSQL;
    }

    public function getPolls()
    {
        $polls = DB::table(table('polls'))
            ->select()
            ->get();
        return $polls;
    }

    public function getPollOptions($id)
    {
        $opts = DB::table(table('pollOptions'))
            ->select()
            ->where('poll_id', $id)
            ->get();
        return $opts;
    }
}
