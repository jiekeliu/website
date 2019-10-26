<?php

  $id = $_POST['id'];
  $problem = $_POST['problem'];
  $time = $_POST['time'];
  if ($id =='') {
      exit(json_encode(array('code'=>1,'msg'=>'后台：id不能为空')));
   }
   if ($problem =='') {
      exit(json_encode(array('code'=>1,'msg'=>'后台：problem不能为空')));
   }

  include_once "connFunction.php";
  $connFun = new connFun;
  $res = $connFun->update("UPDATE `website_login`.`problem` SET `problem` = '".$problem."',
`time` = '".$time."' WHERE `problem`.`id` =".$id.";");
  if ($res)
      {
      		ob_clean();
          exit(json_encode(array('code'=>0,'msg'=>'更新成功')));
      }
  else
      {	
      		ob_clean();
          exit(json_encode(array('code'=>1,'msg'=>'添加失败')));
      }
?>