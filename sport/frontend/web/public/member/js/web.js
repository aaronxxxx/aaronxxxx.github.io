$(function () {
    setInterval(estObj.dispTime, 1000);  
});
function rollbackDeal(id,zz_type,live_type){
    if(confirm("确定取消转账吗？")){
        $.ajax({
            type: "POST",
            url: "/?r=member/transaction-log/rollback",
            data: {
                live_id: id,
                change_type: zz_type,
                live_type: live_type
            }
        }).done(function( msg ) {
                alert(msg);
                chgType('zzRecord');
            }).fail(function(error){
                alert(error.responseText);
            });
    }
}
$(window).on('load', function() {
    var _href = window.location.href.split('/');
    if( _href[4] == 'money-log' ) {
        var btn = $('.d-btn');
        btn.removeClass('btn_color');
        btn.parent('li').siblings().find('span').removeClass('down_icon');
        btn.each(function() {
            $(this).on('click', function() {
                var str = $(this).val();
                localStorage.setItem('tabName', str);
            })
        })
        var str = localStorage.getItem('tabName');
        $('.d-btn[value="'+str+'"]').addClass('btn_color');
        $('.d-btn[value="'+str+'"]').siblings().addClass('down_icon');
    } else {
        window.localStorage.clear()
        $('#MACenterContent .MNav .mbtn').eq(2).click(function(){
            var str = '今日';
            localStorage.setItem('tabName', str);
            $('.d-btn').removeClass('btn_color');
            $('.d-btn').parent('li').siblings().find('span').removeClass('down_icon');
            $('.d-btn[value="'+str+'"]').addClass('btn_color');
            $('.d-btn[value="'+str+'"]').siblings().addClass('down_icon');
        })
    }
})
/**
 * 时间对象
 * @type object
 */
var estObj = {
    now: (new Date()).valueOf() || 0,
    pre0: function (num) {
        return num < 10 ? ('0' + num) : num;
    },
    dispTime: function () {                                                     /* 即時時間顯示 */
        var nowNew = (estObj.now += 1000),
            dateObj = new Date(nowNew),
            p0 = estObj.pre0,
            Y = dateObj.getFullYear(),
            Mh = dateObj.getMonth() + 1,
            D = p0(dateObj.getDate()),
            H = p0(dateObj.getHours()),
            M = p0(dateObj.getMinutes()),
            S = p0(dateObj.getSeconds());

        if (Mh > 12) {
            Mh = 01;
        } else if (Mh < 10) {
            Mh = '0' + Mh;
        }

        $("#EST_reciprocal").html(Y + '/' + Mh + '/' + D + ' - ' + H + ':' + M + ':' + S);
    }
};

/**
 * 鼠标覆盖
 * @param {dom} o
 * @returns {}
 */
function mover(o){
    o.style.backgroundPosition='0 bottom';
}

/**
 * 鼠标移开
 * @param {dom} o
 * @returns {}
 */
function mout(o){
    o.style.backgroundPosition='0 top';
}

/**
 * 字符串转整型 
 * @param {string} str  数字字符串
 * @returns {Number}    整型值
 */
function str2int(str) {
    return isNaN(Number(str)) ? -1 : Number(str);
}

/**
 * 打开窗口
 * @param {string} url      url
 * @param {string} title    窗口名称
 * @param {int} width       窗口宽度
 * @param {int} height      窗口高度
 * @returns {}
 */
function openWindow(url, title, width, height) {
    var iTop = (window.screen.availHeight - 30 - height) / 2;                   // 获得窗口的垂直位置 
    var iLeft = (window.screen.availWidth - 10 - width) / 2;                    // 获得窗口的水平位置 
    window.open(url, title, 'height=' + height + ',,innerHeight=' + height + 
            ',width=' + width + ',innerWidth=' + width + ',top=' + iTop + 
            ',left=' + iLeft + 
            ',status=no,toolbar=no,menubar=no,location=no,resizable=no,scrollbars=0,titlebar=no').focus();
}

function cx(type) {
    switch(type){
        case 'ck':
            window.location.href="/?r=member/transaction-log/bank";
            break;
        case 'hk':
            window.location.href="/?r=member/transaction-log/bank&type=hk";
            break;
        case 'qk':
            window.location.href="/?r=member/transaction-log/bank&type=qk";
            break;
        case 'zz':
            window.location.href="/?r=member/transaction-log/bank&type=zz";
            break;
        case 'today':
            window.location.href="/?r=member/lottery/lottery";
            break;
        case 'history':
            window.location.href="/?r=member/lottery/lottery-date";
            break;
    }
}
function syy(type,time){
    switch(type){
        case 'caipiao':
            window.location.href="/?r=member/lottery/lottery&time="+time+"";
            break;
        case 'sport':
            window.location.href="/?r=member/sport/sport&type=1&day_diff="+time+"";
            break;
        case 'cg':
            window.location.href="/?r=member/sport/sport&type=串关&day_diff="+time+"";
            break;
    }
}

