<?php

namespace Blade;

use Jenssegers\Blade\Blade;
use Sys\LogSys;
use Utils;

class BladeController
{
    public $blade;
    //protected $user;

    public function __construct($type, $view = false)
    {
        if ($type === 'view') {
            $this->blade = new Blade('../resources/views', DIRS['ROOT'] . 'cache');
        } elseif ($type === 'widget') {
            $this->blade = new Blade(DIRS['WIDGETS_PATH'] . '/' . $view . '/php', 'cache');
        }

        $this->logSys = new LogSys;
    }

    public function loadDirectives($user)
    {
        $this->auth = new Utils\Auth;
        $this->user = $user;
        $this->blade->if('auth', function () {
            return $this->auth->check();
        });

        $this->blade->if('guest', function () {
            return $this->auth->guest();
        });

        $this->blade->if('adm', function () {
            return $this->user->isADM();
        });

        $this->blade->directive('endauth', function ($expression) {
            return '<?php endif; ?>';
        });

        $this->blade->directive('endguest', function ($expression) {
            return '<?php endif; ?>';
        });

        $this->blade->directive('endadm', function ($expression) {
            return '<?php endif; ?>';
        });

        $this->blade->directive('require', function ($path) {
            return "<?php require($path) ?>";
        });

        $this->blade->directive('Separator', function ($height) {
            return "<?php separator($height) ?>";
        });

        $this->blade->directive('lang', function ($string, $params = []) {
            return "<?php echo __($string) ?>";
        });

        $this->blade->directive('createLog', function ($action) {
            return $this->logSys->createLog($action);
        });

        $this->blade->directive('hellox', function ($expression) {
            return "<?php echo 'Hello x ' . {$expression}; ?>";
        });
    }

    public function loadView($view, $data)
    {
        // Check for view file
        if (file_exists('../resources/views/' . $view . '.blade.php')) {
            echo $this->blade->make($view, ['data' => $data])->render();
        //require_once '../app/views/' . $view . '.php';
        } else {
            // View does not exist
            die('View doesn\'t exist');
        }
    }

    public function loadWidget($view, $data = false)
    {
        // Check for view file
        if (file_exists('../app/widgets/' . $view . '/php/script.blade.php')) {
            echo $this->blade->make('script', ['data' => $data])->render();
        } else {
            echo 'Widget doesn\'t exist';
        }
    }
}
