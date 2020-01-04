$(document).ready(function(){ 
	getWebsiteInfo();
	getWebInfo();
});	
//导航信息获取函数
function getWebsiteInfo(){
	$.post("../controller/getWebsiteInfo.php",function (data) {
    	var data = JSON.parse(data);
//		console.log(data);
		for (var i = 0; i < data.length ; i++) {
			var str ="<tr>"
		  		+"<form method='post' id='barform"+data[i].tid+"'>"
				+"<td>"+data[i].tid+"</td>"
				+setOptionForList(data[i], data)
				+"<td><input type='text' name='tname' id='tname"+data[i].tid+"' value='"+data[i].tname+"' /></td>"
				+"<td><input type='text' name='turl' id='turl"+data[i].tid+"' value='"+data[i].turl+"' /></td>"
			  	+"</form>"
			  	+"<td><button type='button' class='btn btn-info btn-sm' onclick='changeNavbar("+data[i].tid+")'>修改</button></td>"
				+"<th><button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-target='.bs-example-modal-sm' onclick='setBarid("+data[i].tid+");'>删除</button></th>"
		  		+"</tr>";
			$('#itable').append(str);
		}
		setOption(data);
    });
}
//列表父导航id设置函数
function setOptionForList(data, alldata){
	str = "<td>"
		+"<select class='form-control' name='father_id' id='father_id"+data.tid+"'>"
		+"<option id ='sel0'>0</option>";	      	
	var tid = parseInt(data['tid']);
	var father_id = parseInt(data['father_id']);
	$.each(alldata,function(index,value){
		var tpid = parseInt(value['father_id']);
		if(tpid == 0 && value['tid']!=tid){
			if (father_id == value['tid']) {
				str += "<option id ='sel"+value['tid']+"' selected>"+value['tid']+"</option>";
			} else{
				str += "<option id ='sel"+value['tid']+"'>"+value['tid']+"</option>";
			}
		}
	});
	str +="</select>"+"</td>";
	return str;
}

//父导航id设置函数
function setOption(data){
//	console.log(data);
	var str = "";
	$.each(data,function(index,value){
		var tpid = parseInt(value['father_id']);
		if(tpid == 0){
			str += "<option id ='sel"+value['tid']+"'>"+value['tid']+"</option>";
		}
	});
	$('#father_id').append(str);
}
//网站信息获取函数
function getWebInfo(){
	$.post("../controller/getWebInfo.php",function (data) {
    	var data = JSON.parse(data);
//		console.log(data);
		$("#web_name").val(data[0].web_name);
		$("#webimg_url").val(data[0].webimg_url);
		$("#webfooter_info").val(data[0].webfooter_info);
    });
}


function changeWebInfo(){
	$.post("../controller/changeWebINfo.php", $('#webform').serialize(),function (data) {
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

//导航修改函数
function changeNavbar(id){
	var father_id = $("#father_id"+id).val();
	var tname = $("#tname"+id).val();
	var turl = $("#turl"+id).val();
	var tid = id;
	var subdata = {tid:tid, father_id:father_id, tname:tname, turl:turl}
//	console.log(subdata);
	$.post("../controller/changeWebsiteInfo.php",subdata,function (data) {
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

//导航添加函数
function addBar(){
	$.post("../controller/addWebsiteInfo.php", $('#addform').serialize(),function (data) {
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

//用户id设置函数
function setBarid(id){
	$("#duid").html(id);
}

//导航删除函数
function delNavbar(){
	var tid = $("#duid").html();
	$.post("../controller/delWebsiteInfo.php",{tid:tid},function (data) {
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