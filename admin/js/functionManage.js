$(document).ready(function(){ 
	getFunctionInfo();
});	

var res_data;   //所有返回数据
var maxpage = 0;   //最大页数

function getFunctionInfo(){
	$.post("../controller/getFunctionInfo.php",function (data) {
    	var data = JSON.parse(data);
		$.each(data,function(key,value){  //遍历键值对
           $('#pageli').before("<li><a href='javascript:;' onclick='setData("+key+");'>"+key+"</a></li>");
           maxpage++;
  		})
		for (var i = 0; i < data[1].length ; i++) {
			var str ="<tr>"
		  		+"<td>"+data[1][i].fid+"</td>"
		  		+"<td>"+data[1][i].fpid+"</td>"
		  		+"<td>"+data[1][i].fname+"</td>"
		  		+"<td>"+data[1][i].furl+"</td>"
		  		+"<td>"+data[1][i].fgrade+"</td>"
		  		+"<td>"+data[1][i].fstatus+"</td>"
		  		+"<th><button type='button' class='btn btn-sm btn-info' data-toggle='modal' data-target='#changeModal' onclick='changeUser("+data[1][i].fid+");'>修改</button></th>"
	  			+"<th><button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-target='.bs-example-modal-sm' onclick='setFunctionid("+data[1][i].fid+");'>删除</button></th>"
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
	  		+"<td>"+res_data[page][i].fid+"</td>"
		  	+"<td>"+res_data[page][i].fpid+"</td>"
		  	+"<td>"+res_data[page][i].fname+"</td>"
		  	+"<td>"+res_data[page][i].furl+"</td>"
		  	+"<td>"+res_data[page][i].fgrade+"</td>"
		  	+"<td>"+res_data[page][i].fstatus+"</td>"
	  		+"<th><button type='button' class='btn btn-sm btn-info' data-toggle='modal' data-target='#changeModal' onclick='changeUser("+res_data[page][i].fid+");'>修改</button></th>"
	  		+"<th><button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-target='.bs-example-modal-sm' onclick='setFunctionid("+res_data[page][i].fid+");'>删除</button></th>"
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
		var fid = parseInt(res_data[apage][i].fid);
		if (fid == id) {
			arr = res_data[apage][i];
		}
	}
	console.log(arr);
	$("#cfid").val(arr['fid']);
	$("#cfpid").val(arr['fpid']);
	$("#cfname").val(arr['fname']);
	$("#cfurl").val(arr['furl']);
	$("#cfgrade").val(arr['fgrade']);
	$("#cfstatus").val(arr['fstatus']);
}

//用户信息确认修改函数
function changeFunctionDeed(){
	$.post("../controller/changeFunctionInfo.php", $('#changeform').serialize(),function (data) {
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

//功能添加函数
function addFunction(){
	$.post("../controller/addFunctionInfo.php", $('#addform').serialize(),function (data) {
//	  	console.log(data);
    	var res = JSON.parse(data);
    	if (res.code) {
    		alert(res.msg);
            parent.location.reload();
        }else{
            alert(res.msg);
        }
    });
}

//用户id设置函数
function setFunctionid(id){
	$("#duid").html(id);
}

function delFunction(){
	var fid = $("#duid").html();
	$.post("../controller/delFunctionInfo.php",{fid:fid},function (data) {
//	  	console.log(data);
    	var res = JSON.parse(data);
    	if (res.code) {
    		alert(res.msg);
            parent.location.reload();
        }else{
            alert(res.msg);
        }
    });
}