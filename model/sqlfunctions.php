<?php
/*
数据操作文件
*/
class connFun{
	 private $mysql_conn;
	 public function __construct(){
		include_once "conn.php";
		$obj = new Mysql;
		if(Class_exists("Mysql")){   //检测数据库链接类是否存在
			if(!is_object($obj))
				throw new Exception("obj isnot object");
		}else{
			throw new Exception("class is not exists");
		}
		$this->mysql_conn = $obj->sucessConn();
	}
	
	public function getRes(){
		return $this->mysql_conn;
	}
/*  ----------------------------------act_manage用户表------------------------------------------------------- */
	//act_manage表查询操作by uid，$uid：用户编号
	public function act_query($uid){
		$str = "SELECT * FROM `act_manage`WHERE uid =".$uid;
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		include_once "act.php";
		while ($row = mysql_fetch_assoc($re,MYSQL_ASSOC))
		{
			$user = new Act($row['uid'],$row['uname'],$row['upwd'],$row['utime'],$row['ustatus'],$row['uemail']);
		}
		mysql_close($this->mysql_conn);
		return $user;
	}
	//act_manage表查询操作by uemail，$uemail：用户邮箱
	public function act_queryByEmail($uemail){
		$str = "SELECT * FROM `act_manage`WHERE uemail ='".$uemail."'; ";
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		include_once "act.php";
		while ($row = mysql_fetch_assoc($re,MYSQL_ASSOC))
		{
			$user = new Act($row['uid'],$row['uname'],$row['upwd'],$row['utime'],$row['ustatus'],$row['uemail']);
		}
		mysql_close($this->mysql_conn);
		return $user;
	}
	
	//act_manage表查询操作by uname，$uname：用户名
	public function act_queryByName($uname){
		$str = "SELECT * FROM `act_manage` WHERE uname ='".$uname."'; ";
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		include_once "act.php";
		while ($row = mysql_fetch_assoc($re,MYSQL_ASSOC))
		{
			$user = new Act($row['uid'],$row['uname'],$row['upwd'],$row['utime'],$row['ustatus'],$row['uemail']);
		}
		mysql_close($this->mysql_conn);
		return $user;
	}
	
	//act_manage表所有内容查询操作
	public function act_queryAll(){
		$str = "SELECT * FROM `act_manage`;";
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		include_once "act.php";
		$res_arr = array();
		while ($row = mysql_fetch_assoc($re,MYSQL_ASSOC))
		{
			$user = new Act($row['uid'],$row['uname'],$row['upwd'],$row['utime'],$row['ustatus'],$row['uemail']);
			array_push($res_arr, $user);
		}
		mysql_close($this->mysql_conn);
		return $res_arr;
	}
	
	/*act_manage表插入操作
	$uname:用户名
	$upwd:密码
	$utime:注册时间
	$uemail:电子邮箱
	*/
	
	public function act_insert($uname,$upwd,$utime,$uemail){
		
		$str = "INSERT INTO `act_manage` ( `uname` , `upwd` , `utime` , `uemail` )
		VALUES ('".$uname."', '".$upwd."', '".$utime."', '".$uemail."');";
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		mysql_close($this->mysql_conn);
		return $re;
	}
	/*act_manage表修改操作
	$uid:用户编号
	$uname:用户名
	$upwd:密码
	$ustatus:用户状态
	$uemail:电子邮箱
	*/
	public function act_update($uid,$uname,$upwd,$ustatus,$uemail){
		
		$str = "UPDATE `act_manage` SET `uname` = '".$uname."',
				`upwd` = '".$upwd."',
				`ustatus` = ".$ustatus.",
				`uemail` = '".$uemail."' WHERE uid =".$uid.";";
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		mysql_close($this->mysql_conn);
		return $re;
	}
	
	
	/*act_manage表删除操作
	$uid:用户编号
	*/
	public function act_delete($uid){
		
		$str = "DELETE FROM `act_manage` WHERE uid =".$uid;
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		mysql_close($this->mysql_conn);
		return $re;
	}
	
/*  ----------------------------------act_manage表------------------------------------------------------- */

/*  ----------------------------------fontsetting网站基本信息表------------------------------------------------------- */
	/*fontsetting表插入操作
	$web_name:网站名称
	$webimg_url:网站图标链接地址
	$webfooter_info:网站备注信息
	*/
	public function fontsetting_insert($web_name,$webimg_url,$webfooter_info){
		
		$str = "INSERT INTO `frontsetings` ( `web_name` , `webimg_url` , `webfooter_info` )
				VALUES ('".$web_name."', '".$webimg_url."', '".$webfooter_info."');";
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		mysql_close($this->mysql_conn);
		return $re;
	}
	
