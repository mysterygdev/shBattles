<?php

namespace Utils;

class Cookie
{
    public static function put(string $key, $value, $time): void
    {
        setcookie($key, $value, $time, '/', null, null, true);
    }

    public static function has(string $key): bool
    {
        if (isset($_COOKIE[$key])) {
            return true;
        } else {
            return false;
        }
    }

    public static function get(string $key): string
    {
        if (isset($_COOKIE[$key])) {
            $result = $_COOKIE[$key];
            return $result;
        }
    }

    public function exists(string $key): bool
    {
        if (isset($_COOKIE[$key])) {
            return true;
        } else {
            return false;
        }
    }

    public function all($type = null)
    {
        $result = '<pre>';
        $result .= $this->variables($type, $_COOKIE);
        $result .= '</pre>';
        return $result;
    }

    public function forget(string $key): void
    {
        if (isset($_COOKIE[$key])) {
            unset($_COOKIE[$key]);
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
