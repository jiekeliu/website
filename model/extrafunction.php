<?php
/*
功能扩展类

*/

class AxtraFun{
/*
createMod():数据库操作文件检测函数
$url：模块控制主页地址
*/
	public function createMod($url)
    {	
        $dpath = dirname(dirname($url));
        if(!file_exists($dpath)){  //模块检测
        	die("该模块不存在");
        }
        $array=explode('/', $url);
    	$a = $array[count($array)-1];
		$name=explode('.', $a )[0];
        
        $dpath = $dpath."/".$name."_sql.php"; //地址拼接
        if(file_exists($dpath)){
        	include_once $dpath;
			$obj = new Sqlcontra();
			$status = $obj->createTable();  //结果获取
			if($status){
				return true;
			}else{
				return false;
			}
        }else{
        	return true;
        }
        
    }
	
	
}
?>