<?php

namespace Classes\Utils;

use Classes\Utils\Data;
use Classes\Utils\Cookie;

/**
 * @author Brandon Gonzalez
 * @copyright Copyright (c) 2020, Brandon Gonzalez
 */

class Session
{
    private $sessionName;
    private $name = APP['sessionName'];
    protected $referer;

    public function __construct()
    {
        $this->data = new Data();
        $this->cookie = new Cookie();
        if (!isset($_SESSION)) {
            // Start our session
            if (!empty($name)) {
                session_name($this->name);
            } else {
                session_name('Default');
            }
            session_start();
            if (!empty($name)) {
                setcookie($this->name, session_id(), 0, '/', null, null, true);
            } else {
                setcookie('Default', session_id(), 0, '/', null, null, true);
            }
        }
        $this->sessionName = $this->name;
    }

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
        // check if session started on each function
        // can extend this to allow as many keys as you want to without much text at all

        if (isset($_SESSION)) {
            if (session_name() === $this->sessionName) {
                if ($key2 || !empty($key2)) {
                    if (!isset($_SESSION[$key][$key2])) {
                        $_SESSION[$key][$key2] = $value;
                    }
                } else {
                    if (!isset($_SESSION[$key])) {
                        $_SESSION[$key] = $value;
                    }
                }
            }
        }
    }

    public function regenerate(): void
    {
        if (isset($_SESSION)) {
            if (session_name() === $this->sessionName) {
                session_regenerate_id(true);
            }
        }
    }

    public function has(string $key, $key2 = null): bool
    {
        if (isset($_SESSION)) {
            if (session_name() === $this->sessionName) {
                if (isset($_SESSION[$key])) {
                    return true;
                }
                if (isset($_SESSION[$key2])) {
                    return true;
                }
                return false;
            }
        }
    }

    public function get(string $key, $key2 = null): string
    {
        if (isset($_SESSION)) {
            if (session_name() === $this->sessionName) {
                if ($key2) {
                    if (isset($_SESSION[$key][$key2])) {
                        return $_SESSION[$key][$key2];
                    }
                } else {
                    if (isset($_SESSION[$key])) {
                        if (is_array($_SESSION[$key])) {
                            $result = var_dump($_SESSION[$key]);
                        } else {
                            $result = $_SESSION[$key];
                        }
                        return $result;
                    }
                }
            }
        }
    }

    public function exists(string $key): bool
    {
        if (isset($_SESSION)) {
            if (session_name() === $this->sessionName) {
                if (isset($_SESSION[$key])) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    public function all($type = null)
    {
        if (isset($_SESSION)) {
            if (session_name() === $this->sessionName) {
                $result = '<pre>';
                $result .= $this->variables($type, $_SESSION);
                $result .= '</pre>';
                return $result;
            }
        }
    }

    public function forget(string $key): void
    {
        if (isset($_SESSION)) {
            if (session_name() === $this->sessionName) {
                if (isset($_SESSION[$key])) {
                    unset($_SESSION[$key]);
                }
            }
        }
    }

    public function flush(): void
    {
        if (isset($_SESSION)) {
            if (session_name() === $this->sessionName) {
                session_unset();
                session_destroy();
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

    public function getReferer()
    {
        if ($this->cookie->has('referer')) {
            return $this->cookie->get('referer');
        } else {
            return '/';
        }
    }

    public function setReferer()
    {
        $this->referer = $_SERVER['REQUEST_URI'];
        //echo 'ref: '.$this->referer;
        if ($this->referer === '/community/getRankings') {
            $this->referer = '/community/rankings';
        } else {
            $this->referer = $_SERVER['REQUEST_URI'];
        }
        $this->cookie->put('referer', $this->referer, time() + 100, '/');
    }
}
