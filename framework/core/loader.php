<?php

namespace Framework\Core;

use App\Exceptions;

class Loader
{
    public $configs = [
        'app',
        'auth',
        'config',
        'database',
        'dirs',
        'donate',
        'mail',
        'maps',
        'paypal',
        'register',
        'server',
        'stripe',
        'webmall',
    ];
    public $helpers = [
        'abort',
        'lang',
        'modal',
        'redirect',
        'select',
        'table',
        'template',
        'translate',
        'url'
    ];

    // Load config files
    public function config($config, $path = false)
    {
        if (!$path) {
            $path = '';
        }
        if (file_exists(CONFIG_PATH . $path . '/' . $config . '.php')) {
            return require_once CONFIG_PATH . $path . '/' .  $config . '.php';
        } else {
            throw new Exceptions\ConfigException;
        }
    }

    public function loadFilesFromDir($path, $type, $array, $recursive = false)
    {
        if (!is_dir($path)) {
            return false;
        }
        $all_dir_files = scandir($path);
        foreach ($all_dir_files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            if (is_dir($path . '/' . $file) && $recursive) {
                $this->loadFilesFromDir($path . '/' . $file, $type, $array, $recursive);
            } else {
                $fileName = basename($file, '.php');
                $fileName = strtoupper($fileName);
                $fullPath = $path . $file;
                if ($type == 'helper') {
                    if ($array) {
                        //if array provided we load from array, if not we load all
                        if (in_array(basename($file, '.php'), $array)) {
                            include $fullPath;
                        }
                    } else {
                        include $fullPath;
                    }
                } elseif ($type == 'config') {
                    if ($array) {
                        //if array provided we load from array, if not we load all
                        if (in_array(basename($file, '.php'), $array)) {
                            if ($file == 'database.php') {
                                define('DB', require_once $fullPath);
                            } else {
                                define($fileName, require_once $fullPath);
                            }
                        }
                    } else {
                        if ($file == 'database.php') {
                            define('DB', require_once $fullPath);
                        } else {
                            define($fileName, require_once $fullPath);
                        }
                    }
                }
            }
        }
        return true;
    }

    public function ifArray($array, $file, $do)
    {
        if ($array) {
            //if array provided we load from array, if not we load all
            if (in_array(basename($file, '.php'), $array)) {
                $do;
            }
        } else {
            $do;
        }
    }

    public function loadConfigs()
    {
        $this->loadFilesFromDir(CONFIG_PATH, 'config', $this->configs, true);
    }

    // Load library classes
    public function library($lib)
    {
        //echo 'Loading lib ('.$lib.')..<br>';
        if (file_exists(LIB_PATH . $lib . '.class.php')) {
            include LIB_PATH . $lib . 'class.php';
        }
    }

    // loader helper functions. Naming conversion is xxx.php;
    public function helper($helper)
    {
        //echo 'Loading helper ('.$helper.')..<br>';
        if (file_exists(HELPER_PATH . $helper . '.php')) {
            include HELPER_PATH . $helper . '.php';
        } else {
            throw new Exceptions\HelperException;
        }
    }

    public function loadHelpers()
    {
        $this->loadFilesFromDir(HELPER_PATH, 'helper', $this->helpers, true);
    }
}
