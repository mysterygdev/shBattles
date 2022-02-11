<?php
    define('AJAX_CALL', true);
    // Autoloader
    require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/bootstrap.php';
    $bootstrap = new  App\Bootstrap();
    $bootstrap->isAjax();
    use Jenssegers\Blade\Blade;
    use App\Models as Models;
    use Classes\Utils as Utils;

    $support = new Models\Main\Support();

    $session = new Utils\Session;
    $user = new Utils\User($session);

    $user->fetchUser();

    $data = [
        'support' => $support,
        'user' => $user
    ];

    //$support = model(Models\Main\Support::class);

    $blade = new Blade(DIRS['ROOT'] . 'resources/jquery/addons/ajax/site/support', DIRS['ROOT'] . 'cache');
    if (file_exists(DIRS['ROOT'] . 'resources/jquery/addons/ajax/site/support/send_ticket.blade.php')) {
        echo $blade->make('send_ticket', ['data' => $data])->render();
    } else {
        die('View doesn\'t exist');
    }
