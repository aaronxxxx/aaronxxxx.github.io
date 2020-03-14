function setbet(datas) {
     var touzhutype = datas[7] ? datas[7] : 0;
    $.ajax({
        type: "get",
        url: "/?r=passport/user-api/login",
        data: {},
        dataType: "json",
        success: function (rst) {
            console.log(rst);
            if (rst.code == 1) {
                layer.msg("登录后才能进行此操作",{icon:2,time:2000});
                return;
            }  else {
                if (touzhutype == 1 && (datas[3] == "Match_Ao" || datas[3] == "Match_Ho")) { //让球串关
                    var patrn = /[0-9.\/]{1,}-/;
                    var pl = patrn.exec(datas[1]);
                    patrn = /[0-9.\/]{1,}/;
                    pl = patrn.exec(datas[1]);
                    if (pl == "0") {
                        alert("篮美标准盘不允许串关");
                        return;
                    }
                }
                $.post("/?r=sport/basketball/basketball-match",
                    {ball_sort: datas[0], touzhuxiang:datas[1], match_id:datas[2],
                    point_column: datas[3],ben_add: datas[4],is_lose:datas[5],
                    xx: datas[6],touzhutype: touzhutype, rand: Math.random()},
                    function (data) {
                    parent.leftFrame.bet(data.msg);
                },
                        "json");
            }
        }
    })
}
