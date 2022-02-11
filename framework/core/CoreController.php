<?php

namespace Framework\Core;

class CoreController
{
    // Children
    protected $auth;
    protected $browser;
    protected $captcha;
    protected $data;
    protected $logSys;
    protected $pagination;
    protected $panels;
    protected $select;
    protected $user;
    protected $zone;

    // Load model
    public function model($model, $class1 = false, $class2 = false)
    {
        // Instantiate model
        return new $model($class1, $class2);
    }

    // Load view
    public function view($view, $data = [])
    {
        //$this->user = new \Classes\Utils\User;
        $blade = new \Framework\Blade\BladeController('view');
        // Load Directives
        $blade->loadDirectives($this->user, $this->session);
        // Load View
        $blade->loadView($view, $data);
    }

    // Load widget
    public function widget($view, $data = [])
    {
        $blade = new \Framework\Blade\BladeController('widget', $view);
        // Load Directives
        $blade->loadDirectives($this->user, $this->session);
        // Load View
        $blade->loadWidget($view, $data);
    }
}
