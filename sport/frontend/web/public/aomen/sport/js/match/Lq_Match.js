function setbet(typename_in, match_name_in, match_id_in, point_column_in, ben_add_in, is_lose, xx_in, tztype) {
    if (!$("#username").val()) { //没有登录
        layer.confirm('还未登录,是否现在登录？', {btn: ['确定', '取消']},
                function () {
                    var $url = window.location.href;
                    var $index = $url.indexOf('/?r=');
                    if (parseInt($index) >= 0) {
                        $url = $url.substr($index);
                        $url = $url.replace('/?r=', '[]');
                      $url=$url.replace(/&/g,'{}');
                    }
                    top.location = '/?r=mobile/disp/login&url=' + $url;
                }, function (index) {
            layer.close(index);
        });
    } else {


        if (tztype == 1 && (point_column_in == "Match_Ao" || point_column_in == "Match_Ho")) { //让球串关
            var patrn = /[0-9.\/]{1,}-/;
            var pl = patrn.exec(touzhuxiang_in);
            patrn = /[0-9.\/]{1,}/;
            pl = patrn.exec(touzhuxiang_in);
            if (pl == "0") {
                alert("篮美标准盘不允许串关");
                return;
            }
        }
        touzhutype = tztype;
        $.post("/?r=sport/basketball/basketball-match",
                {ball_sort: typename_in, touzhuxiang: match_name_in, match_id: match_id_in, point_column: point_column_in, ben_add: ben_add_in, is_lose: is_lose, xx: xx_in, touzhutype: touzhutype, rand: Math.random()}
        , function (data) {
            bet(data.msg);
        },
                "json");
    }
}