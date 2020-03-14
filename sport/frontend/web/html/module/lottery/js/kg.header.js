$(function () {
    /* 滚动公告 */
    $.get('index.php?m=lotto&c=index&a=get_notice', function (data) {
        if (data !== '')
        {
            $('#affiche').html(data);
        }
    });
    var promo = $('.shan');
    setInterval(function () {
        if($(promo).hasClass('red')){
            $(promo).removeClass("red");
        }else{
            $(promo).addClass("red");
        }
    }, 700);
    $('input[placeholder]').placeholder();
    $('input[name="username2"]').keyup(function () {
        this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');
        this.value = this.value.toLowerCase();//转小写
    });
    $('#hPic').click(function () {
        $("#hPic").attr("src", 'http://' + APP_DOMAIN + '/cl/?module=System&method=Verity2&SR=' + Math.random());
        $("#hPic").css("display", "inline");
        $("input[name='core2']").val("");
    });
    $("input[name='core2']").focus(function () {
        $("#hPic").click();
    });
    $("#registsubmit").click(function () {
        $(this).css("border", "none");
        if ($('input[name="username2"]').val() === '' || $('input[name="username2"]').val() === '用户名') {
            alert('请输入用户名');
            $('input[name="username2"]').focus();
            return false;
        }
        if ($('input[name="userpwd2"]').val() === '' || $('input[name="userpwd2"]').val() === '密码') {
            alert('请输入密码');
            $('input[name="userpwd2"]').focus();
            return false;
        }
        if ($("input[name='core2']").val() == '' || $("input[name='core2']").val() == '验证码') {
            alert('请输入验证码');
            return false;
        }
        $('input[name="username2"],input[name="userpwd2"],input[name="core2"]').attr('disabled', true);
        $.ajax({
            url: 'http://' + APP_DOMAIN + '/cl/?module=Index&method=CheckUser',
            type: 'GET',
            data: {jsonp: 'callback', username: $('input[name="username2"]').val(), userpwd: $('input[name="userpwd2"]').val(),rncode:$('input[name="core2"]').val()},
            dataType: 'jsonp',
            timeout: 30000,
            success: function (data) {
                if (data.status) {
                    if (data.alert_msg != 'no') {
                        alert(data.alert_msg);
                    }
                    location.href = 'http://' + APP_URL_LOTTO + '/';
                } else {
                    $('input[name="username2"],input[name="userpwd2"],input[name="core2"]').val('');
                    alert(data.msg);
                    $('input[name="username2"],input[name="userpwd2"],input[name="core2"]').removeAttr('disabled');
                }
            },
            error: function () {
                $('input[name="username2"],input[name="userpwd2"],input[name="core2"]').removeAttr('disabled');
            }
        });
    });
    $('#navlist > li').bind('mouseover', jsddm_open);
    $('#navlist > li').bind('mouseout', jsddm_timer);
    document.onclick = jsddm_close;
});


/**
 * 加入收藏
 * @param {type} sURL
 * @param {type} sTitle
 * @returns {undefined}
 */
function AddFavorite(sURL, sTitle)
{
    sURL = encodeURI(sURL);
    try
    {
        window.external.addFavorite(sURL, sTitle);
    }
    catch (e)
    {
        try
        {
            window.sidebar.addPanel(sTitle, sURL, "");
        }
        catch (e)
        {
            alert("请使用Ctrl+D进行添加,或手动在浏览器里进行设置.");
        }
    }
}

/**
 * 设为首页
 * @param {type} url
 * @returns {undefined}
 */
function SetHome(url)
{
    if (document.all)
    {
        document.body.style.behavior = 'url(#default#homepage)';
        document.body.setHomePage(url);
    }
    else
    {
        alert('您好,您的浏览器不支持自动设置页面为首页功能,请您手动在浏览器里设置该页面为首页.');
    }
}

/***
 * 会员中心导航
 * @param {type} mo
 * @param {type} me
 * @returns {undefined}
 */
function MGetPager(mo, me)
{
    window.open("http://" + APP_DOMAIN + "/cl/?module=" + mo + "&other=" + me, "MACENTER", "top=50,left=50,width=1020,height=600,status=no,scrollbars=yes,resizable=no").focus()
}

function beforeclose() {
    if (confirm('您确定要退出?')) {
        window.location.href = "http://" + APP_DOMAIN + "/cl/?module=Public&method=logout";
    }
}

