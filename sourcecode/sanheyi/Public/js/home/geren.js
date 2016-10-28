$(function()
{
	//以下为样式设计
	//$(".beijing").css('height',$(window).height());
	//$(".denglu").css('top',341);
	//$(".denglu").css('left',249);
	
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