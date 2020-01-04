<?php
/*
网站基本信息录入和站长基本信息处理文件
*/
header('Content-Type:text/html;Charset=utf-8');
date_default_timezone_set("PRC");
$uname = $_POST['uname'];
$upwd = $_POST['upwd'];
$uemall = $_POST['uemall'];
$web_name = $_POST['web_name'];
if ($uname == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：用户名不能为空')));
}
if ($upwd == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：密码不能为空')));
}
if ($uemall == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：邮箱不能为空')));
}
if ($web_name == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：网站名称不能为空')));
}
$utime = date('Y-m-d', time());
include_once "../../model/sqlfunctions.php";
$fun1 = new connFun;
$act_res =$fun1->act_insert($uname,$upwd,$utime,$uemall);

$fun2 = new connFun;
$fon_res =$fun2->fontsetting_insert($web_name,' ',' ');

$fun3 = new connFun;
$fun_res1 = $fun3->fun_insert(0,"用户管理","userManage.html",1);

$fun4 = new connFun;
$fun_res2 = $fun4->fun_insert(0,"功能管理","functionManage.html",1);

$fun5 = new connFun;
$fun_res3 = $fun5->fun_insert(0,"网站管理","websiteManage.html",1);

$fun6 = new connFun;
$fun_res4 = $fun6->fun_insert(0,"站长信息","stationMasterInfo.html",1);

$fun7 = new connFun;
$stt_res = $fun7->stationmaster_insert();

$fun8 = new connFun;
$aut_res = $fun8->authority_insert(1, 1, '1|2|3|4');
//var_dump($act_res);

if(act_res && $fon_res && fun_res1 && fun_res2 && fun_res3 && fun_res4 && $stt_res && $aut_res){
	ob_clean();
	exit(json_encode(array('code'=>1,'msg'=>'all ready')));
}else{
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'exists error')));
}


?>
