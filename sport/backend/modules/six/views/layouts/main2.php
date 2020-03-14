<?php
use yii\helpers\Html;
$this->beginPage();
$vertime = "Y-m-d H:i:s";
$time_limit = strtotime($vertime) - time();
if ($time_limit < 259200 && $time_limit >= 172800) {
    $time_day = "三天内到期";
} elseif ($time_limit < 172800 && $time_limit >= 86400) {
    $time_day = "两天内到期";
} elseif ($time_limit < 86400 && $time_limit >= 0) {
    $time_day = "一天内到期";
} else {
    $time_day = "已经到期";
}
?>
<!DOCTYPE html /public "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>top</title>

    <script type="text/javascript" language="javascript" src="http://apps.bdimg.com/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" language="javascript" src="/public/common/js/live_order.js"></script>
    <script type="text/javascript" language="javascript" src="/public/common/js/sound.js"></script>
    <script type="text/javascript" language="javascript" src="/public/common/js/My97DatePicker/WdatePicker.js"></script>
    <script type="text/javascript" language="javascript" src="/public/common/js/layer/layer.js"></script>
</head>
<body style="background: #fff;">
<!--头部start-->
<div class="hd" >
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="300" height="82" style="background:url(/public/common/images/logo4.png) no-repeat 8px 10px; "></td>
            <td align="center" style="background:url(/public/common/images/topbg.gif) no-repeat"><table cellspacing="0" cellpadding="0" border="0" width="100%" height="54">
                    <tbody>
                    <tr>
                        <td width="1%" align="left"><img onClick="switchBar(this)" height="15" alt="关闭左边管理菜单" src="/public/common/images/on-of.gif" width="15" border="0" /></td>
                        <td width="49%" align="left"><div class="show" id="tisi"><marquee scrolldelay="5" scrollamount="2" id="m_xx" onMouseOver="this.stop()" onMouseOut="this.start()"></marquee></div><div id="hk_mp3"></div></td>
                        <td width="50%" align="right">

                            <a href="fund/tixian.php?status=未结算"  target="main">
                                提款(<font color="red" id="tknum">--</font>)
                            </a>
                            <a href="fund/huikuan.php?status=未结算"  target="main">
                                汇款(<font color="red" id="hknum">--</font>)
                            </a>
                            <a href="fund/chongzhi.php?status=未结算"  target="main">
                                存款(<font color="red" id="cknum">--</font>)
                            </a>
                            <a href="user/list.php?is_stop=异常" target="main">
                                异常会员(<font color="red" id="ernum">--</font>)
                            </a>
                            <a href="sports/cg_list.php?status=0" target="main">
                                未结算串关(<font color="red" id="cgnum">--</font>)
                            </a>
                            <a href="agents/list.php?remark=0" target="main">
                                待审核代理(<font color="red" id="dlnum">--</font>)
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table height="26" border="0" align="left" cellpadding="0" cellspacing="0" class="subbg" NAME=t1>
                    <tbody>
                    <tr align="middle">
                        <td width="71" height="26" align="center" valign="middle" background="/public/common/images/top_tt_bg.gif"><a
                                href="right.php"
                                target="main" class="STYLE2">管理首页</a></td>
                        <td align="center" class="topbar"><span class="STYLE2"> </span></td>
                        <?php
                        if (isset(Yii::$app->params['U_Purview']) && strpos(Yii::$app->params['U_Purview'] , '修改网站信息')) {?>
                            <td width="71" align="center" valign="middle" background="/public/common/images/top_tt_bg.gif"><a
                                    href="webconfig/index.php"
                                    target="main" class="STYLE2">系统设置</a></td>
                            <td align="center" class="topbar"><span class="STYLE2"> </span></td>
                        <?php } ?>

                        <?php
                        if (isset(Yii::$app->params['U_Purview']) && strpos(Yii::$app->params['U_Purview'] , '管理员管理')) {
                            ?>

                            <td width="71" align="center" valign="middle" background="/public/common/images/top_tt_bg.gif" ><a   href="manage/list.php" target="main">管理员管理</a></td>
                            <td align="center" class="topbar"><span class="STYLE2"> </span></td>
                        <?php } ?>
                        <?php
                        if (isset(Yii::$app->params['U_Purview']) && strpos(Yii::$app->params['U_Purview'] , '查看会员信息')) {
                            ?>
                            <td width="71" align="center" valign="middle" background="/public/common/images/top_tt_bg.gif" ><a  href="user/user_log.php" target="main" class="STYLE3">日志管理</a></td>
                            <td align="center" class="topbar"><span class="STYLE2"> </span></td>

                            <td width="71" align="center" valign="middle" background="/public/common/images/top_tt_bg.gif" ><a  href="user/list.php?1=1"  target="main" class="STYLE2">会员管理</a></td>
                            <td align="center" class="topbar"><span class="STYLE2"> </span></td>
                        <?php } ?>
                        <?php
                        if (isset(Yii::$app->params['U_Purview']) && strpos(Yii::$app->params['U_Purview'] , '查看报表')) {
                            ?>
                            <td width="71" align="center" valign="middle" background="/public/common/images/top_tt_bg.gif"><a  href="report/all_game_index.php"  target="main" class="STYLE2">报表明细</a></td>
                            <td align="center" class="topbar"><span class="STYLE2"> </span></td>
                        <?php } ?>
                        <?php
                        if (isset(Yii::$app->params['U_Purview']) && strpos(Yii::$app->params['U_Purview'] , '加款扣款')) {
                            ?>
                            <td width="71" align="center" valign="middle" background="/public/common/images/top_tt_bg.gif"><a  href="fund/huikuan.php?status=全部汇款"  target="main" class="STYLE2">汇款管理</a></td>
                            <td align="center" class="topbar"><span class="STYLE2"> </span></td>
                            <td width="71" align="center" valign="middle" background="/public/common/images/top_tt_bg.gif"><a  href="fund/chongzhi.php?status=在线支付"  target="main" class="STYLE2">存款管理</a></td>
                            <td align="center" class="topbar"><span class="STYLE2"> </span></td>
                            <td width="71" align="center" valign="middle" background="/public/common/images/top_tt_bg.gif"><a  href="fund/tixian.php"  target="main" class="STYLE2">提款管理</a></td>
                            <td align="center" class="topbar"><span class="STYLE2"> </span></td>
                            <td width="71" align="center" valign="middle" background="/public/common/images/top_tt_bg.gif"><a  href="fund/domoney.php"  target="main" class="STYLE2">加款扣款</a></td>
                            <td align="center" class="topbar"><span class="STYLE2"> </span></td>
                        <?php } ?>
                        <td width="71" align="center" valign="middle" background="/public/common/images/top_tt_bg.gif"><a href="manage/set_pwd.php"   target="main" class="STYLE2">修改密码</a></td>
                        <td align="center" class="topbar"><span class="STYLE2"> </span></td>
                        <td width="71" align="center" valign="middle" background="/public/common/images/top_tt_bg.gif"><a  href="out.php" target="_top" class="STYLE2">退出登录</a></td>
                    </tr>
                    </tbody>
                </table></td>
        </tr>

    </table>
    <script language="javascript">
        var displayBar = true;
        function switchBar(obj) {
            if (displayBar)
            {
                parent.frame.cols = "0,*";
                displayBar = false;
                obj.title = "打开左边管理菜单";
            }
            else {
                parent.frame.cols = "195,*";
                displayBar = true;
                obj.title = "关闭左边管理菜单";
            }
        }

        function showsubmenu(sid) {
            whichEl = eval("submenu" + sid);
            if (whichEl.style.display === "none") {
                eval("submenu" + sid + ".style.display=\"\";");
            } else {
                eval("submenu" + sid + ".style.display=\"none\";");
            }
        }

        function myfun() {
            eval("submenu1.style.display=\"none\";");
            eval("submenu2.style.display=\"none\";");
            eval("submenu3.style.display=\"none\";");
            eval("submenu4.style.display=\"none\";");
            eval("submenu5.style.display=\"none\";");
            eval("submenu6.style.display=\"none\";");
            eval("submenu7.style.display=\"none\";");
            eval("submenu8.style.display=\"none\";");
            eval("submenu9.style.display=\"none\";");
            eval("submenu10.style.display=\"none\";");
            eval("submenu13.style.display=\"none\";");
            //eval("submenu14.style.display=\"none\";");
            eval("submenu15.style.display=\"none\";");
            eval("submenu22.style.display=\"none\";");
        }
        /*用window.onload调用myfun()*/
        window.onload = myfun;//不要括号

        <?php if (isset(Yii::$app->params['S_USER_ID']) && Yii::$app->session[Yii::$app->params['S_USER_ID']]) { ?>
        function top_systop() {
            $.getJSON("systop.php?callback=?", function (json) {
                if (!json.sum) {
                    return false;
                }
                var html = "您有：";
                $("#tknum").html(json.tknum);
                if (json.tknum > 0) {
                    html += "<span class=\"num\">" + json.tknum + "</span> 条<strong><A href=\"fund/tixian.php?status=未结算\"  target=\"main\">提款</a></strong> ";
                    $("#hk_mp3").html("<embed src='/resource/ring/tk.mp3' width='0' height='0'></embed>");
                }

                $("#hknum").html(json.hknum);
                if (json.hknum > 0) {
                    html += "<span class=\"num\">" + json.hknum + "</span> 条<strong><A href=\"fund/huikuan.php?status=未结算\"  target=\"main\">汇款</a></strong> ";
                    $("#hk_mp3").html("<embed src='/resource/ring/hk.mp3' width='0' height='0'></embed>");
                }

                $("#cknum").html(json.cknum);
                if (json.cknum > 0) {
                    html += "<span class=\"num\">" + json.cknum + "</span> 条<strong><A href=\"fund/chongzhi.php?status=未结算\"  target=\"main\">存款</a></strong> ";
                    $("#hk_mp3").html("<embed src='/resource/ring/hk.mp3' width='0' height='0'></embed>");
                }
                $("#dlnum").html(json.dlnum);
                if (json.dlnum > 0) {
                    html += "<span class=\"num\">" + json.dlnum + "</span> 条<strong><A href=\"agents/list.php?remark=0\"  target=\"main\">待审核代理</a></strong> ";
                    $("#hk_mp3").html("<embed src='/resource/ring/hk.mp3' width='0' height='0'></embed>");
                }
                var html2 = "";
                if (json.auto_zhenren_num > 0) {
                    html2 += "<A href=\"casino/zz_log.php?gtype=<?= urldecode('All') ?>&status=<?= urldecode('4') ?>\"  target=\"main\">您有<span class=\"num\">" + json.auto_zhenren_num + "</span> 条真人转账未审核。</a></strong> ";
                    $("#hk_mp3").html("<embed src='/resource/ring/hk.mp3' width='0' height='0'></embed>");
                }
                if (json.add_number_new > 0) {
                    html2 += "<A href=\"user/list.php?1=1\"  target=\"main\">&nbsp;&nbsp;恭喜！恭喜！您有" + json.add_number_new + "个新的用户注册了。(一分钟内)</a></strong> ";
                    $("#hk_mp3").html("<embed src='/resource/ring/hk.mp3' width='0' height='0'></embed>");
                }
                $("#ernum").html(json.ernum);
                $("#cgnum").html(json.cgnum);
                html += "信息未处理！";
                if (html === "您有：信息未处理！") {
                    html = "";
                }
                $("#m_xx").html(html + html2);
                $("#tisi").css("display", "block");
                if (json.tknum === 0 && json.hknum === 0 && json.cknum === 0 &&
                    json.ag_hall_num === 0 && json.add_number_new === 0 &&
                    json.ver_time_num === 0 && json.auto_zhenren_num === 0) {
                    $("#m_xx").html("");
                    $("#tisi").css("display", "none");
                }

            });
            setTimeout("top_systop()", 10000);
        }
        top_systop();
        <?php } ?>
    </script>
