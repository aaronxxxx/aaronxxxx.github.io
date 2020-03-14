function setbet(datas) {
    var touzhutype = 0;
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
                $.post("/?r=sport/other/other-match",
                    {ball_sort: datas[0], touzhuxiang:datas[1], match_id:datas[2],
                        point_column: datas[3],ben_add: datas[4],is_lose:datas[5],
                        xx: datas[6],touzhutype: touzhutype, rand: Math.random()},
                function (data) {
                    parent.leftFrame.bet(data.msg);
                }, "json");
            }
        }
    })
}


