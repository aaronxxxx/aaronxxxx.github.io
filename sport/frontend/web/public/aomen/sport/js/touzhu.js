var cg_count = 0; //串关串数
var time_id = '';
var winRedirect = 0;
var resetCheck = 1;
//var checked = 'checked';
var bet_file = 'football/football-match';
var typename_in = '';
var touzhuxiang_in = '';
var match_id_in = '';
var point_column_in = '';
var ben_add_in = '';
var is_lose_in = '';
var xx_in = '';
var matchIds = '';
var master_guest = '';
var topname = '';
$(document).ready(function() {
  ////////////////////////////////////////////////////
  $("#order_gold").keyup(function() {
    js_money();
    $("#orderok").fadeOut();
    var bet_money = parseFloat($("#order_gold").val());
    var user_money = $("#order_credit").html();
    user_money = parseFloat(user_money.replace("RMB", " "));
    if (bet_money > user_money) {
      $("#error_msg").html("您的账户余额不足!");
      $("#div_error").show();
      $("#order_gold").val("");
      $("#order_win_gold").html(0);
      return false;
    }
    return false;
  });
});
//计算可赢多少钱
function js_money() {
    var type = $("#touzhutype").val();
  //输入金额，最高可赢跟着改变
  var bet_money = parseFloat($("#order_gold").val());
  var user_money = $("#order_credit").html();
  user_money = parseFloat(user_money.replace("RMB", " "));
  if (bet_money > 0 && bet_money <= user_money) {
    if (touzhutype == 0 ||type ==2) { //单式下注 + 冠军下注
      temp_point = parseFloat($("input[name='bet_point[]']").val()) + parseInt($("input[name='ben_add[]']").val(), 10);
      var win = (bet_money * temp_point-bet_money).toFixed(2);
      $("#order_win_gold").html(win);
    }
    if (type == 1 ) {
      //串关下注,计算串关最多可以赢
      cg_count = $("#cgCount").val();
      var temp_point = 1;
      //串关赔率相乘
      for (i = 0; i < cg_count; i++) {
        temp_point = (parseFloat($("input[name='bet_point[]']:eq(" + i + ")").val()) + parseFloat($("input[name='ben_add[]']:eq(" + i + ")").val())) * parseFloat(temp_point);
      }
      var win = (bet_money * temp_point-bet_money).toFixed(2);
      $("#order_win_gold").html(win);
    }
    
    if ($("#win_span").html() > 0) {
      $("#istz").css("display", "block");
    } else {
      $("#istz").css("display", "none");
    }
  }
}

function quxiao_bet() {
  window.clearTimeout(winRedirect);
  $("#div_bet").fadeOut();
  $("#order_gold").html('');
  // $("#order_win_gold").html('');
  cg_count = 0;
}

function clear_input() {
  $("#div_error").hide();
  $("#order_gold").val("");
  $("#order_win_gold").html(0);
}

function del_bet(obj) {
  if (touzhutype == 0) {
    quxiao_bet();
  } else {
    $(obj).parent().parent().remove();
    cg_count--;
    if (cg_count == 0) {
      quxiao_bet();
    }
    clear_input();
    $("#cg_num").html(cg_count);
    $("#cg_msg").show();
    js_money();
  }

}

function waite() {
  if (touzhutype == 0) { //单式
    //time_id = window.setTimeout("refresh_order()",10000);
    window.clearTimeout(winRedirect);
    winReload();
  }
}