</div>
<!--头部end-->
<div>
    <!--左边start-->
    <div class="navleft">
        <table width="173" border="0" cellpadding="0" cellspacing="0">
            <?php
            if (isset(Yii::$app->params['U_Purview']) && (strpos(Yii::$app->params['U_Purview'], '查看注单') || strpos(Yii::$app->params['U_Purview'], '手工结算注单'))) {
                ?>

                <tr>
                    <td>
                        <table width="100%"
                               border=0 align=right cellPadding=0 cellSpacing=0 class=leftframetable>
                            <tbody>
                            <tr>
                                <td  class="tdbg">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="35"></td>
                                            <td class="styles" style="cursor: hand" onclick=showsubmenu(1); height=25>体育管理</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table id=submenu1 cellSpacing=0 cellPadding=0 width="100%" border=0 class="tabpd">
                                        <tbody>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a href="javascript:void();" onclick="show('all','单式')" target="main">
                                                    单式注单</a>┆<a href="sports/cg_list.php?status=<?= urldecode('all') ?>" target="main">串关注单</a></td>
                                        </tr>
                                        <tr>
                                            <td><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a href="sports/orderlist.php?status=<?= urldecode('all') ?>&type=<?= urldecode('足球') ?>"
                                                             target="main">足球注单</a>┆<a href="sports/orderlist.php?status=<?= urldecode('all') ?>&type=<?= urldecode('篮球') ?>"
                                                                                       target="main">篮球注单</a></td>
                                        </tr>
                                        <tr>
                                            <td><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a href="sports/orderlist.php?status=<?= urldecode('all') ?>&type=<?= urldecode('网球') ?>"
                                                             target="main">网球注单</a>┆<a href="sports/orderlist.php?status=<?= urldecode('all') ?>&type=<?= urldecode('排球') ?>"
                                                                                       target="main">排球注单</a></td>
                                        </tr>
                                        <tr>
                                            <td><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a href="sports/orderlist.php?status=<?= urldecode('all') ?>&type=<?= urldecode('棒球') ?>"
                                                             target="main">棒球注单</a>┆<a href="sports/orderlist.php?status=<?= urldecode('all') ?>&type=<?= urldecode('冠军') ?>"
                                                                                       target="main">冠军注单</a></td>
                                        </tr>
                                        <tr>
                                            <td><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a href="sports/orderlist.php?status=<?= urldecode('all') ?>&type=<?= urldecode('其他') ?>"
                                                             target="main">其他注单</a></td>
                                        </tr>
                                        <tr>
                                            <td height=10></td>
                                        </tr>
                                        <?php
                                        if (isset(Yii::$app->params['U_Purview']) && strpos(Yii::$app->params['U_Purview'], '手工结算注单')) {
                                            ?>

                                            <tr>
                                                <td><img src="/public/common/images/closed.gif"></td>
                                                <td height=23><a href="sports/sgjsds.php?status=0"
                                                                 target="main">手工结算单式</a></td>
                                            </tr>
                                            <tr>
                                                <td><img src="/public/common/images/closed.gif"></td>
                                                <td height=23><a href="sports/cg_list.php?status=<?= urldecode('all') ?>" target="main">手工结算串关</a></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <td><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a href="sports/gq_lose.php"
                                                             target="main">滚球未审核注单</a></td>
                                        </tr>
                                        <tr>
                                            <td height=10></td>
                                        </tr>

                                        <?php
                                        if (isset(Yii::$app->params['U_Purview']) && strpos(Yii::$app->params['U_Purview'], '手工录入体育比分')) {
                                            ?>

                                            <tr>
                                                <td width="2%"><img src="/public/common/images/closed.gif"></td>
                                                <td height=23><a href="sports/zqbf.php" target="main">足球比分</a>┆<a   href="sports/lqbf.php"  target="main">篮球比分 </a></td>
                                            </tr>
                                            <tr>
                                                <td><img src="/public/common/images/closed.gif"></td>
                                                <td height=23><a   href="sports/wqbf.php"  target="main">网球比分</a>┆<a   href="sports/pqbf.php"  target="main">排球比分</a></td>
                                            </tr>
                                            <tr>
                                                <td><img src="/public/common/images/closed.gif"></td>
                                                <td height=23><a   href="sports/bqbf.php"  target="main">棒球比分</a>┆<a   href="sports/gjbf.php?1=1"  target="main">冠军比分</a></td>
                                            </tr>
                                            <tr>
                                                <td><img src="/public/common/images/closed.gif"></td>
                                                <td height=23><a   href="sports/qtbf.php"  target="main">其他赛事比分</a></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <?php
            }
            ?>

            <?php
            if (isset(Yii::$app->params['U_Purview']) && (strpos(Yii::$app->params['U_Purview'], '查看注单') || strpos(Yii::$app->params['U_Purview'], '手工结算注单'))) {
                ?>

                <tr>
                    <td>
                        <table class="leftframetable" cellspacing="0" cellpadding="0" width="100%" align="right"
                               border="0">
                            <tbody>
                            <tr>
                                <td  class="tdbg">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="35"></td>
                                            <td  class="titledaohang" style="cursor: hand" onClick="showsubmenu(2);"><span class="styles">彩票注单管理</span></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table id="submenu2" cellspacing="0" cellpadding="0" width="100%" border="0" class="tabpd">
                                        <tbody>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/orderlist.php?status=0&type=<?= urldecode('CQ') ?>&js=<?= urldecode('0,1,2,3') ?>"
                                                    target="main">重庆时时彩</a>┆<a
                                                    href="Lottery/orderlist.php?status=0&type=<?= urldecode('JX') ?>&js=<?= urldecode('0,1,2,3') ?>"
                                                    target="main">江西时时彩</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/orderlist.php?status=0&type=<?= urldecode('TJ') ?>&js=<?= urldecode('0,1,2,3') ?>"
                                                    target="main">极速时时彩</a>┆<a
                                                    href="Lottery/orderlist.php?status=0&type=<?= urldecode('GDSF') ?>&js=<?= urldecode('0,1,2,3') ?>"
                                                    target="main">广东十分彩</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/orderlist.php?status=0&type=<?= urldecode('GXSF') ?>&js=<?= urldecode('0,1,2,3') ?>"
                                                    target="main">广西十分彩</a>┆<a
                                                    href="Lottery/orderlist.php?status=0&type=<?= urldecode('TJSF') ?>&js=<?= urldecode('0,1,2,3') ?>"
                                                    target="main">天津十分彩</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/orderlist.php?status=0&type=<?= urldecode('BJPK') ?>&js=<?= urldecode('0,1,2,3') ?>"
                                                    target="main">北京PK拾</a>┆<a
                                                    href="Lottery/orderlist.php?status=0&type=<?= urldecode('BJKN') ?>&js=<?= urldecode('0,1,2,3') ?>"
                                                    target="main">北京快乐8</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/orderlist.php?status=0&type=<?= urldecode('GD11') ?>&js=<?= urldecode('0,1,2,3') ?>"
                                                    target="main">广东11选5</a>┆<a
                                                    href="Lottery/orderlist.php?status=0&type=<?= urldecode('T3') ?>&js=<?= urldecode('0,1,2,3') ?>"
                                                    target="main">上海时时乐</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/orderlist.php?status=0&type=<?= urldecode('D3') ?>&js=<?= urldecode('0,1,2,3') ?>"
                                                    target="main">3D彩</a>┆<a
                                                    href="Lottery/orderlist.php?status=0&type=<?= urldecode('P3') ?>&js=<?= urldecode('0,1,2,3') ?>"
                                                    target="main">排列三</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/orderlist.php?status=0&type=<?= urldecode('CQSF') ?>&js=<?= urldecode('0,1,2,3') ?>"
                                                    target="main">重庆十分彩</a></td>
                                        </tr>
                                        <tr>
                                            <td height=10></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/orderlist.php?status=0&type=<?= urldecode('ALL_LOTTERY') ?>&js=<?= urldecode('0,1,2,3') ?>" target="main">全部彩票注单</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="javascript:void(0);" onclick="updateOrder();" target="main">更新开奖结果</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/orderlist.php?status=0&type=<?= urldecode('ALL_LOTTERY') ?>&js=<?= urldecode('0') ?>" target="main">未结算彩票注单</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/orderlist.php?reset_order=<?= urldecode('重新结算') ?>&type=<?= urldecode('ALL_LOTTERY') ?>&js=<?= urldecode('2') ?>" target="main">重新结算过的彩票注单</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/orderlist_lottery_user.php?js=<?= urldecode('0,1,2,3') ?>" target="main">按用户分类的彩票注单</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>


                <?php
            }
            ?>

            <?php
            if (isset(Yii::$app->params['U_Purview']) && strpos(Yii::$app->params['U_Purview'], '手工录入彩票结果')) {
                ?>


                <tr>
                    <td>
                        <table class="leftframetable" cellspacing="0" cellpadding="0" width="100%" align="right"
                               border="0">
                            <tbody>
                            <tr>
                                <td  class="tdbg">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="35"></td>
                                            <td  class="titledaohang" style="cursor: hand" onClick="showsubmenu(22);"><span class="styles">彩票结果管理</span></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table id="submenu22" cellspacing="0" cellpadding="0" width="100%" border="0" class="tabpd">
                                        <tbody>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/result/B5/result_b5.php?status=0&type=<?= urldecode('重庆时时彩') ?>"
                                                    target="main">重庆时时彩</a>┆<a
                                                    href="Lottery/result/B5/result_b5.php?status=0&type=<?= urldecode('江西时时彩') ?>"
                                                    target="main">江西时时彩</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/result/B5/result_b5.php?status=0&type=<?= urldecode('极速时时彩') ?>"
                                                    target="main">极速时时彩</a>┆<a
                                                    href="Lottery/result/GDSF/result_gdsf.php?status=0&type=<?= urldecode('广东十分彩') ?>"
                                                    target="main">广东十分彩</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/result/GXSF/result_gxsf.php?status=0&type=<?= urldecode('广西十分彩') ?>"
                                                    target="main">广西十分彩</a>┆<a
                                                    href="Lottery/result/TJSF/result_tjsf.php?status=0&type=<?= urldecode('天津十分彩') ?>"
                                                    target="main">天津十分彩</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/result/BJPK/result_bjpk.php?status=0&type=<?= urldecode('北京PK拾') ?>"
                                                    target="main">北京PK拾</a>┆<a
                                                    href="Lottery/result/BJKN/result_bjkn.php?status=0&type=<?= urldecode('北京快乐8') ?>"
                                                    target="main">北京快乐8</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/result/GD11/result_gd11.php?status=0&type=<?= urldecode('广东11选5') ?>"
                                                    target="main">广东11选5</a>┆<a
                                                    href="Lottery/result/B3/result_b3.php?status=0&type=<?= urldecode('上海时时乐') ?>"
                                                    target="main">上海时时乐</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/result/B3/result_b3.php?status=0&type=<?= urldecode('3D彩') ?>"
                                                    target="main">3D彩</a>┆<a
                                                    href="Lottery/result/B3/result_b3.php?status=0&type=<?= urldecode('排列三') ?>"
                                                    target="main">排列三</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/result/CQSF/result_cqsf.php?status=0&type=<?= urldecode('重庆十分彩') ?>"
                                                    target="main">重庆十分彩</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>


                <?php
            }
            ?>

            <?php
            if (isset(Yii::$app->params['U_Purview']) && strpos(Yii::$app->params['U_Purview'], '修改彩票赔率')) {
                ?>
                <tr>
                    <td>
                        <table class="leftframetable" cellspacing="0" cellpadding="0" width="100%" align="right"
                               border="0">
                            <tbody>
                            <tr>
                                <td  class="tdbg">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="35"></td>
                                            <td  class="titledaohang" style="cursor: hand" onClick="showsubmenu(3);"><span class="styles">彩票赔率管理</span></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table id="submenu3" cellspacing="0" cellpadding="0" width="100%" border="0" class="tabpd">
                                        <tbody>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/odds.php?type=<?= urldecode('重庆时时彩') ?>"
                                                    target="main">重庆时时彩</a>┆<a
                                                    href="Lottery/odds.php?type=<?= urldecode('江西时时彩') ?>"
                                                    target="main">江西时时彩</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/odds.php?type=<?= urldecode('极速时时彩') ?>"
                                                    target="main">极速时时彩</a>┆<a
                                                    href="Lottery/odds.php?type=<?= urldecode('广东十分彩') ?>"
                                                    target="main">广东十分彩</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/odds.php?type=<?= urldecode('广西十分彩') ?>"
                                                    target="main">广西十分彩</a>┆<a
                                                    href="Lottery/odds.php?type=<?= urldecode('天津十分彩') ?>"
                                                    target="main">天津十分彩</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/odds.php?type=<?= urldecode('北京PK拾') ?>"
                                                    target="main">北京PK拾</a>┆<a
                                                    href="Lottery/odds.php?type=<?= urldecode('北京快乐8') ?>"
                                                    target="main">北京快乐8</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/odds.php?type=<?= urldecode('广东11选5') ?>"
                                                    target="main">广东11选5</a>┆<a
                                                    href="Lottery/odds.php?type=<?= urldecode('上海时时乐') ?>"
                                                    target="main">上海时时乐</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/odds.php?type=<?= urldecode('3D彩') ?>"
                                                    target="main">3D彩</a>┆<a
                                                    href="Lottery/odds.php?type=<?= urldecode('排列三') ?>"
                                                    target="main">排列三</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/odds.php?type=<?= urldecode('重庆十分彩') ?>"
                                                    target="main">重庆十分彩</a></td>
                                        </tr>

                                        <tr>
                                            <td height="10"></td>
                                        </tr>
                                        <tr>
                                            <td><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/LotteryConfig.php" target="main">时时彩程序设置</a></td>
                                        </tr>
                                        <tr>
                                            <td><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a
                                                    href="Lottery/config/lottery_six_config.php" target="main">彩票金额设置</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <?php
            }
            ?>

            <?php
            if (isset(Yii::$app->params['U_Purview']) && (strpos(Yii::$app->params['U_Purview'], '查看注单') || strpos(Yii::$app->params['U_Purview'], '手工结算注单') || strpos(Yii::$app->params['U_Purview'], '修改彩票赔率'))) {
                ?>

                <tr>
                    <td>
                        <table class="leftframetable" cellspacing="0" cellpadding="0" width="100%" align="right"
                               border="0">
                            <tbody>
                            <tr>
                                <td  class="tdbg">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="35"></td>
                                            <td  class="titledaohang" style="cursor: hand" onClick="showsubmenu(4);"><span class="styles">六合彩管理</span></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table id="submenu4" cellspacing="0" cellpadding="0" width="100%" border="0" class="tabpd">
                                        <tbody>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a href="/?r=six/index/index">六合彩注单(按用户)</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a href="/?r=six/index/order">六合彩注单(按注单)</a></td>
                                        </tr>

                                        <?php
                                        if (isset(Yii::$app->params['U_Purview']) && strpos(Yii::$app->params['U_Purview'], '修改彩票赔率')) {
                                            ?>

                                            <tr>
                                                <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                                <td height="23"><a href="/?r=six/odds/liangmian">六合彩赔率</a></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a href="/?r=six/index/result">六合彩开奖结果</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23"><a href="/?r=six/index/qishu" >六合彩期数设置</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <?php
            }
            ?>

            <?php
            if (isset(Yii::$app->params['U_Purview']) && strpos(Yii::$app->params['U_Purview'], '真人娱乐')) {
                ?>
                <tr>
                    <td>
                        <table class="leftframetable" cellspacing="0" cellpadding="0" width="100%" align="right"
                               border="0">
                            <tbody>
                            <tr>
                                <td  class="tdbg">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="35"></td>
                                            <td  class="titledaohang" style="cursor: hand" onClick="showsubmenu(5);">
                                                <span class="styles">真人娱乐操作</span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table id="submenu5" cellspacing="0" cellpadding="0" width="100%" border="0" class="tabpd">
                                        <tbody>
                                        <?php
                                        if (isset(Yii::$app->params['U_Purview']) && strpos(Yii::$app->params['U_Purview'], '查看注单')) {
                                            ?>

                                            <tr>
                                                <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                                <td height="23">
                                                    <a href="casino/live_order.php?gtype=<?= urldecode('All') ?>&status=<?= urldecode('0,1,4') ?>" target="main">
                                                        查看真人注单
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                                <td height="23">
                                                    <a href="casino/eGame_order.php?gtype=<?= urldecode('All') ?>&status=<?= urldecode('0,1,4') ?>" target="main">
                                                        电子游艺注单
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                                <td height="23">
                                                    <a href="casino/live_money.php" target="main">真人实时金额</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23">
                                                <a href="casino/live_user.php" target="main">平台账号列表</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23">
                                                <a href="casino/zz_log.php?gtype=<?= urldecode('All') ?>&status=<?= urldecode('0,1,4') ?>" target="main">
                                                    所有转账记录
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23">
                                                <a href="casino/zz_log.php?gtype=<?= urldecode('All') ?>&status=<?= urldecode('4') ?>" target="main">
                                                    待审核的转账
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23">
                                                <a href="casino/zz_log.php?gtype=<?= urldecode('All') ?>&status=<?= urldecode('0') ?>" target="main">
                                                    未结算的转账
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif" /></td>
                                            <td height="23">
                                                <a href="casino/ag_user_fs_list.php?gtype=<?= urldecode('All') ?>" target="main">
                                                    一键反水列表
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <?php
            }
            ?>

            <?php
            if (isset(Yii::$app->params['U_Purview']) && strpos(Yii::$app->params['U_Purview'], '查看会员信息')) {
                ?>

                <tr>
                    <td>
                        <table class=leftframetable cellSpacing=0 cellPadding=0 width="100%" align=right border=0>
                            <tbody>
                            <tr>
                                <td  class="tdbg">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="35"></td>
                                            <td class="styles" style="cursor: hand" onclick=showsubmenu(6); height=25>会员管理</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table id=submenu6 cellSpacing=0 cellPadding=0 width="100%" border=0 class="tabpd">
                                        <tbody>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a href="user/list.php?1=1" target="main">会员列表</a>┆<a   href="user/user_log.php"  target="main">会员日志 </a></td>
                                        </tr>
                                        <tr  style="display: none;">
                                            <td><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a   href="user/check_reb.php"  target="main">核查返利</a>┆<a   href="user/rebates.php"  target="main">会员返利</a></td>
                                        </tr>
                                        <tr>
                                            <td><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a   href="fund/hccw.php"  target="main">会员存/取/汇款</a></td>
                                        </tr>
                                        <tr>
                                            <td><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a   href="user/user_group_list.php"  target="main">会员组列表</a></td>
                                        </tr>
                                        <tr>
                                            <td><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a   href="hygl/lsyhxx.php"  target="main">历史银行信息</a></td>
                                        </tr>
                                        <tr>
                                            <td><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a   href="../app/member/cache/hacker_look.php"  target="main">黑名单列表</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <?php
            }
            ?>
            <?php
            if (isset(Yii::$app->params['U_Purview']) && (strpos(Yii::$app->params['U_Purview'], '查看财务信息') || strpos(Yii::$app->params['U_Purview'], '加款扣款') || strpos(Yii::$app->params['U_Purview'], '财务审核'))) {
                ?>

                <tr>
                    <td>
                        <table class=leftframetable cellSpacing=0 cellPadding=0 width="100%" align=right border=0>
                            <tbody>
                            <tr>
                                <td  class="tdbg">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="35"></td>
                                            <td class="styles" style="cursor: hand" onclick=showsubmenu(7); height=25>财务管理</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table id=submenu7 cellSpacing=0 cellPadding=0 width="100%" border=0 class="tabpd">
                                        <tbody>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a href="fund/chongzhi.php?status=<?= urldecode('在线支付') ?>" target="main">存款管理</a>┆<a   href="fund/tixian.php?status=<?= urldecode('全部提款') ?>"  target="main">提款管理 </a></td>
                                        </tr>
                                        <tr>
                                            <td><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a   href="fund/huikuan.php?status=<?= urldecode('全部汇款') ?>"  target="main">汇款管理</a>┆<a   href="fund/usercw.php"  target="main">会员存/取/汇款</a></td>
                                        </tr>
                                        <?php
                                        if (isset(Yii::$app->params['U_Purview']) && strpos(Yii::$app->params['U_Purview'], '加款扣款')) {
                                            ?>

                                            <tr>
                                                <td><img src="/public/common/images/closed.gif"></td>
                                                <td height=23><a   href="fund/domoney.php"  target="main">加款扣款</a></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <td><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a   href="report/money_log_by_user.php"  target="main">财务日志</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <?php
            }
            ?>
            <?php
            if (isset(Yii::$app->params['U_Purview']) && strpos(Yii::$app->params['U_Purview'], '消息管理')) {
                ?>

                <tr>
                    <td>
                        <table class=leftframetable cellSpacing=0 cellPadding=0 width="100%" align=right border=0>
                            <tbody>
                            <tr>
                                <td  class="tdbg">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="35"></td>
                                            <td class="styles" style="cursor: hand" onclick=showsubmenu(8); height=25>消息管理</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table id=submenu8 cellSpacing=0 cellPadding=0 width="100%" border=0 class="tabpd">
                                        <tbody>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a href="message/bulletin.php?1=1" target="main">公告管理</a></td>
                                        </tr>
                                        <tr>
                                            <td><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a   href="message/user_msg.php"  target="main">站内消息 </a></td>
                                        </tr>
                                        <tr>
                                            <td><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a   href="message/msg_register.php"  target="main">注册消息 </a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <?php
            }
            ?>
            <?php
            if (isset(Yii::$app->params['U_Purview']) && (strpos(Yii::$app->params['U_Purview'], '查看代理信息') || strpos(Yii::$app->params['U_Purview'], '添加代理') || strpos(Yii::$app->params['U_Purview'], '删除代理') || strpos(Yii::$app->params['U_Purview'], '修改代理'))) {
                ?>

                <tr>
                    <td>
                        <table class=leftframetable cellSpacing=0 cellPadding=0 width="100%" align=right border=0>
                            <tbody>
                            <tr>
                                <td  class="tdbg">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="35"></td>
                                            <td class="styles" style="cursor: hand" onclick=showsubmenu(9); height=25>代理管理</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table id=submenu9 cellSpacing=0 cellPadding=0 width="100%" border=0 class="tabpd">
                                        <tbody>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a href="agents/list.php?1=1" target="main">代理列表</a></td>
                                        </tr>
                                        <tr>
                                            <td><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a   href="agents/report.php"  target="main">代理报表</a></td>
                                        </tr>
                                        <tr>
                                            <td><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a   href="agents/report_inout.php"  target="main">代理存取报表</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <?php
            }
            ?>

            <?php
            if (isset(Yii::$app->params['U_Purview']) && strpos(Yii::$app->params['U_Purview'], '查看报表')) {
                ?>

                <tr>
                    <td>
                        <table class=leftframetable cellSpacing=0 cellPadding=0 width="100%" align=right border=0>
                            <tbody>
                            <tr>
                                <td  class="tdbg">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="35"></td>
                                            <td class="styles" style="cursor: hand" onclick=showsubmenu(10); height=25>报表管理</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table id=submenu10 cellSpacing=0 cellPadding=0 width="100%" border=0 class="tabpd">
                                        <tbody>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a href="report/all_game_index.php" target="main">报表明细</a>┆<a href="report/all_game_index.php" target="main">今日报表</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a href="report/sport_history.php" target="main">体育明细</a>┆<a href="report/sport_history.php" target="main">今日体育</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a href="report/lottery_history.php" target="main">彩票明细</a>┆<a href="report/lottery_history.php" target="main">今日彩票</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a href="report/six_lottery_history.php" target="main">六合彩明细</a>┆<a href="report/six_lottery_sp.php" target="main">六合彩-特码</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a href="report/live_history.php" target="main">真人与游艺明细</a>┆<a href="report/live_history.php" target="main">今日真人</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif"></td>
                                            <td  height=23><a href="report/money.php" target="main">金额明细</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <?php
            }
            ?>

            <?php
            if (isset(Yii::$app->params['U_Purview']) && strpos(Yii::$app->params['U_Purview'], '数据管理')) {
                ?>

                <tr>
                    <td>
                        <table class=leftframetable cellSpacing=0 cellPadding=0 width="100%" align=right border=0>
                            <tbody>
                            <tr>
                                <td  class="tdbg">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="35"></td>
                                            <td class="styles" style="cursor: hand" onclick=showsubmenu(13); height=25>数据管理</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td><table id=submenu13 cellSpacing=0 cellPadding=0 width="100%" border=0 class="tabpd">
                                        <tbody>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a href="dataset/qcsj.php" target="main">清除数据</a></td>
                                        </tr>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif"></td>
                                            <td height=23><a href="dataset/sjyh.php" target="main">数据优化</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <?php
            }
            ?>

            <?php
            if (isset(Yii::$app->params['U_Purview']) && strpos(Yii::$app->params['U_Purview'], '管理员管理')) {
                ?>

                <tr>
                    <td>
                        <table class=leftframetable cellSpacing=0 cellPadding=0 width="100%" align=right border=0>
                            <tbody>
                            <tr>
                                <td  class="tdbg">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="35"></td>
                                            <td class="styles" style="cursor: hand" onclick=showsubmenu(14); height=25>管理员管理</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table id=submenu14 cellSpacing=0 cellPadding=0 width="100%" border=0 class="tabpd">
                                        <tbody>
                                        <tr>
                                            <td width="2%"><img src="/public/common/images/closed.gif"></td>
                                            <td height=23>
                                                <a href="manage/list.php?1=1" target="main">管理员列表</a>┆
                                                <a href="manage/log.php?1=1"  target="main">管理员日志 </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="2%">
                                                <img src="/public/common/images/closed.gif">
                                            </td>
                                            <td height=23>
                                                <a href="manage/online.php" target="main">在线管理员</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <?php
            }
            ?>

            <?php
            if (isset(Yii::$app->params['U_Purview']) && strpos(Yii::$app->params['U_Purview'], '修改网站信息')) {
                ?>

                <tr>
                    <td>
                        <table class=leftframetable cellSpacing=0 cellPadding=0 width="100%" align=right border=0>
                            <tbody>
                            <tr>
                                <td  class="tdbg">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="35"></td>
                                            <td class="styles" style="cursor: hand" onclick=showsubmenu(15); height=25>系统管理</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table id=submenu15 cellSpacing=0 cellPadding=0 width="100%" border=0 class="tabpd">
                                        <tbody>
                                        <tr>
                                            <td width="2%">
                                                <img src="/public/common/images/closed.gif">
                                            </td>
                                            <td height=23>
                                                <a href="webconfig/index.php" target="main">系统设置</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="2%">
                                                <img src="/public/common/images/closed.gif">
                                            </td>
                                            <td height=23>
                                                <a href="webconfig/setHuikuan.php" target="main">设置汇款信息</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="2%">
                                                <img src="/public/common/images/closed.gif">
                                            </td>
                                            <td height=23>
                                                <a href="webconfig/payset.php" target="main">第三方支付设置</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <?php
            }
            ?>

            <tr>
                <td height="8">
                    <table class=leftframetable cellSpacing=1 cellPadding=1 width="100%" align=right
                           border=0>
                        <tbody>
                        <tr>
                            <td  class="tdbg">

                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="35"></td>
                                        <td class="styles" height=25>系统信息</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height=105>
                                        <span class="STYLE2" style="padding-left:10px;display: inline-block;">
                                            <img src="/public/common/images/closed.gif" />
                                            版权所有：JLF<?= isset($web_site['web_name']) ? $web_site['web_name'] : '' ?><br/>
                                            <img src="/public/common/images/closed.gif" />
                                            设计制作：<a  class="hongse" href="http://messenger3.providesupport.com/messenger/1c30k089mz5zb0ljlbv7u6gxfl.html" target="_blank">咨询</a><?= isset($web_site['web_name']) ? $web_site['web_name'] : '' ?><br/>
                                            <img src="/public/common/images/closed.gif" />
                                            技术支持：<a  class="hongse" href="http://messenger3.providesupport.com/messenger/1c30k089mz5zb0ljlbv7u6gxfl.html" target="_blank">咨询</a><?= isset($conf_www) ? $conf_www : '' ?><br/>
                                            <img src="/public/common/images/closed.gif" />
                                            系统版本：3.0
                                        </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

        </table>
    </div>
    <!--左边end-->

    <!--右边start-->
    <div  class="rights">
        <?php $this->beginBody() ?>
        <?= $content ?>
        <?php $this->endBody() ?>
    </div>
    <!--右边end-->
</div>
</body>
</html>