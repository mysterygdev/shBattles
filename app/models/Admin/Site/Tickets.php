<?php

namespace Models\Admin\Site;

use Illuminate\Database\Capsule\Manager as DB;

class Tickets
{
    public $count = 1;

    public function getTickets()
    {
        $tickets = DB::table(table('tickets') . ' as [T]')
             ->select(['[T].TicketUID', '[T].UserUID', '[T].RespUID', '[T].TicketID', '[T].Type', '[T].Status', '[T].Category', '[T].Subject', '[T].Message', '[T].Date', '[T].Main', '[U].UserID'])
             ->join(table('shUserData') . ' as  [U]', '[T].UserUID', '=', '[U].UserUID')
             ->where('[T].Status', '!=', 4)
             ->where('[T].Main', 1)
             ->orderBy('[T].TicketID', 'DESC')
             ->get();
        return $tickets;
    }

    public function loadTicket($id)
    {
        $tickets = DB::table(table('tickets'))
             ->select()
             ->where('TicketID', $id)
             ->orderBy('TicketUID')
             ->get();
        return $tickets;
    }
}
