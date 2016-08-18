<?php
/**
 * Created by PhpStorm.
 * User: Nimo
 * Date: 07/08/2016
 * Time: 10:08 CH
 */

//Thong so ve database
define("DB_TYPE",'mysql');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_DBNAME', 'blog');


define('PATH_APPLICATION', __DIR__ . "/app"); //trả về full đường dẫn của file và trừ thằng tên file ra cho đến app

define('BASE_PATH',"http://localhost/mvc-routes");

define('ENVIRONMENT', 'development');//đặt 1 biến là hằng environment
//mai sau chyaj song r đổi development sang 1 cái bất kì thì sẽ chyaj v false và ẩn lỗi đi
if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
    error_reporting(E_ALL);  // xuất tất cả các lỗi, tuỳ chọn hiển thị lỗi hay ko, E_WARNING
    ini_set("display_errors", 1); // hiện lỗi
} else {
    error_reporting(0);
    ini_set("display_errors", 0);
}

