<?php 
header('Content-Type:text/html;Charset=utf-8');
date_default_timezone_set("PRC");
include_once "../../model/sqlfunctions.php";
$fun = new connFun;
$fon_res =$fun->fontsetting_select();
$fon_res = json_encode($fon_res);
print_r($fon_res);
?>