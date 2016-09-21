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
	$(".caidan").eq(1).find("dd").css('display','block');
	$(".caidan").eq(1).find("dd").eq(5).css('background','#ececec');
	
	//以下为加减数量
	$(".jia").click(function()
	{
		var val = $(".inp2").val();
		
		if(val<100){
			val++
			$(".inp2").val(val)
		}
	});
	
	$(".jian").click(function()
	{
		var val = $(".inp2").val();
		
		if(val>1){
			val--
			$(".inp2").val(val)
		}
	});
})