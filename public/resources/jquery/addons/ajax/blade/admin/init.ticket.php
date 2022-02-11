<?php
    define('AJAX_CALL', true);
    // Autoloader
    require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/bootstrap.php';
    $bootstrap = new  App\Bootstrap();
    $bootstrap->isAjax();
    use Jenssegers\Blade\Blade;
    use App\Models as Models;
    use Classes\Utils as Utils;

    $tickets = new Models\Admin\Site\Tickets();

    $session = new Utils\Session;
    $user = new Utils\User($session);

    $user->fetchUser();

    $data = [
        'tickets' => $tickets,
        'user' => $user
    ];

    //$support = model(Models\Main\Support::class);

    $blade = new Blade(DIRS['ROOT'] . 'resources/jquery/addons/ajax/admin/tickets', DIRS['ROOT'] . 'cache');
    if (file_exists(DIRS['ROOT'] . 'resources/jquery/addons/ajax/admin/tickets/ticket.blade.php')) {
        echo $blade->make('ticket', ['data' => $data])->render();
    } else {
        die('View doesn\'t exist');
    }
