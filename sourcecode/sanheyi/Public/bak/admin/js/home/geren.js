$(function()
{
	//以下为样式设计
	$(".beijing").css('height',$(window).height());
	$(".denglu").css('top',$(window).height()*0.3);
	$(".denglu").css('left',($(window).width()-$(".denglu").width())/2);
	
	//以下为输入框得到焦点时边框变色效果
	$(".shuru").focus(function(){
		$(".shuru").css('border-color','#c2c2c2');
		$(".shuru").css('box-shadow','none');
		$(this).css('border-color','#66afe9');
		$(this).css('box-shadow','0 0 1px #66afe9 inset,0 0px 8px #66afe9');
	});
	$(".shuru").blur(function()
	{
		$(".shuru").css('border-color','#c2c2c2');
		$(".shuru").css('box-shadow','none');
	})
})