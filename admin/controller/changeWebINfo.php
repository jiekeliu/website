<?php
header('Content-Type:text/html;Charset=utf-8');
date_default_timezone_set("PRC");
$web_name = $_POST['web_name'];
$webimg_url = $_POST['webimg_url'];
$webfooter_info = $_POST['webfooter_info'];
if ($web_name== '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：网站名称不能为空')));
}
if ($webimg_url == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：网站图标不能为空')));
}
if ($webfooter_info == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：备注信息为空')));
}

include_once "../../model/sqlfunctions.php";
$fun = new connFun;
$fon_res =$fun->fontsetting_update($web_name,$webimg_url,$webfooter_info);
if($fon_res){
	exit(json_encode(array('code'=>1,'msg'=>'更新成功')));
}else{
	exit(json_encode(array('code'=>0,'msg'=>'更新失败')));
}

?>