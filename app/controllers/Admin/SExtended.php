<?php

namespace App\Controllers\Admin;

use Framework\Core\CoreController as Controller;
use App\Models;
use Classes\Sys\LogSys;
use Classes\Shaiya\SExtended as SE;
use Classes\Utils as Utils;

class SExtended extends Controller
{
    public function __construct()
    {
        $this->sExtended = new SE;
        $this->logSys = new LogSys;
        $this->session = new Utils\Session;
        $this->user = new Utils\User($this->session);
    }

    public function sendNotice()
    {
        $data = [
            'user' => $this->user,
            'sE' => $this->sExtended,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/SExtended/sendNotice', $data);
    }

    public function sendPlayerNotice()
    {
        $notice = $this->model(Models\Admin\SExtended\SendPlayerNotice::class);

        $data = [
            'user' => $this->user,
            'sE' => $this->sExtended,
            'logSys' => $this->logSys,
            'notice' => $notice
        ];

        $this->view('pages/ap/SExtended/sendPlayerNotice', $data);
    }

    public function sendPlayerPM()
    {
        $data = [
            'user' => $this->user,
            'sE' => $this->sExtended,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/SExtended/sendPlayerPM', $data);
    }

    public function sendTradeChat()
    {
        $data = [
            'user' => $this->user,
            'sE' => $this->sExtended,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/SExtended/sendTradeChat', $data);
    }
}
