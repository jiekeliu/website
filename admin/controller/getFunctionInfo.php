<?php
header('Content-Type:text/html;Charset=utf-8');
date_default_timezone_set("PRC");
include_once "../../model/sqlfunctions.php";
$fun = new connFun;
$fun_res =$fun->fun_queryAll();

$arr = [];
for($i=0; $i<count($fun_res);$i++ ){
	$j = (int)$i/10+1;
	$arr[$j][$i%10] = $fun_res[$i];
}
$arr = json_encode($arr);
print_r($arr);
?>