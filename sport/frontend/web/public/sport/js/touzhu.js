var cg_count = 0; //串关串数
var winRedirect = 0;
var resetCheck = 1;
var time = 20;
var checked = 'checked';
var bet_file = 'football/football-match';
var typename_in = '';
var touzhuxiang_in = '';
var match_id_in = '';
var point_column_in = '';
var ben_add_in = '';
var is_lose_in = '';
var xx_in = '';
var tid_in = '';
var cgdata1 = '';
var cgdata2 = '';
var topname = '';
var touzhutype = 0;
//计算可赢多少钱
function js_money() {
    //输入金额，最高可赢跟着改变
    var bet_money = parseFloat($("#bet_money").val());
    var user_money = $("#user_money").html();
    user_money = parseFloat(user_money.replace("RMB", " "));
    if (bet_money > 0 && bet_money <= user_money) {
        if (touzhutype == 0) {//单式下注
            temp_point = parseFloat($("#ds input[name='bet_point[]']").val()) + parseInt($("#ds input[name='ben_add[]']").val(), 10);
            var win = (bet_money * temp_point - bet_money).toFixed(2);
            $("#win_span").html(win);
            $("#bet_win").val(win);
        }
        if (touzhutype == 1) {
            //串关下注,计算串关最多可以赢
            var temp_point = 1;
            //串关赔率相乘
            for (i = 0; i < cg_count; i++)
            {
                temp_point = (parseFloat($(".newcg input[name='bet_point[]']:eq(" + i + ")").val()) +
                             parseInt($(".newcg input[name='ben_add[]']:eq(" + i + ")").val())) * temp_point;

            }
            var win = (parseFloat(bet_money) * temp_point - bet_money).toFixed(2);
            $("#win_span").html(win);
            $("#bet_win").val(win);
        }
    }
}

function quxiao_bet() {
    cg_count = 0;
    location.reload();
}

function bet_money_keyup() {
    js_money();
    $("#orderok").fadeOut();
    var bet_money = parseFloat($("#bet_money").val());
    var user_money = $("#user_money").html();
    user_money = parseFloat(user_money.replace("RMB", " "));
    if (bet_money > user_money) {
        alert("您的账户余额不足!");
        $("#bet_money").val("");
        clear_input();
        return false;
    }
    return false;
}

function clear_input() {
    $("#bet_money").removeClass("read");
    $("#bet_money").addClass("edit");
    $("#bet_money").attr("readonly", false);
    $("#win_span").html("0.00");
    $("#bet_win").val("0.00");
    $("#ODtimer").html(time);
    if (touzhutype == 0) {
        $("#cg_msg").hide();
    }
}

//删除串关中不需要的赛事
function delteam(id){
    cg_count--;
    $("."+id).remove();
    js_money();
    if(cg_count==0){
        location.reload();
    }
}

//刷新选择的赛事
function onclickReloadTime() {
    var reloadTime = document.getElementById("checkOrder");
    window.clearTimeout(winRedirect);
    if (!reloadTime.checked) {
        window.clearTimeout(winRedirect);
        resetCheck = 0;
         checked = '';
    } else {
        winRedirect = window.setTimeout("winReload()", 1000);
        resetCheck = 1;
        checked = 'checked';
    }
}

function winReload() {
    if (resetCheck == 0 || touzhutype == 1)
    {
        checked = '';
        window.clearTimeout(winRedirect);
        return;
    }
    var showTimer = document.getElementById("ODtimer").innerHTML;
    showTimer = showTimer * 1 - 1;
    document.getElementById("ODtimer").innerHTML = showTimer;
    if (showTimer <= 0) {
        refresh_order();
    } else {
        winRedirect = window.setTimeout("winReload()", 1000);
    }
}

