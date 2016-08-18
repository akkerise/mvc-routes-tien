<?php

/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 8/9/16
 * Time: 10:17 AM
 */
class helper
{
    static function setErr($name, $value)
    {
        $_SESSION['err'][$name] = $value;
    }

    static function setInput($name, $value)
    {
        $_SESSION['input'][$name] = $value;
    }

    static function setMessage($name, $value)
    {
        $_SESSION['mess'][$name] = $value;
    }

    static function oldInputLogin($name, $pass)
    {
        self::setInput('old_username', $name);
        self::setInput('old_password', $pass);
    }

    static function oldInputRegister($name, $pass, $repeat_pass, $email)
    {
        self::setInput('old_usernameR', $name);
        self::setInput('old_passwordR', $pass);
        self::setInput('old_repeat_passwordR', $repeat_pass);
        self::setInput('old_emailR', $email);
    }

    static function okInput($ok_login_user)
    {
        self::setInput('ok_login_user',$ok_login_user);
    }
    static function okRegister($ok_register_user)
    {
        self::setInput('ok_login_user',$ok_register_user);
    }
}