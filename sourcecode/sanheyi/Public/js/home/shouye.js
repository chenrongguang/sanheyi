$(function()
{
	//以下为导航栏效果
	$(".caidan dt").click(function()
	{
		$(".caidan").css('background','#c9cacb');
		$(this).parent(".caidan").css('background','#ddddde');
		$(this).find("img").attr('src','/Public/images/4.png');
		$(".caidan dt img").not($(this).find("img")).attr('src','/Public/images/3.png');
		$(this).parent(".caidan").find("dd").slideToggle();
		$(".caidan dd").not($(this).parent(".caidan").find("dd")).slideUp();
	})
	
	//以下为广告窗口动效
	$(".er li").hover(function()
	{
		$(this).find(".erxiao").css({
			"animation-name":"move",
			"animation-duration": "0.5s",
			"animation-timing-function":"ease-in",
			"animation-delay":"0",
			"animation-iteration-count":"1",
			"animation-fill-mode":"forwards",			
		});
	},function()
	{
		$(this).find(".erxiao").css({
			"animation-name":"dow",
			"animation-duration": "0.5s",
			"animation-timing-function":"ease-in",
			"animation-delay":"0",
			"animation-iteration-count":"1",
			"animation-fill-mode":"forwards",
		});
	});
})