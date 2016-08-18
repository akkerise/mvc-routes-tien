<?php

/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 8/8/16
 * Time: 11:26 AM
 */
class application
{
    private $controller;
    private $action = 'view';
    private $param;
    private $request_path = array();

    public function __construct()
    {

        $this->request_path = $this->request_path();
        $this->splitURL();// lấy ra các param cắt = dấu sược /


        $controller = empty($this->controller) ? 'index' : $this->controller; // nếu ko có controller thì sẽ là trang index luôn

        $controller = strtolower($controller) . "_controller"; // nối chuỗi vào controller để tìm ra có controller ko

        //KIEM TRA FILE CO TON TAI HAY KHONG?
//        echo "<pre>";var_dump($this->param);echo "</pre>"; exit;

        if (!file_exists(PATH_APPLICATION . "/frontend/controller/" . $controller . ".php")) { // ktra có hay ko
            header("Location:" . BASE_PATH . "/p404"); // ko có chuyển sang 404
        }

        require PATH_APPLICATION . "/frontend/controller/" . $controller . ".php"; // nếu có thì gọi REQUIRE vào

        $controllerObj = new $controller(); // khởi tạo obj mới
        // KIEM TRA XEM CLASS CO TON TAI HAY KHONG?
        if (!class_exists($controller)) { // ktra xem có class đấy ko
            header("Location:" . BASE_PATH . "/p404"); // đ có thì về 404
        }


        //Kiem tra xem method co ton tai hay ko?
        if (method_exists($controller, $this->action)) { //action của ng dùng mặc định là view // admin thì có thêm edit them sưa xóa.
            if (!empty($this->param)) {  // ktra có tham số truyền vào url hay ko

//                echo "<pre>"; var_dump($this->param); echo "</pre>";exit();
                call_user_func_array(array($controllerObj, $this->action), $this->param); // gọi phương thức action trong obj vs tham số param truyền vào -> chuyển ra trang chi tiết
            } else {
                $controllerObj->{$this->action}(); // về trang dsach
            }
        } else {
            header("Location:" . BASE_PATH . "/p404");
        }


    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getParam()
    {
        return $this->param;
    }

    /**
     * @return array|string
     */
    public function getRequestPath()
    {
        return $this->request_path;
    }


    private function request_path()
    {
        $request_uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $script_name = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'));
        $parts = array_diff_assoc($request_uri, $script_name);
        if (empty($parts) && empty($parts[0])) {
            return '/';
        }
        $path = implode('/', $parts);
//       strpos tìm thằng ? trong chuỗi path vừa cắt và nối dc
        if (($position = strpos($path, '?')) !== FALSE) {
//            nếu mà tìm thấy thằng ? trong chuỗi $path thì ...
//      substr cắt chuỗi, cắt từ vị trí
            $path = substr($path, 0, $position);
        }
        return $path;
    }


    private function splitURL()
    {
        if (empty($this->request_path)) {
            $this->controller = null;
            $this->param = null;
        } else {
            $url = $this->request_path; // truyen $url la doan url cat dc
            $url = filter_var($url, FILTER_SANITIZE_URL); // kiem tra voi filter
            $url = explode("/", $url); // cat theo dau / de lay gia tri
            $this->controller = isset($url[0]) ? $url[0] : null; // dau tien se la controller xu ly
//            $this->action = isset($url[1]) ? $url[0] : null; // tiep theo la action
            unset($url[0]); // cat controller ra khoi mang

            $this->param = array_values($url);
        }

    }
}