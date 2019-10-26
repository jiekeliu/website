
<?php

class Mysql{

    public function conn(){
             
		$mysql_conf = array(
		    'host'    => 'localhost', 
		    'db'      => 'website_login', 
		    'db_user' => 'root', 
		    'db_pwd'  => 'root', 
		    );
		$mysql_conn = @mysql_connect($mysql_conf['host'], $mysql_conf['db_user'], $mysql_conf['db_pwd']);
		if (!$mysql_conn) {
		    die("could not connect to the database:\n" . mysql_error());//诊断连接错误
		}
		mysql_query("set names 'utf8'");//编码转化
		$select_db = mysql_select_db($mysql_conf['db']);
		if (!$select_db) {
		    die("could not connect to the db:\n" .  mysql_error());
		}
		return $mysql_conn;

    }
}

?>
