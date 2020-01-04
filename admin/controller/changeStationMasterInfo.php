<?php
header('Content-Type:text/html;Charset=utf-8');
date_default_timezone_set("PRC");
$name = $_POST['name'];
$age = $_POST['age'];
$rfs = $_POST['rfs'];
$profession = $_POST['profession'];
$like = $_POST['like'];
$specialty = $_POST['specialty'];
$pac = $_POST['pac'];
$plan = $_POST['plan'];
$selfintro = $_POST['selfintro'];
if ($name== '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：名称不能为空')));
}
if ($age == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：年龄不能为空')));
}
if ($rfs == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：学历不能为空')));
}
if ($profession == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：专业不能为空')));
}

include_once "../../model/sqlfunctions.php";
$fun = new connFun;
$sta_res =$fun->stationmaster_update($name, $age, $rfs, $profession, $like, $specialty, $pac, $plan, $selfintro);
if($sta_res){
	exit(json_encode(array('code'=>1,'msg'=>'更新成功')));
}else{
	exit(json_encode(array('code'=>0,'msg'=>'更新失败')));
}

?>