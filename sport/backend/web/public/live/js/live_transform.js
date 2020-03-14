function confirmChangeMoney(){

	var amount= $("#amount").val();
	var platform = $('#platform').val();
	var transform = $("#transform").val();
	var userid=$("#uid").val();
	

    if(amount==""){
        alert("请输入转账金额。");
        return;
    }
    
    var regu = /^[-]{0,1}[0-9]{1,}$/;
    if(!regu.test(amount)){
        alert('金额不是整数或者网络繁忙，请稍后重试。');
        return;
    }
    
    if(confirm("确定转账吗？")){
        if (!checkChangeMoney(userid,amount,platform,transform)) {
            return false;
        }
        $.ajax({
            async: false,
            type: "POST",
            url: "/?r=live/exchange-api/index",
            data: {
            	userid:userid,
            	amount: amount,
            	platform: platform,
            	transform:transform,
            },
            dataType: "json",
            beforeSend: function(){
                $("#btn_int").attr({disabled: "disabled" });
                $("#btn_out").attr({disabled: "disabled" });
                //$.blockUI({message:'转账中,请稍候...'});
                
            },
            success: function (data) {
                if (data.code === 0) {
                    alert('转账成功');
                    window.history.go(-1);
                    //location.href="/#/live/user";
                    //console.log('转账成功');
                } else {
                    alert(data.msg);
                }
                
                //document.write("<script>window.location.href = '/?r=member/live/index';</script>");
                //document.write("<script>window.location.href = '/#/member/live/index';</script>");
            },
            complete: function() {
             //   $.unblockUI();
                $("#btn_int").removeAttr("disabled");
                $("#btn_out").removeAttr("disabled");
            },
            error: function (error) {
                //console.log('error'+error.responseText);
                alert('error'+error.responseText);
            }
        });
    }
}

function checkChangeMoney(userid,amount,platform,transform){
    if (!checkAccount(userid,amount,platform,transform)) {
        return false;
    } else if (!checkMoney(userid,amount,platform,transform)) {
        return false;
    }

    return true;
}

function checkAccount(userid,amount,platform,transform) {
    var ret = false;
    
    $.ajax({
        async: false,
        type: 'post',
        url: '/?r=live/exchange-api/check-account',
        data: {
        	userid:userid,
        	amount:amount,
        	platform:platform,
        	transform:transform
        },
        dataType: "json",
        beforeSend: function(){
            // ...
        },
        success: function(data) {
            if (data === 'undefinded' || data.code === 'undefinded') {
                return false;
            }

            ret = data.code === 0 ? true : false;
            if (ret === false) {
                alert(data.msg);
            }
        },
        complete: function() {
            // ...
        },
        error: function(msg) {
            //alert(msg);
            return false;
        }
    });
    
    return ret;
}

function checkMoney(userid,amount,platform,transform) {
    var ret = false;
    
    $.ajax({
        async: false,
        type: 'post',
        url: '/?r=live/exchange-api/check-money',
        data: {
        	userid:userid,
        	amount:amount,
        	platform:platform,
        	transform:transform
        },
        dataType: "json",
        beforeSend: function(){
            // ...
        },
        success: function(data) {
            if (data === 'undefinded' || data.code === 'undefinded') {
                //console.log(data);
                return false;
            }
            
            ret = data.code === 0 ? true : false;
            if (ret === false) {
                //console.log(data);
                alert(data.msg);
            }
        },
        complete: function() {
            // ...
        },
        error: function(msg) {
            //console.log(msg);
            //alert(msg);
            return false;
        }
    });
    
    return ret;
}
