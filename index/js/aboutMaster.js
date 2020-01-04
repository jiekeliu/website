$(document).ready(function(){ 
	$(".headerpage").load("header.html");
	$(".footerpage").load("footer.html");
	getStationMasterInfo();
});

function getStationMasterInfo(){
	$.post("../../admin/controller/getStationMasterInfo.php",function (data) {
    	var data = JSON.parse(data);
//		console.log(data);
		$("#name").html(data[0].name);
		$("#name2").html(data[0].name);
		$("#selfintro").html(data[0].selfintro);
		$("#profession").html(data[0].profession);
		$("#age").html(data[0].age);
		$("#rfs").html(data[0].rfs);
		$("#like").html(data[0].like);
		$("#specialty").html(data[0].specialty);
    });
}
