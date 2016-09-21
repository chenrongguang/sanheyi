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
	//$(".caidan").eq(1).find("dd").slideDown();
	$(".caidan").eq(1).find("dd").css('display','block');
	$(".caidan").eq(1).find("dd").eq(4).css('background','#ececec');
	
	//erweima
	var qrcode = new QRCode(document.getElementById("erwei"), {
            width : 350,//设置宽高
            height : 350
        });
        qrcode.makeCode($("#fuzhi").val());
        /*document.getElementById("send").onclick =function(){
            qrcode.makeCode(document.getElementById("getval").value);
        }*/
	
	//以下为点击复制
	function copyUrl2()
	{
		var Url2=document.getElementById("fuzhi");
		Url2.select(); // 选择对象
		document.execCommand("Copy"); // 执行浏览器复制命令
		alert("已复制好，可贴粘。");
	}
	
	$(".bot").click(function()
	{
		copyUrl2();
	})


	
})