$(document).ready(function(){ 
	getUserInfo();
});	

var res_data;   //所有返回数据
var maxpage = 0;   //最大页数

function getUserInfo(){
	$.post("../controller/getUserInfo.php",function (data) {
    	var data = JSON.parse(data);
		$.each(data,function(key,value){  //遍历键值对
           $('#pageli').before("<li><a href='javascript:;' onclick='setData("+key+");'>"+key+"</a></li>");
           maxpage++;
  		})
		for (var i = 0; i < data[1].length ; i++) {
			var str ="<tr>"
		  		+"<td>"+data[1][i].uid+"</td>"
		  		+"<td>"+data[1][i].uname+"</td>"
		  		+"<td>"+data[1][i].upwd+"</td>"
		  		+"<td>"+data[1][i].ustatus+"</td>"
		  		+"<td>"+data[1][i].utime+"</td>"
		  		+"<td>"+data[1][i].uemail+"</td>"
		  		+"<td>"+data[1][i].Agrede+"</td>"
		  		+"<th><button type='button' class='btn btn-sm btn-info' data-toggle='modal' data-target='#changeModal' onclick='changeUser("+data[1][i].uid+");'>修改</button></th>"
	  			+"<th><button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-target='.bs-example-modal-sm' onclick='setUserid("+data[1][i].uid+");'>删除</button></th>"
		  		+"</tr>";
			$('#itable').append(str);
		}
     	res_data = data;
    });
}

function setData(page){
	//console.log(res_data);
	$("#itable").find("tr").not(":first").remove();
	for (var i = 0; i < res_data[page].length ; i++) {
		var str ="<tr>"
	  		+"<td>"+res_data[page][i].uid+"</td>"
	  		+"<td>"+res_data[page][i].uname+"</td>"
	  		+"<td>"+res_data[page][i].upwd+"</td>"
	  		+"<td>"+res_data[page][i].ustatus+"</td>"
	  		+"<td>"+res_data[page][i].utime+"</td>"
	  		+"<td>"+res_data[page][i].uemail+"</td>"
	  		+"<td>"+res_data[page][i].Agrede+"</td>"
	  		+"<th><button type='button' class='btn btn-sm btn-info' data-toggle='modal' data-target='#changeModal' onclick='changeUser("+res_data[page][i].uid+");'>修改</button></th>"
	  		+"<th><button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-target='.bs-example-modal-sm' onclick='setUserid("+res_data[page][i].uid+");'>删除</button></th>"
	  		+"</tr>";
		$('#itable').append(str);
		$("#hiddenpage").html(page);
	}
	
}

//翻页控制函数
function pageContro(status){
	var page =parseInt($("#hiddenpage").html());
	if (status) {
		if (page+1 > maxpage) {
			alert('已达最大页');
		} else{
			setData(page+1);
		}
	} else{
		if (page-1 < 1) {
			alert('已达最小页');
		} else{
			setData(page-1);
		}
	}
}

//修改模态框查询函数
function changeUser(id){
	var apage =parseInt($("#hiddenpage").html());
	arr = [];
	for (var i = 0; i < res_data[apage].length ; i++) {
		var uid = parseInt(res_data[apage][i].uid);
		if (uid == id) {
			arr = res_data[apage][i];
		}
	}
//	console.log(arr);
	$("#cuid").val(arr['uid']);
	$("#cuname").val(arr['uname']);
	$("#cupwd").val(arr['upwd']);
	$("#cuemail").val(arr['uemail']);
	$("#cAgrede").val(arr['Agrede']);
	$("#custatus").val(arr['ustatus']);
}

//用户信息确认修改函数
function changeUserDeed(){
	$.post("../controller/changeUserInfo.php", $('#changeform').serialize(),function (data) {
//  	console.log(data);
    	var res = JSON.parse(data);
    	if (res.code) {
    		alert(res.msg);
            setTimeout(function(){window.location.reload();},1000);
        }else{
            alert(res.msg);
        }
    });
}


//用户添加函数
function addUser(){
	$.post("../controller/addUserInfo.php", $('#addform').serialize(),function (data) {
	  	console.log(data);
    	var res = JSON.parse(data);
    	if (res.code) {
    		alert(res.msg);
            setTimeout(function(){window.location.reload();},1000);
        }else{
            alert(res.msg);
        }
    });
}

//用户id设置函数
function setUserid(id){
	$("#duid").html(id);
}

function delUser(){
	var uid = $("#duid").html();
	$.post("../controller/delUserInfo.php",{uid:uid},function (data) {
//	  	console.log(data);
    	var res = JSON.parse(data);
    	if (res.code) {
    		alert(res.msg);
            setTimeout(function(){window.location.reload();},1000);
        }else{
            alert(res.msg);
        }
    });
}