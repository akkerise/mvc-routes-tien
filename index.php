<?php
/**
 * Created by PhpStorm.
 * User: Nimo
 * Date: 07/08/2016
 * Time: 8:01 CH
 */
include "config.php";

include "libs/bootstrap.php";

$admin_pattern = "/(\/admin).$/";


if (preg_match($admin_pattern, $_SERVER['REQUEST_URI'])){
    $app = new application_admin();
}else{
    $app = new application();
}