	/*fontsetting表修改操作
	$web_name:网站名称
	$webimg_url:网站图标链接地址
	$webfooter_info:网站备注信息
	*/
	public function fontsetting_update($web_name,$webimg_url,$webfooter_info){
		$str = "UPDATE `frontsetings` SET `web_name` = '".$web_name."',
			`webimg_url` = '".$webimg_url."',
			`webfooter_info` = '".$webfooter_info."' WHERE set_id =1";
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		mysql_close($this->mysql_conn);
		return $re;
	}
	
	/*fontsetting表查询操作
	*/
	public function fontsetting_select(){
		$str = "SELECT *FROM `frontsetings`";
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		
		$res_arr = array();
		while ($row = mysql_fetch_assoc($re,MYSQL_ASSOC))
		{
			array_push($res_arr, $row);
		}
		mysql_close($this->mysql_conn);
		return $res_arr;
	}
/*  ----------------------------------fontsetting表------------------------------------------------------- */

/*  ----------------------------------function_table功能目录表------------------------------------------------------- */
	/*function_table表插入操作
	$fpid:父功能id
	$fname:功能名称
	$furl:功能实现地址
	fgrade:功能层级
	*/
	public function fun_insert($fpid, $fname, $furl, $fgrade){
		
		$str = "INSERT INTO `function_table` ( `fpid` , `fname` , `furl` , `fgrade` )
				VALUES (".$fpid.", '".$fname."', '".$furl."', ".$fgrade." )";
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		mysql_close($this->mysql_conn);
		return $re;
	}
	
	/*function_table表全部查询操作
	*/
	public function fun_queryAll(){
		$str = "SELECT *FROM `function_table`";
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		
		$res_arr = array();
		while ($row = mysql_fetch_assoc($re,MYSQL_ASSOC))
		{
			array_push($res_arr, $row);
		}
		mysql_close($this->mysql_conn);
		return $res_arr;
	}
	
	/*function_table表全部查询操作by 用户id
	*/
	public function fun_queryByUid($uid){
		
		$aut_res =$this->authority_queryByUid($uid);
		include_once "conn.php";
		$obj = new Mysql;
		if(Class_exists("Mysql")){   
			if(!is_object($obj))
				throw new Exception("obj isnot object");
		}else{
			throw new Exception("class is not exists");
		}
		$this->mysql_conn = $obj->sucessConn();
		$arr=explode("|",$aut_res[0]["Fid_having"]);
		$res_arr = array();
		foreach($arr as $value){
			$str = "SELECT * FROM `function_table`
					WHERE fid =".$value.";";
			$re = mysql_query($str,$this->mysql_conn);
			if (!$re) {
				die("couldn't get the res:\n" . mysql_error());
			}
			while ($row = mysql_fetch_assoc($re,MYSQL_ASSOC))
			{
				array_push($res_arr, $row);
			}
		}
		mysql_close($this->mysql_conn);
		return $res_arr;
	}
	
	/*function_table表修改操作
	$fid:功能编号
	$fpid:父功能id
	$fname:功能名称
	$furl:功能实现地址
	fgrade:功能层级
	fstatus:状态
	*/
	public function fun_update($fid, $fpid, $fname, $furl, $fgrade, $fstatus){
		
		$str = "UPDATE `function_table` SET `fpid` =".$fpid.",
				`fname` = '".$fname."',
				`furl` = '".$furl."',
				`fgrade` =".$fgrade.",
				`fstatus` =".$fstatus." WHERE fid =".$fid.";";
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		mysql_close($this->mysql_conn);
		return $re;
	}
	
	/*function_table表修改操作
	$fid:编号
	*/
	public function fun_delete($fid){
		
		$str = "DELETE FROM `function_table` WHERE fid =".$fid;
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		mysql_close($this->mysql_conn);
		return $re;
	}
	
/*  ----------------------------------function_table表------------------------------------------------------- */

/*  ----------------------------------stationmaster站长信息表------------------------------------------------------- */
	/*stationmaster_table表插入操作
	默认插入一个空白行，站长信息只能修改不能删除
	*/
	public function stationmaster_insert(){
		
		$str = "INSERT INTO `stationmasterinfo` ( `name` , `age` , `rfs` , `profession` , `like` , `specialty` , `pac` , `plan` , `selfintro` )
				VALUES ('name', 0, ' ', ' ', ' ', ' ', ' ', ' ', ' ')";
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		mysql_close($this->mysql_conn);
		return $re;
	}
	
