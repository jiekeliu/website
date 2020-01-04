<?php
header('Content-Type:text/html;Charset=utf-8');
date_default_timezone_set("PRC");
$uid = $_POST['uid'];
if ($uid == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：用户编号不能为空')));
}
include_once "../../model/sqlfunctions.php";
$fun = new connFun;
$act_res =$fun->act_delete($uid);
if($act_res){
	exit(json_encode(array('code'=>1,'msg'=>'删除成功')));
}else{
	exit(json_encode(array('code'=>0,'msg'=>'删除失败')));
}
?>