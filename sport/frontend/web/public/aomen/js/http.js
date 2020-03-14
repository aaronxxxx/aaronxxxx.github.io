
	var url = window.location.href;
			 if (url.indexOf("https") < 0) {
			   var ishttp = false;
			   if(url.indexOf(".com") > 0) {
				ishttp = true;
			   }
			   if(url.indexOf("www..com") > 0) {
				ishttp = true;
			   }
			  if(ishttp){
			   url = url.replace("http:", "https:");
			   window.location.href = url;
			  }
			}
