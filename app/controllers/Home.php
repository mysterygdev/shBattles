<?php

namespace Controllers;

use Core\CoreController;
use Models;
use Utils;

class Home extends CoreController
{
    public function __construct()
    {
        //$this->auth = new Utils\Auth;
        $this->browser = new Utils\Browser;
        $this->captcha = new Utils\Captcha;
        $this->pagination = new Utils\Pagination;
        $this->data = new Utils\Data;
        $this->user = new Utils\User;
    }

    public function index()
    {
        $newsModel = $this->model(Models\Community\News::class, $this->user);
        $serverInfo = $this->model(Models\Server\ServerInfo::class);
        $vote = $this->model(Models\Game\Vote::class, $this->user);

        $widgets = $this->model(Widgets::class, $this->user);

        $data = [
            'news' => $newsModel,
            'info' => $serverInfo,
            'vote' => $vote,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/home/index', $data);
    }

    public function downloads()
    {
        $widgets = $this->model(Widgets::class, $this->user);

        $data = [
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/server/download', $data);
    }
}
