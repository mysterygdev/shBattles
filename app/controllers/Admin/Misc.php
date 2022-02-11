<?php

namespace App\Controllers\Admin;

use Framework\Core\CoreController as Controller;
use App\Models as Models;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class Misc extends Controller
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->logSys = new LogSys;
        $this->session = new Utils\Session;
        $this->user = new Utils\User($this->session);
    }

    public function actionLog()
    {
        $action = $this->model(Models\Admin\Misc\ActionLog::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'action' => $action
        ];

        $this->view('pages/ap/misc/actionLog', $data);
    }

    public function disbandGuild()
    {
        $guild = $this->model(Models\Admin\Misc\DisbandGuild::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'guild' => $guild
        ];

        $this->view('pages/ap/misc/disbandGuild', $data);
    }

    public function guildLeaderChange()
    {
        $guildLeaderChange = $this->model(Models\Admin\Misc\GuildLeaderChange::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'guild' => $guildLeaderChange
        ];

        $this->view('pages/ap/misc/guildLeaderChange', $data);
    }

    public function guildNameChange()
    {
        $guildNameChange = $this->model(Models\Admin\Misc\GuildNameChange::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'guild' => $guildNameChange
        ];

        $this->view('pages/ap/misc/guildNameChange', $data);
    }

    public function guildSearch()
    {
        $guildSearch = $this->model(Models\Admin\Misc\GuildSearch::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'guild' => $guildSearch
        ];

        $this->view('pages/ap/misc/guildSearch', $data);
    }

    public function itemList()
    {
        $itemList = $this->model(Models\Admin\Misc\ItemList::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'items' => $itemList
        ];

        $this->view('pages/ap/misc/itemList', $data);
    }

    public function itemSearchCat()
    {
        $items = $this->model(Models\Admin\Misc\ItemSearchCat::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'items' => $items
        ];

        $this->view('pages/ap/misc/itemSearchCat', $data);
    }

    public function itemSearchName()
    {
        $items = $this->model(Models\Admin\Misc\ItemSearchName::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'items' => $items
        ];

        $this->view('pages/ap/misc/itemSearchName', $data);
    }

    public function manageGuilds()
    {
        $guild = $this->model(Models\Admin\Misc\ManageGuilds::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'guild' => $guild
        ];

        $this->view('pages/ap/misc/manageGuilds', $data);
    }

    public function mobList()
    {
        $mobList = $this->model(Models\Admin\Misc\MobList::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'mobs' => $mobList
        ];

        $this->view('pages/ap/misc/mobList', $data);
    }

    public function playersOnline()
    {
        $playersOnline = $this->model(Models\Admin\Misc\PlayersOnline::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'players' => $playersOnline
        ];

        $this->view('pages/ap/misc/playersOnline', $data);
    }

    public function statPadders()
    {
        $stat = $this->model(Models\Admin\Misc\StatPadders::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'stat' => $stat
        ];

        $this->view('pages/ap/misc/statPadders', $data);
    }

    public function worldChat()
    {
        $worldChat = $this->model(Models\Admin\Misc\WorldChat::class);

        $data = [
            'data' => $this->data,
            'user' => $this->user,
            'logSys' => $this->logSys,
            'chat' => $worldChat
        ];

        $this->view('pages/ap/misc/worldChat', $data);
    }
}
