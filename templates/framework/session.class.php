<?php

class Session {
    const SESSION_STARTED = TRUE;
    const SESSION_NOT_STARTED = FALSE;

    private $sessionState = self::SESSION_NOT_STARTED;

    protected static $_session_name = '';
    protected static $instance;

    public static function getInstance() {
        self::$_session_name = get_called_class();
        if (!isset(self::$instance[self::$_session_name])) {
            self::$instance[self::$_session_name] = new self::$_session_name;
        }

        self::$instance[self::$_session_name]->startSession();
        return self::$instance[self::$_session_name];
    }

    public function startSession() {
        if ($this->sessionState == self::SESSION_NOT_STARTED) {
            if (session_status() == PHP_SESSION_NONE) {
                $this->sessionState = session_start();
            } else {
                $this->sessionState = self::SESSION_STARTED;
            }
        }
        return $this->sessionState;
    }

    public function __set($name, $value) {
        $_SESSION[$name] = $value;
    }

    public function __get($name) {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
        return null;
    }

    public function __isset($name) {
        return isset($_SESSION[$name]);
    }

    public function __unset($name) {
        unset($_SESSION[$name]);
    }

    public function destroy() {
        if ($this->sessionState == self::SESSION_STARTED) {
            $this->sessionState = !session_destroy();
            unset($_SESSION);
            return !$this->sessionState;
        }
        return FALSE;
    }
}
?>
