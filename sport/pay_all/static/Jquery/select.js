$(function($) {

 //选择金额
 allMoneyLi=$(".moneyBox li");
 skl_money=$("input[name='money']");
 skl_custom_money=$("input[name='skl_custom_money']");
 skl_otherMoney="其他金额";

 allMoneyLi.click(function(){	  
	  
	//先移除样式
	allMoneyLi.removeClass("selectli");
	
	thisLi=$(this);
	thisLi.addClass("selectli");
	
	skl_money.val(thisLi.attr("data-value"));
	$("input[name='skl_money_type']").val(thisLi.attr("money-type"));
	 
  });
  
  
 //选择支付方式
 allPayLi=$(".payBox li");

 allPayLi.click(function(){	  
	  
	//先移除样式
	allPayLi.removeClass("selectli");
	
	thisPayLi=$(this);
	thisPayLi.addClass("selectli");
	

	$("input[name='typ']").val(thisPayLi.attr("data-payAlias"));
	
	//改变seller_email键
	$("input[id='seller_email']").attr("name",thisPayLi.attr("data-EmailKey"));	
	
	//改变money键	
	skl_money.attr("name",thisPayLi.attr("data-MoneyKey"));
	 
  }); 
 
		//获得焦点
	skl_custom_money.focus(function(){
    if(skl_custom_money.val() == skl_otherMoney){
		  skl_money.val(skl_custom_money.val(""));
		}
		
	});

	//焦点离开
	skl_custom_money.focusout(function(){
		skl_money.val(skl_custom_money.val());
	});	
  
  //显示默认金额
  allMoneyLi.first().click();
  
  //显示默认的支付方式  
  allPayLi.eq(0).click() 
//alert(addds);
 });