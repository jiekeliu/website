<?php
  $pid = $_POST['pid'];
  $answer = $_POST['answer'];
  if ($answer == '') {
      exit(json_encode(array('code'=>1,'msg'=>'后台：answer不能为空')));
   }
   if ($pid <= 0) {
      exit(json_encode(array('code'=>1,'msg'=>'后台：pid异常')));
   }

  include_once "connFunction.php";
  $connFun = new connFun;
  $res = $connFun->insert("INSERT INTO `answer` ( `pid` , `answer` , `time` )
VALUES ( ".$pid.", '".$answer."', '".date("Y/m/d")."' )");
  if ($res)
      {		
      		ob_clean();
          exit(json_encode(array('code'=>0,'msg'=>'添加成功')));
      }
  else
      {
      		ob_clean();
          exit(json_encode(array('code'=>1,'msg'=>'添加失败')));
      }
  

?>