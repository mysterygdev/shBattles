<?php

namespace App\Models\Admin\Site\TieredSpender;

use Classes\Sys\LogSys;
use Illuminate\Database\Capsule\Manager as DB;

class AddRewards
{
    public function __construct()
    {
        $this->db = new \Classes\DB\MSSQL;
    }

    public function getTickets()
    {
    }
}
