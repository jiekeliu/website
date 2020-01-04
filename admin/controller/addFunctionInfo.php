<?php
header('Content-Type:text/html;Charset=utf-8');
date_default_timezone_set("PRC");
$fpid = $_POST['fpid'];
$fname = $_POST['fname'];
$furl = $_POST['furl'];
$fgrade = $_POST['fgrade'];
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

include_once "../../model/sqlfunctions.php";
$fun = new connFun;
$fun_res =$fun->fun_insert($fpid, $fname, $furl, $fgrade);

//权限更改
$fun2 = new connFun;
$fun_res2 =$fun2->fun_queryAll();
$Fid_having ='';
for($i=0; $i<count($fun_res2);$i++ ){
	$strnum = strval($fun_res2[$i]['fid']);
	$Fid_having .= $strnum.'|';
}
$Fid_having = substr($Fid_having, 0, -1);
$fun3 = new connFun;
$aut_res =$fun3->authority_update(1, 1, $Fid_having);

if($fun_res && $aut_res){
	exit(json_encode(array('code'=>1,'msg'=>'添加成功')));
}else{
	exit(json_encode(array('code'=>0,'msg'=>'添加失败')));
}

?>