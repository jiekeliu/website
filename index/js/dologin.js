$(document).ready(function(){ 
	resetHeight();
});

//信息提交函数
$('#submit_btn').click(function () {
	var uname = $('#uname').val();
	var upwd = $('#upwd').val();
	if (uname == '') {
		alert('name not allow empty')
		return;
	}
	if (upwd == '') {
		alert('pwd not allow paraty')
		return;
	}
    $.post("../controller/dologin.php", $('#form').serialize(),function (data) {
    	var data = JSON.parse(data);
    	console.log(data);  
    	if (data.code) {
    		alert(data.msg);
    		setTimeout(window.location.href ="../controller/checkCookie.php",1000);
    	} else{
    		alert(data.msg);
    	}    
    });
});


function resetHeight(){
	var h = ($(document).height()-$('#con').height())/2;
	$('#con').css('margin-top',h);
}