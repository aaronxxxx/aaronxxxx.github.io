// JavaScript Document
function loadSource($src,$type){
    if($type == "js"){
        var $hd= document.createElement('script');
        $hd.setAttribute("type","text/javascript");
        $hd.setAttribute("src",$src);
    }else if($type == "css"){
        var $hd = document.createElement('link');
        $hd.setAttribute("rel","stylesheet");
        $hd.setAttribute("type","text/css");
        $hd.setAttribute("href",$src);
    }
   if(typeof $hd != "undefined"){
        document.getElementsByTagName("head")[0].appendChild($hd);
    }
    
}
function page($page){
	alert($page);
}
loadSource("/public/common/css/page.css","css");