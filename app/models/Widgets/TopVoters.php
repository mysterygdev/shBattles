<?php

namespace App\Models\Widgets;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils\Data;
use Classes\Utils\User;

class TopVoters
{
    public $charName;
    public $count;

    public function __construct($user)
    {
        $this->data = new Data;
        $this->user = $user;
    }

    public function getTopVoters()
    {
        $res = DB::table(table('voteLogs'))
            ->select()
            ->orderBy('LastVote')
            ->get();
        /* foreach ($res as $fet) {
            $this->charName = $this->user->getCharNameFromUser($fet->UserUID);
            $this->count = count($res);
        } */
        return $res;
    }

    public function getUserCharName()
    {
        foreach ($this->getTopVoters() as $fet) {
            return $this->user->getCharNameFromUser($fet->UserUID);
        }
    }

    public function getUserVoteCount($user)
    {
        $res = DB::table(table('voteLogs'))
            ->where('UserUID', $user)
            ->value('VoteCount');
        return $res;
        /* $res = DB::table(table('voteLogs'))
            ->select()
            ->where('UserUID', $_SESSION['User']['UserUID'])
            ->orderBy('Date')
            ->get();
        $count = count($res);
        return $count; */
    }
}
