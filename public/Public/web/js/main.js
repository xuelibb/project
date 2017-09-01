$(function(){
	/*main-left高度控制*/
	var mr_height = $(".main-right").height();
	$(".main-left").css("height",mr_height + 'px');

	/*sub-nav控制*/
	$(".main-left .sub-nav li").click(function(){
		$(this).parent().find("li").removeClass("active");
		$(this).addClass("active");
	})

	var win_width = $(window).width();
	var win_height = $(window).height();
	$(".recharge-bg-box .bg1").css("height",(win_height/2) + 'px');
	$(".recharge-bg-box .bg1 .arrow").css({'border-left-width':(win_width/2)+'px','border-right-width':(win_width/2)+'px','border-top-width':80});
	$(".recharge-bg-box .bg2").css("height",(win_height/2) + 'px');

	/*设置recharge-ft-bg的位置*/
	if($("body").height()<win_height){
		$(".recharge-ft-bg").addClass("active");
	}
	// $(window).resize(function(){
	// 	if($("body").height()<win_height){
	// 		$(".recharge-ft-bg").addClass("active");
	// 	}
	// })
})


