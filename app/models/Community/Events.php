<?php

namespace App\Models\Community;

use Illuminate\Database\Capsule\Manager as DB;
use Utils;

class Events
{
    public $rowCount;
    public $res;
    public $errors = [];

    public function __construct()
    {
        $this->data = new Utils\Data;
    }

    public function getEvents()
    {
        $res = DB::table(table('eventCalender'))
            ->select()
            ->orderBy('EventID', 'ASC')
            ->get();
        return $res;
    }
}
