<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 8/10/2016
 * Time: 11:18 PM
 */
class submit_controller extends base_controller
{
    public function view()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sName = trim($_POST['sName']);
            $sCategories = trim($_POST['sCategories']);
            $sContent = $_POST['sContent'];
            $sTitle = $_POST['sTitle'];
//            ktra có tồn tại người dùng đấy ko thì ms cho post bài
            if (isset($sName)) {
                $this->loadModel('submit');
                $getExistUser = $this->model->getSubmitUserByName($sName);
                $user_ID = $getExistUser['id'];

                if (empty($user_ID)) {
                    header("Location:" . BASE_PATH . "/submit");
                    $loi[] = 'exist data';
                    $_SESSION['old']['sess_sName'] = $sName;
                    $_SESSION['old']['sess_sTitle'] = $sTitle;
                    $_SESSION['old']['sess_sContent'] = $sContent;
                    $_SESSION['old']['sess_sCategory'] = $sCategories;
                    $_SESSION['err']['wrong_existData'] = 'user name ko tồn tại';
                }

                if (empty($loi)) {
                    $success_post = $this->model->insertPost($sTitle, $sContent, $user_ID, $sCategories);
                    $this->loadView('submit', array(
                        'success_post' => $success_post
                    ));
                }
            }
        }else{
            $this->loadModel('submit');
            $result = $this->model->getAllCategories();
            $this->loadView('submit', array(
                'result' => $result
            ));

        }

    }
}
