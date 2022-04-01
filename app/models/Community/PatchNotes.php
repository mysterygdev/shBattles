<?php

namespace Models\Community;

use Illuminate\Database\Capsule\Manager as DB;

class PatchNotes
{

    public function getPatchNotes()
    {
        $patchNotes = DB::table(table('patchNotes'))
            ->select()
            ->orderBy('Date', 'DESC')
            ->get();
        return $patchNotes;
    }
}
