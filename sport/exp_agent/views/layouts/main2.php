<?php
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>top</title>
    <link href="public/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="public/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
    <link href="/public/common/css/Font-Awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/public/common/css/skin_1.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" language="javascript" src="/public/common/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" language="javascript" src="/public/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="/public/common/js/layer/layer.js"></script>
    <script type="text/javascript" language="javascript" src="/public/common/js/live_order.js"></script>
    <script type="text/javascript" language="javascript" src="/public/common/js/sound.js"></script>
    <script type="text/javascript" language="javascript" src="/public/common/js/My97DatePicker/WdatePicker.js"></script>
    <script type="text/javascript" language="javascript" src="public/common/js/director.min.js"></script>
    <script type="text/javascript" language="javascript" src="public/common/js/router.js"></script>
    <script type="text/javascript" language="javascript" src="public/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" language="javascript" src="public/datetimepicker/js/bootstrap-datetimepicker.zh-CN.js"></script>
    <script src="/public/sport/js/order.js" type="text/javascript"></script>
    <script src="/public/sport/js/cgOrder.js" type="text/javascript"></script>
     <script src="/public/sport/js/bf.js" type="text/javascript"></script>
     <script type="text/javascript" language="javascript" src="/public/common/js/ajax_jump.js"></script>
     <script type="text/javascript">
        $(function () {
           $(".dropdown-toggle").click(function () {
                $(this).next(".submenu").toggle();
                 $(this).find(".drop-icon").toggleClass("drop-iconchk");
           })

        })
    </script>

</head>
<body>
<!--头部start-->
 <div class="hd">

        <a href="#" class="navbar-brand">
            <img src="" alt="后台管理系统logo" />
        </a>

<!--        <div class="hd-right">
            <a href="fund/tixian.php?status=未结算">提款(<font color="red" id="tknum">--</font>)
            </a>
            <a href="fund/huikuan.php?status=未结算">汇款(<font color="red" id="hknum">--</font>)
            </a>
            <a href="fund/chongzhi.php?status=未结算">存款(<font color="red" id="cknum">--</font>)
            </a>
            <a href="user/list.php?is_stop=异常">异常会员(<font color="red" id="ernum">--</font>)
            </a>
            <a href="sports/cg_list.php?status=0">未结算串关(<font color="red" id="cgnum">--</font>)
            </a>
            <a href="agents/list.php?remark=0">待审核代理(<font color="red" id="dlnum">--</font>)
            </a>
        </div>-->

 <div class="hd-right">
            <a href="javascript:void(0);" title="您有2条提款信息未读"><i class="fa fa-btc"></i><span class="count" id="tknum">2</span>
            </a>
            <a href="javascript:void(0);" title="您有4条汇款信息未读"><i class="fa fa-line-chart "></i><span class="count" id="hknum">4</span>
            </a>
            <a href="javascript:void(0);" title="您有5条存款信息未读"><i class="fa fa-money"></i><span class="count" id="cknum">5</span>
            </a>
            <a href="javascript:void(0);" title="您有8条异常会员未读"><i class="fa fa-warning "></i><span class="count" id="ernum">8</span>
            </a>
            <a href="javascript:void(0);" title="您有3条未结算串关信息未读"><i class="fa fa-comment-o"></i><span class="count" id="cgnum">3</span>
            </a>
            <a href="javascript:void(0);" title="您有1条待审核代理信息未读"><i class="fa fa-leaf "></i><span class="count" id="dlnum">1</span>
            </a>
        </div>


        <div class="showmarq" id="tisi">
            <marquee scrolldelay="5" scrollamount="2" id="m_xx" class="white" onmouseover="this.stop()" onmouseout="this.start()">您有：29条信息没有处理</marquee>
        </div>

        <div class="nava">
            <a href="?r=index/index">管理首页</a>
            <a href="?r=sysmng/config">系统设置</a>
            <a href="#/admin/manage/list">管理员管理</a>
            <a href="javascript:void(0);">日志管理</a>
            <a href="javascript:void(0);">会员管理</a>
            <a href="javascript:void(0);">报表明细</a>
            <a href="javascript:void(0);">汇款管理</a>
            <a href="javascript:void(0);">存款管理</a>
            <a href="javascript:void(0);">提款管理</a>
            <a href="javascript:void(0);">加款扣款</a>
            <a href="?r=admin/manage/setpwdpage">修改密码</a>
            <a href="javascript:void(0);" id="logout">退出登录</a>
        </div>
    </div>
