<?php
	$response = "";
	$search = $_GET['search'];	
	include_once "../admin/connFunction.php";
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
    	$response =  "problem 0 结果";
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
      $response =  "answer 0 结果";
  }
   
?>
 <!--
        作者：刘杰
        时间：2019-10-11
        描述：
    -->
<!-- 主体内容 -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>个人测试：Jsonker -学习分享网站</title>
  <link rel="stylesheet" type="text/css" href="../layui/css/layui.css">
  <script src="../layui/layui.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/problem_solve.css" />
</head>
<body style="min-width: 1500px;">	
		<ul class="layui-nav" lay-filter="">
		  <li class="layui-nav-item">
		    <a href="../index.html"><img src="//t.cn/RCzsdCq" class="layui-nav-img">Jsonker-个人测试</a>
		  </li>
		  <li class="layui-nav-item"><a href="#">学习笔记</a></li>
		  <li class="layui-nav-item"><a href="#">成果展示</a></li>
		  <li class="layui-nav-item"><a href="#">汉译文档</a></li>
		  <li class="layui-nav-item"><a href="#">文章分享</a></li>
		  <li class="layui-nav-item"><a href="problem_solve.php">问题解答</a></li>
		  <li class="layui-nav-item"><a href="#">视屏音频</a></li>
		  <li class="layui-nav-item"><a href="#">关于我</a></li>
		</ul>
	
		<table class="layui-table">
		  <colgroup>
		    <col >
		    <col width="100">
		  </colgroup>
		  <tbody>
		    <tr>
		      <td>
		        <input type="search" name="title" required  lay-verify="required" placeholder="search problem" autocomplete="off" class="layui-input" id="search">
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
				if($response != ""){
			?>	
				<p style="background-color: red;text-align: center; color: white;margin: 100px auto;font-size: 40px;"> 
					<?php echo $response ?>
				</p>
			<?php
				}
			 ?>
					
			<?php 
			    for ($i=0; $i < $num; $i++) { 
			?>			  
			  
			  <div class="layui-colla-item">
			    <h2 class="layui-colla-title" style="font-size: 20px;">
			    	<?php echo $pro_arr[$i][problem]; ?>
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
	
   	<div class="footer">
			版权所有 © 蜀ICP备18020811号
	</div>
    <script src="../layui/layui.js"></script>
    <script src="../js/problem_solve.js"></script>
  </body>
</html>
