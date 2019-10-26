<?php
    header('Content-Type:text/html;Charset=utf-8');  
	$usename = $_POST['username'];
	$pwd = $_POST['pwd'];

	if ($usename == '') {
			exit(json_encode(array('code'=>1,'msg'=>'后台：用户名不能为空')));
		}
	if ($pwd == '') {
		exit(json_encode(array('code'=>1,'msg'=>'后台：密码不能为空')));
	}
    include_once "connFunction.php";
    $connFun = new connFun;
    $res = $connFun->query("SELECT * FROM `admins` WHERE usename = '001'");
    $user = mysql_fetch_assoc($res);
    if ($pwd !=$user['password']) {
		echo "1";
	}else{
		setcookie("name",$usename,time()+36000,"/");
		echo "0" ;
	}

?>