function onclickReloadTime() {
  var reloadTime = document.getElementById("checkOrder");
  window.clearTimeout(winRedirect);
  if (!reloadTime.checked) {
    //winRedirect=window.setTimeout("Win_Redirect()", winRedirectTimer);
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
  if (resetCheck == 0 || touzhutype == 1) {
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

function refresh_order() {
  var bet_file = $("#bet_file").val();
  $.post("/?r=sport/" + bet_file, {
    ball_sort: typename_in,
    match_id: match_id_in,
    touzhuxiang: touzhuxiang_in,
    point_column: point_column_in,
    ben_add: ben_add_in,
    is_lose: is_lose_in,
    xx: xx_in,
    touzhutype: touzhutype,
    checked: checked,
    rand: Math.random()
  },
  function(data) {
    bet(data);
  },
  "json");
}

order_data = '';
datas = '';
var i =1;
function bet(data) {
  //下注函数 
  clear_input();
  if (data.touzhutype == 0){
    datas = datas + '<input type="hidden" name="ball_sort[]" value="'+data.typename+'"/>\n\
                                    <input type="hidden" name="point_column[]" value="'+data.pointColumn+'"/>\n\
                                   <input type="hidden" name="match_id[]" value="'+data.Match_ID+'"/>\n\
                                   <input type = "hidden" name = "match_name[]" value = "'+data.Match_Name+'" / >\n\
                                   <input type = "hidden" name = "match_showtype[]" value = "'+data.Match_ShowType+'" >\n\
                                   <input type = "hidden" name = "match_rgg[]" value = "'+data.Match_RGG+'" / >\n\
                                   <input type = "hidden" name = "match_dxgg[]" value = "'+data.Match_DxGG+'" / >\n\
                                   <input type = "hidden" name = "match_nowscore[]" value ="'+data.Match_NowScore+'" / >\n\
                                   <input type = "hidden" name = "match_type[]" value = "'+data.Match_Type+'" / >\n\
                                   <input type = "hidden" name = "bet_point[]" value = "'+data.point+'" / >\n\
                                   <input type = "hidden" name = "tid[]" value = "" / >\n\
                                   <input type = "hidden" name = "master_guest[]" value = "'+data.Match_Master + "VS." + data.Match_Guest+'" >\n\
                                   <input type ="hidden" name="ben_add[]" value="'+data.benAdd+'">';
    $("#touzhudiv").html(datas);
    $("#div_bet").show();
    $("#order_menutype").html(data.touzhuxiang);
    $("#order_league").html(data.Match_Name);
    $("#order_team_h").html(data.Match_Master);
    if (data.touzhuxiang.indexOf('让球')>0) {
      $('#order_con_c').html(data.Match_RGG).show();
    }else{
        $('#order_con_c').hide();
    }
    $("#order_con_c").html(data.Match_RGG);
    $("#order_team_c").html(data.Match_Guest);
    $("#order_chose_team").html(data.xx);
    $("#order_ior").html(data.point);
    $("#div_bet").show();
    cg_count = 1;
  } else if(data.touzhutype==1){
        var betinfos =  new Object();
        betinfos.matchId = data.Match_ID;
        betinfos.typeName = data.typename;
        betinfos.matchTime = data.Match_Time;
        betinfos.matchName = data.Match_Name;
        betinfos.matchMaster = data.Match_Master;
        betinfos.matchGuest = data.Match_Guest;
        betinfos.masterGuest = data.Match_Master + "VS." + data.Match_Guest;
        betinfos.point= data.point;
        betinfos.pointColumn = data.pointColumn;
        betinfos.showType = data.Match_ShowType;
        betinfos.rgg = data.Match_RGG;
        betinfos.dxgg = data.Match_DxGG;
        betinfos.nowScore = data.Match_NowScore;
        betinfos.benAdd = data.benAdd;
        betinfos.matchType = data.Match_Type;
        betinfos.xx = data.xx;
        betinfos.touzhuType = data.touzhuxiang;
    //不同类型赛事
    topname  = $("#touzhudiv").find('input[name="typename"]').val();
    matchIds = $("#touzhudiv").find('input[name="matchId"]').val();
    master_guest = $("#touzhudiv").find('input[name="master_guest"]').val();
    datas = data.Match_Name+"|"+data.Match_Master+"|"+ data.Match_Guest;
    //显示下注数据
    if (matchIds.indexOf(data.Match_ID) >= 0 || master_guest.indexOf(data.Match_Master + '-' + data.Match_Guest) >= 0) {
      alert("同场赛事不能重复参与串关");
      return;
    }
    cg_count = $("#cg_num").html();
    if (cg_count > 7) {
      alert("串关最多允许8场赛事");
      return;
    }

    if (datas.indexOf("滚球") >= 0) {
      alert("滚球未开放串关功能");
      return;
    }
    if (datas.indexOf("半全场") >= 0) {
      alert("半全场未开放串关功能");
      return;
    }
    if (datas.indexOf("角球數") >= 0) {
      alert("角球數未开放串关功能");
      return;
    }
    if (datas.indexOf("角球数") >= 0) {
      alert("角球數未开放串关功能");
      return;
    }
    if (datas.indexOf("先開球") >= 0) {
      alert("先開球未开放串关功能");
      return;
    }
    if (datas.indexOf("先开球") >= 0) {
      alert("先開球未开放串关功能");
      return;
    }
    if (datas.indexOf("入球数") >= 0) {
      alert("入球数未开放串关功能");
      return;
    }
    if (datas.indexOf("波胆") >= 0) {
      alert("波胆未开放串关功能");
      return;
    }
    if (datas.indexOf("网球") >= 0) {
      alert("网球未开放串关功能");
      return;
    }
    if (datas.indexOf("排球") >= 0) {
      alert("排球未开放串关功能");
      return;
    }
    if (datas.indexOf("棒球") >= 0) {
      alert("棒球未开放串关功能");
      return;
    }
    if (datas.indexOf("金融") >= 0) {
      alert("金融未开放串关功能");
      return;
    }
    // if (datas.indexOf("冠军") >= 0) {
    //   alert("冠军未开放串关功能");
    //   return;
    // }
    if (datas.indexOf("进球數") >= 0) {
      alert("未开放进球數功能");
      return;
    }
    if (datas.indexOf("进球数") >= 0) {
      alert("未开放进球數功能");
      return;
    }
    if (datas.indexOf("主场-") >= 0) {
      alert("该赛事不能参与串关");
      return;
    }
    oneId = matchIds+data.Match_ID+"|";
    oneMG = master_guest+data.Match_Master+"-"+data.Match_Guest+"|";
    onetopname = data.typename
    if(topname !=data.typename){//赛事类型不同
      $.post("/?r=mobile/sport/index/use-session",{betinfos:betinfos,type:2},function(data){
        var n = 0;
        for(var i in data){
          n++;
        }
        $("#cg_num").html(n);
        cg_count = n;
        $("#touzhudiv").find('input[name="matchId"]').val(oneId);
        $("#touzhudiv").find('input[name="master_guest"]').val(oneMG);
        $("#touzhudiv").find('input[name="typename"]').val(onetopname);
      },"json");
    }else {
      $.post("/?r=mobile/sport/index/use-session", {betinfos: betinfos, type: 0}, function (data) {
        var n = 0;
        for(var i in data){
          n++;
        }
        $("#cg_num").html(n);
        cg_count = n;
        $("#touzhudiv").find('input[name="matchId"]').val(oneId);
        $("#touzhudiv").find('input[name="master_guest"]').val(oneMG);
        $("#touzhudiv").find('input[name="typename"]').val(onetopname);
      }, "json");
    }
    $('#' + data.pointColumn + '_' + data.Match_ID).removeClass("odds_box");
    $('#' + data.pointColumn + '_' + data.Match_ID).addClass("odds_box_up");
  } else {
    $("#touzhutype").val(2);
    var bet_info = data.x_title + "-" + data.match_name + "-" + data.teamName + "@" + data.point;
    var match_sort = data.typename + "-" + data.x_title;
    var matchName = data.match_name + "&nbsp" + data.match_date;
    datas = datas + '<div class="match_msg">\n\
                                   <input type="hidden" name="ball_sort[]" value="冠军"/>\n\
                                   <input type="hidden" name="point_column[]" value="' + data.pointColumn + '"/>\n\
                                   <input type="hidden" name="match_id[]" value="' + data.match_id + '"/>\n\
                                   <input type="hidden" name="tid[]" value="' + data.tid + '"/>\n\
                                   <input type = "hidden" name = "match_name[]" value = "' + data.x_title + '"/>\n\
                                   <input type = "hidden" name = "master_guest[]" value = "' + data.match_name + '"/>\n\
                                   <input type = "hidden" name = "bet_info[]" value = "' + bet_info + '" >\n\
                                   <input type = "hidden" name = "bet_point[]" value = "' + data.point + '" >\n\
                                   <input type = "hidden" name = "ben_add[]" value = "0" >\n\
                                    <input type = "hidden" name = "match_showtype[]" value = "" >\n\
                                   <input type = "hidden" name = "match_endtime[]" value = "' + data.match_coverdate + '" >\n\
                                   </div>\n';
    $("#touzhudiv").html(datas);
    $('#div_bet').show();
    $('#order_menutype').html(data.matchType);
    $('#order_league').html(data.x_title);
    $('#order_teamname').html(data.match_name);
    $('#order_rtype').html(data.team_name);
    $('#order_ior').html(data.point);
    $('#order_gold').removeAttr("disabled");
    cg_count = 1;
  }
  js_money();
}

/*
 *综合过关，切换选择/提交页面
 */
function change_div(divname){
  time=time_s;
  if(divname=='submit'){
    $("#error_msg").html("");
    $("#div_error").hide();
    $("#order_gold").val("");
    $("#order_win_gold").html(0);
    $("#select_div").hide();
    $("#submit_div").show();
  } else{
    $("#submit_div").hide();
    $("#select_div").show();
  }
}

/*
 *综合过关提交页面_删除比赛
 */
function deldiv(delid){
  //删除提交页面上的比赛
  $.ajax({
    type: "post",
    url: "/?r=mobile/sport/index/use-session",
    data: {delid:delid,type:1},
    dataType:"json",
    success: function (data) {
      var div = document.getElementById(delid);
      div.parentNode.removeChild(div);
      //清除下注金额
      $("#cgCount").val(data.length);
      $("#order_gold").val("");
      $("#order_win_gold").html(0.00);

      //删除隐藏表单里的数据
      var input = document.getElementById('input_'+delid);
      input.parentNode.removeChild(input);
      //修改选择页面的选中状态
      $("td[name='"+delid+"']").removeClass("odds_box_up");
      $("td[name='"+delid+"']").addClass("odds_box");
      location.reload();
    }
  })
  location.reload();

}

/*
 *综合过关提交页面_删除全部比赛
 */
function delall(all,match,type){
  //删除提交页面上的比赛
  layer.confirm("是否确认删除该订单？",{
    btn:['确认','取消']
    },function(){
      $.ajax({
        type: "post",
        url: "/?r=mobile/sport/index/use-session",
        data: {type:2,del:all},
        dataType:"json",
        success: function (data) {
          if(match == "football") {
            if (type == "today") {
              window.location.href = "/?r=mobile/sport/football/today-win-match-name-z"
            } else {
              window.location.href = "/?r=mobile/sport/football/breakfast-win-match-name-z"
            }
          }else{
            if (type == "today") {
              window.location.href = "/?r=mobile/sport/basketball/today-win-match-name-z"
            } else {
              window.location.href = "/?r=mobile/sport/basketball/breakfast-win-match-name-z"
            }
          }
        }
      })
  });
}
function isnum(obj) {
  v = obj.value;
  if (v != "") {
    if (v == (parseInt(v) * 1)) {
      num = v.indexOf(".");
      if (num == -1) return true;
      else {
        $("#error_msg").html("交易金额只能为整数!");
        $("#div_error").show();
        $("#order_gold").val("");
        $("#order_win_gold").html(0);
        return false;
      }
    } else {
      $("#error_msg").html("交易金额只能为整数!");
      $("#div_error").show();
      $("#order_gold").val("");
      $("#order_win_gold").html(0);
      return false;
    }
  }
}

function checknum() {
  var v = $("#order_gold").val();
  if (v == (parseInt(v) * 1)) {
    var num = v.indexOf(".");
    if (num == -1) return true;
    else {
      $("#error_msg").html("交易金额只能为整数!");
      $("#div_error").show();
      $("#order_gold").val("");
      $("#order_win_gold").html(0);
      return false;
    }
  } else {
    $("#error_msg").html("交易金额只能为整数!");
    $("#div_error").show();
    $("#order_gold").val("");
    $("#order_win_gold").html(0);
    return false;
  }
}

function check_bet(match,type) { //提交按钮，提交数据检查
  var bet_money = parseFloat($("#order_gold").val());
  $("#bet_money").val(bet_money);
  if (bet_money != (bet_money * 1)) bet_money = 0;
  var min_point_span = $("#min_point_span").html();
  var max_point_span = $("#order_max_bet").html();
  if (bet_money < min_point_span) {
    $("#error_msg").html("交易金额最少为 " + min_point_span + " RMB");
    $("#div_error").show();
    $("#order_gold").val("");
    $("#order_win_gold").html(0);
    return false;
  }
  if(bet_money > max_point_span){
    $("#error_msg").html("最高交易金额为"+max_point_span+"RMB");
    $("#div_error").show();
    $("#order_gold").val("");
    $("#order_win_gold").html(0);
    return false;
  }
  var user_money = $("#order_credit").html();
  user_money = parseFloat(user_money.replace("RMB", " "));
  if (bet_money > user_money) { ("#error_msg").html("您的账户余额不足");
    $("#div_error").show();
    $("#order_gold").val("");
    $("#order_win_gold").html(0);
    return false;
  }
  if (!checknum()){
    return false; //验证是否为正整数
    window.clearTimeout(winRedirect);
  }
    layer.confirm("是否确认提交该交易？",{
        btn:['确认','取消']
    },function(){
        $("#submit_from").removeAttr("onclick");
        $("#layui-layer1").remove();
      $.ajax({
          type: "post",
          url: "/?r=sport/left/bet",
          data: $("#form1").serialize(),
          dataType: "json",
          success: function (data) {
            if (data.msg.indexOf("交易成功") >= 0 || data.msg.indexOf("交易确认中") >=0) {
              layer.msg(data.msg,{
                icon:1,
                time:2000
              },function(){
                if(match=="football"){
                  if (type == "today") {
                      window.location.href = "/?r=mobile/sport/football/today-win-match-name-z"
                  } else {
                      window.location.href = "/?r=mobile/sport/football/breakfast-win-match-name-z"
                  }
                }else if(match=="basketball"){
                  if (type == "today") {
                    window.location.href = "/?r=mobile/sport/basketball/today-win-match-name-z"
                  } else {
                    window.location.href = "/?r=mobile/sport/basketball/breakfast-win-match-name-z"
                  }
                }else {
                  location.reload();
                }
              });
            } else {
              $("#div_error").show();
              $("#error_msg").html(data.msg);
              setTimeout("location.reload();",2000);

            }
          }
        });
    },function(){
      location.reload();
        // return false; // 必须返回false，否则表单会自己再做一次提交操作，并且页面跳转
    })
    
   
}
