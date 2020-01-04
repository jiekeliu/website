<?php
/*
$mysql_conn:数据库链接
*/
class Createtables{
	
	public function tCreate($mysql_conn){
		/*
		创建站长信息表
		*/
		$info_sql ="CREATE TABLE stationmasterinfo(
	    `id` int(11) NOT NULL AUTO_INCREMENT,
	    `name` varchar(30) NOT NULL,
	    `age` int(3) NOT NULL,
	    `rfs` varchar(30) NOT NULL COMMENT '学历',
	    `profession` varchar(30) NOT NULL COMMENT '专业',
	    `like` text COMMENT '爱好',
	    `specialty` text COMMENT '特长',
	    `pac` text COMMENT '优缺点',
	    `plan` text COMMENT '人生规划',
	    `selfintro` text COMMENT '自我描述',
	    PRIMARY KEY (`id`))";
		if((int)$this->check_table_is_exist('stationmasterinfo',$mysql_conn)==0){
			$info_res = mysql_query($info_sql,$mysql_conn);
			if(!$info_res){
				die(json_encode(array('code'=>0,'msg'=>'couldn not get the res:'.mysql_error())));
			}
		}  
		/*
		创建前端基本信息表
		*/
		$set_sql = "CREATE TABLE IF NOT EXISTS `frontsetings` (
		  `set_id` int(2) NOT NULL AUTO_INCREMENT,
		  `web_name` varchar(255) NOT NULL COMMENT '网站名称',
		  `webimg_url` varchar(255) NOT NULL COMMENT '网站图标',
		  `webfooter_info` varchar(255) NOT NULL COMMENT '网站备注信息',
		  PRIMARY KEY (`set_id`)
		) ";
		if((int)$this->check_table_is_exist('frontsetings',$mysql_conn)==0){
			$set_res = mysql_query($set_sql,$mysql_conn);
			if(!$set_res){
				die(json_encode(array('code'=>0,'msg'=>'couldn not get the res:'.mysql_error())));
			}
		}
		/*
		创建前端导航基本信息表
		*/
		$nav_sql = "CREATE TABLE IF NOT EXISTS `navigationbar` (
		  `tid` int(2) NOT NULL AUTO_INCREMENT,
		  `father_id` int(2) NOT NULL COMMENT '父导航id',
		  `tname` varchar(255) NOT NULL COMMENT '名称',
		  `turl` varchar(255) NOT NULL COMMENT '链接地址',
		  PRIMARY KEY (`tid`)
		)";
		if((int)$this->check_table_is_exist('navigationbar',$mysql_conn)==0){
			$nav_res = mysql_query($nav_sql,$mysql_conn);
			if(!$nav_res){
				die(json_encode(array('code'=>0,'msg'=>'couldn not get the res:'.mysql_error())));
			}
		}
		/*
		创建用户信息表
		*/
		$act_sql = "CREATE TABLE IF NOT EXISTS `act_manage` (
		  `uid` int(11) NOT NULL AUTO_INCREMENT,
		  `uname` varchar(255) NOT NULL COMMENT '用户名',
		  `upwd` varchar(255) NOT NULL COMMENT '用户密码',
		  `utime` date NOT NULL COMMENT '注册时间',
		  `ustatus` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
		  `uemail` varchar(255) NOT NULL COMMENT 'email',
		  PRIMARY KEY (`uid`),
		  UNIQUE KEY `uemail` (`uemail`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='账户管理表' AUTO_INCREMENT=1 ;";
		if((int)$this->check_table_is_exist('act_manage',$mysql_conn)==0){
			$act_res = mysql_query($act_sql,$mysql_conn);
			if(!$act_res){
				die(json_encode(array('code'=>0,'msg'=>'couldn not get the res:'.mysql_error())));
			}
		}
		/*
		创建功能信息表
		*/
		$fun_sql = "CREATE TABLE IF NOT EXISTS `function_table` (
		  `fid` int(11) NOT NULL AUTO_INCREMENT,
		  `fpid` int(11) NOT NULL COMMENT '父功能id',
		  `fname` varchar(255) NOT NULL COMMENT '功能名称',
		  `furl` varchar(255) NOT NULL COMMENT '功能实现地址',
		  `fgrade` int(2) NOT NULL DEFAULT '0' COMMENT '功能等级',
		  `fstatus` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
		  PRIMARY KEY (`fid`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='功能表' AUTO_INCREMENT=1 ;";
		if((int)$this->check_table_is_exist('function_table',$mysql_conn)==0){
			$fun_res = mysql_query($fun_sql,$mysql_conn);
			if(!$fun_res){
				die(json_encode(array('code'=>0,'msg'=>'couldn not get the res:'.mysql_error())));
			}
		}
		/*
		创建提交信息管理表
		*/
		$sub_sql = "CREATE TABLE IF NOT EXISTS `submit_data` (
		  `Did` int(11) NOT NULL AUTO_INCREMENT,
		  `Uid` int(11) NOT NULL COMMENT '提交人id',
		  `Data` text NOT NULL COMMENT '提交数据',
		  `Dtype` varchar(255) NOT NULL COMMENT '数据类型',
		  `Dtime` date NOT NULL COMMENT '提交时间',
		  PRIMARY KEY (`Did`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='提交数据管理表' AUTO_INCREMENT=1 ;";
		if((int)$this->check_table_is_exist('submit_data',$mysql_conn)==0){
			$sub_res = mysql_query($sub_sql,$mysql_conn);
			if(!$sub_res){
				die(json_encode(array('code'=>0,'msg'=>'couldn not get the res:'.mysql_error())));
			}
		}
		/*
		创建用户权限管理表
		*/
		$aut_sql = "CREATE TABLE IF NOT EXISTS `authority_user` (
		  `Aid` int(11) NOT NULL AUTO_INCREMENT,
		  `Agrede` tinyint(2) NOT NULL COMMENT '权限层级',
		  `Uid` int(11) NOT NULL COMMENT '用户id号',
		  `Fid_having` varchar(255) NOT NULL COMMENT '所拥有的功能的id',
		  PRIMARY KEY (`Aid`),
		  UNIQUE KEY `Uid` (`Uid`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户-功能-层级关系表' AUTO_INCREMENT=1 ;";
		if((int)$this->check_table_is_exist('authority_user',$mysql_conn)==0){
			$aut_res = mysql_query($aut_sql,$mysql_conn);
			if(!$aut_res){
				die(json_encode(array('code'=>0,'msg'=>'couldn not get the res:'.mysql_error())));
			}
		}
		
		
		return true;
	}
	/*
	数据表存在性检测函数
	$sql:查询语句
	$find_table:数据表名称
	$mysql_conn:数数据库链接地址
	*/
	
	function check_table_is_exist($find_table,$mysql_conn){
		$sql = "show databases;";
		$row=mysql_query($sql,$mysql_conn);
		$database=array();
		$finddatabase=$find_table;
		while ($result=mysql_fetch_array($row,MYSQL_ASSOC))
		{
		  $database[]=$result['Database'];
		}
		unset($result,$row);
		/*开始判断表是否存在*/
		if(in_array($find_table,$database))
		{
		  return true;
		}
		else
		{
		  return false;
		}
	}
	
	
}

?>