//刷新下注的信息
function refresh_order() {
    $("#ODtimer").html(time);
    $.post("/?r=sport/" + bet_file, {ball_sort: typename_in, match_id: match_id_in,
        touzhuxiang: touzhuxiang_in, touzhutype: touzhutype_in, point_column: point_column_in,
        ben_add: ben_add_in, xx: xx_in, tid:tid_in,is_lose:is_lose_in,match_type:match_type,rand: Math.random()}, function (data) {
        bet(data.msg);
    }, "json");
    onclickReloadTime();
}

//下注内容
function bet(data) {
    typename_in = data.typename;
    match_id_in = data.match_id;
    touzhuxiang_in = data.touzhuxiang;
    touzhutype_in = data.touzhutype;
    point_column_in = data.pointColumn;
    ben_add_in = data.benAdd;
    xx_in = data.xx;
    bet_file = data.bet_file;
    is_lose_in = data.isLose;
    tid_in = data.tid;
    match_type = data.matchType;
    //下注函数
    clear_input();
    $("#msg_div").hide();
    $("#bet_div").show();
    if(data.touzhutype==0 || data.touzhutype==1) {
        var bet_info = data.touzhuxiang + "@" + data.point;
        var master_guest = data.Match_Master + "VS." + data.Match_Guest;
        if (data.touzhuxiang.indexOf("让球") >= 0) {
            if (data.touzhuxiang == "让球") {
                var match_title = data.Match_Master + ' <span class="radio">' + data.Match_RGG + '</span> ' + data.Match_Guest;
            } else {
                var match_title = data.Match_Master + ' <span class="radio">' + data.Match_BRpk + '</span> ' + data.Match_Guest;
            }
        } else {
            var match_title = data.Match_Master + ' <span class="radio">VS</span> ' + data.Match_Guest;
        }
    }
    if (data.touzhutype == 0) {
        touzhutype = 0;
        //显示下注数据
        $("#touzhutype").val(0);
        $("#bet_money").val('');
        $("#ds").show();
        $(".choose_cg").hide();
        $(".title h1").html(data.typename);
        $("#ds .leag").html(data.Match_Name);
        $("#ds .gametype").html(data.touzhuxiang);
        $("#ds .tName").html(match_title);
        $("#ds .team em").html(data.xx);
        $("#ds #ioradio_id").html(data.point);
        $("#min_point_span").html(data.sportMinBet);
        $("#max_point_span").html(data.sportMaxBet);
        $("#ds input[name='ball_sort[]']").val(data.typename);
        $("#ds input[name='point_column[]']").val(data.pointColumn);
        $("#ds input[name='match_id[]']").val(data.Match_ID);
        $("#ds input[name='match_name[]']").val(data.Match_Name);
        $("#ds input[name='match_showtype[]']").val(data.Match_ShowType);
        $("#ds input[name='match_rgg[]']").val(data.Match_RGG);
        $("#ds input[name='match_dxgg[]']").val(data.Match_DxGG);
        $("#ds input[name='match_nowscore[]']").val(data.Match_NowScore);
        $("#ds input[name='match_type[]']").val(data.Match_Type);
        $("#ds input[name='master_guest[]']").val(master_guest);
        $("#ds input[name='bet_info[]']").val(bet_info);
        $("#ds input[name='bet_point[]']").val(data.point);
        $("#ds input[name='ben_add[]']").val(data.benAdd);
        $("#ds input[name='match_time[]']").val(data.Match_Time);
        $("#ds input[name='match_endtime[]']").val(data.Match_CoverDate);
        $("#ds input[name='bet_file[]']").val(data.bet_file);
        $("#submit_yes").attr('onclick','check_bet("ds")');
        $('#bet_money').removeAttr("disabled");
        $(".tiTimer").show();
        cg_count = 1;
    } else if (data.touzhutype == 1) { //串关
        cgdata1 = cgdata2  ="";
        touzhutype = 1;
        $("#bet_money").val("");
        //显示下注数据
        if (topname != data.typename) {
            cg_count = 0;
            $('.newcg').remove();
        }
        if(topname==""){
            topname = data.typename;
            cg_count = 0;
        }
        $("#touzhutype").val(data.touzhutype);
        $("#ds").hide();
        $('.choose_cg').show();

        var count = cg_count+2;
        for(var i=2;i<count;i++) {
            cgdata1 = cgdata1+ "|" + $("input[name='match_id[]']:eq("+i+")").val();
            cgdata2 = cgdata2 + "|" + $("input[name='master_guest[]']:eq("+i+")").val();
        }
        if (cgdata1.indexOf(data.Match_ID) >= 0 || cgdata2.indexOf(data.Match_Master + "VS." + data.Match_Guest) >= 0) {
            alert("同场赛事不能重复参与串关");
            return;
        }
        //未开放包含，角球数，先开球，入球数，波胆，网球，排球，棒球，冠军，进球数，主场
        if (master_guest.indexOf("角球") >= 0) {
            alert("角球數未开放串关功能");
            if(cg_count==0){
                location.reload();
            }
            return;
        }
        $('.cg').clone().appendTo(".choose_cg");
        $('.cg:eq(1)').attr('class','cg'+data.Match_ID);
        $('.cg'+data.Match_ID).addClass('newcg');
        $(".title h1").html(data.typename+"--综合过关");
        $(".cg"+data.Match_ID+" .leag_txt").html(data.Match_Name);
        $(".cg"+data.Match_ID+" .gametype").html(data.touzhuxiang);
        $(".cg"+data.Match_ID+" .tName").html(match_title);
        $(".cg"+data.Match_ID+" #team1 em").html(data.xx);
        $("#min_point_span").html(data.sportMinBet);
        $("#max_point_span").html(data.sportMaxBet);
        $(".cg"+data.Match_ID+" .light").html(data.point);
        $(".cg"+data.Match_ID+" .deletebtn .par").attr('onClick','delteam("cg'+data.Match_ID+'")');
        $(".cg"+data.Match_ID+" input[name='ball_sort[]']").val(data.typename);
        $(".cg"+data.Match_ID+" input[name='point_column[]']").val(data.pointColumn);
        $(".cg"+data.Match_ID+" input[name='match_id[]']").val(data.Match_ID);
        $(".cg"+data.Match_ID+" input[name='match_name[]']").val(data.Match_Name);
        $(".cg"+data.Match_ID+" input[name='match_showtype[]']").val(data.Match_ShowType);
        $(".cg"+data.Match_ID+" input[name='match_rgg[]']").val(data.Match_RGG);
        $(".cg"+data.Match_ID+" input[name='match_dxgg[]']").val(data.Match_DxGG);
        $(".cg"+data.Match_ID+" input[name='match_nowscore[]']").val(data.Match_NowScore);
        $(".cg"+data.Match_ID+" input[name='match_type[]']").val(data.Match_Type);
        $(".cg"+data.Match_ID+" input[name='master_guest[]']").val(master_guest);
        $(".cg"+data.Match_ID+" input[name='bet_info[]']").val(bet_info);
        $(".cg"+data.Match_ID+" input[name='bet_point[]']").val(data.point);
        $(".cg"+data.Match_ID+" input[name='ben_add[]']").val(data.benAdd);
        $(".cg"+data.Match_ID+" input[name='match_time[]']").val(data.Match_Time);
        $(".cg"+data.Match_ID+" input[name='match_endtime[]']").val(data.Match_CoverDate);
        $(".cg"+data.Match_ID+" input[name='bet_file[]']").val(data.bet_file);
        $(".cg"+data.Match_ID).show();
        $(".cg").hide();
        $("#submit_yes").attr('onclick','check_bet("cg")');
        $(".tiTimer").hide();
        if (cg_count > 7) {
            alert("串关最多允许8场赛事");
            return;
        }

        topname = data.typename;
        cg_count++;
    } else {
        touzhutype = 0;
        time = 90;
        $("#bet_money").val("");
        $(".tiTimer").show();
        var bet_info = data.x_title + "-" + data.match_name + "-" + data.team_name + "@" + data.point;
        $('#ds').show();
        $('.choose_cg').hide();
        $(".title h1").html(data.matchType+'--冠军');
        $(".leag").html(data.x_title);
        $(".gametype").html('冠军');
        $(".tName").hide();
        $(".team em").html(data.team_name);
        $("#ioradio_id").html(data.point);
        $("#min_point_span").html(data.sportMinBet);
        $("#max_point_span").html(data.sportMaxBet);
        $("input[name='ball_sort[]']").val('冠军');
        $("input[name='point_column[]']").val(data.pointColumn);
        $("input[name='match_id[]']").val(data.match_id);
        $("input[name='tid[]']").val(data.tid);
        $("input[name='match_name[]']").val(data.x_title);
        $("input[name='master_guest[]']").val(data.match_name);
        $("input[name='bet_info[]']").val(bet_info);
        $("input[name='bet_point[]']").val(data.point);
        $("input[name='ben_add[]']").val(0);
        $("input[name='match_endtime[]']").val(data.match_coverdate);
        $("#submit_yes").attr('onclick','check_bet("ds")');
        $("#ODTime").html(time);
        $("#touzhutype").val(data.touzhutype);
        $('#bet_money').removeAttr("disabled");
        cg_count = 1;
    }
    onclickReloadTime();
    js_money();
}