<!--头部end-->

    <!--左边start-->
        <div class="navleft">
        <ul class="menu">
            <li class="active">
                <a href="javascript:void(0)" class="dropdown-toggle"><i class="fa fa-futbol-o ico-left fa-fw "></i>体育管理 <i class="fa fa-chevron-circle-right drop-icon"></i></a>

                <ul class="submenu">
                    <li>
                        <a href="javascript:void(0);" onclick="show('all','单式')">单式注单</a><em class="xian">┆</em><a href="JavaScript:void(0);" onclick="showCg('all');">串关注单</a>

                    </li>
                    <li><a href="javascript:void(0);" onclick="show('all','足球')">足球注单</a><em class="xian">┆</em><a href="javascript:void(0);" onclick="show('all','篮球')">篮球注单</a>


                    </li>
                    <li><a href="javascript:void(0);" onclick="show('all','网球')">网球注单</a><em class="xian">┆</em><a href="javascript:void(0);" onclick="show('all','排球')">排球注单</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" onclick="show('all','棒球')">棒球注单</a><em class="xian">┆</em><a href="javascript:void(0);" onclick="show('all','冠军')">冠军注单</a>

                    </li>
                    <li>
                        <a href="javascript:void(0);" onclick="show('all','其他')">其他注单</a>

                    </li>

                    <li>
                        <a href="javascript:void(0);" onclick="settle(0)">手工结算单式</a>

                    </li>
                    <li>
                        <a href="javascript:void(0);" onclick="showCg('all')">手工结算串关</a>


                    </li>
                    <li><a href="javascript:void(0);" onclick="grounder();">滚球未审核注单</a>
                    </li>
                    <li><a href="javascript:void(0);" onclick="zqbf();">足球比分</a><em class="xian">┆</em><a href="javascript:void(0);" onclick="lqbf();">篮球比分 </a>

                    </li>
                    <li>
                        <a href="javascript:void(0);" onclick="wqbf();">网球比分</a><em class="xian">┆</em><a href="javascript:void(0);" onclick="pqbf();">排球比分</a>

                    </li>
                    <li><a href="javascript:void(0);" onclick="bqbf();">棒球比分</a><em class="xian">┆</em><a href="javascript:void(0);" onclick="gjbf();">冠军比分</a></li>
                    <li><a href="javascript:void(0);" onclick="qtbf();">其他赛事比分</a></li>

                </ul>

            </li>
            <li>
                <a href="javascript:void(0)" class="dropdown-toggle"><i class="fa fa-dashboard ico-left fa-fw"></i>彩票注单管理<i class="fa fa-chevron-circle-right drop-icon"></i></a>
                <ul class="submenu">
                    <li><a href="/?r=lottery&type=CQ&js=0,1,2,3&p=1">重庆时时彩</a><em class="xian">┆</em><li><a href="/?r=lottery&type=CQSF&js=0,1,2,3&p=1">重庆十分彩</a></li>
                    </li>
                    <li><a href="/?r=lottery&type=TJ&js=0,1,2,3&p=1">极速时时彩</a><em class="xian">┆</em><a href="/?r=lottery&type=GDSF&js=0,1,2,3&p=1">广东十分彩</a>
                    </li>
                    <li><a href="/?r=lottery&type=GXSF&js=0,1,2,3&p=1">广西十分彩</a><em class="xian">┆</em><a href="/?r=lottery&type=TJSF&js=0,1,2,3&p=1">天津十分彩</a>
                    </li>
                    <li><a href="/?r=lottery&type=BJPK&js=0,1,2,3&p=1">北京PK拾</a><em class="xian">┆</em><a href="/?r=lottery&type=BJKN&js=0,1,2,3&p=1">北京快乐8</a>
                    </li>
                    <li><a href="/?r=lottery&type=GD11&js=0,1,2,3&p=1">广东11选5</a><em class="xian">┆</em><a href="/?r=lottery&type=T3&js=0,1,2,3&p=1">上海时时乐</a>
                    </li>
                    <li><a href="/?r=lottery&type=D3&js=0,1,2,3&p=1">3D彩</a><em class="xian">┆</em><a href="/?r=lottery&type=P3&js=0,1,2,3&p=1">排列三</a>
                    </li>

                    <li><a href="/?r=lottery&type=ALL_LOTTERY&js=0,1,2,3&p=1">全部彩票注单</a>

                    </li>
                    <li><a href="javascript:void(0);" onclick="updateOrder();">更新开奖结果</a>
                    </li>
                    <li>
                        <a href="/?r=lottery&type=ALL_LOTTERY&js=0&p=10">未结算彩票注单</a>
                    </li>
                    <li><a href="/?r=lottery&type=ALL_LOTTERY&js=2&p=1">重新结算过的彩票注单</a>
                    </li>
                    <li><a href="/?r=lottery/index/lotteryuser&type=JX&js=0,1,2,3&p=1">按用户分类的彩票注单</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0)" class="dropdown-toggle"><i class="fa fa-sitemap ico-left fa-fw"></i>彩票结果管理<i class="fa fa-chevron-circle-right drop-icon"></i></a>
                <ul class="submenu">
                    <li><a href="/?r=lottery/index/ball5&status=0&type=重庆时时彩">重庆时时彩</a><em class="xian">┆</em><a href="/?r=lottery/index/cqsfc&status=0&type=重庆十分彩">重庆十分彩</a>
                    </li>
                    <li><a href="/?r=lottery/index/ball5&status=0&type=极速时时彩">极速时时彩</a><em class="xian">┆</em><a href="/?r=lottery/index/gdsfc&status=0&type=广东十分彩">广东十分彩</a>
                    </li>
                    <li>
                        <a href="/?r=lottery/index/gxsfc&status=0&type=广西十分彩">广西十分彩</a><em class="xian">┆</em><a href="/?r=lottery/index/tjsfc&status=0&type=天津十分彩">天津十分彩</a>
                    </li>
                    <li><a href="/?r=lottery/index/bjpk10&status=0&type=北京PK拾">北京PK拾</a><em class="xian">┆</em><a href="/?r=lottery/index/bjkl8&status=0&type=北京快乐8">北京快乐8</a>
                    </li>
                    <li><a href="/?r=lottery/index/gd11x5&status=0&type=广东11选5">广东11选5</a><em class="xian">┆</em><a href="/?r=lottery/index/ball3&status=0&type=上海时时乐">上海时时乐</a>
                    </li>
                    <li><a href="/?r=lottery/index/ball3&status=0&type=3D彩">3D彩</a><em class="xian">┆</em><a href="/?r=lottery/index/ball3&status=0&type=排列三">排列三</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0)" class="dropdown-toggle"><i class="fa fa-crosshairs ico-left fa-fw"></i>彩票赔率管理<i class="fa fa-chevron-circle-right drop-icon"></i></a>
                <ul class="submenu">
                    <li>
                        <a href="/?r=lottery/index/oddscqssc">重庆时时彩</a><em class="xian">┆</em><a href="/?r=lottery/index/oddscqsfc">重庆十分彩</a>
                    </li>
                    <li><a href="/?r=lottery/index/oddstjssc">极速时时彩</a><em class="xian">┆</em><a href="/?r=lottery/index/oddsgdsfc">广东十分彩</a>
                    </li>
                    <li>
                        <a href="/?r=lottery/index/oddsgxsfc">广西十分彩</a><em class="xian">┆</em><a href="/?r=lottery/index/oddstjsfc">天津十分彩</a>
                    </li>
                    <li><a href="/?r=lottery/index/oddsbjpk10">北京PK拾</a><em class="xian">┆</em><a href="/?r=lottery/index/oddsbjkl8">北京快乐8</a>
                    </li>
                    <li>
                        <a href="/?r=lottery/index/oddsgd11x5">广东11选5</a><em class="xian">┆</em><a href="/?r=lottery/index/oddsshssl">上海时时乐</a>
                    </li>
                    <li>
                        <a href="/?r=lottery/index/oddsfc3d">3D彩</a><em class="xian">┆</em><a href="/?r=lottery/index/oddspl3">排列三</a>
                    </li>
                    <li>
                        <a href="/?r=lottery/default/index">时时彩程序设置</a>
                    </li>
                    <li><a href="/?r=lottery/default/money-set">彩票金额设置</a></li>

                </ul>
            </li>
            <li>
                <a href="javascript:void(0)" class="dropdown-toggle"><i class="fa fa-copyright ico-left fa-fw"></i>六合彩管理<i class="fa fa-chevron-circle-right drop-icon"></i></a>
                <ul class="submenu">
                    <li><a href="/?r=six/index/index">六合彩注单(按用户)</a></li>
                    <li><a href="/?r=six/index/order">六合彩注单(按注单)</a></li>
                    <li><a href="/?r=six/odds/liangmian">六合彩赔率</a></li>
                    <li><a href="/?r=six/index/result">六合彩开奖结果</a></li>
                    <li><a href="/?r=six/index/qishu">六合彩期数设置</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0)" class="dropdown-toggle"><i class="fa fa-street-view ico-left fa-fw"></i>真人娱乐操作<i class="fa fa-chevron-circle-right drop-icon"></i></a>
                    <ul class="submenu">
                        <li><a href="/?r=live/order">查看真人注单
                        </a>
                    </li>
                    <li><a href="/?r=live/egame">电子游艺注单
                    </a></li>
                    <li><a href="/?r=live/order/money">真人实时金额</a>

                    </li>
                    <li><a href="/?r=live/user">平台账号列表</a>

                    </li>
                    <li><a href="/?r=live/log">所有转账记录
                    </a></li>
                    <li><a href="/?r=live/log&status=4">待审核的转账
                    </a>
                </li>
                <li><a href="/?r=live/log&status=0">未结算的转账
                </a>
            </li>
            <li>
                <a href="/?r=live/fs">一键反水列表
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:void(0)" class="dropdown-toggle"><i class="fa fa-user ico-left fa-fw"></i>会员管理<i class="fa fa-chevron-circle-right drop-icon"></i></a>
        <ul class="submenu">
            <li><a href="user/list.php?1=1">会员列表</a><em class="xian">┆</em><a href="user/user_log.php">会员日志 </a>
            </li>
            <li><a href="user/check_reb.php">核查返利</a><em class="xian">┆</em><a href="user/rebates.php">会员返利</a>
            </li>
            <li><a href="fund/hccw.php">会员存/取/汇款</a>
            </li>
            <li>
                <a href="user/user_group_list.php">会员组列表</a>
            </li>
            <li>
                <a href="hygl/lsyhxx.php">历史银行信息</a>
            </li>
            <li><a href="../app/member/cache/hacker_look.php">黑名单列表</a></li>
        </ul>
    </li>

    <li>
        <a href="javascript:void(0)" class="dropdown-toggle"><i class="fa fa-cny ico-left fa-fw"></i>财务管理<i class="fa fa-chevron-circle-right drop-icon"></i></a>
        <ul class="submenu">
            <li><a href="fund/chongzhi.php?status=在线支付">存款管理</a><em class="xian">┆</em><a href="fund/tixian.php?status=全部提款">提款管理 </a>

            </li>
            <li><a href="fund/huikuan.php?status=全部汇款">汇款管理</a>

            </li>
            <li> <a href="fund/usercw.php">会员存/取/汇款</a>

            </li>
            <li>
                <a href="fund/domoney.php">加款扣款</a>

            </li>
            <li>
                <a href="report/money_log_by_user.php">财务日志</a>
            </li>

        </ul>
    </li>
    <li>
        <a href="javascript:void(0)" class="dropdown-toggle"><i class="fa fa-commenting-o ico-left fa-fw"></i>消息管理<i class="fa fa-chevron-circle-right drop-icon"></i></a>
        <ul class="submenu">
            <li><a href="?r=message/bulletin/index">公告管理</a><em class="xian">┆</em><a   href="?r=message/bulletin/list" >公告列表 </a></li>
            <li><a href="?r=message/user/index">站内消息 </a><em class="xian">┆</em><a   href="?r=message/user/list" >消息列表 </a></li>
            <li><a href="?r=message/register/index">注册消息 </a></li>
        </ul>
    </li>

    <li>
        <a href="javascript:void(0)" class="dropdown-toggle"><i class="fa fa-eye ico-left fa-fw"></i>代理管理<i class="fa fa-chevron-circle-right drop-icon"></i></a>
        <ul class="submenu">
            <li><a href="/?r=agent/index/list">代理列表</a></li>
            <li><a href="/?r=agent/report/index">代理报表</a></li>
            <li><a href="/?r=agent/cqk/index">代理存取报表</a></li>
