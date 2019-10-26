<?php

  $id = $_POST['id'];
  if ($id =='') {
      exit(json_encode(array('code'=>1,'msg'=>'后台：id不能为空')));
   }

    // exit(json_encode(array('code'=>0,'msg'=>$id)));
  include_once "connFunction.php";
  $connFun = new connFun;
  $res = $connFun->delete("DELETE FROM `website_login`.`answer` WHERE `answer`.`id`=".$id);
  if ($res)
      {		
      		ob_clean();
          exit(json_encode(array('code'=>0,'msg'=>'删除成功')));
      }
  else
      {
      		ob_clean();
          exit(json_encode(array('code'=>1,'msg'=>'删除失败')));
      }
?>