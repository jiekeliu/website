
<?php
include_once "conn.php";
/**
 * $sql:数据查询语句
 */
class connFun 
{


 	public function query($str){

 		$obj = new Mysql;
		if(Class_exists("Mysql")){
		    if(!is_object($obj))
		            echo "obj isnot object";
		        
		}else{
		     echo "class isnot exists";
		}
		// echo "$str";
		$mysql_conn = $obj->conn();
        $re = mysql_query($str);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		return $re;
		mysql_close($mysql_conn);
    
	}
    /**
     * $sql:sql语句
   */
	public function insert($str){

 		$obj = new Mysql;
		if(Class_exists("Mysql")){
		    if(!is_object($obj))
		            echo "obj isnot object";
		        
		}else{
		     echo "class isnot exists";
		}
		// echo "$str";
		$mysql_conn = $obj->conn();
        $re = mysql_query($str);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		return $re;
		mysql_close($mysql_conn);
    
	}

	
	public function update($str){

 		$obj = new Mysql;
		if(Class_exists("Mysql")){
		    if(!is_object($obj))
		            echo "obj isnot object";
		        
		}else{
		     echo "class isnot exists";
		}
		// echo "$str";
		$mysql_conn = $obj->conn();
        $re = mysql_query($str);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		return $re;
		mysql_close($mysql_conn);
    
	}

	public function delete($str){

 		$obj = new Mysql;
		if(Class_exists("Mysql")){
		    if(!is_object($obj))
		            echo "obj isnot object";
		        
		}else{
		     echo "class isnot exists";
		}
		// echo "$str";
		$mysql_conn = $obj->conn();
        $re = mysql_query($str);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		return $re;
		mysql_close($mysql_conn);
    
	}

}

?>