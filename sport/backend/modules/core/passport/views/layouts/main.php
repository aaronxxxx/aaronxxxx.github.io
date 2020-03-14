<?php
use yii\helpers\ArrayHelper;

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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>K-bet管理系统</title>
    <link href="/public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/public/common/css/Font-Awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/public/common/css/skin_1.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" language="javascript" src="http://apps.bdimg.com/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" language="javascript" src="/public/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="/public/common/js/layer/layer.js"></script>
    <script type="text/javascript" language="javascript" src="/public/common/js/set-date.js"></script>
    <script type="text/javascript" language="javascript" src="/public/common/js/sound.js"></script>
    <script type="text/javascript" language="javascript" src="/public/common/js/My97DatePicker/WdatePicker.js"></script>
    <script type="text/javascript" language="javascript" src="public/common/js/director.min.js"></script>
    <script type="text/javascript" language="javascript" src="public/common/js/router.js"></script>
    <script type="text/javascript" language="javascript" src="public/common/js/jquery.validate.min.js"></script>
    <script type="text/javascript" language="javascript" src="public/common/js/jquery.validate.methods.js"></script>
    <script type="text/javascript" language="javascript" src="public/common/js/jquery.validate.messages_zh.js"></script>
    <script type="text/javascript" language="javascript" src="public/common/js/jquery.dialog.js"></script>
 <script type="text/javascript" language="javascript" src="public/common/js/base.js"></script>
  <!--<script src="/public/sport/js/order.js" type="text/javascript"></script>-->
     <script type="text/javascript">
        $(function () {
           $(".dropdown-toggle").click(function () {
               $(this).next(".submenu").toggleClass("menu-active");
               $(this).find(".drop-icon").toggleClass("drop-iconchk");
           })

           //系统信息
            $("#systeminfo").click(function () {
               $(this).next(".submenu").toggleClass('chkshow menu-active');
               $(this).find(".drop-icon").toggleClass("drop-iconchks drop-iconchk");
           })

        })
    </script>

</head>
<body>
<!--头部start-->
 <div class="hd">

        <a href="javascript:void(0)" class="navbar-brand">
            <span style="color: #FFFF01;">K-bet管理系统</span>
        </a>

        <div class="hd-right">
            <?php
            if(ArrayHelper::isIn('财务管理', Yii::$app->params['purviews'])){
            ?>
                <a href="#/finance/fund/tixian&status=未结算&type=noTime" title="您有0条提款信息未读"><i class="fa fa-btc"></i><span class="count" id="tknum">0</span></a>
                <a href="#/finance/default/huikuan&status=未结算&type=noTime" title="您有0条汇款信息未读"><i class="fa fa-line-chart "></i><span class="count" id="hknum">0</span></a>
                <a href="#/finance/fund/money-save&status=未结算&type=noTime" title="您有0条存款信息未读"><i class="fa fa-money"></i><span class="count" id="cknum">0</span></a>
            <?php
            }
            ?>
            <?php
            if(ArrayHelper::isIn('会员管理', Yii::$app->params['purviews'])){
            ?>
                <a href="#/member/index&status=异常" title="您有0条异常会员未读"><i class="fa fa-warning "></i><span class="count" id="ernum">0</span></a>
            <?php
            }
            ?>
            <?php
            if(ArrayHelper::isIn('代理管理', Yii::$app->params['purviews'])){
            ?>
                <a href="#/agent/index/list-type&remark=0" title="您有0条待审核代理信息未读"><i class="fa fa-leaf "></i><span class="count" id="dlnum">0</span></a>
            <?php
            }
            ?>
        </div>

        <div class="nava">
            <a href="/">管理首页</a>
            <?php
            if(ArrayHelper::isIn('系统管理', Yii::$app->params['purviews'])){
             ?>
                <a href="#/sysmng/config">系统设置</a>
            <?php
            }
            ?>
            <?php
            if(ArrayHelper::isIn('管理员管理', Yii::$app->params['purviews'])){
            ?>
                <a href="#/admin/manage/list">管理员管理</a>
            <?php
            }
            ?>
            <?php
            if(ArrayHelper::isIn('会员管理', Yii::$app->params['purviews'])){
            ?>
                <a href="#/member/user-log/list">日志管理</a>
                <a href="#/member/index">会员管理</a>
            <?php
            }
            ?>
            <?php
            if(ArrayHelper::isIn('报表管理', Yii::$app->params['purviews'])){
            ?>
                <a href="#/report/index/index">报表明细</a>
            <?php
            }
            ?>
            <?php
            if(ArrayHelper::isIn('财务管理', Yii::$app->params['purviews'])){
            ?>
                <a href="#/finance/default/huikuan">汇款管理</a>
                <a href="#/finance/fund/money-save&status=在线支付">存款管理</a>
                <a href="#/finance/fund/tixian&status=全部提款">提款管理</a>
                <a href="#/finance/default/index">加款扣款</a>
            <?php
            }
            ?>
            <a href="#/admin/manage/setpwdpage">修改密码</a>
            <a href="javascript:void(0);" id="logout">退出登录</a>
        </div>
    </div>
