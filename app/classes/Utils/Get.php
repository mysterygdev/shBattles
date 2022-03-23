<?php

namespace Classes\Utils;

/**
 * @author Brandon Gonzalez
 * @copyright Copyright (c) 2020, Brandon Gonzalez
 */

class Get
{

    /**
     * Creates a session variable
     *
     * @param $key
     * The key of the session
     * @param $value
     * The value of said key
     * @param $key2
     * The second key of the session (if needed)
     * @return void
     */
    public function put($key, $value, $key2 = null): void
    {
        // check if get started on each function
        // can extend this to allow as many keys as you want to without much text at all

        if (isset($_GET)) {
            if ($key2 || !empty($key2)) {
                if (!isset($_GET[$key][$key2])) {
                    $_GET[$key][$key2] = $value;
                }
            } else {
                if (!isset($_GET[$key])) {
                    $_GET[$key] = $value;
                }
            }
        }
    }

    public function has(string $key, $key2 = null): bool
    {
        if (isset($_GET)) {
            if (isset($_GET[$key])) {
                return true;
            }
            if (isset($_GET[$key2])) {
                return true;
            }
            return false;
        }
    }

    public function get(string $key, $key2 = null): string
    {
        if (isset($_GET)) {
            if ($key2) {
                if (isset($_GET[$key][$key2])) {
                    return $_GET[$key][$key2];
                }
            } else {
                if (isset($_GET[$key])) {
                    if (is_array($_GET[$key])) {
                        $result = var_dump($_GET[$key]);
                    } else {
                        $result = $_GET[$key];
                    }
                    return $result;
                }
            }
        }
    }

    public function exists(string $key): bool
    {
        if (isset($_GET)) {
            if (isset($_GET[$key])) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function all($type = null)
    {
        if (isset($_GET)) {
            $result = '<pre>';
            $result .= $this->variables($type, $_GET);
            $result .= '</pre>';
            return $result;
        }
    }

    public function forget(string $key): void
    {
        if (isset($_GET)) {
            if (isset($_GET[$key])) {
                unset($_GET[$key]);
            }
        }
    }

    public function variables($type, $vars)
    {
        switch ($type) {
            case '1':
                return var_dump($vars);
            case '2':
                return print_r($vars);
            default:
                return var_dump($vars);
        }
    }
}
