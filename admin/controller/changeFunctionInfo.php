<?php
header('Content-Type:text/html;Charset=utf-8');
date_default_timezone_set("PRC");
$fid = $_POST['fid'];
$fpid = $_POST['fpid'];
$fname = $_POST['fname'];
$furl = $_POST['furl'];
$fgrade = $_POST['fgrade'];
$fstatus = $_POST['fstatus'];
if ($fid == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：功能编号不能为空')));
}
if ($fpid == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：功能父编号不能为空')));
}
if ($fname == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：功能名不能为空')));
}
if ($furl == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：链接地址不能为空')));
}
if ($fgrade == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：功能层级不能为空')));
}
if ($fstatus == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：状态不能为空')));
}

include_once "../../model/sqlfunctions.php";
$fun = new connFun;
$fun_res =$fun->fun_update($fid, $fpid, $fname, $furl, $fgrade, $fstatus);
if($fun_res){
	exit(json_encode(array('code'=>1,'msg'=>'更新成功')));
}else{
	exit(json_encode(array('code'=>0,'msg'=>'更新失败')));
}


?>