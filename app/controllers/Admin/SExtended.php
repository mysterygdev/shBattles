<?php

namespace Controllers\Admin;

use Core\CoreController;
use Shaiya\SExtended as SE;
use Models;
use Utils;
use Sys\LogSys;

class SExtended extends CoreController
{
    public function __construct()
    {
        $this->sExtended = new SE;
        $this->logSys = new LogSys;
        $this->user = new Utils\User;
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
