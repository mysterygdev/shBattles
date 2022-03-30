<?php

namespace App;

use Dotenv\Dotenv;
use Framework\Core\Loader;
use Classes\DB\MSSQL as DB;
use Classes\Security\Security;
use Classes\Utils as Utils;
use Classes\Exception\Exception;
use Pecee\SimpleRouter\SimpleRouter;

class Bootstrap
{
    public function __construct()
    {
        # Load Vendor autoloader for Vendor resources
        require_once dirname(__DIR__) . '/vendor/autoload.php';

        $this->loader = new Loader;

        $this->init();
    }

    private function init()
    {
        # Misc Helpers
        $this->loadDefines();
        if (!defined('AJAX_CALL')) {
            # Load Dotenv
            $this->initDotEnv();
            # Load core classes
            require_once CORE_PATH . 'loader.php';
            # Load configuration files
            $this->loadConfigs();
            # Load Helpers
            $this->loadHelpers();
            # Init PHP
            $this->loadPhp();
            # Init SSL Check
            $this->security = new Security;
            # Set Default Exception
            $this->loadException();
            # Set Timezone
            date_default_timezone_set(APP['timeZone']);
            # Init DB
            $this->database = new DB;
            # Load HTMLPurifier
            require_once LIB_PATH . 'HTMLPurifier/HTMLPurifier.auto.php';
            # Load Langs
            //$this->loadLangSystem();
        }
    }

    public function loadDefines()
    {
        // Define misc helpers
        define('DS', DIRECTORY_SEPARATOR);
        define('BS', '\\');
        define('FS', '/');
        define('LB', '<br>');
        define('ST', '|');
        // Define path constants
        if (defined('AJAX_CALL')) {
            define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
        } else {
            define('ROOT_PATH', getcwd() . DS);
        }
        define('APP_PATH', ROOT_PATH . '/../app' . DS);
        define('CLASSES_PATH', APP_PATH . 'classes' . DS);
        define('CONTROLLER_PATH', APP_PATH . 'controllers' . DS);
        define('EXCEPTIONS_PATH', APP_PATH . 'exceptions' . DS);
        define('MODELS_PATH', APP_PATH . 'models' . DS);
        define('WIDGETS_PATH', APP_PATH . 'widgets' . DS);
        define('CONFIG_PATH', APP_PATH . '/../config' . DS);
        define('FRAMEWORK_PATH', ROOT_PATH . '/../framework' . DS);
        define('BLADE_PATH', FRAMEWORK_PATH . 'Blade' . DS);
        define('CORE_PATH', FRAMEWORK_PATH . 'Core' . DS);
        define('HELPER_PATH', FRAMEWORK_PATH . 'Helpers' . DS);
        define('LIB_PATH', FRAMEWORK_PATH . 'libraries' . DS);
        define('ROUTES_PATH', FRAMEWORK_PATH . 'routes' . DS);
        define('LOGS_PATH', ROOT_PATH . '/../logs' . DS);
        define('PUBLIC_PATH', '/');
        define('PBLC_RESOURCES_PATH', PUBLIC_PATH . 'resources/');
        define('THEMES_PATH', PBLC_RESOURCES_PATH . 'themes/');
        define('CORE_THEME_PATH', THEMES_PATH . 'core');
        define('YP_THEME_PATH', THEMES_PATH . 'YouPlay');
        define('AJAX_PATH', PUBLIC_PATH . 'jquery/addons/ajax/' . DS);
        define('RESOURCES_PATH', APP_PATH . '/../resources' . DS);
        define('LANGS_PATH', RESOURCES_PATH . '/langs' . DS);
        define('VIEWS_PATH', RESOURCES_PATH . '/views' . DS);
        define('DB_PATH', FRAMEWORK_PATH . 'database' . DS);
        define('UPLOAD_PATH', PUBLIC_PATH . 'uploads' . DS);
    }

    public function initDotEnv()
    {
        $rootDir = dirname(dirname(__FILE__));
        $dotenv = Dotenv::createImmutable($rootDir);
        $dotenv->load();
    }

