<?php

namespace App\Models\Community;

use Illuminate\Database\Capsule\Manager as DB;

class Events
{
    public $rowCount;
    public $res;
    public $errors = [];

    public function __construct($session)
    {
        $this->data = new \Classes\Utils\Data;
        $this->session = $session;
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
