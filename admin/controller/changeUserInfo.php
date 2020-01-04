<?php
header('Content-Type:text/html;Charset=utf-8');
date_default_timezone_set("PRC");
$uid = $_POST['uid'];
$uname = $_POST['uname'];
$upwd = $_POST['upwd'];
$uemail = $_POST['uemail'];
$ustatus = $_POST['ustatus'];
$Agrede = $_POST['Agrede'];
if ($uid == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：用户编号不能为空')));
}
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
if ($ustatus == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：状态不能为空')));
}
if ($Agrede == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：权限层级不能为空')));
}

include_once "../../model/sqlfunctions.php";
$fun = new connFun;
$act_res =$fun->act_update($uid,$uname,$upwd,$ustatus,$uemail);
$fun2 = new connFun;
$aut_res =$fun2->authority_update($uid, $Agrede, '3|4');

if($act_res && $aut_res){
	exit(json_encode(array('code'=>1,'msg'=>'更新成功')));
}else{
	exit(json_encode(array('code'=>0,'msg'=>'更新失败')));
}

?>