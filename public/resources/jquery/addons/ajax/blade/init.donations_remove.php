<?php
    define('AJAX_CALL', true);
    // Autoloader
    require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/bootstrap.php';
    $bootstrap = new  App\Bootstrap();
    $bootstrap->isAjax();
    use Jenssegers\Blade\Blade;
    use Models;
    use Utils;

    $session = new Utils\Session;
    $user = new Utils\User($session);

    $donations = new Models\Admin\PaymentCenter\Donations;

    $data = [
        'donations' => $donations,
        'user' => $user
    ];

    $blade = new Blade(DIRS['ROOT'] . 'resources/jquery/addons/ajax/admin/donations/', DIRS['ROOT'] . 'cache');
    if (file_exists(DIRS['ROOT'] . 'resources/jquery/addons/ajax/admin/donations/removeDonation.blade.php')) {
        echo $blade->make('removeDonation', ['data' => $data])->render();
    } else {
        die('View doesn\'t exist');
    }
