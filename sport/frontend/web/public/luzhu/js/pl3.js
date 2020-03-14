un = fp = 0;

//各彩种倒数时间
function fenpan() {
    $.get("file/lottery.json?_=" + Math.random(), function (data) {
        cqssc(data.cqssc.fengpan, data.cqssc.opentime);
        bjpk10(data.pk10.fengpan, data.pk10.opentime);
        orpk(data.orpk.fengpan, data.orpk.opentime);
        ssrc(data.ssrc.fengpan, data.ssrc.opentime);
        mlaft(data.mlaft.fengpan, data.mlaft.opentime);
        gxsfc(data.gxsf.fengpan, data.gxsf.opentime);
        cqsfc(data.cqsfc.fengpan, data.cqsfc.opentime);
        gd(data.gd11.fengpan, data.gd11.opentime);
        gdsfc(data.gdsfc.fengpan, data.gdsfc.opentime);
        tjsfc(data.tjsf.fengpan, data.tjsf.opentime);
        shssl(data.shssl.fengpan, data.shssl.opentime);
        tjssc(data.tjssc.fengpan, data.tjssc.opentime);
        ts5(data.ts5.fengpan, data.ts5.opentime);
        bjkl8(data.kl8.fengpan, data.kl8.opentime);
        clearTimeout(fp);
        endtime(data.pl3.opentime, data.pl3.fengpan);
        if (data.pl3.opentime > 30) {

        } else {
            clearInterval(un);
        }
        if ($("#prevGameNo").text() != data.pl3.numbers) {
            var html = '';
            for (var i = 0; i < data.pl3.hm.length; i++) {
                html += '<span id="result' + data.pl3.hm[i] + '" class="number num' + data.pl3.hm[i] + '"></span>'
            }
            $(".numresult").html(html);
            $("#prevGameNo").html(data.pl3.numbers);
        }
    }, "json");
}

//盘口信息
function loadinfo() {
    fenpan();
    $.get("file/lottery.json?_=" + Math.random(), function (data) {
        if (data.pl3.opentime > 0) {
            un = setInterval(fenpan, 3000);
            $("#currGameNo").html(data.pl3.number);
        } else {
            $(".bet_odds").html("-");
            $(".amount").html("封盘");
            $("#autoinfo").html("已经封盘，请稍后进行投注！");
            return false;
        }
    }, "json");
}

//投注提交
function order() {
    $('.btn-red').attr("disabled",true);
    var betjsonstr = "{";
    cou = m = 0, txt = '', c = true;
    var money=0;
    for (var i = 1; i < 7; i++) {
        if (i == 4) {
            for (var s = 1; s < 8; s++) {
                $(".ball_" + i + "_" + s).each(function () {
                	var e = $(this);
                	money=money+parseInt(e.val()*1);
                });
            	if (!isNaN(money) && money != 0) {
                    cou++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + money + "\",";
                }
            	money = 0;
            }
        } else if (i == 5) {
            for (var s = 1; s < 6; s++) {
                $(".ball_" + i + "_" + s).each(function () {
                	var e = $(this);
                	money=money+parseInt(e.val()*1);
                });
            	if (!isNaN(money) && money != 0) {
                    cou++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + money + "\",";
                }
            	money = 0;
            }
        } else if (i == 6) {
            for (var s = 1; s < 11; s++) {
                $(".ball_" + i + "_" + s).each(function () {
                	var e = $(this);
                	money=money+parseInt(e.val()*1);
                });
            	if (!isNaN(money) && money != 0) {
                    cou++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + money + "\",";
                }
            	money = 0;
            }
        } else {
            for (var s = 1; s < 15; s++) {
                $(".ball_" + i + "_" + s).each(function () {
                	var e = $(this);
                	money=money+parseInt(e.val()*1);
                });
            	if (!isNaN(money) && money != 0) {
                    cou++;
                    betjsonstr = betjsonstr + "\"" + "ball_" + i + "_" + s + "\":\"" + money + "\",";
                }
            	money = 0;
            }
        }
    }
    betjsonstr = betjsonstr.substr(0, betjsonstr.length - 1);
    betjsonstr = betjsonstr + "}";


    if (cou <= 0) {
        $('.btn-red').attr("disabled",false);
        layer.msg("请输入下注金额!!!", {icon: 0}); 
        return false;
    }
    $.post("/?r=lottery/lzpl3/index/prepare-order", {data: betjsonstr}, function (data) {
        $('.btn-red').attr("disabled",false);
        if(data.status==false){
            layer.alert(data.msg);return false;
        }else{
            layer.confirm("共 ￥" + data.summoney + " / " + data.sumbetball + " 笔，确定下注吗？<br />下注明细如下：<br />" + data.ballmsg,
                function(index){
                    cq_cancel();
                    layer.close(index);
                    $.post("/?r=lottery/lzpl3/index/insert-order", {data: betjsonstr}, function (data) {
                        if (data.code == '10') {
                            layer.msg("操作成功", {icon: 1});
                            parent.window.ajaxlogin();
                            $('.selected-bet').removeClass('selected-bet');
                            $('.selectedinput').removeClass('selectedinput');
                        } else {
                            layer.msg("操作失败", {icon: 0});
                            return false;
                        }
                    }, "json");
                });
        }
    }, "json");
}