<?php

namespace App\Controllers;

use Framework\Core\CoreController as Controller;
use App\Models as Models;
use Classes\Utils as Utils;

class Help extends Controller
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->session = new Utils\Session;
        $this->user = new Utils\User($this->session);
    }

    public function policy()
    {
        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/help/policy', $data);
    }

    public function support()
    {
        $support = $this->model(Models\Help\Support::class, $this->user);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'support' => $support,
            'data' => $this->data,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/help/support', $data);
    }

    public function rules()
    {
        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/help/rules', $data);
    }

    public function ticket($id)
    {
        $support = $this->model(Models\Help\Support::class, $this->user);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'support' => $support,
            'data' => $this->data,
            'user' => $this->user,
            'widgets' => $widgets,
            'ticketID' => $id,
        ];

        $this->view('pages/cms/help/support/ticket', $data);
    }

    public function newTicket()
    {
        $support = $this->model(Models\Help\Support::class, $this->user);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'support' => $support,
            'data' => $this->data,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/help/support/newTicket', $data);
    }
}
