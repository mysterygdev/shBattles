<?php

namespace Controllers;

use Core\CoreController as Controller;
use Models;
use Utils;
use Utils\Session;

class Server extends Controller
{
    protected $referer;
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->user = new Utils\User;
        Session::setReferer();
    }

    public function about()
    {
        $widgets = $this->model(Widgets::class, $this->user);

        $data = [
            'user' => $this->user,
            'widgets' => $widgets
        ];
        $this->view('pages/cms/server/about', $data);
    }

    public function bossRecords()
    {
        $bossRecords = $this->model(Models\Server\BossRecords::class, $this->user);

        $widgets = $this->model(Widgets::class, $this->user);

        $data = [
            'bossrecords' => $bossRecords,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/server/bossrecords', $data);
    }

    public function dropFinder()
    {
        $dropFinder = $this->model(Models\Server\DropFinder::class, $this->user);

        $widgets = $this->model(Widgets::class, $this->user);

        $data = [
            'drops' => $dropFinder,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/server/dropfinder', $data);
    }

    public function drops()
    {
        $widgets = $this->model(Widgets::class, $this->user);

        $data = [
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/server/drops', $data);
    }

    public function download()
    {
        $widgets = $this->model(Widgets::class, $this->user);

        $data = [
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/server/download', $data);
    }

    public function terms()
    {
        $widgets = $this->model(Widgets::class, $this->user);

        $data = [
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/server/terms', $data);
    }

    // POST
    public function itemSearch()
    {
        $dropFinder = $this->model(Models\Server\DropFinder::class, $this->user);

        $widgets = $this->model(Widgets::class, $this->user);

        $data = [
            'drops' => $dropFinder,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('fetch/dropFinder/itemSearch', $data);
    }
}
