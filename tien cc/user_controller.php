<?php

/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 8/13/16
 * Time: 9:34 AM
 */
class user_controller extends base_controller
{       //de hien thi ra danh sach nguoi dung
    function view()
    {
       if (isset($_SESSION['admin'])){
           // goi model day ra (user_admin_model)
           $this->loadModel('user_admin');

           $data = $this->model->getAllUser();


           $this->loadAdminView('list_user', array(
               'data' => $data
           )); //load view xem co load dc view hay ko

       }
    }
    function edit($id)//load du lieu cua nguoi dung + form de chinh sua
    {
        if (isset($_SESSION['admin'])){

            $this->loadModel('user_admin');

            $result = $this->model->getUserById($id);
//            echo "<pre>";var_dump($result); echo "</pre>"; exit;

            $this->loadAdminView('edit_user',array(
                'data' => $result
            ));


        }else{
            header('Location:'.BASE_PATH.'/admin/login');
        }
    }

    function update($id)//chinh sua du lieu cua database
    {
        if (isset($_SESSION['admin'])){

            if ($_SERVER['REQUEST_METHOD'] === 'POST'){
//                echo "<pre>";var_dump($_POST); echo "</pre>"; exit;
                if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['repassword'])){
                    //dk dung o day
                    $flag = 1; //co dung la 1 con khac 1 la sai

                    //kiem tra dau vao user name
                    if (Validation::isValidUser($_POST['username'])){
                        $username = $_POST['username'];
                    }else{
                        $flag=0;
                        Helper::setError('username', "username deo dung chuan");
                    }

                    //kiem tra dau vao cua email
                    if (filter_var($_POST['email'],FILTER_SANITIZE_EMAIL)){
                        $email = $_POST['email'];
                    }else {
                        $flag = 0;
                        Helper::setError('email', "email co me no roi");
                    }

                    //kiem tra password
                    if (Validation::isValidPass($_POST['password'])){
                        $password = $_POST['password'];
                    }else{
                        $flag = 0;
                        Helper::setError('password', "password ngu vcl");
                    }

                    //kiem tra repassword
                    if (Validation::isValidPass($_POST['repassword'])){
                        $repassword = $_POST['repassword'];
                    }else{
                        $flag = 0;
                        Helper::setError('repassword',  'deo nho pass ah may');
                    }

                    if ($_POST['password'] !== $_POST['repassword']){
                        $flag = 0;
                        Helper::setError('repass danh lai ma cung deo xong ah');
                    }

                    if ($flag != 1 ){
                        header('Location:'.BASE_PATH."/admin/user/edit/".$id);
                    }else {
                        $this->loadModel('user_admin');
                    
                        $data = $this->model->getUserByID($id);

                        $check = 1;
                        
                        //kiem tra username ton tai
                        if ($username !== $data['user_name']){// kiem tra ten da sua xem co trong database chua
                            if ($this->model->checkUserExist($username)){
                                $check = 0; //neu co thang user nao giong roi thi chuyen co
                                Helper::setError('username', "Trung username nhe");
                            }
                        }

                        //kiem tra email ton tai
                        if ($email !== $data['user_email']){// kiem tra email da sua xem co trong database chua 
                            if ($this->model->checkEmailExist($email)){
                                $check = 0; 
                                Helper::setError('email', "Trung email nhe");
                            }
                        }
                        
                        if ($check != 1){
                            header('Location:'.BASE_PATH."/admin/user/edit/".$id);
                        }else {
                            $password = password_hash($password, PASSWORD_BCRYPT);// ma hoa pass
                            $result = $this->model->updateUser($username,$password,$email,$id);
                            if ($result){
                                Helper::setMes('update', "Thanh con me no cong roi nhe");
                            }else{
                                Helper::setError('update', "deo update dc nhe");
                            }
                            header('Location:'.BASE_PATH."/admin/user/edit/".$id);
                        }

                    }




                }else{
                    //dk sai o day
                    die("Thieu roi anh oi");
                }

            }else{
                die('wrong method');
            }

        }else{
            header('Location:'.BASE_PATH.'/admin/login');
        }
    }
    function delete($id)
    {
        if (isset($_SESSION['admin'])){
            $this->loadModel('user_admin');
            $result = $this->model->deleteUserById($id);
            if ($result) {
//                echo "<pre>";var_dump('xoa dc roi nhe'); echo "</pre>"; exit;
                Helper::setMes('delete',"xoa tai khoan co ID la ".$id." ");
//                $_SESSION['mes']['delete'] // goi session
                header('Location:'.BASE_PATH.'/admin/user');
            }else {
                echo "<pre>";var_dump('xit me roi'); echo "</pre>"; exit;

            }
        }else {
            header('Location:'.BASE_PATH.'/admin/login'); //Neu ko phai la admin thi chuyen ra trang dang ky
        }
    }

}