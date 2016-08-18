<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 8/12/2016
 * Time: 11:23 PM
 */
session_start();
include dirname(PATH_APPLICATION) . "/libs/validate.php";
include dirname(PATH_APPLICATION) . "/libs/helper.php";

class register_controller extends base_controller
{
    public function view()
    {
        $this->loadModel('login');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $error = array();
            $trim_name = trim($_POST['register_name']);
            $trim_pass = trim($_POST['register_pass']);
            $trim_repeat_pass = trim($_POST['register_repeat_pass']);
            $trim_email = trim($_POST['register_email']);
            helper::oldInputRegister($trim_name, $trim_pass, $trim_repeat_pass, $trim_email);

            $getDataByName = $this->model->getDataByName($trim_name);
            $getDataByEmail = $this->model->getDataByEmail($trim_email);
            if (!validate::validUser($trim_name)) {
                $error[] = 'wrong_name';
                helper::setErr('wrong_nameR', 'Tên đăng nhập sai định dạng nhé');
            } else {
                if (!empty($getDataByName)) {
                    $error[] = 'exist_username';
                    helper::setErr('exist_name', 'Tên đăng nhập đã tồn tại nhé');
                }
            }
            if (!validate::validPass($trim_pass)) {
                $error[] = 'wrong_pass';
                helper::setErr('wrong_passR', 'Password sai định dạng nhé!!');
            } else {
                if ($trim_pass != $trim_repeat_pass) {
                    $error[] = 'wrong_repeat_passR';
                    helper::setErr('wrong_repeat_pass', 'Pass nhập lại không đúng');
                }
            }
            if (!validate::validEmail($trim_email)){
                $error[] = 'wrong_email';
                helper::setErr('wrong_emailR','Email sai định dạng nhé!!!');
            }else{
                if (!empty($getDataByEmail)) {
                    $error[] = 'exist_email';
                    helper::setErr('exist_email', 'Email đã tồn tại nhé');
                }
            }


            if (empty($error)){
                $md5_trim_pass = md5($trim_pass);
                $this->model->insertRegister($trim_name,$md5_trim_pass,$trim_email);
                helper::setMessage('register_success','Đăng Kí Thành Công Rồi Nhé!!');
                header("Location:" . BASE_PATH . "/login");
                helper::okInput('ok_register_user',$trim_name);
            }else{
                header("Location:" . BASE_PATH . "/login");
            }
        }else{
            $this->loadView('login');
        }
    }
}
