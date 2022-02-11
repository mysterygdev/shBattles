<?php

namespace App\Models\Help;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class Support
{
    public $fet;
    public $Status;
    public $row;

    public function __construct($user)
    {
        $this->data = new \Classes\Utils\Data;
        $this->session = new Utils\Session;
        //$this->getTickets();
    }

    public function getTickets()
    {
        $res = DB::table(table('tickets'))
            ->select()
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->where('Main', 1)
            ->get();
        $this->fet = $res;
    }

    public function getStatus($Status)
    {
    }

    public function editTicket($UserUID, $TicketID)
    {
        $res = DB::table(table('tickets'))
            ->select()
            ->where('UserUID', $UserUID)
            ->where('ticketID', $TicketID)
            ->orderBy('Date', 'ASC')
            ->get();
        $this->row = $res;
        return $res;
    }

    public function getTicketData($UserUID, $TicketID)
    {
        $res = DB::table(table('tickets'))
            ->select()
            ->where('UserUID', $UserUID)
            ->where('ticketID', $TicketID)
            ->where('Main', 1)
            ->orderBy('Date', 'ASC')
            ->get();
        return $res;
    }
}
