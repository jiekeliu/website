<?php
header('Content-Type:text/html;Charset=utf-8');
date_default_timezone_set("PRC");
$tid = $_POST['tid'];
if ($tid == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：编号错误')));
}
include_once "../../model/sqlfunctions.php";
$fun = new connFun;
$nav_res =$fun->navigationbar_delete($tid);
if($nav_res){
	exit(json_encode(array('code'=>1,'msg'=>'删除成功')));
}else{
	exit(json_encode(array('code'=>0,'msg'=>'删除失败')));
}
?>