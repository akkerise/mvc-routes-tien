<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 8/11/2016
 * Time: 11:25 AM
 */
class search_controller extends base_controller
{
    public function view(){
        $this->loadModel('search');
        if (isset($_GET['search_name'])){
            $limit = 10;

            if (isset($_GET['page'])) {
                $search = $this->model->searchProName($_GET['search_name'],$limit,$_GET['page']);
                $key = $_GET['search_name'];
                $total_post = count($search);
                $total_page = ceil($total_post / $limit);
            } else {
                $search = $this->model->searchProName($_GET['search_name'],$limit,$page = 1);
                $total_post = count($search);
                $total_page = ceil($total_post / $limit);
                $key = $_GET['search_name'];
            }
//            var_dump($search);exit();
            $this->loadView('search', array(
                'result' => $search,
                'title' => 'Tien dep trai vice car lone',
                'description' => "Fap The World???",
                'current_page' => isset($_GET['page']) ? $_GET['page'] : 1,
                'total_page' => $total_page,
                'key' => $key
            ));
        }


    }
}

?>