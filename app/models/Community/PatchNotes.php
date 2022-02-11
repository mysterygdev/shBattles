<?php

namespace App\Models\Community;

use Illuminate\Database\Capsule\Manager as DB;

class PatchNotes
{
    public function __construct()
    {
        $this->db = new \Classes\DB\MSSQL;
    }

    public function getPatchNotes()
    {
        $patchNotes = DB::table(table('patchNotes'))
            ->select()
            ->orderBy('Date', 'DESC')
            ->get();
        return $patchNotes;
    }
}
