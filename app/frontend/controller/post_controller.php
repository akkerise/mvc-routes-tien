<?php

/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 8/8/16
 * Time: 2:35 PM
 */
class post_controller extends base_controller
{
    public function view($param = null)
    {
        if (empty($param)) {
            $this->loadModel('page');
            if (!isset($_GET['page'])) {
                $page = 1;
            } else {
                if (!filter_var($_GET['page'], FILTER_SANITIZE_STRING)) {
                    header("Location:" . BASE_PATH . "/p404");
                } else {
                    $page = $_GET['page'];
                }
            }

            $getDataByPage = $this->model->getDataByPage($page);

            $this->loadView('index', array(
                'data' => $getDataByPage,
                'current_page' => isset($_GET['page']) ? $_GET['page'] : 1
            ));
        } else {
//            Xử lí param trước
            if (!filter_var($param, FILTER_SANITIZE_NUMBER_INT)) {
                header("Location:" . BASE_PATH . "/p404");
            } else {
                $this->loadModel('post');
                $result = $this->model->getDataById($param);
                $this->loadView('detail-post', array(
                    'data' => $result
                ));
            }
        }
    }
}