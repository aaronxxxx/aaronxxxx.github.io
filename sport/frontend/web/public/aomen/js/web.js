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
    // window.open("AddScfj.aspx", "newWindows", 'height=100,width=400,top=0,left=0,
    // toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no'); 
}

/**
 * 修改登录密码点击事件
 */
$("#changepw").click(function () {
    var url = '/?r=member/index/modify-login-pwd';
    
    openWindow(url, '修改登录密码', 360, 320);
});

/**
 * 修改取款密码点击事件
 */
$("#change_qk").click(function () {
    var url = '/?r=member/index/modify-withdraw-pwd';
    
    openWindow(url, '修改取款密码', 360, 320);
});



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