function get_money() {
    $.ajax({
        url: 'http://' + APP_DOMAIN + '/cl/?module=System&method=get_money',
        type: 'GET',
        data: {jsonp: 'callback'},
        dataType: 'jsonp',
        success: function (data) {
            if (data.Balance4 != -1) {
                $("#money").text(data.Balance4);
            } else {
                location.href = "http://" + APP_DOMAIN + "/?module=System&method=First";
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('#money').html('--');
        }
    });
}

function get_ag_money() {
    $.ajax({
        url: 'http://' + APP_DOMAIN + '/cl/?module=MGetData&method=GetSunPlusDetail&args=Y,Y',
        type: 'GET',
        data: {jsonp: 'callback'},
        dataType: 'jsonp',
        success: function (data) {
            $("#ag_money").html(data.Balance4 || '0');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('#ag_money').html('--');
        }
    });
}

function get_bb_money()
{
    $.ajax({
        url: 'http://' + APP_DOMAIN + '/cl/?module=MGetData&method=GetBbin&args=Y',
        type: 'GET',
        data: {jsonp: 'callback'},
        dataType: 'jsonp',
        success: function (data) {
            $('#bb_money').html(data.Balance4);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('#bb_money').html('--');
        }
    });
}

function get_ds_money() {
    $.ajax({
        url: 'http://' + APP_DOMAIN + '/cl/?module=MGetData&method=GetSun&args=Y',
        type: 'GET',
        data: {jsonp: 'callback'},
        dataType: 'jsonp',
        success: function (data) {
            $('#ds_money').text(data.Balance4);
        },
        error: function () {
            $('#ds_money').html('--');
        }
    });
}

function get_prize() {
    $.ajax({
        type: 'get',
        url: '?module=System&method=get_prize',
        success: function (data) {
            if (data != -1) {
                $("#prize_value").text(data).show();
                $("#prize_name").show();
            } else {
                $("#prize_value").text('0.00').show();
                $("#prize_name").show();
            }
        }
    });
}

/**
 * 获取积分等级
 * @returns {undefined}
 */
function get_level() {
//    'vgold' =>$vgold,   //打码量
//    'points' =>$user_gold['member_points'],   //积分
//    'biglevel' =>$biglevel,
//    'level' => $level
    $.ajax({
        type: 'get',
        url: '?module=PointsLevel&method=judgeLevel',
        data: {
            username: 'normal'
        },
        cache: false,
        dataType: 'json',
        success: function (data) {
            if (data.biglevel) {
                $(".vip").removeClass("lv2").addClass("lv" + data.biglevel);
                //alert('biglevel:' + data.biglevel + '---level:' + data.level + '---points:' + data.points + '---vgold:' + data.vgold);
            } else {
                alert(123);
            }
        }
    });
}

function passwordshow(th, id) {
    var pwc = document.getElementById(id);
    if (th.value == '') {
        th.style.display = 'none';
        pwc.style.display = 'inline';
        pwc.value = '密码';
    }
}
function passwordhide(th, id) {
    var pw = document.getElementById(id);
    th.style.display = 'none';
    th.value = '';
    pw.style.display = 'inline';
    pw.focus();
}

function go_game(username, url) {
    if (username == '') {
        alert("您还没有登录，请登录");
        $("input[name='username']").focus();
        return false;
    }
    if (typeof (url) === "undefined")
    {
        return true;
    }
    window.open(url, 'newwindow' + username, 'toolbar=no, menubar=no, scrollbars=no, resizable=no,location=no, status=no');
    return false;
}

var timeout = 500;
var closetimer = 0;
var ddmenuitem = 0;

function jsddm_open() {
    jsddm_canceltimer();
    jsddm_close();
    ddmenuitem = $(this).find('ul').eq(0).css('visibility', 'visible');
}

function jsddm_close() {
    if (ddmenuitem)
        ddmenuitem.css('visibility', 'hidden');
}

function jsddm_timer() {
    closetimer = window.setTimeout(jsddm_close, timeout);
}

function jsddm_canceltimer() {
    if (closetimer) {
        window.clearTimeout(closetimer);
        closetimer = null;
    }
}

function OnlineService() {
    window.open("", "newFrame", 'toolbar=no, menubar=no, scrollbars=no, resizable=no,location=no, status=no, width=800, height=600');
}
