<?php
    include_once "connFunction.php";
    $connFun = new connFun;
    $res = $connFun->query("SELECT * FROM problem");
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
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>problem_manager</title>
  <link rel="stylesheet" type="text/css" href="../layui/css/layui.css">
  <script src="../layui/layui.js"></script>
  <style type="text/css">
    .header{
      margin-top: 20px;
    }

    .header span{
      width: 100px;
      height: 50px;
      padding: 10px;
      background-color: #009688;
      margin-left: 30px;
      color: #fff;
    }
    .header div{
      border-bottom: 2px solid #009688;margin-top: 8px; 
    }
    .header button{
      float: right;
      margin-top: -6px;
      margin-right:10px; 
    }
    .spacing{
      width: 100%;
      height: 50px;
    }

  </style>
</head>
<body style="padding:10px">

<table class="layui-table">
  <colgroup>
    <col >
    <col width="100">
  </colgroup>
  <tbody>
    <tr>
      <td>
        <input type="text" name="title" required  lay-verify="required" placeholder="problem" autocomplete="off" class="layui-input" id="pro">
      </td>
      <td><button class="layui-btn layui-btn-xs layui-btn-radius layui-btn" onclick="add_problem()"> 添  加 </button></td>
    </tr>    
  </tbody>
</table>

<div class="header">
  <span>problem列表</span>
  <div></div>
</div>

<table class="layui-table">
  <colgroup>
    <col width="50">
    <col >
    <col width="200">
    <col width="100">
    <col width="100">
    <col width="100">
  </colgroup>
  <thead>
    <tr>
      <th>id</th>
      <th>problem</th>
      <th>time</th>
      <th>修改</th>
      <th>删除</th>
      <th>我要回答</th>
    </tr> 
  </thead>
  <tbody>

<?php 
      for ($i=0; $i <$num ; $i++) { 
        
 ?>
    <tr>
      <td><?php echo $pro_arr[$i][id]; ?></td>
      <td><?php echo $pro_arr[$i][problem]; ?></td>
      <td><?php echo $pro_arr[$i][time];?></td>
      <td><button class="layui-btn layui-btn-xs layui-btn-radius layui-btn-warm" onclick="modify_problem(<?php echo $pro_arr[$i][id];?>, 0)" >修改</button></td>
      <td><button class="layui-btn layui-btn-xs layui-btn-radius layui-btn-warm" onclick="modify_problem(<?php echo $pro_arr[$i][id];?>, 1)">删除</button></td>
      <td><button class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" onclick="answer(<?php echo $pro_arr[$i][id];?>)">我要回答</button></td>
    </tr>
<?php 
  }
 ?>
    
  </tbody>
</table>


 <script type="text/javascript">
  layui.use('layer', function(){
  var layer = layui.layer;
  $ = layui.jquery;
  
 });  

 function add_problem(){
  layer.confirm('确定添加吗？', {
  btn: ['点错了', '确定'] //可以无限个按钮
  }, function(index, layero){
    layer.close(layer.index);
  }, function(index){
    var pro = $('#pro').val();
     
     $.post('problem_add.php',{'pro':pro},function(res){
               if (res.code>0) {
                  layer.msg(res.msg);
                  layer.alert(res.msg,{icon:2});
               }else{
                  layer.msg(res.msg);
                  setTimeout(function(){window.location.reload();},1000);
               }
      },"json");


  });
 }

 function modify_problem(pro_id , mothod){
  var tit = "";
   if (mothod == 0) {
    var tit = "修改";
   } else {
    var tit = "删除";
   }
  layer.open({
  title: [tit, 'font-size:18px;'],
  type: 2,
  offset: '100px', 
  area: ['450px', '300px'],
  content: ['problem_modify.php?pro_id='+pro_id+'&mothod='+mothod, 'no'] 
  });
}


function answer(pro_id){
  layer.open({
  title: ["answer", 'font-size:18px;'],
  type: 2, 
  offset: '100px',
  area: ['450px', '300px'],
  content: ['answer_html.php?pro_id='+pro_id, 'no'] 
  });
}


 </script>

</body>
</html>