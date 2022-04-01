<?php

namespace Controllers\Admin;

use Core\CoreController;
use Models;
use Utils;
use Sys\LogSys;

class Account extends CoreController
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->user = new Utils\User;
        $this->logSys = new LogSys;
    }

    public function ban()
    {
        $ban = $this->model(Models\Admin\Account\AccountBan::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'ban' => $ban
        ];

        $this->view('pages/ap/account/ban', $data);
    }

    public function bannedUsers()
    {
        $bannedUsers = $this->model(Models\Admin\Account\BannedUsers::class);

        $data = [
            'data' => $this->data,
            'user' => $this->user,
            'logSys' => $this->logSys,
            'banned' => $bannedUsers
        ];

        $this->view('pages/ap/account/bannedUsers', $data);
    }

    public function dpHandout()
    {
        $dpHandout = $this->model(Models\Admin\Account\DPHandout::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'dpHandout' => $dpHandout
        ];

        $this->view('pages/ap/account/dpHandout', $data);
    }

    public function edit()
    {
        $edit = $this->model(Models\Admin\Account\AccountEdit::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'edit' => $edit
        ];

        $this->view('pages/ap/account/edit', $data);
    }

    public function ipSearch()
    {
        $ipSearch = $this->model(Models\Admin\Account\IPSearch::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'search' => $ipSearch
        ];

        $this->view('pages/ap/account/ipSearch', $data);
    }

    public function search()
    {
        $accountSearch = $this->model(Models\Admin\Account\AccountSearch::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'search' => $accountSearch
        ];

        $this->view('pages/ap/account/search', $data);
    }

    public function unban()
    {
        $unBan = $this->model(Models\Admin\Account\AccountUnBan::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'unban' => $unBan
        ];

        $this->view('pages/ap/account/unban', $data);
    }
}
