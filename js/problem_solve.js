layui.use(['element', 'layer'], function(){
    var element = layui.element;
    var layer = layui.layer;
  	$ = layui.jquery;
});
        
function search(){
    var search = $('#search').val();
	if (search == '') {
		layer.alert("search不能为空",{icon:2});
			return;
	}
	window.location.href = "problem_solve.php?search="+search;
}  