<!--头部end-->

    <!--左边start-->
        <div class="navleft">
        <ul class="menu">
            <?php
                if(isset(Yii::$app->params['sysmenus'])){
                    foreach (Yii::$app->params['sysmenus'] as $moduleKey => $moduleValue) {
                        if(isset($moduleValue['menus']) && count($moduleValue['menus']) > 0){
                            if(ArrayHelper::isIn($moduleValue['title'], Yii::$app->params['purviews'])){
            ?>
                    <li>
                        <a href="javascript:void(0)" class="dropdown-toggle"><i class="fa <?=isset($moduleValue['icon'])?$moduleValue['icon']:'fa-gear'?> ico-left fa-fw"></i><?=isset($moduleValue['title'])?$moduleValue['title']:''?><i class="fa fa-chevron-circle-right drop-icon "></i></a>
                        <ul class="submenu">
            <?php
                        foreach ($moduleValue['menus'] as $menuKey => $menuValue) {
                            if(is_array($menuValue)) {
            ?>
                                <li>
            <?php
                                $count = count($menuValue);
                                $i=0;
                                foreach ($menuValue as $subMenuKey => $subMenuValue){
                                    $i++;
                                    if($i == $count) {
            ?>
                                        <a href="<?=$subMenuValue?>"><?=$subMenuKey?></a>
            <?php
                                    } else {
            ?>
                                        <a href="<?=$subMenuValue?>"><?=$subMenuKey?></a><em class="xian">┆</em>
            <?php
                                    }
                                }
            ?>
                                </li>
            <?php
                            } else {
            ?>
                                <li><a href="<?=$menuValue?>"><?=$menuKey?></a></li>
            <?php
                            }
                        }
            ?>
                        </ul>
                    </li>
            <?php
                            }
                        }
                    }
                }
            ?>
                <!-- <li>
                    <a href="javascript:void(0)" class="dropdown-toggle" id="systeminfo"><i class="fa fa-cogs ico-left fa-fw"></i>系统信息<i class="fa fa-chevron-circle-right drop-icon drop-iconchks"></i></a>
                    <ul class="submenu chkshow">
                        <li>
                            <a href="javascript:void(0)">版权所有：JLF</a></li>
                            <li><a class="hongse" href="http://messenger3.providesupport.com/messenger/1c30k089mz5zb0ljlbv7u6gxfl.html" target="_blank">设计制作：咨询</a><br>
                            </li>
                            <li><a class="hongse" href="http://messenger3.providesupport.com/messenger/1c30k089mz5zb0ljlbv7u6gxfl.html" target="_blank">技术支持：咨询</a><br>
                            </li>
                            <li><a href="javascript:void(0)">系统版本：3.0</a></li>

                        </ul>
                    </li> -->
                </ul>

            </div>
    <!--左边end-->

    <!--右边start-->
    <div  class="rights">
        <div class="rightsct">
        <?php $this->beginBody() ?>
        <?= $content ?>
        <?php $this->endBody() ?>
        </div>
    </div>
    <!--右边end-->
    <div id="audioWrap"></div>
