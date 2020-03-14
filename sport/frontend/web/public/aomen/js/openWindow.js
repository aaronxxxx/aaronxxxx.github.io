//判斷瀏覽器
var ua = [
	["LBBROWSER", "lieboa"],
	["Maxthon", "maxthon"],
	["Firefox", "firefox"],
	["SE", "sogou"],
	["Opera", "Opera"],
	["BIDUBrowser", "baidu"],
	["MSIE", "IE"],
	["Chrome", "chrome"],
	["Safari", "Safari"]
];
 
var _$ = function(id){return document.getElementById(id)};
 
var suitUa = function(){
	var _ua = navigator.userAgent;
	var ual = ua.length;
	for(var i = 0 ; i < ual; i++){
		if(new RegExp(ua[i][0]).test(_ua)){
			return ua[i];
		}
	}
	return ["unkown", "未知??器"];
}
var _cua = suitUa();

function openWindowConvert(url, title) {
	if(_cua[1] == "sogou"){
		alert("請使用其他瀏覽器開啟")
	}else{
    openWindow(url, title, 400, 350);
	};
}

/**
 * 打?窗口
 * @param {string} url      url
 * @param {string} title    窗口名?
 * @param {int} width       窗口?度
 * @param {int} height      窗口高度
 * @returns {}
 */
function openWindow(url, title, width, height) {
    var iTop = (window.screen.availHeight - 30 - height) / 2;                   // ?得窗口的垂直位置
    var iLeft = (window.screen.availWidth - 10 - width) / 2;                    // ?得窗口的水平位置
    window.open(url, title, 'height=' + height + ',,innerHeight=' + height +
        ',width=' + width + ',innerWidth=' + width + ',top=' + iTop +
        ',left=' + iLeft +
        ',status=no,toolbar=no,menubar=no,location=no,resizable=no,scrollbars=0,titlebar=no').focus();
}