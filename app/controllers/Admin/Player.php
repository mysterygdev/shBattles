<?php

namespace App\Controllers\Admin;

use Framework\Core\CoreController as Controller;
use App\Models as Models;
use Classes\Sys\LogSys;
use Classes\Utils as Utils;

class Player extends Controller
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->logSys = new LogSys;
        $this->session = new Utils\Session;
        $this->user = new Utils\User($this->session);
    }

    public function chatSearch()
    {
        $chat = $this->model(Models\Admin\Player\ChatSearch::class);

        $data = [
            'data' => $this->data,
            'user' => $this->user,
            'logSys' => $this->logSys,
            'chat' => $chat
        ];

        $this->view('pages/ap/player/chatSearch', $data);
    }

    public function edit()
    {
        $edit = $this->model(Models\Admin\Player\EditPlayer::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'edit' => $edit
        ];

        $this->view('pages/ap/player/edit', $data);
    }

    public function editWhItems()
    {
        $item = $this->model(Models\Admin\Player\WhEdit::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'item' => $item
        ];

        $this->view('pages/ap/player/editWhItems', $data);
    }

    public function deleteWhItems()
    {
        $item = $this->model(Models\Admin\Player\WhDelete::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'item' => $item
        ];

        $this->view('pages/ap/player/deleteWhItems', $data);
    }

    public function itemDelete()
    {
        $item = $this->model(Models\Admin\Player\ItemDelete::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'item' => $item
        ];

        $this->view('pages/ap/player/itemDelete', $data);
    }

    public function itemEdit()
    {
        $item = $this->model(Models\Admin\Player\ItemEdit::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'item' => $item
        ];

        $this->view('pages/ap/player/itemEdit', $data);
    }

    public function jail()
    {
        $jail = $this->model(Models\Admin\Player\Jail::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'jail' => $jail
        ];

        $this->view('pages/ap/player/jail', $data);
    }

    public function linkedGear()
    {
        $player = $this->model(Models\Admin\Player\PlayerLinked::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'player' => $player
        ];

        $this->view('pages/ap/player/linkedGear', $data);
    }

    public function restore()
    {
        $restore = $this->model(Models\Admin\Player\Restore::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'restore' => $restore
        ];

        $this->view('pages/ap/player/restore', $data);
    }

    public function sendGiftPlayer()
    {
        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/player/sendGifts/sendGiftPlayer', $data);
    }

    public function sendGiftAll()
    {
        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/player/sendGifts/sendGiftAll', $data);
    }

    public function sgpPost()
    {
        $gift = $this->model(Models\Admin\Player\Gift::class);

        $charName = isset($_POST['CharName']) ? $this->data->purify(trim($_POST['CharName'])) : false;
        $itemId = isset($_POST['ItemID']) ? $this->data->purify(trim($_POST['ItemID'])) : false;
        $itemCount = isset($_POST['ItemCount']) ? $this->data->purify(trim($_POST['ItemCount'])) : false;

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'postChecks' => [
                'char' => $charName,
                'itemId' => $itemId,
                'itemCount' => $itemCount
            ],
            'gift' => $gift
        ];

        $this->view('pages/ap/fetchApi/player/sendGiftPlayer', $data);
    }

    public function sgpVerifyPost()
    {
        $gift = $this->model(Models\Admin\Player\Gift::class);

        $charName = isset($_POST['CharName']) ? $this->data->purify(trim($_POST['CharName'])) : false;
        $itemId = isset($_POST['ItemID']) ? $this->data->purify(trim($_POST['ItemID'])) : false;
        $itemCount = isset($_POST['ItemCount']) ? $this->data->purify(trim($_POST['ItemCount'])) : false;

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'postChecks' => [
                'char' => $charName,
                'itemId' => $itemId,
                'itemCount' => $itemCount
            ],
            'gift' => $gift
        ];

        $this->view('pages/ap/fetchApi/player/verifySendGiftPlayer', $data);
    }

    public function sgpSubmitPost()
    {
        $gift = $this->model(Models\Admin\Player\Gift::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'gift' => $gift
        ];

        $this->view('pages/ap/fetchApi/player/submitSendGiftPlayer', $data);
    }

    public function sgaPost()
    {
        $gift = $this->model(Models\Admin\Player\Gift::class);

        $itemId = isset($_POST['ItemID']) ? $this->data->purify(trim($_POST['ItemID'])) : false;
        $itemCount = isset($_POST['ItemCount']) ? $this->data->purify(trim($_POST['ItemCount'])) : false;

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'postChecks' => [
                'itemId' => $itemId,
                'itemCount' => $itemCount
            ],
            'gift' => $gift
        ];

        $this->view('pages/ap/fetchApi/player/sendGiftAll', $data);
    }

    public function sgaVerifyPost()
    {
        $gift = $this->model(Models\Admin\Player\Gift::class);

        $itemId = isset($_POST['ItemID']) ? $this->data->purify(trim($_POST['ItemID'])) : false;
        $itemCount = isset($_POST['ItemCount']) ? $this->data->purify(trim($_POST['ItemCount'])) : false;

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'postChecks' => [
                'itemId' => $itemId,
                'itemCount' => $itemCount
            ],
            'gift' => $gift
        ];

        $this->view('pages/ap/fetchApi/player/verifySendGiftAll', $data);
    }

    public function sgaSubmitPost()
    {
        $gift = $this->model(Models\Admin\Player\Gift::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'gift' => $gift
        ];

        $this->view('pages/ap/fetchApi/player/submitSendGiftAll', $data);
    }

    public function unJail()
    {
        $unJail = $this->model(Models\Admin\Player\UnJail::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'jail' => $unJail
        ];

        $this->view('pages/ap/player/unJail', $data);
    }
}
