<?php

namespace Controllers;

use Core\CoreController as Controller;
use Models as Models;
use Utils;

class Help extends Controller
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->user = new Utils\User();
    }

    public function policy()
    {
        $widgets = $this->model(Widgets::class, $this->user);

        $data = [
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/help/policy', $data);
    }

    public function support()
    {
        $support = $this->model(Models\Help\Support::class, $this->user);

        $widgets = $this->model(Widgets::class, $this->user);

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
        $widgets = $this->model(Widgets::class, $this->user);

        $data = [
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/help/rules', $data);
    }

    public function ticket($id)
    {
        $support = $this->model(Models\Help\Support::class, $this->user);

        $widgets = $this->model(Widgets::class, $this->user);

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

        $widgets = $this->model(Widgets::class, $this->user);

        $data = [
            'support' => $support,
            'data' => $this->data,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/help/support/newTicket', $data);
    }
}
