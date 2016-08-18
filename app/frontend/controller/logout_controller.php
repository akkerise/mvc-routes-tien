<?php
/**
 * Created by PhpStorm.
 * User: nguyenduytien
 * Date: 8/13/16
 * Time: 5:19 PM
 */
session_start();

class logout_controller extends base_controller
{
    public function view()
    {
        unset($_SESSION['input']);
        header("Location:" . BASE_PATH . "/index");
    }
}