//  --------top_fix_module--------
      var hd_status = true;
      $("#hd_left,#hd_right").click(function () {
        if (hd_status == false) {
           hd_show();
           hd_status = true;
        } else {
           hd_shr();
           hd_status = false;
        }
         
      });
      function hd_show(){
        // $("#hd_content").css("width","84%");
        $("#head").css("animation","hd_stretch .3s linear forwards");
        $("#nav_ul").append('<li><a href="#">学习笔记</a> </li>');
        $("#nav_ul").append('<li><a href="#">成果展示</a> </li>');
        $("#nav_ul").append('<li><a href="#">汉译文档</a> </li>');
        $("#nav_ul").append('<li><a href="#">文章分享</a> </li>');
        $("#nav_ul").append('<li><a href="#">问题解答</a> </li>');
        $("#nav_ul").append('<li><a href="#">视屏音频</a> </li>');
        $("#nav_ul").append('<li><a href="#">关于我</a> </li>');
      }
      function hd_shr(){
        $("#head").css("animation","hd_shrink .3s linear forwards");
        $("#nav_ul").empty();
      }
// --------top_fix_module--------