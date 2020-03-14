// typename_in游戏类型
// touzhuxiang_in游戏玩法
// match_id_in比赛ID
// point_column_in下注类型（如Match_DsSpl=单双-双）
// ben_add_in//计算输赢，ben_add为1时减本金，否则不减
// is_lose_in	如果为1，说明是滚球，需要等待确认（注，篮球滚球不需要确认）
// xx_in 玩法信息，如单，双  不入数据库
// touzhutype 1未串关，0为单式
// function setbet(typename_in, touzhuxiang_in, match_id_in, point_column_in, ben_add_in, is_lose_in, xx_in) {
function setbet(datas) {
    var touzhutype = datas[7] ? datas[7] : 0;
    $.ajax({
        type: "post",
        url: "/?r=passport/user-api/login",
        data: {},
        dataType: "json",
        success: function (rst) {
            if (rst.code == 1) {
                layer.msg("登录后才能进行此操作",{icon:2,time:2000});
                return;
            } else {
                $.post("/?r=sport/football/football-match",
                    {ball_sort: datas[0],touzhuxiang:datas[1], match_id:datas[2],
                        point_column: datas[3],ben_add: datas[4],is_lose:datas[5],
                        xx: datas[6],touzhutype: touzhutype, rand: Math.random()}
                , function (data) {
                    parent.leftFrame.bet(data.msg);
                },
                      "json");
            }
        }
    })
}

