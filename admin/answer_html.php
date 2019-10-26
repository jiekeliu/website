<?php
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
<title>layui.form小例子</title>
<link rel="stylesheet" href="../layui/css/layui.css" media="all">
</head>
<body>

<form class="layui-form" action="">
  <div class="layui-form-item">
    <label class="layui-form-label">problem:</label>
    <div class="layui-input-block">
    	<div style="padding-top: 9px;padding-bottom: 9px;">
    		<?php echo $pro_arr[0][problem]; ?>
    	</div>
    </div> 
  </div>
  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">answer:</label>
    <div class="layui-input-block">
      <textarea id="answer" name="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
    </div>
  </div>
</form>
	<button class="layui-btn" style="margin: 20px 100px;" onclick="add_answer(<?php echo $pro_arr[0][id];?>)">立即提交</button>
    <button type="reset" class="layui-btn layui-btn-primary">重&nbsp;&nbsp;&nbsp;&nbsp;置</button>



  <!-- 更多表单结构排版请移步文档左侧【页面元素-表单】一项阅览 -->
<script src="../layui/layui.js"></script>
<script>
layui.use(['form','layer'], function(){
  var form = layui.form;
  var layer = layui.layer;
  $ = layui.jquery;
});

function add_answer(pid){
  layer.confirm('确定添加吗？', {
  btn: ['点错了', '确定'] //可以无限个按钮
  }, function(index, layero){
    layer.close(layer.index);
  }, function(index){
    var answer = $('#answer').val();
    if (answer == '') {
		layer.alert("answer不能为空",{icon:2});
		return;
	}
   	
    $.post('answer_add.php',{'answer':answer,'pid':pid},function(res){
               if (res.code>0) {
                  layer.msg(res.msg);
                  layer.alert(res.msg,{icon:2});
               }else{
                  layer.msg(res.msg);
                  setTimeout(function(){window.location.reload();},1000);
               }
     },'json');


  });
 }


</script>
</body>
</html>