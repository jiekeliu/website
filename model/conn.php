<?php
/*
$hostname:主机名
$dbname:数据库名
$username:数据库用户名
$pwd:数据库链接密码
*/
class Mysql{
	/*
		数据库链接测试函数，不存在sql_conn.txt文件时使用
	*/
    public function conn($hostname,$dbname,$username,$pwd){
             
		$mysql_conf = array(
		    'host'    => $hostname, 
		    'db'      => $dbname, 
		    'db_user' => $username, 
		    'db_pwd'  => $pwd, 
		    );
		$mysql_conn = @mysql_connect($mysql_conf['host'], $mysql_conf['db_user'], $mysql_conf['db_pwd']);
		if (!$mysql_conn) {
		    die("could not connect to the host:\n" . mysql_error());//诊断连接错误
		}
		mysql_query("set names 'utf8'");//编码转化
		$select_db = mysql_select_db($mysql_conf['db']);
		if (!$select_db) {
		    die("could not connect to the database,please create a new database:\n" .  mysql_error());
		}
		return $mysql_conn;

    }
	
	/*
		数据库链接函数，存在sql_conn.txt文件时使用
		preg_match("/\s/", $str):检查字符串是否有隐藏空格
		trim($arr):去掉字符串两端空格
	*/
	 public function sucessConn(){
		$sql_conn = dirname(dirname(__FILE__))."/sql_conn.txt";
		//echo $sql_conn;
		if(file_exists($sql_conn)){
			include_once "filecontrol.php";
			$fobj = new FileControl();
			$arr = $fobj->freader($sql_conn);
			$arr = array_filter($arr);
			$hostname = trim($arr[0]);
			$dbname = trim($arr[1]);
			$username = trim($arr[2]);
			$pwd = trim($arr[3]);
			$mysql_conn = $this->conn($hostname,$dbname,$username,$pwd);
			return $mysql_conn;
		}else{
			die("the sql_conn file is not exists");
		}
		
		
	 }
	
	
}

?>
