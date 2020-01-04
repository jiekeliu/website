<?php
header('Content-Type:text/html;Charset=utf-8');
date_default_timezone_set("PRC");
include_once "../../model/sqlfunctions.php";
$fun = new connFun;
$nav_res =$fun->navigationbar_queryAll();
$nav_res = json_encode($nav_res);
print_r($nav_res);


?>