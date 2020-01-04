<?php
/*
cookie检测页面
*/

header('Content-Type:text/html;Charset=utf-8');
date_default_timezone_set("PRC");
if(isset($_COOKIE["url"])){
	Header("Location:".$_COOKIE["url"]);
}else{
	echo "请按正常程序进入后台";
}
?>