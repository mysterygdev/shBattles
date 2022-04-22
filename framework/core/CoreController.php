<?php

namespace Core;

class CoreController
{
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
        $blade = new \Blade\BladeController('view');
        // Load Directives
        $blade->loadDirectives($this->user);
        // Load View
        $blade->loadView($view, $data);
    }

    // Load widget
    public function widget($view, $data = [])
    {
        $blade = new \Blade\BladeController('widget', $view);
        // Load Directives
        $blade->loadDirectives($this->user);
        // Load View
        $blade->loadWidget($view, $data);
    }
}
