$(function()
{
	//以下为导航栏效果
	$(".caidan dt").click(function()
	{
		$(".caidan").css('background','#c9cacb');
		$(this).parent(".caidan").css('background','#ddddde');
		$(this).find("img").attr('src','images/4.png');
		$(".caidan dt img").not($(this).find("img")).attr('src','images/3.png');
		$(this).parent(".caidan").find("dd").slideToggle();
		$(".caidan dd").not($(this).parent(".caidan").find("dd")).slideUp();
	})
	
	//以下为点击复制
	/*function copyToClipboard(txt) {
    if (window.clipboardData) {
        window.clipboardData.clearData();
        window.clipboardData.setData("Text", txt);
        alert("已经成功复制到剪帖板上！");
    } else if (navigator.userAgent.indexOf("Opera") != -1) {
        window.location = txt;
    } else if (window.netscape) {
        try {
            netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
        } catch(e) {
            alert("被浏览器拒绝！\n请在浏览器地址栏输入'about:config'并回车\n然后将'signed.applets.codebase_principal_support'设置为'true'");
        }
        var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
        if (!clip) return;
        var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
        if (!trans) return;
        trans.addDataFlavor('text/unicode');
        var str = new Object();
        var len = new Object();
        var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
        var copytext = txt;
        str.data = copytext;
        trans.setTransferData("text/unicode", str, copytext.length * 2);
        var clipid = Components.interfaces.nsIClipboard;
        if (!clip) return false;
        clip.setData(trans, null, clipid.kGlobalClipboard);
        alert("已经成功复制到剪帖板上！");
		}
	}
	function copyTo() {
		var txt = $(".kuang").val();
		alert(txt)
		copyToClipboard(txt);
	}*/
	
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