<?php

  $pro = $_POST['pro'];
  if ($pro == '') {
      exit(json_encode(array('code'=>1,'msg'=>'后台：不能为空')));
   }

  include_once "connFunction.php";
  $connFun = new connFun;
  // echo date("Y/m/d");
  $res = $connFun->insert(" INSERT INTO `problem`(`problem`, `time`) VALUES ('".$pro."','".date("Y/m/d")."') ");
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