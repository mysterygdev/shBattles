<?php

namespace App\Controllers\Admin;

use Framework\Core\CoreController as Controller;
use App\Models;
use Classes\Sys\LogSys;
use Classes\Utils;

class Admin extends Controller
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->session = new Utils\Session;
        $this->user = new Utils\User($this->session);
        $this->logSys = new LogSys;
    }

    public function index()
    {
        $panels = new Utils\Panels;

        $data = [
            'user' => $this->user,
            'panels' => $panels,
            'data' => $this->data,
        ];

        $this->view('pages/ap/index', $data);
    }

    public function accessLogs()
    {
        $accessLogs = $this->model(Models\Admin\AccessLogs::class);

        $data = [
            'user' => $this->user,
            'accessLogs' => $accessLogs,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/admin/accessLogs', $data);
    }

    public function commandLogs()
    {
        $commandLogs = $this->model(Models\Admin\CommandLogs::class);

        $data = [
            'user' => $this->user,
            'commandLogs' => $commandLogs,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/admin/commandLogs', $data);
    }
}
