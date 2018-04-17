$(".layui-nav-item a").on("click",function(){
			$(this).parent("li").siblings().removeClass("layui-nav-itemed");
			if($(this).parent("li").hasClass("layui-nav-itemed")){
				$(this).parent("li").removeClass("layui-nav-itemed");
			}else{
				$(this).parent("li").addClass("layui-nav-itemed");
			}

			/*$(this).parent('li').addClass("layui-this");
			$(this).parent('dd').addClass("layui-this");*/
			
		})

if(navgradenum != 0){
		$(".layui-this").removeClass("layui-this");
		$(".layui-nav-itemed").removeClass("layui-nav-itemed");

	switch(navgradenum){
		case '2'://二级菜单
				$("#"+navmarkid).parent('li').addClass('layui-this');
			break;
		case '3'://三级菜单
				$("#"+navmarkid).parent('dd').addClass('layui-this');
				$("#"+navmarkid).parent().parent().parent('li').addClass('layui-nav-itemed');
			break;
		default:

	}
}


$(".pagination li").click(function(){
	var linkpage = $(this).find('a').attr('href');
	var ary = linkpage.split("?");
	var url = ary[1];
	var ary = url.split("&");
	var url = ary[0];
	var pagenum = url.split("=")[1];

	$("#searchform #pagenum").attr('value',pagenum);
	$("#searchform").submit();
	return false;
});

