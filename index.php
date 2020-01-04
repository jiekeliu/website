<?php
/*
文件概述：index.PHP为数据库文件的检测文件和域名重定向文件

$dpath:当前文件所在文件夹地址
$sql_conn：数据库链接文件
file_exists($sql_conn)：检测文件是否存在
Header("Location:$url"):域名重定向
*/
$dpath = dirname(__FILE__);
$sql_conn = $dpath."/sql_conn.txt";
if(file_exists($sql_conn)){
	include_once "model/conn.php";
	$obj = new Mysql;
	if(Class_exists("Mysql")){   //检测数据库链接类是否存在
		if(!is_object($obj))
			exit(json_encode(array('code'=>0,'msg'=>'后台提示：obj isnot object')));
	}else{
		exit(json_encode(array('code'=>0,'msg'=>'后台提示：class isnot exists')));
	}
	 $mysql_conn = $obj->sucessConn();
	 
	 if (!$mysql_conn) {   //检测数据库链接是否正确
		die("could not connect to the database_index:\n" . mysql_error());//诊断连接错误
		Header("Location:web_conn_sql.html");
	 }else{
		 mysql_close($mysql_conn);
		 Header("Location:index/view/index.html");//跳转网站首页
	 }
}else{
	Header("Location:admin/view/web_conn_sql.html");
}
?>
