$(document).ready(function(){ 
	resetHeight();
	checkReferrer();
	getfunctioninfo();
	getstationmasterinfo();
});		
//访问来源检测函数
function checkReferrer(){
	var fromurl = document.referrer;
	if (fromurl=='') {
		window.location.href ="http://www.newweb.com/index/view/dologin.html"
	} 
}
//功能信息获取设置函数
function getfunctioninfo(){
	$.post("../controller/functioninfo.php",function(data){
	    var res = JSON.parse(data);
//	    console.log(res);
	    var fun_data = [];
	    fun_data[0] = [];
		for(var i =0 ;i < res.length;i++){
			var fpid = parseInt(res[i]['fpid']);
			if (fpid == 0) {
				var fid = parseInt(res[i]['fid']);
				fun_data[0].push(res[i]);
				fun_data[fid] = [];
			}
			if(fpid != 0){
				fun_data[fpid].push(res[i]);
			}
	    }
		
		$.each(fun_data[0],function(index,value){
			var id = parseInt(value['fid']);
			if (fun_data[id].length > 0) {
				var str = "<li role='presentation' class='dropdown'>"
					    +"<a class='dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>"
					    + value['fname']+"<span class='caret'></span>"
					    +"</a>"
					    +"<ul class='dropdown-menu'>";
				str +="<li role='presentation'>"
					+"<a href='javascript:;' onclick=\"linkIframe('"+value['furl']+"')\">"+value['fname']+"</a>"
					+"</li>";
				$.each(fun_data[id],function(index2,value2){
					str += "<li role='presentation'>"
					+"<a href='javascript:;' onclick=\"linkIframe('"+value2['furl']+"')\">"+value2['fname']+"</a>"
					+"</li>";
				});	
				str +="</ul></li>";
				$('#ul').before(str);
				
			} else{
				var str = "<li role='presentation'>"
				+"<a href='javascript:;' onclick=\"linkIframe('"+value['furl']+"')\">"+value['fname']+"</a>"
				+"</li>";
		    	$('#ul').before(str);
			}
		});  //each
		
	});   //post
}
		
//站长信息获取设置函数
function getstationmasterinfo(){
	$.post("../controller/stationmasterinfo.php",function(data){
	    var res = JSON.parse(data);
//		console.log(res);
		$('#name').html(res[0].name+'网站后台');
	});
}

function resetHeight(){
	var h = ($(document).height()-$('#topbar').height());
//	$('#ul').css('height',h);
	$('#iframe').css('height',h-10);
}
//链接转换函数
function linkIframe(a){
    var str = a;
    $('#iframe').attr('src',str);
}

//cookic删除函数
function deleteCookie() {
    var cookies = document.cookie.split(";");
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
    }
    if(cookies.length > 0)
    {
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i];
            var eqPos = cookie.indexOf("=");
            var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
            var domain = location.host.substr(location.host.indexOf('.'));
            document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/; domain=" + domain;
        }
    }
}

function exitSystem(){
	deleteCookie();
    window.location.href ="../../index/view/index.html";
}