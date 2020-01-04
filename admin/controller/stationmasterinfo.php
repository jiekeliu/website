<?php 
header('Content-Type:text/html;Charset=utf-8');
date_default_timezone_set("PRC");
include_once "../../model/sqlfunctions.php";
$fun = new connFun;
$sta_res =$fun->stationmaster_select();
$sta_res = json_encode($sta_res);
print_r($sta_res);
?>