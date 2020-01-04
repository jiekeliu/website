<?php
header('Content-Type:text/html;Charset=utf-8');
date_default_timezone_set("PRC");
$father_id = $_POST['father_id'];
$tname = $_POST['tname'];
$turl = $_POST['turl'];
if ($father_id == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：父编号不能为空')));
}
if ($tname == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：名称不能为空')));
}
if ($turl == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：链接地址不能为空')));
}

include_once "../../model/sqlfunctions.php";
$fun = new connFun;
$nav_res =$fun->navigationbar_insert($father_id, $tname, $turl);
if($nav_res){
	exit(json_encode(array('code'=>1,'msg'=>'添加成功')));
}else{
	exit(json_encode(array('code'=>0,'msg'=>'添加失败')));
}

?>