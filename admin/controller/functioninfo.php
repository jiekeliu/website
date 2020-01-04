<?php 
header('Content-Type:text/html;Charset=utf-8');
date_default_timezone_set("PRC");
include_once "../../model/sqlfunctions.php";
$uid = $_COOKIE["unameid"];
$fun = new connFun;
$fun_res =$fun->fun_queryByUid($uid);
$fun_res = json_encode($fun_res);
print_r($fun_res);
?>