<!--                <li><a href="javascript:void(0);" onclick="agent_jump1();">代理列表</a></li>
            <li><a href="javascript:void(0);" onclick="agent_jump2();">代理报表</a></li>
            <li><a href="javascript:void(0);" onclick="agent_jump3();">代理存取报表</a></li>-->
            </ul>
        
        </li>
        <li>
            <a href="javascript:void(0)" class="dropdown-toggle"><i class="fa fa-bar-chart ico-left fa-fw"></i>报表管理<i class="fa fa-chevron-circle-right drop-icon"></i></a>
            <ul class="submenu">
                <li><a href="/?r=report/index/index">报表明细</a><em class="xian">┆</em><a href="report/all_game_index.php">今日报表</a></li>

                <!-- <li><a href="report/sport_history.php">体育明细</a><em class="xian">┆</em><a href="report/sport_history.php">今日体育</a></li> -->

                <li>
                    <a href="report/lottery_history.php">彩票明细</a><em class="xian">┆</em><a href="report/lottery_history.php">今日彩票</a></li>

                    <li><a href="/?r=report/statement/six-detail">六合彩明细</a><em class="xian">┆</em><a href="/?r=report/statement/tema">六合彩-特码</a></li>
                    <li><a href="report/live_history.php">真人与游艺明细</a></li>
                    <li><a href="report/live_history.php">今日真人</a></li>


                    <li><a href="report/money.php">金额明细</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)" class="dropdown-toggle"><i class="fa fa-tasks ico-left fa-fw"></i>数据管理<i class="fa fa-chevron-circle-right drop-icon"></i></a>
                <ul class="submenu">
                    <li><a href="#/dataset/clean/index">清除数据</a></li>
