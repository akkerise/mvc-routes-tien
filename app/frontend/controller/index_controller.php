<?php

/**
 * Created by PhpStorm.
 * User: Nimo
 * Date: 08/08/2016
 * Time: 8:23 CH
 */
session_start();
class index_controller extends base_controller
{
    public function view()
    {
        $limit = 4;
        $this->loadModel('index'); //load model
        $total_post = $this->model->totalPost()['total'];// tính tổng số bài trên csdl
        $total_page = ceil($total_post / $limit);// tính xem nếu 4 bài 1 trang thì sẽ có bnhieu trang

        if (isset($_GET['page']) ) { //xem người dùng có nhập gì vào thanh url đằng sau index.php ko
//            nếu có giá trị nhập vào thì ktra xem có phải là 1 số nguyên dương ko, và số đấy có nhỏ hơn tổng số page mình có ko
            if (filter_var($_GET['page'],FILTER_SANITIZE_NUMBER_INT) && $_GET['page']<= $total_page){
                $result = $this->model->getDataByPage($limit, $_GET['page']); //chạy model để lấy dữ liệu ra
            }else{
                header("Location:" . BASE_PATH . "/p404"); // nhập vào ko phải là số thì đẩy vè trang 404
            }
        } else{
            $result = $this->model->getDataByPage($limit,1); //còn nếu mà ko nhập gì thì n sẽ tự động là trang 1
        }

        $this->loadView('index', array( //load các dữ liệu vừa lấy ra và đẩy vào VIEW
            'result' => $result,
            'title' => 'Tien dep trai vice car lone',
            'description' => "Fap The World???",
            'current_page' => isset($_GET['page']) ? $_GET['page'] : 1,
            'total_page' => $total_page
        ));
    }

}