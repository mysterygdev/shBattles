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
        // Load Vendor autoloader for Vendor resources
        require_once dirname(__DIR__) . '/vendor/autoload.php';

        $this->loader = new Loader;

        $this->init();
    }

    private function init()
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
        define('FRAMEWORK_PATH', ROOT_PATH . '/../framework' . DS);
        define('PUBLIC_PATH', 'Public' . DS);
        define('CONFIG_PATH', APP_PATH . '/../config' . DS);
        define('RESOURCES_PATH', APP_PATH . '/../resources' . DS);
        define('CONTROLLER_PATH', APP_PATH . 'controllers' . DS);
        define('MODELS_PATH', APP_PATH . 'models' . DS);
        define('WIDGETS_PATH', APP_PATH . 'widgets' . DS);
        define('VIEWS_PATH', APP_PATH . 'views' . DS);
        define('BLADE_PATH', FRAMEWORK_PATH . 'Blade' . DS);
        define('CORE_PATH', FRAMEWORK_PATH . 'Core' . DS);
        define('DB_PATH', FRAMEWORK_PATH . 'database' . DS);
        define('LIB_PATH', FRAMEWORK_PATH . 'libraries' . DS);
        define('ROUTES_PATH', FRAMEWORK_PATH . 'routes' . DS);
        define('HELPER_PATH', FRAMEWORK_PATH . 'Helpers' . DS);
        define('UPLOAD_PATH', PUBLIC_PATH . 'uploads' . DS);
        if (!defined('AJAX_CALL')) {
            // Load core classes
            require_once CORE_PATH . 'loader.php';
            // Load Dotenv
            $this->initDotEnv();
            // Load configuration files
            $this->loadConfigs();
            // Set Default Exception
            $exception = new Exception;
            set_exception_handler([$exception, 'handler']);
            // Set Timezone
            date_default_timezone_set(CONFIG['timeZone']);
            // Load HTMLPurifier
            require_once LIB_PATH . 'HTMLPurifier/HTMLPurifier.auto.php';
            // Load Stripe
            require_once LIB_PATH . 'Stripe/init.php';
            // Init SSL Check
            $this->security = new Security;
            // Load Helpers
            $this->loadHelpers();
            // Init Session
//            $this->session = new Utils\Session;
            // Init PHP
            $this->php = new Utils\PHP;
            // Init DB
            $this->database = new DB;
            // Init Settings
            $this->settings = new \Classes\Settings\Settings;
            // Init Data
            $this->data = new Utils\Data;
            // Init Paypal
            $this->paypal = new \Classes\Donate\PayPal\Paypal;
            // Init Stripe
            //$this->stripe = new \Classes\Donate\Stripe\Stripe;
            // Load Langs
            $this->getLang();
            $this->loadLangs();
            \Stripe\Stripe::setApiKey(STRIPE['secret_key']);
            //define('DOC_ROOT', dirname(dirname(__FILE__)));
            //echo 'current directory: ' . dirname(dirname(__FILE__));
        }
    }

    public function dispatch()
    {
        /* Load external routes file */
        require_once '../framework/routes/routes.php';

        // Start the routing
        SimpleRouter::start();
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
            // Init Session
            $this->session = new Utils\Session;
            // Init PHP
            $this->php = new Utils\PHP;
            // Init DB
            $this->database = new DB;
            // Init Settings
            $this->settings = new \Classes\Settings\Settings($this->session);
            // Init Data
            $this->data = new Utils\Data;

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

    public function loadConfigs()
    {
        define('APP', $this->loader->config('app'));
        define('AUTH', $this->loader->config('auth'));
        define('CONFIG', $this->loader->config('config'));
        define('DIRS', $this->loader->config('dirs'));
        define('DONATE', $this->loader->config('donate'));
        define('DB', $this->loader->config('database'));
        define('MAIL', $this->loader->config('mail'));
        define('MAPS', $this->loader->config('maps'));
        define('PAYPAL', $this->loader->config('paypal'));
        define('REGISTER', $this->loader->config('register'));
        define('SERVER', $this->loader->config('server'));
        define('STRIPE', $this->loader->config('stripe'));
        define('VOTE', $this->loader->config('vote'));
        define('WEBMALL', $this->loader->config('webmall'));
        //$this->loader->loadConfigs();
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

    public function initDotEnv()
    {
        $rootDir = dirname(dirname(__FILE__));
        $dotenv = Dotenv::createImmutable($rootDir);
        $dotenv->load();
    }
}
