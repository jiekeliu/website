<?php 
class FileControl{
	/*
	创造数据库信息文件函数
	$sql_conn:数据库信息文件地址
	fopen():打开并创建文件
	fwrite()：将信息写入文件
	*/
	 public function fcrate($hostname,$dbname,$username,$pwd){
		$dpath = dirname(dirname(__FILE__));
		$sql_conn = $dpath."/sql_conn.txt";
//		echo $sql_conn;
		if(file_exists($sql_conn)){
			 unlink($sql_conn);
			 fcrate($hostname,$dbname,$username,$pwd);
		}else{
			$myfile = fopen($sql_conn, "w+") or die("Unable to open file!");
			$txt = $hostname."\r\n";
			fwrite($myfile, $txt);
			
			$txt = $dbname."\r\n";
			fwrite($myfile, $txt);
			
			$txt = $username."\r\n";
			fwrite($myfile, $txt);
			
			$txt = $pwd."\r\n";
			fwrite($myfile, $txt);
			
			fclose($myfile);
		 }
		 return $sql_conn;
	 }
	 
	/*
	文件内容读取，并转换成数组输出
	feof():函数检测是否已到达文件末尾 
	fgets():从文件指针中读取一行
	*/
	 public function freader($filename){
		$file = fopen($filename, "r");
		$res=array();
		$i=0;
		//输出文本中所有的行，直到文件结束为止。
		while(!feof($file))
		{
		 $res[$i]= fgets($file);
		 $i++;
		}
		fclose($file);
		return $res;
	  }
	 
}

?>