function chgType(type) {
    switch(type){
        case 'ballRecord':
            window.location.href="/?r=member/sport/index";
            break;
        case 'liveHistory'://视讯直播
            window.location.href="/?r=member/live/live";
            break;
        case 'skRecord'://彩票
            window.location.href="/?r=member/lottery/lottery";
            break;
        case 'cqRecord'://存取款记录
            window.location.href="/?r=member/transaction-log/bank";
            break;
        case 'zzRecord'://存取款记录
            window.location.href="/?r=member/transaction-log/bank&type=zz";
            break;
        case 'moneylog'://存取款记录
            window.location.href="/?r=member/money-log/index";
            break;
    }
}
$(".MMain tbody tr").live({
    mouseenter: function() {
        $("td", this).addClass("mouseenter");
    },
    mouseleave: function() {
        $("td", this).removeClass("mouseenter");
    }
});


$("#MALeft a").click(function() {
    if(!$(this).hasClass('mcurrent')) {
        $("#MALeft a").removeClass('mcurrent');
        $(this).addClass('mcurrent');
    };
});
$("#MADeposit").click(function(){
    var _bankBTN = $("#banktrans");
    if(!_bankBTN.hasClass('mcurrent')) {
        $("#MALeft a").removeClass('mcurrent');
        _bankBTN.addClass('mcurrent');
    }
})

function setDate(dateType) {
    var dateNow = new Date();
    var dateStart;
    var dateEnd;
    if (dateType == "today") {
        dateStart = dateNow.Format("yyyy-MM-dd");
        dateEnd = dateNow.Format("yyyy-MM-dd");
    } else if (dateType == "yesterday") {
        dateNow.addDays(-1);
        dateStart = dateNow.Format("yyyy-MM-dd");
        dateEnd = dateNow.Format("yyyy-MM-dd");
    } else if (dateType == "lastSeven") {//最近7天
        dateEnd = dateNow.Format("yyyy-MM-dd");
        dateNow.addDays(-6);
        dateStart = dateNow.Format("yyyy-MM-dd");
    } else if (dateType == "lastThirty") {//最近30天
        dateEnd = dateNow.Format("yyyy-MM-dd");
        dateNow.addDays(-29);
        dateStart = dateNow.Format("yyyy-MM-dd");
    } else if (dateType == "thisWeek") {//本周
        dateEnd = dateNow.Format("yyyy-MM-dd");
        dateNow.addDays(-dateNow.getDay());
        dateStart = dateNow.Format("yyyy-MM-dd");
    } else if (dateType == "lastWeek") {//上周
        dateNow.addDays(-dateNow.getDay() - 1);
        dateEnd = dateNow.Format("yyyy-MM-dd");
        dateNow.addDays(-6);
        dateStart = dateNow.Format("yyyy-MM-dd");
    } else if (dateType == "thisMonth") {//本月
        dateEnd = dateNow.Format("yyyy-MM-dd");
        dateNow.addDays(-dateNow.getDate() + 1);
        dateStart = dateNow.Format("yyyy-MM-dd");
    } else if (dateType == "lastMonth") {//上月
        dateNow.addDays(-dateNow.getDate());
        dateEnd = dateNow.Format("yyyy-MM-dd");
        dateNow.addDays(-dateNow.getDate() + 1);
        dateStart = dateNow.Format("yyyy-MM-dd");
    }
    $('#s_time').val(dateStart);
    $("#e_time").val(dateEnd);
    location.href = $('#form12').attr('action') + "&" + $('#form12').serialize();
}
Date.prototype.Format = function (fmt) { //author: meizz
    var o = {
        "M+": this.getMonth() + 1, //月份
        "d+": this.getDate(), //日
        "h+": this.getHours(), //小时
        "m+": this.getMinutes(), //分
        "s+": this.getSeconds(), //秒
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度
        "S": this.getMilliseconds() //毫秒
    };

    if (/(y+)/.test(fmt)) {
        fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    }

    for (var k in o) {
        if (new RegExp("(" + k + ")").test(fmt)) {
            fmt = fmt.replace(RegExp.$1, (RegExp.$1.length === 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
        }
    }

    return fmt;
};
Date.prototype.addDays = function (d) {
    this.setDate(this.getDate() + d);
};

Date.prototype.addWeeks = function (w) {
    this.addDays(w * 7);
};

Date.prototype.addMonths = function (m) {
    var d = this.getDate();
    this.setMonth(this.getMonth() + m);

    if (this.getDate() < d) {
        this.setDate(0);
    }
};

Date.prototype.addYears = function (y) {
    var m = this.getMonth();
    this.setFullYear(this.getFullYear() + y);

    if (m < this.getMonth()) {
        this.setDate(0);
    }
};
//测试 var now = new Date(); now.addDays(1);//加减日期操作 alert(now.Format("yyyy-MM-dd"));
