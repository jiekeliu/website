<?php
if (isset($_COOKIE['name'])) {
	include_once "connFunction.php";
    $connFun = new connFun;
    $res = $connFun->query("select * from admins where usename = '001'");
    $admins = mysql_fetch_assoc($res);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Jsonker网站后台管理</title>
  <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../layui/css/layui.css" rel="stylesheet">
  <link href="../css/admin_index.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
		  <div class="container-fluid">
		    <!--个人图标 -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="javascript:;" id="linkmanu" onclick="showmenu();">Jsonker</a>
		    </div>
		    
		    <!-- 左导航 -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		     
		     <!-- 右导航 -->
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="../index.html">主页</a></li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav> 
		<div style="height:30px;width: 100%;"></div>
		<!-- 主体部分 -->


	<div class="container-fluid">
	   <div class="row">
	   	<!-- 左侧导航 --> 
		  <div class="col-xs-12s col-md-2" id="leftmenu" style="padding: 0px;">
		 
<div id="menu" class="menu">

<ul class="layui-nav layui-nav-tree layui-inline" lay-filter="demo" style="margin-right: 10px;">
  <li class="layui-nav-item layui-nav-itemed">
    <a href="javascript:;">问题管理模块</a>
    <dl class="layui-nav-child">
      <dd><a href="javascript:;" onclick="linkIframe('problem_manager.php');">问题列表</a></dd>
      <dd><a href="javascript:;" onclick="linkIframe('answer_list.php');");">回答列表</a></dd>
    </dl>
  </li>
  <li class="layui-nav-item">
    <a href="javascript:;">解决方案</a>
    <dl class="layui-nav-child">
      <dd><a href="">移动模块</a></dd>
      <dd><a href="">后台模版</a></dd>
      <dd><a href="">电商平台</a></dd>
    </dl>
  </li>
  <li class="layui-nav-item"><a href="">云市场</a></li>
  <li class="layui-nav-item"><a href="">社区</a></li>
</ul>


</div>

		  </div>
		  <!-- 右侧 -->
		   <div class="col-xs-12 col-md-10" style="padding: 0px;">

<div style="width: 100%;" id="cv">
	<iframe src="problem_manager.php"  width="100%" height="100%" frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="auto" allowtransparency="yes" id="iframe">
	     	 	
	</iframe>
</div>



		  </div>
	</div>







   

<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="../jquery-3.2.1/jquery-3.2.1.min.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
     <script src="../layui/layui.js"></script>

    <script type="text/javascript">


layui.use('element', function(){
  var element = layui.element;
  
  //…
});




    // 窗口大小改变时执行的函数
    window.onresize = function(){
        resetmenu();   
    }
     // 加载页面时执行的函数
    window.onload=function(){
    	resetmenu();
    	var height =$(window).height()-100;
    	$('#menu').height(height);
    	$('#cv').height(height);
    }

    //左侧菜单控制函数
    function resetmenu(){
    	 var windowWidth = $(window).width();
         if(windowWidth <768){
           $('#leftmenu').css('display','none');
           $('#linkmanu').html('<span class="glyphicon glyphicon-th-large">');
         }else{
         	$('#leftmenu').css('display','');
         	$('#linkmanu').html('Jsonker网站后台管理');
         	
         }
    }


    function showmenu(){
    	 var windowWidth = $(window).width();
         if(windowWidth <768){
            var icss = $('#leftmenu').css('display');
    	    if (icss == 'none') {
                $('#leftmenu').css('display','');
    	    } else {
                $('#leftmenu').css('display','none');
    	     }
         }
    	
    }


    function linkIframe(a){
    	 var windowWidth = $(window).width();
         if(windowWidth <768){
           $('#leftmenu').css('display','none');
           $('#linkmanu').html('<span class="glyphicon glyphicon-th-large">'); 
           var str = a;
           $('#iframe').attr('src',str);
         }else{
           var str = a;
           $('#iframe').attr('src',str);
         }
    }

    
    </script>

</body>
</html>



<?php

} else {
	echo "请按顺序进入网站";
  header("Refresh:2;url=../index.html");
}

?>
