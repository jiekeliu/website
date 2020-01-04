$(document).ready(function(){ 
	resetHeight();
});
//	信息提交函数
$('#submit_btn').click(function () {
    $.post("../controller/web_conn_sql.php", $('#form').serialize(),function (data) {
    	console.log(data);
    	var res = JSON.parse(data);
    	if (res.code) {
    		alert(res.msg);
    		setTimeout(window.location.href ='web_datebase.html',1000);
    	} else{
    		alert(res.msg);
    	}
    });
})

function resetHeight(){
	var h = ($(document).height()-$('#con').height())/2;
	$('#con').css('margin-top',h);
//	console.log(h);
}