<!--                    <li><a href="?r=dataset/optimize/index">数据优化</a></li>-->
                </ul>
            </li>

            <li>
                <a href="javascript:void(0)" class="dropdown-toggle"><i class="fa fa fa-globe ico-left fa-fw"></i>管理员管理<i class="fa fa-chevron-circle-right drop-icon drop-iconchk"></i></a>
                <ul class="submenu" style="display: block;">
                    <li><a href="#/admin/manage/list">管理员列表</a><em class="xian">┆</em>
                        <a href="#/admin/log/list">管理员日志 </a>
                    </li>
                    <li><a href="#/admin/online/list">在线管理员</a></li>

                </ul>
            </li>
            <li>
                <a href="javascript:void(0)" class="dropdown-toggle"><i class="fa fa-gear ico-left fa-fw"></i>系统管理<i class="fa fa-chevron-circle-right drop-icon "></i></a>
                <ul class="submenu">
                    <li>
                        <a href="/?r=sysmng/config">系统设置</a></li>
                        <li><a href="/?r=sysmng/account">设置汇款信息</a>
                        </li>
                        <li><a href="/?r=sysmng/pay">第三方支付设置</a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0)" class="dropdown-toggle"><i class="fa fa-cogs ico-left fa-fw"></i>系统信息<i class="fa fa-chevron-circle-right drop-icon drop-iconchk"></i></a>
                    <ul class="submenu" style="display: block;">
