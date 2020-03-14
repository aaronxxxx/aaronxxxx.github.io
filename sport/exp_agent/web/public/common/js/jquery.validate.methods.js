jQuery.validator.addMethod("mobile",  
    function(value, element, param) {
		var reg = /^1[3|5|7|8|9]\d{9}$/;
		return this.optional(element) || reg.test(value); 
    },
"值不合法");

jQuery.validator.addMethod("phone",  
    function(value, element, param) {
		var reg = /^1[3|5|7|8|9]\d{9}|0\d{2,3}-?\d{7,8}$/;
		return this.optional(element) || reg.test(value); 
    },
"值不合法");

jQuery.validator.addMethod("money",  
    function(value, element, param) {
		var reg = /^(0|[1-9]\d*)(\.\d{1,2})?$/;
		return this.optional(element) || reg.test(value); 
    },
"金额输入不正确");

jQuery.validator.addMethod("password",
	    function(value, element, param) {
			var upperCase= new RegExp('[A-Z]');
		    var lowerCase= new RegExp('[a-z]');
		    var numbers = new RegExp('[0-9]');
	        var capitalletters = 0;
	        var loweletters = 0;
	        var number = 0;
	        if (value.match(upperCase)) { capitalletters = 1} else { capitalletters = 0; };
	        if (value.match(lowerCase)) { loweletters = 1}  else { loweletters = 0; };
	        if (value.match(numbers)) { number = 1}  else { number = 0; };
	        var total = capitalletters + loweletters + number;
			return this.optional(element) || (total == 3); 
	    },
	"值不合法");

jQuery.validator.addMethod("remotecheck",  
    function(value, element, param) {
        var result=false;
        var url=param,store=$(element).data("store");
        if(store!=null && store==value){
        	result=true;
        }else{
          if(url!=null && url.trim()!=""){
        	  var pd = {};
  			  pd[element.name] = value;
        	  $.ajaxRequest({
        		async:false,
  				type : "POST",
  				url : url,
  				data : pd,
  				beforeSend : function() {
  				},
  				success : function(data) {
  					if(data.msg&&data.msg=="true"){
  						result=true;
  					}
  				},
  				complete : function() {
  					
  				}
  			 });
          }
        }
        return result;
    },
"值已存在！");

