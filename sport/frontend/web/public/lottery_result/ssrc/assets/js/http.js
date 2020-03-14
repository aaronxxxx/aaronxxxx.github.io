
	var url = window.location.href;
			 if (url.indexOf("https") < 0) {
			   var ishttp = false;
			   if(url.indexOf("kbcp88.com") > 0) {
				ishttp = true;
			   }
			   if(url.indexOf("www.kbcp88.com") > 0) {
				ishttp = true;
			   }
			  if(ishttp){
			   url = url.replace("http:", "https:");
			   window.location.href = url;
			  }
			}