</body>
</html>
<script>
    $(function () {
        $("#logout").click(function (e) {
            $.dialog.confirm('是否确定退出登录？', function (data) {
                if(data){
                    $.ajax({
                        type: "POST",
                        url:"/?r=passport/login/logout",
                        dataType:'json',
                        error:function () {
                            alert('出错了，请稍后再试');
                        },
                        success:function (data) {
                            if(data.code==1){
                                location.href = '/?r=passport/login/login';
                            }
                        }
                    })
                }
            });
        });

        function loadMsgs() {
            $.ajax({
                type: "POST",
                url:'/?r=passport/index/msgs',
                dataType:'json',
                success:function (data) {
                    if(data.status) {


                        if(data.data.cknum>0){
                            $("#audioWrap").html("<audio src='../../../../../public/common/qita.mp3' autoplay='autoplay' loop='loop'/>");
                        }
                        if(data.data.hknum>0){
                            $("#audioWrap").html("<audio src='../../../../../public/common/huikuan.mp3' autoplay='autoplay' loop='loop'/>");
                        }
                        if(data.data.tknum>0){
                            $("#audioWrap").html("<audio src='../../../../../public/common/tikuan.mp3' autoplay='autoplay' loop='loop'/>");
                        }
                        if(data.data.ernum>0){
                            $("#audioWrap").html("<audio src='../../../../../public/common/yichang.mp3' autoplay='autoplay' loop='loop'/>");
                        }
                        if(data.data.dlnum>0){
                            $("#audioWrap").html("<audio src='../../../../../public/common/daili.mp3' autoplay='autoplay' loop='loop'/>");
                        }
                        if(data.data.cknum == 0 && data.data.hknum == 0 && data.data.tknum == 0 && data.data.ernum == 0 && data.data.dlnum == 0){
                            $("#audioWrap").html("");
                        }

                        $('#cknum').text(data.data.cknum);
                        $('#cknum').parent('a').attr('title', '您有'+data.data.cknum+'条存款信息未读');
                        $('#hknum').text(data.data.hknum);
                        $('#hknum').parent('a').attr('title', '您有'+data.data.hknum+'条汇款信息未读');
                        $('#tknum').text(data.data.tknum);
                        $('#tknum').parent('a').attr('title', '您有'+data.data.tknum+'条提款信息未读');
                        $('#ernum').text(data.data.ernum);
                        $('#ernum').parent('a').attr('title', '您有'+data.data.ernum+'条异常会员未读');
                        //$('#cgnum').text(data.data.cgnum);
                        //$('#cgnum').parent('a').attr('title', '您有'+data.data.cgnum+'条未结算串关信息未读');
                        $('#dlnum').text(data.data.dlnum);
                        $('#dlnum').parent('a').attr('title','您有'+data.data.dlnum+'条待审核代理信息未读');
                        //$('#dlnum_msg').text(data.data.dlnum);
                    }else {
                        $.dialog.notify(data.msg);
                    }
                }
            });
        };
        loadMsgs();

        setInterval(function () {
            $.ajax({
                url:'?r=admin/online/check',
                dataType:'json',
                success:function (data) {
                    if(data.status && data.code == -1){
                        $.ajax({
                                url:"?r=passport/login/logout",
                                dataType:'json',
                            });
                        $.dialog.alert('您已被其他管理员踢出，或者在线时间超过12小时，请重新登入', function(){
                            $.ajax({
                                url:"?r=passport/login/logout",
                                dataType:'json',
                                success:function (data) {
                                    location.href = '?r=passport/login/login';
                                }
                            })
                        });
                    }
                }
            });
            loadMsgs();
        }, 10000);
    })
</script>