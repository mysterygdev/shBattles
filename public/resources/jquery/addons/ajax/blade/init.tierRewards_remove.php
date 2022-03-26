<?php
    define('AJAX_CALL', true);
    // Autoloader
    require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/bootstrap.php';
    $bootstrap = new  App\Bootstrap();
    $bootstrap->isAjax();
    use Jenssegers\Blade\Blade;
    use App\Models as Models;
    use Classes\Utils as Utils;

    $session = new Utils\Session;
    $user = new Utils\User($session);

    $rewards = new Models\Admin\Site\TieredSpender\Rewards;

    $data = [
        'rewards' => $rewards,
        'user' => $user
    ];

    $blade = new Blade(DIRS['ROOT'] . 'resources/jquery/addons/ajax/admin/tierRewards/', DIRS['ROOT'] . 'cache');
    if (file_exists(DIRS['ROOT'] . 'resources/jquery/addons/ajax/admin/tierRewards/removeReward.blade.php')) {
        echo $blade->make('removeReward', ['data' => $data])->render();
    } else {
        die('View doesn\'t exist');
    }
