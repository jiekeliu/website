$(document).ready(function(){ 
	resetHeight();
});

//信息提交函数
$('#submit_btn').click(function () {
	var uemail = $('#uemall').val();
	var chk_res = checkEmeail(uemail);
	if (!chk_res) {
		alert("邮箱表达式错误，请重新输入");
		$('#uemall').val("");
		return;
	} 
    $.post("../controller/web_datebase.php", $('#form').serialize(),function (data) {
    	var res = JSON.parse(data);
    	console.log(res);
    	if (res.code) {
    		alert(res.msg);
    		setTimeout(window.location.href ='../../index.php',1000);
    	} else{
    		alert(res.msg);
    	}       
    });
});

//邮箱格式校验函数
function checkEmeail(email){
	var reg = /^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/; //邮箱js正则
	if(reg.test(email)){
		return 1;
	}else{
		return 0;
	}
}

function resetHeight(){
	var h = ($(document).height()-$('#con').height())/2;
	$('#con').css('margin-top',h);
}