    public function loadConfigs()
    {
        define('APP', $this->loader->config('app'));
        define('AUTH', $this->loader->config('auth', 'mixed/auth'));
        define('DIRS', $this->loader->config('dirs', 'mixed/main'));
        define('DONATE', $this->loader->config('donate', 'cms/game/donate'));
        define('COINBASE', $this->loader->config('COINBASE', 'cms/game/donate'));
        define('DB', $this->loader->config('database', 'mixed/main'));
        define('MAIL', $this->loader->config('mail'));
        define('MAPS', $this->loader->config('maps', 'cms/game'));
        define('PAYPAL', $this->loader->config('paypal', 'cms/game/donate'));
        define('REGISTER', $this->loader->config('register', 'mixed/auth'));
        define('SERVER', $this->loader->config('server'));
        define('STRIPE', $this->loader->config('stripe', 'cms/game/donate'));
        define('TERRA', $this->loader->config('terra', 'cms/game'));
        define('VOTE', $this->loader->config('vote', 'cms/game'));
        define('WEBMALL', $this->loader->config('webmall'));
        //$this->loader->loadConfigs();
        //$this->loader->loadResources(CONFIG_PATH, 'config', $this->loader->configs, true);
    }

    public function loadHelpers()
    {
        /* $loader = new Loader; */
        /* $loader->helper('modal');
        $loader->helper('template');
        $loader->helper('url');
        $loader->helper('abort');
        $loader->helper('redirect');
        $loader->helper('table');
        $loader->helper('lang');
        $loader->helper('translate'); */
        $this->loader->loadHelpers();
    }

    public function loadPhp()
    {
        $this->php = new Utils\PHP;
    }

    public function loadException()
    {
        $exception = new Exception;
        set_exception_handler([$exception, 'handler']);
    }

    public function loadLangSystem()
    {
        $this->getLang();
        $this->loadLangs();
    }

    public function getLang()
    {
        // Defaut language English
        $getLang = (isset($_GET['lang'])) ? $_SESSION['lang'] = $_GET['lang'] : '';
        $lang = (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) : '';

        if ($getLang) {
            if (!defined('LANG')) {
                define('LANG', $getLang);
            }
        } elseif (isset($_SESSION['lang'])) {
            if (!defined('LANG')) {
                define('LANG', $_SESSION['lang']);
            }
        } elseif ($lang) {
            if (!defined('LANG')) {
                define('LANG', $lang);
            }
        } else {
            $lang = 'en';
            if (!defined('LANG')) {
                define('LANG', $lang);
            }
        }
    }

    public function loadLangs()
    {
        if (!is_dir(RESOURCES_PATH . '/langs/' . LANG)) {
            define('MESSAGES', require_once RESOURCES_PATH . '/langs/en/messages.php');
        } else {
            define('MESSAGES', require_once RESOURCES_PATH . '/langs/' . LANG . '/messages.php');
        }
    }

    public function isAjax()
    {
        if (defined('AJAX_CALL')) {
            //$this->run();

            // Load core classes
            require_once CORE_PATH . 'loader.php';
            // Load Dotenv
            $this->initDotEnv();
            // Load configuration files
            $this->loadConfigs();
            // Load HTMLPurifier
            require_once LIB_PATH . 'HTMLPurifier/HTMLPurifier.auto.php';
            // Init SSL Check
            $this->security = new Security;
            // Load Helpers
            $this->loadHelpers();
            // Init PHP
            $this->php = new Utils\PHP;
            // Init Session
            $this->session = new Utils\Session;
            // Init DB
            $this->database = new DB;
            // Init Data
            //$this->data = new Utils\Data;

            //echo 'ajax loaded';

            // Load HTMLPurifier
            require_once LIB_PATH . 'HTMLPurifier/HTMLPurifier.auto.php';
            // Load Purifier Method
            //$this->data->do('load_purifier');

            // Load Helpers
            foreach (scandir(DIRS['FRAMEWORK_PATH'] . '/Helpers/') as $filename) {
                $path = DIRS['FRAMEWORK_PATH'] . '/Helpers/' . $filename;
                if (is_file($path)) {
                    require_once $path;
                }
            }
        }
    }

    public function dispatch()
    {
        /* Load external routes file */
        require_once '../framework/routes/routes.php';

        // Start the routing
        SimpleRouter::start();
    }
}
