<?php
header('Content-Type:text/html;Charset=utf-8');
$uname = $_POST['uname'];
$upwd = $_POST['upwd'];
if ($uname == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：用户名不能为空')));
}
if ($upwd == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：密码不能为空')));
}
include_once "../../model/sqlfunctions.php";
$fun = new connFun;
$act_res =$fun->act_queryByName($uname);
if($act_res){
	if($act_res->getUpwd()==$upwd){
		setcookie("url","../../admin/view/index.html",time()+36000,"/");
		setcookie("unameid",$act_res->getUid(),time()+36000,"/");
		exit(json_encode(array('code'=>1,'msg'=>'后台提示：登录成功')));
	}else{
		exit(json_encode(array('code'=>0,'msg'=>'后台提示：密码不正确')));
	}
}else{
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：用户不存在')));
} 



 ?>