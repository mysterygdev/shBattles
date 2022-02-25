<?php

namespace App\Controllers;

use Framework\Core\CoreController as Controller;
use App\Models as Models;
use Classes\Utils;

class Home extends Controller
{
    public function __construct()
    {
        //$this->auth = new Utils\Auth;
        $this->browser = new Utils\Browser;
        $this->captcha = new Utils\Captcha;
        $this->pagination = new Utils\Pagination;
        $this->data = new Utils\Data;
        $this->session = new Utils\Session;
        $this->user = new Utils\User($this->session);
    }

    public function index()
    {
        $newsModel = $this->model(Models\Community\News::class, $this->user);
        $serverInfo = $this->model(Models\Server\ServerInfo::class);

        $widgets = $this->model(Widgets::class, $this->user , $this->session);

        $data = [
            'news' => $newsModel,
            'info' => $serverInfo,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/home/index', $data);
    }

    public function downloads()
    {
        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/server/download', $data);
    }
}
