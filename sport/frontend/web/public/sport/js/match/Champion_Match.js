//datas(match_type,match_id,tid,x_title,url)
function setbet(datas) {
    var touzhutype = 2;//touzhutype = 2为冠军
    $.ajax({
        type: "get",
        url: "/?r=passport/user-api/login",
        data: {},
        dataType: "json",
        success: function (data) {
            if (data.code == 1) {
               layer.msg("登录后才能进行此操作",{icon:2,time:2000});
                return;
            } else {
                $.post(datas[4],{match_type:datas[0], match_id:datas[1],
                    tid:datas[2], x_title:datas[3],touzhutype:touzhutype, rand:Math.random()},
                    function (data) {
                            parent.leftFrame.bet(data.msg);
                        }, "json");}
        }
    })
}

