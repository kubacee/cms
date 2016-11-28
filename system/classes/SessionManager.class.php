<?php

/**
 * Session names
 *
 *
 * Class Session
 */
class SessionManager
{
    public static function start() {
        if (session_id() == '' || !isset($_SESSION)) {
            session_start();
            session_regenerate_id();
        }
    }

    public static function get($sessionName) {
        if (self::is($sessionName)) {
            return $_SESSION[$sessionName];
        } else {
            return false;
        }
    }

    public static function set($sessionName, $value) {
        self::start();

        $_SESSION[$sessionName] = $value;
    }

    public static function is($sessionName) {
        self::start();

        return isset($_SESSION[$sessionName]);
    }

    public static function clear() {
        self::start();

//        session_start();
        $_SESSION = array();
    }

    public static function destroy() {
        self::start();
        session_destroy();
    }

    public static function name($sessionName) {
        self::start();
        session_name($sessionName);
    }
}