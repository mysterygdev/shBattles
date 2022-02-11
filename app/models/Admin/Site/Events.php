<?php

namespace App\Models\Admin\Site;

use Classes\Sys\LogSys;
use Illuminate\Database\Capsule\Manager as DB;

class Events
{
    public $count = 1;

    public function __construct()
    {
        $this->db = new \Classes\DB\MSSQL;

        //$logSys = new LogSys;
        //$logSys->createLog('Visited Access Logs Page');
    }

    public function getEvents()
    {
        $events = DB::table(table('eventCalender'))
            ->select()
            ->orderBy('Date', 'DESC')
            ->get();
        return $events;
    }

    public function getEventTitle($id)
    {
        $res = DB::table(table('eventCalender'))
            ->where('EventID', $id)
            ->value('Title');
        return $res;
    }

    public function getEventDetails($id)
    {
        $res = DB::table(table('eventCalender'))
            ->where('EventID', $id)
            ->value('Details');
        return $res;
    }

    public function getEventStartTime($id)
    {
        $res = DB::table(table('eventCalender'))
            ->where('EventID', $id)
            ->value('StartTime');
        return $res;
    }

    public function getEventEndTime($id)
    {
        $res = DB::table(table('eventCalender'))
            ->where('EventID', $id)
            ->value('EndTime');
        return $res;
    }

    public function updateEvent($id, $title, $details, $start, $end)
    {
        $this->updateEventTitle();
        $this->updateEventDetails();
        $this->updateEventStartTime();
        $this->updateEventEndTime();
    }

    public function updateEventTitle($id, $title)
    {
        $update = DB::table(table('eventCalender'))
            ->where('EventID', $id)
            ->update(['Title' => $title]);
    }

    public function updateEventDetails($id, $details)
    {
        $update = DB::table(table('eventCalender'))
            ->where('EventID', $id)
            ->update(['Details' => $details]);
    }

    public function updateEventStartTime($id, $time)
    {
        $update = DB::table(table('eventCalender'))
            ->where('EventID', $id)
            ->update(['StartTime' => $time]);
    }

    public function updateEventEndTime($id, $time)
    {
        $update = DB::table(table('eventCalender'))
            ->where('EventID', $id)
            ->update(['EndTime' => $time]);
    }

    public function createEvent($title, $details, $start, $end = false)
    {
        if (!$end) {
            $create = DB::table(table('eventCalender'))
                ->insert([
                    'Title' => $title,
                    'Details' => $details,
                    'StartTime' => $start
                ]);
        } else {
            $create = DB::table(table('eventCalender'))
                ->insert([
                    'Title' => $title,
                    'Details' => $details,
                    'StartTime' => $start,
                    'EndTime' => $end,
                ]);
        }
    }

    public function deleteEvent($id)
    {
        $delete = DB::table(table('eventCalender'))
            ->where('EventID', $id)
            ->delete();
    }
}
