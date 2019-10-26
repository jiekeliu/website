<?php
	
		$search = $_GET['search'];
		
	  include_once "connFunction.php";
    $connFun = new connFun;
    $sql = "SELECT * FROM `problem`";
    if ($search != '') {
		      $sql = "SELECT * FROM `problem` WHERE problem LIKE '%".$search."%'";
		  }
    $res = $connFun->query($sql);
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

    $res_answer = $connFun->query("SELECT * FROM answer");
    $num_answer = mysql_num_rows($res_answer);
    $pro_arr_answer = array();
    if (mysql_num_rows($res_answer) > 0) {
      // 输出数据
      while($row_answer = mysql_fetch_assoc($res_answer)) {
            $arr_answer = array('id' => $row_answer["id"],'pid'=>$row_answer['pid'],'answer'=>$row_answer['answer'],'time'=>$row_answer['time'],'show'=>$row_answer['show']);
            array_push($pro_arr_answer, $arr_answer);
      }
  } else {
      echo "answer 0 结果";
  }
   
?>
 <!--
        作者：刘杰
        时间：2019-09-09
        描述：
    -->
<!-- 主体内容 -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>answer_manager</title>
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
    .spacing{
      width: 100%;
      height: 50px;
    }
    
    .answer_content{
    	width: 90%;
    	min-height: 400px;
    	margin: 0px auto;
    }
    
    .ans_txt{
    	width:90%;
    	min-height: 150px;
    	border: 1px solid gainsboro;
    	font-size: 20px;
    	border-radius:5px ;
    	margin: 20px 5%;
    }
    
    .ans_txt p{
    	margin: 30px 10px;
    	padding: 10px;
    	background-color: #F2F2F2;
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
		        <input type="search" name="title" required  lay-verify="required" placeholder="search" autocomplete="off" class="layui-input" id="search">
		      </td>
		      <td><button class="layui-btn layui-btn-xs layui-btn-radius layui-btn" onclick="search()"> 查找 </button></td>
		    </tr>    
		  </tbody>
		</table>
	
		<div class="header">
		  <span>problem列表</span>
		  <div></div>
		</div>

    <div class="answer_content">
			<div class="layui-collapse">
			<?php 
			    for ($i=0; $i < $num; $i++) { 
			?>			  
			  
			  <div class="layui-colla-item">
			    <h2 class="layui-colla-title" style="font-size: 20px;">
			    	<?php echo $pro_arr[$i][problem]; ?>
			    	<button class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" onclick="answer(<?php echo $pro_arr[$i][id];?>)">我要回答</button>
			    </h2>
			    <div class="layui-colla-content">
			    	<div class="ans_txt ">
			    		<?php 
							for ($j=0; $j < $num_answer; $j++) { 
							  if ($pro_arr_answer[$j][pid] == $pro_arr[$i][id]) {      
							?>
							<div class="layui-card">
							  <div class="layui-card-body">
							    <p><?php  print_r($pro_arr_answer[$j][answer]); ?></p>
							    
							    <div class="layui-btn layui-btn-sm layui-btn-radius layui-btn-warm" onclick="modify_problem(<?php echo $pro_arr_answer[$j][id];?>, 0)">
						    	修  &nbsp; &nbsp; &nbsp;改
							    </div>
							    <div class="layui-btn layui-btn-sm layui-btn-radius layui-btn-danger" onclick="modify_problem(<?php echo $pro_arr_answer[$j][id];?>, 1)">
							          删  &nbsp; &nbsp; &nbsp;除
							    </div>
							    
							  </div>
							</div>
							<?php 	
							  }
							}
							?>
			    	</div>
			    </div>
				</div>
			<?php 
			    }
			?>
   		</div> 
   	</div>

   	
    <script src="../layui/layui.js"></script>
    <script type="text/javascript">
        layui.use(['element', 'layer'], function(){
            var element = layui.element;
            var layer = layui.layer;
  					$ = layui.jquery;
        });
        
        
      function search(){
      	var search = $('#search').val();
			  if (search == '') {
					layer.alert("search不能为空",{icon:2});
					return;
				}
				console.log(search);
			  window.location.href = "answer_list.php?search="+search;
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
		  content: ['answer_modify.php?pro_id='+pro_id+'&mothod='+mothod, 'no'] 
		  });
		}

    </script>
  </body>
</html>
