<?php

  $id = $_POST['id'];
  $answer = $_POST['answer'];
  $time = $_POST['time'];
  if ($id =='') {
      exit(json_encode(array('code'=>1,'msg'=>'后台：id不能为空')));
   }
   if ($answer =='') {
      exit(json_encode(array('code'=>1,'msg'=>'后台：problem不能为空')));
   }

  include_once "connFunction.php";
  $connFun = new connFun;
  $res = $connFun->update("UPDATE `website_login`.`answer` SET `answer` = '".$answer."',
`time` = '".$time."' WHERE `answer`.`id` =".$id.";");
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