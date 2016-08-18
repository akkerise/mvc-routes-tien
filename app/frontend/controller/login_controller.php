<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 8/12/2016
 * Time: 8:55 PM
 */session_start();
include dirname(PATH_APPLICATION) . "/libs/validate.php";
include dirname(PATH_APPLICATION) . "/libs/helper.php";

class login_controller extends base_controller
{

    public function view($param = null)
    {

        $this->loadModel('login');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//            echo "<pre>"; var_dump($_SESSION); echo "</pre>";exit();
            $error = array();
            $trimName = trim($_POST['login_name']);
            $trimPass = trim($_POST['login_pass']);
            helper::oldInputLogin($trimName,$trimPass);

            $getDataByName = $this->model->getDataByName($trimName);

            if (empty($getDataByName)){ // không có user nào tồn tại
                $error = 'wrong_name';
                helper::setErr('wrong_name','Sai tên đăng nhập hoặc tên không tồn tại nhé');
            }else{ // có tồn tại r thì check pass
                if ($trimPass == $getDataByName['user_pass']){
                    helper::setMessage('login_success','Đăng Nhập Thành Công');
                    helper::okInput($getDataByName['user_name']); //để dùng cho trang chủ, thay thế đang nhập đang kí bằng welcome người dùng
                    //$test = $getDataByName['user_name'];
//                    $this->loadView('index',array(
//                        'test' => $test
//                    ));
                    header("Location:" . BASE_PATH."/login");
//                    unset($_SESSION['input']);
                }else{
                    $error = 'wrong_pass';
                    helper::setErr('wrong_pass','Pass không đúng nhé!');
                }
            }
            if (!empty($error)){
                header("Location:" . BASE_PATH . "/login");
            }
        }else{
            $this->loadView('login');
        }

    }
}