	/*stationmaster_table表修改操作
	$name:姓名
	$age:年龄
	$rfs: 学历
	$profession:专业
	$like:爱好
	$specialty:特长
	$pac:优缺点
	$plan:人生规划
	$selfintro:自我描述
	*/
	public function stationmaster_update($name, $age, $rfs, $profession, $like, $specialty, $pac, $plan, $selfintro){
		
		$str = "UPDATE `stationmasterinfo` SET `name` = '".$name."',
				`age` =".$age.",
				`rfs` = '".$rfs."',
				`profession` = '".$profession."',
				`like` = '".$like."',
				`specialty` = '".$specialty."',
				`pac` = '".$pac."',
				`plan` = '".$plan."',
				`selfintro` = '".$selfintro."' WHERE id =1;";
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		mysql_close($this->mysql_conn);
		return $re;
	}
	
	/*stationmaster_table表查询操作
	*/
	public function stationmaster_select(){
		$str = "SELECT *FROM `stationmasterinfo`";
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		$res_arr = array();
		while ($row = mysql_fetch_assoc($re,MYSQL_ASSOC))
		{
			array_push($res_arr, $row);
		}
		mysql_close($this->mysql_conn);
		return $res_arr;
	}
	
/*  ----------------------------------stationmaster表------------------------------------------------------- */

/*  ----------------------------------authority_user权限关系表------------------------------------------------------- */
	/*authority_user表插入操作
	$Agrede:权限层级
	$Uid:用户id号
	$Fid_having:所拥有的功能的id
	*/
	public function authority_insert($Agrede, $Uid, $Fid_having){
		
		$str = "INSERT INTO `authority_user` ( `Agrede` , `Uid` , `Fid_having` )
				VALUES ( ".$Agrede.", ".$Uid.", '".$Fid_having."' )";
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		mysql_close($this->mysql_conn);
		return $re;
	}
	
	/*authority_user表查询操作by用户id
	
	*/
	public function authority_queryByUid($Uid){
		$str = "SELECT * FROM `authority_user` WHERE Uid =".$Uid."; ";
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		$res_arr = array();
		while ($row = mysql_fetch_assoc($re,MYSQL_ASSOC))
		{
			array_push($res_arr, $row);
		}
		mysql_close($this->mysql_conn);
		return $res_arr;
	}
	
	/*authority_use表修改操作
	$Agrede:权限层级
	$Uid:用户id号
	$Fid_having:所拥有的功能的id
	*/
	public function authority_update($Uid, $Agrede, $Fid_having){
		
		$str = "UPDATE `authority_user` SET `Agrede`= ".$Agrede.",`Fid_having`='".$Fid_having."' WHERE Uid = ".$Uid.";";
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		mysql_close($this->mysql_conn);
		return $re;
	}
	
	/*function_table表修改操作
	$Uid:用户id
	*/
	public function authority_delete($Uid){
		$str = "DELETE FROM `authority_user` WHERE Uid =".$Uid;
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		mysql_close($this->mysql_conn);
		return $re;
	}
/*  ----------------------------------authority_user表------------------------------------------------------- */

/*  ----------------------------------navigationbar目录表------------------------------------------------------- */
	/*authority_user表插入操作
	$father_id:父导航id
	$tname:名称
	$turl;链接地址
	*/
	public function navigationbar_insert($father_id, $tname, $turl){
		
		$str = "INSERT INTO `navigationbar` ( `father_id` , `tname` , `turl` )
				VALUES ( ".$father_id.", '".$tname."', '".$turl."' );";
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		mysql_close($this->mysql_conn);
		return $re;
	}
	
	/*authority_user表修改操作
	$father_id:父导航id
	$tname:名称
	$turl;链接地址
	$tid:编号
	*/
	public function navigationbar_update($tid, $father_id, $tname, $turl){
		$str = "UPDATE `navigationbar` SET `father_id` =".$father_id.",
				`tname` = '".$tname."',
				`turl` = '".$turl."' WHERE tid =".$tid.";";
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		mysql_close($this->mysql_conn);
		return $re;
	}
	
	/*navigationbar_queryAll查寻操作
	*/
	public function navigationbar_queryAll(){
		$str = "SELECT *FROM `navigationbar`";
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		$res_arr = array();
		while ($row = mysql_fetch_assoc($re,MYSQL_ASSOC))
		{
			array_push($res_arr, $row);
		}
		mysql_close($this->mysql_conn);
		return $res_arr;
	}
	
	/*navigationbar_table表删除操作
	$tid:编号
	*/
	public function navigationbar_delete($tid){
		$str = "DELETE FROM `navigationbar` WHERE tid =".$tid;
		$re = mysql_query($str,$this->mysql_conn);
        if (!$re) {
		    die("couldn't get the res:\n" . mysql_error());
		}
		mysql_close($this->mysql_conn);
		return $re;
	}
/*  ----------------------------------navigationbar表------------------------------------------------------- */
	
}


?>