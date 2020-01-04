<?php
header('Content-Type:text/html;Charset=utf-8');
include_once "../../model/sqlfunctions.php";
$fun = new connFun;
$fon_res =$fun->navigationbar_queryAll();
$fon_res = json_encode($fon_res);
//var_dump();
print_r($fon_res);
//echo $fon_res[0]['web_name'];

?>