<!--                        <li>
                            <a href="javascript:void(0)">版权所有：JLF</a></li>-->
                            <li><a class="hongse" href="http://messenger3.providesupport.com/messenger/1c30k089mz5zb0ljlbv7u6gxfl.html" target="_blank">设计制作：咨询</a><br>
                            </li>
                            <li><a class="hongse" href="http://messenger3.providesupport.com/messenger/1c30k089mz5zb0ljlbv7u6gxfl.html" target="_blank">技术支持：咨询</a><br>
                            </li>
                            <li><a href="javascript:void(0)">系统版本：3.0</a></li>

                        </ul>
                    </li>


                </ul>

            </div>
    <!--左边end-->

    <!--右边start-->
    <div  class="rights">
        <?php $this->beginBody() ?>
        <?= $content ?>
        <?php $this->endBody() ?>
    </div>
    <!--右边end-->

</body>
</html>
<script>
    $(function () {
        $("#logout").click(function (e) {
            $.ajax({
                type: "POST",
                url:"/?r=login/logout",
                dataType:'json',
                error:function () {
                    alert('出错了，请稍后再试');
                },
                success:function (data) {
                    alert(data.message);
                    if(data.code==1){
                        location.href = '/?r=login/login';
                    }
                }
            })
        })
    })
</script>