<?php
    define('AJAX_CALL', true);
    // Autoloader
    require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/bootstrap.php';
    $bootstrap = new  App\Bootstrap();
    $bootstrap->isAjax();
    use Jenssegers\Blade\Blade;

    $user = new Utils\User();

    $rewards = new Models\Game\Rewards($user);

    $data = [
        'rewards' => $rewards,
        'user' => $user
    ];

    $blade = new Blade(DIRS['ROOT'] . 'resources/jquery/addons/ajax/site/user', DIRS['ROOT'] . 'cache');
    if (file_exists(DIRS['ROOT'] . 'resources/jquery/addons/ajax/site/user/details_edit.blade.php')) {
        echo $blade->make('details_edit', ['data' => $data])->render();
    } else {
        die('View doesn\'t exist');
    }
