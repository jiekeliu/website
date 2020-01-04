<?php
header('Content-Type:text/html;Charset=utf-8');
date_default_timezone_set("PRC");
$uname = $_POST['uname'];
$upwd = $_POST['upwd'];
$uemail = $_POST['uemail'];
$Agrede = $_POST['Agrede'];
if ($uname == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：用户名不能为空')));
}
if ($upwd == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：密码不能为空')));
}
if ($uemail == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：邮箱不能为空')));
}
if ($Agrede == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：权限层级不能为空')));
}
$utime = date('Y-m-d', time());
include_once "../../model/sqlfunctions.php";
$fun = new connFun;
$act_res =$fun->act_insert($uname,$upwd,$utime,$uemail);

$fun3 = new connFun;
$act_res2 =$fun3->act_queryByEmail($uemail);
//print_r($act_res2->getUid());

$fun2 = new connFun;
$aut_res =$fun2->authority_insert($Agrede, $act_res2->getUid(), '3|4');

if($act_res && $aut_res){
	exit(json_encode(array('code'=>1,'msg'=>'更新成功')));
}else{
	exit(json_encode(array('code'=>0,'msg'=>'更新失败')));
}

?>