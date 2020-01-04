<?php 
header('Content-Type:text/html;Charset=utf-8');
date_default_timezone_set("PRC");
include_once "../../model/sqlfunctions.php";
$fun = new connFun;
$act_res =$fun->act_queryAll();

$arr = [];
for($i=0; $i<count($act_res);$i++ ){
	$j = (int)$i/10+1;
	$arr[$j][$i%10] = $act_res[$i]->getAll();
	$fun = new connFun;
	$aut_res =$fun->authority_queryByUid($act_res[$i]->getUid());
	//print_r($aut_res[0]);
	$arr[$j][$i%10]['Agrede'] = $aut_res[0]['Agrede'];
}
$arr = json_encode($arr);
print_r($arr);

?> 