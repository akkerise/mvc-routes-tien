<?php

/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 8/8/16
 * Time: 10:25 AM
 */
class validate
{
    static function validUser($user)
    {
        $pattern = "/^[a-zA-Z0-9]{6,18}$/";
        if (preg_match($pattern, $user)) {
            return true;
        } else {
            return false;
        }
    }

    static function validPass($pass)
    {
        $pattern = "/^[a-zA-Z0-9]{6,32}$/";
        if (preg_match($pattern, $pass)) {
            return true;
        } else {
            return false;
        }
    }

    static function validEmail($email)
    {
        if (filter_var($email,FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }

}



















