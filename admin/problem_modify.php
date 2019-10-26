<?php
	$mothod = $_GET["mothod"];
	// echo $mothod;
	$pro_id = $_GET["pro_id"];
    include_once "connFunction.php";
    $connFun = new connFun;
    $res = $connFun->query("SELECT * FROM problem where id = ".$pro_id);
    $num = mysql_num_rows($res);
    $pro_arr = array();
    if (mysql_num_rows($res) > 0) {
      // 输出数据
      while($row = mysql_fetch_assoc($res)) {
            $arr = array('id' => $row["id"],"problem"=>$row["problem"],"time"=>$row["time"]);
            array_push($pro_arr, $arr);
      }
  } else {
      echo "problem 0 结果";
  } 
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" href="../layui/css/layui.css" media="all">
</head>
<body>
<form class="layui-form"> <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->

  <div class="layui-form-item">
    <label class="layui-form-label">id:</label>
    <div class="layui-input-block">
      <input type="text" id="id" name="" placeholder="请输入" autocomplete="off" class="layui-input" value="<?php echo $pro_arr[0][id]; ?>">
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">problem:</label>
    <div class="layui-input-block">
      <input type="text" id="problem" name="" placeholder="请输入" autocomplete="off" class="layui-input" value="<?php echo $pro_arr[0][problem]; ?>">
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">time:</label>
    <div class="layui-input-block">
      <input type="text" id="time" name="" placeholder="请输入" autocomplete="off" class="layui-input" value="<?php echo $pro_arr[0][time]; ?>">
    </div>
  </div>
</form>
  <div class="layui-form-item">
    <div class="layui-input-block">

 <?php
 		if ($mothod == 0) {
  ?>
      <button class="layui-btn layui-btn-normal" onclick="modify()">修改</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
 <?php
 		} else {
  ?>
	  <button class="layui-btn" lay-submit lay-filter="*" onclick="delect()">删除</button>

  <?php
 		}
  ?>

    </div>
  </div>
  <!-- 更多表单结构排版请移步文档左侧【页面元素-表单】一项阅览 -->
<script src="../layui/layui.js"></script>
<script>
layui.use(['form','layer'], function(){
  var form = layui.form;
  var layer = layui.layer;
  $ = layui.jquery;
});

function modify(){

  layer.confirm('确定修改吗？', {
  btn: ['点错了', '确定'] //可以无限个按钮
  }, function(index, layero){
    layer.close(layer.index);
  }, function(index){
      var id =$.trim($("#id").val()) ;
      var problem =$.trim($("#problem").val()) ;
      var time =$.trim($("#time").val()) ;
      if (problem == '') {
				layer.alert("problem不能为空",{icon:2});
				return;
		}
			
     $.post('problem_modify_manager.php',{'id':id,'problem':problem,'time':time},function(res){
     	console.log(res.code);
               if (res.code>0) {
                  layer.msg(res.msg);
                  layer.alert(res.msg,{icon:2});
               }else{
                  layer.msg(res.msg);
                  setTimeout(function(){window.parent.location.reload();},1000);
               }
      },'json');
  });

}

function delect(){
  layer.confirm('确定删除吗？', {
  btn: ['点错了', '确定'] //可以无限个按钮
  }, function(index, layero){
    layer.close(layer.index);
  }, function(index){
     var id =$.trim($("#id").val()) ;
			
     $.post('problem_delete.php',{'id':id},function(res){
               if (res.code>0) {
                  layer.msg(res.msg);
                  layer.alert(res.msg,{icon:2});
               }else{
                  layer.msg(res.msg);
                  setTimeout(function(){window.parent.location.reload();},1000);
               }
      },'json');


  });
}

</script>
</body>
</html>

