<?php

namespace App\Controllers;

use Framework\Core\CoreController as Controller;
use Illuminate\Database\Capsule\Manager as DB;
use App\Models as Models;
use Classes\Utils;

class Widgets extends Controller
{
    public function __construct($user, $session)
    {
        $this->data = new Utils\Data;
        $this->session = $session;
        $this->user = $user;
    }

    public function display(string $mode = 'right'): object
    {
        $widgets = DB::table(table('widgets'))
            ->where('Enabled', 1)
            ->orderBy('Priority', 'ASC')
            ->get();
        return $widgets;
    }

    public function loadWidgets($name, $data = [])
    {
        //$widget = new Utils\Widget();
        //$widget = $widget->display();
        //$this->widget($name, $data);
        $this->loadWidgetData($name);
    }

    public function loadWidgetData($name)
    {
        switch ($name) {
            case 'affiliates':
                $this->widget($name, $this->affiliates());
                break;
            case 'bossRecords':
                $this->widget($name, $this->bossRecords());
                break;
            case 'discord':
                $this->widget($name, $this->discord());
                break;
            case 'guildRankings':
                $this->widget($name, $this->guildRankings());
                break;
            case 'guildRankingTimer':
                $this->widget($name, $this->guildRankingTimer());
                break;
            case 'playerCount':
                $this->widget($name, $this->playerCount());
                break;
            case 'playersOnlineTime':
                $this->widget($name, $this->playersOnlineTime());
                break;
            case 'polls':
                $this->widget($name, $this->polls());
                break;
            case 'serverStatus':
                $this->widget($name, $this->serverStatus());
                break;
            case 'serverTime':
                $this->widget($name, $this->serverTime());
                break;
            case 'topVoters':
                $this->widget($name, $this->topVoters());
                break;
            case 'quickMenu':
                $this->widget($name, $this->quickMenu());
                break;
        }
    }

    public function affiliates()
    {
        //
    }

    public function bossRecords()
    {
        //
    }

    public function discord()
    {
        //
    }

    public function guildRankings()
    {
        $model = $this->model(Models\Community\GuildRankings::class, $this->user);

        $data = [
            'user' => $this->user,
            'model' => $model
        ];

        return $data;
    }

    public function guildRankingTimer()
    {
        //
    }

    public function playerCount()
    {
        //
    }

    public function playersOnlineTime()
    {
        //
    }

    public function polls()
    {
        //
    }

    public function serverStatus()
    {
        //
    }

    public function serverTime()
    {
        //
    }

    public function topVoters()
    {
        $model = $this->model(Models\Widgets\TopVoters::class, $this->user);

        $data = [
            'user' => $this->user,
            'model' => $model
        ];

        return $data;
    }

    public function quickMenu()
    {
        $data = [
            'user' => $this->user
        ];

        return $data;
    }
}
