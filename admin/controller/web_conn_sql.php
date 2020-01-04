<?php
/*
数据库基本信息录入和网站基本表创建文件
*/
header('Content-Type:text/html;Charset=utf-8');
$hostname = $_POST['hostname'];
$dbname = $_POST['dbname'];
$username = $_POST['username'];
$pwd = $_POST['pwd'];
if ($hostname == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：主机不能为空')));
}
if ($dbname == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：数据库不能为空')));
}
if ($username == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：用户名不能为空')));
}
if ($pwd == '') {
	ob_clean();
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：密码不能为空')));
}

//数据库链接测试
/*
Class_exists():类存在性检测

*/
include_once "../../model/conn.php";
$obj = new Mysql;
if(Class_exists("Mysql")){
	if(!is_object($obj))
		exit(json_encode(array('code'=>0,'msg'=>'后台提示：obj isnot object')));
}else{
	exit(json_encode(array('code'=>0,'msg'=>'后台提示：class isnot exists')));
}
//数据库连通性测试
$mysql_conn = $obj->conn($hostname,$dbname,$username,$pwd);
if (!$mysql_conn) {
	die("could not connect to the database:\n" . mysql_error());//诊断连接错误
	exit(json_encode(array('code'=>0,'msg'=>'后台提示:'. mysql_error() )));
}else{
	//基础数据表创建
	include_once "../../model/create_tables.php";
	$Cobj = new Createtables();
	$tables_res = $Cobj->tCreate($mysql_conn);
	mysql_close($mysql_conn);
	//创建数据库链接文件sql_conn.txt
	include_once "../../model/filecontrol.php";
	$fobj = new FileControl();
	$fres = $fobj->fcrate($hostname,$dbname,$username,$pwd);
	if($fres && $tables_res){
		ob_clean();
		exit(json_encode(array('code'=>1,'msg'=>'prompt: successful creat sql_conn and data tables ,sql_conn in :'.$fres)));
	}else{
		ob_clean();
		exit(json_encode(array('code'=>0,'msg'=>'prompt: error  when create sql_conn or create data tables')));
	}
	
}


?>
