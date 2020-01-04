$(document).ready(function(){ 
	setOption();
	getStationMasterInfo();
});	

function getStationMasterInfo(){
	$.post("../controller/getStationMasterInfo.php",function (data) {
    	var data = JSON.parse(data);
		console.log(data);
		$("#name").val(data[0].name);
		$("#profession").val(data[0].profession);
//		$("#age").val(data[0].age);
		$("#rfs").val(data[0].rfs);
		$("#like").val(data[0].like);
		$("#specialty").val(data[0].specialty);
		$("#pac").val(data[0].pac);
		$("#plan").val(data[0].plan);
		$("#selfintro").val(data[0].selfintro);
		for (var i=0; i<100; i++) {
			var hage = $("#sel"+i).html();
			if (hage == data[0].age) {
//				console.log(hage);
				$("#sel"+i).attr('selected','selected');
			}
		}
    });
}

function changeStationMasterInfo(){
	$.post("../controller/changeStationMasterInfo.php", $('#form').serialize(),function (data) {
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


function setOption(){
	var str = "";
	for (var i=0; i<100; i++) {
		str += "<option id ='sel"+i+"'>"+i+"</option>"
	}
	$('#age').append(str);
}
