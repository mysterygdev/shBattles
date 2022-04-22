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

    public static function exists(string $key): bool
    {
        if (isset($_COOKIE[$key])) {
            return true;
        } else {
            return false;
        }
    }

    public static function forget(string $key): void
    {
        if (isset($_COOKIE[$key])) {
            unset($_COOKIE[$key]);
        }
    }

    public static function variables($type, $vars)
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
