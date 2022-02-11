<?php

namespace App\Controllers;

use Framework\Core\CoreController as Controller;
use App\Models as Models;
use Classes\Utils as Utils;

class WebMall extends Controller
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->session = new Utils\Session;
        $this->user = new Utils\User($this->session);
    }

    /* Get Methods */

    public function cart()
    {
        $webMall = $this->model(Models\Game\WebMall::class);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'webmall' => $webMall,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/game/webmall/cart', $data);
    }

    public function checkout()
    {
        $webMall = $this->model(Models\Game\WebMall::class);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'webmall' => $webMall,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/game/webmall/checkout', $data);
    }

    public function orderFail()
    {
        $webMall = $this->model(Models\Game\WebMall::class);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'webmall' => $webMall,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/game/webmall/orderFail', $data);
    }

    public function orders()
    {
        $webMall = $this->model(Models\Game\WebMall::class);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'webmall' => $webMall,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/game/webmall/orders', $data);
    }

    public function orderSuccess()
    {
        $webMall = $this->model(Models\Game\WebMall::class);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'webmall' => $webMall,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/game/webmall/orderSuccess', $data);
    }

    public function webmall()
    {
        $webMall = $this->model(Models\Game\WebMall::class);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'webmall' => $webMall,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/game/webmall/webmall', $data);
    }

    public function tieredSpender()
    {
        $tiered = $this->model(Models\Game\TieredSpender::class);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'tiered' => $tiered,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/game/webmall/tieredSpender/tieredspender', $data);
    }

    /* Post Methods */

    public function cartAction()
    {
        $webMall = $this->model(Models\Game\WebMall::class);

        $data = [
            'webmall' => $webMall,
            'user' => $this->user
        ];

        $this->view('pages/cms/game/webmall/cartAction', $data);
    }
}
