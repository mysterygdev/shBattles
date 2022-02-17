<?php

namespace App\Controllers;

use Framework\Core\CoreController as Controller;
use App\Models;
use Classes\Utils;

class Server extends Controller
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->session = new Utils\Session;
        $this->user = new Utils\User($this->session);
    }

    public function about()
    {
        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'user' => $this->user,
            'widgets' => $widgets
        ];
        $this->view('pages/cms/server/about', $data);
    }

    public function bossRecords()
    {
        $bossRecords = $this->model(Models\Server\BossRecords::class, $this->user);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

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

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'drops' => $dropFinder,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/server/dropfinder', $data);
    }

    public function drops()
    {
        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/server/drops', $data);
    }

    public function download()
    {
        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/server/download', $data);
    }

    public function terms()
    {
        $widgets = $this->model(Widgets::class, $this->user, $this->session);

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

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'drops' => $dropFinder,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('fetch/dropFinder/itemSearch', $data);
    }
}