function checknum() {
    var v = $("#bet_money").val();
    if (v == (parseInt(v) * 1)) {
        var num = v.indexOf(".");
        if (num == -1)
            return true;
        else {
            alert("交易金额只能为整数");
            return false;
        }
    } else {
        alert("交易金额只能为整数");
        return false;
    }
}

function check_bet(type) { //提交按钮，提交数据检查
    var bet_money = parseFloat($("#bet_money").val());
    if (bet_money != (bet_money * 1))
        bet_money = 0;
    var min_point_span = $("#min_point_span").html();
    if (bet_money < min_point_span) {
        alert("交易金额最少为 " + min_point_span + " RMB");
        $("#bet_money").val("");
        $("#win_span").html(0);
        return false;
    }

    var user_money = $("#user_money").html();
    user_money = parseFloat(user_money.replace("RMB", " "));
    if (bet_money > user_money) {
        alert("您的账户余额不足");
        $("#bet_money").val("");
        $("#win_span").html(0);
        return false;
    }

    if (!checknum())
        return false; //验证是否为正整数

    if(type=='cg' && cg_count<3){
        alert("串关最少投注3场赛事");
        return false;
    }

    window.clearTimeout(winRedirect);
    if(type == 'ds'){
        $(".choose_cg").remove();

    }else{
        $("#ds").remove();
        $(".cg").remove();
    }
    //jquery 表单提交
    $("#submit_yes").blur();
    if (confirm("是否确认提交该交易？")) {
        $.ajax({
            type: "post",
            url: "/?r=sport/left/bet",
            data: $("#form1").serialize(),
            dataType: "json",
            success: function (data) {
                if (data.msg.indexOf("交易成功") >= 0 || data.msg.indexOf("交易确认中") >= 0) {
                    alert(data.msg);
                    $.ajax({
                        type: "post",
                        url: "/?r=passport/user-api/login",
                        data: {},
                        dataType: "json",
                        success: function (rst) {
                            $("#user_money", parent.parent.document).html(rst.data.user.money);
                            location.reload();
                        }
                    })
                } else {
                    alert(data.msg);
                    location.reload();
                }
            },
            error: function () {
                alert("获取数据失败！！");
                location.reload();
            }
        });
    }else{
        return false;
    }
    return false; // 必须返回false，否则表单会自己再做一次提交操作，并且页面跳转
}