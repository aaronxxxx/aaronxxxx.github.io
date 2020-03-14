<?php
use yii\helpers\Html;
?>
<div id="ui-marquee">
    <div class="marquee"><span id="Msg">~欢迎光临~ </span></div>
</div>
<div id="box_body" class="bg2yellow">
    <div id="box_range">
        <div id="header">
            <h1>sk</h1>
            <div class="game-nav">
                <div id="ui-btn-games">
                    <ul class="layer1 sf-menu bg2yellow">
                        <li style="display: none;" class="layer1-li">
                            <a class="layer1-a sf-no-ul" href="/member/lt/">
                                <b></b>
                                六合彩
                            </a>
                        </li>
                    </ul>
                    <nav id="NORMAL">
                        <a data-gtype="LT_Content" href="/member/lt/">六合彩</a>
                    </nav>
                    <nav id="S5"></nav>
                </div>
            </div>
            <ul id="ui-btn-features">
                <li style="color:yellow;font-weight:bold;padding-top:4px;font-size:12px;">功能:</li>
<!--                <li>-->
<!--                    <a style="padding-top: 4px;" data-callback="self.memberCenter.history" title="下注状况"-->
<!--                       data-url="/?r=six/sixtop/historydate&gtype=LT&gamedate=--><?//=date('Y-m-d');?><!--">-->
<!--                        <span style="color: white;">下注状况</span>-->
<!--                    </a>-->
<!--                </li>-->
                <li>
                    <a style="padding-top: 4px;" data-callback="self.memberCenter.historyCount" title="帐户历史"
                       data-url="/?r=member/lottery/lottery">
                        <span style="color: white;">下注历史</span>
                    </a>
                </li>
                <li>
                    <a style="padding-top: 4px;" data-callback="self.memberCenter.rule" title="规则说明"
                       data-url="/?r=six/rule/rule&gtype=LT">
                        <span style="color: white;">规则</span>
                    </a>
                </li>
                <li>
                    <a style="padding-top: 4px;" data-callback="self.memberCenter.gameResult" title="开奖结果"
                       data-url="/?r=six/sixtop/kaijiang&gtype=LT">
                        <span style="color: white;">开奖</span>
                    </a>
                </li>
                <li>
                    <a style="padding-top: 4px;" title="系统公告" data-url="/?r=six/sixtop/news&gtype=LT">
                        <span style="color: white;">公告</span>
                    </a>
                </li>
                <li>
                    <a style="padding-top: 4px;" data-callback="self.memberCenter.quickGold" title="快选金额"
                       data-url="/?r=six/sixtop/quick&gtype=LT">
                        <span style="color: white;font-weight: normal;">快选金额</span>
                    </a>
                </li>
            </ul>
        </div>
        <div id="main_six">
            <div id="left">
                <div id="clock" style="display:none"><b></b><span id="HKTime"></span></div>
                <div id="user_info" style="display:none">
                    <dl class="block">
                        <dt><span class="icon"></span>会员资料</dt>
                        <dd>帐号 <span id="login-username"></span></dd>
                        <dd>额度 <span id="bet-credit"></span></dd>

                        <dd class="footer"></dd>
                    </dl>
                </div>
                <div id="message_box" style="display:none">
                    <div class="inner"></div>
                    <div class="footer"></div>
                </div>
                <div id="left-div">
                    <ul>
                        <li ><a href="#"><img src="/public/aomenPC//img/b002.jpg"/></a></li>
                        <li style="background:url(/public/aomenPC//img/left_4.jpg) no-repeat;height: 24px;"><a href="/?r=six/index/index&rtype=SP"><span style="font-size: 12px;margin-left: 60px;">特别号A面</span></a></li>
                        <li style="background:url(/public/aomenPC//img/left_4.jpg) no-repeat;height: 24px;"><a href="/?r=six/index/index&rtype=SPbside"><span style="font-size: 12px;margin-left: 60px;">特别号B面</span></a></li>
                        <li style="background:url(/public/aomenPC//img/left_4.jpg) no-repeat;height: 24px;"><a href="/?r=six/index/index&rtype=OEOU"><span style="font-size: 12px;margin-left: 60px;">两面</span></a></li>
                        <li style="background:url(/public/aomenPC//img/left_4.jpg) no-repeat;height: 24px;"><a href="/?r=six/index/index&rtype=NA"><span style="font-size: 12px;margin-left: 60px;">正码</span></a></li>
                        <li style="background:url(/public/aomenPC//img/left_4.jpg) no-repeat;height: 24px;"><a href="/?r=six/index/index&rtype=NAS&amp;rtypeN=N1"><span style="font-size: 12px;margin-left: 60px;">正码特</span></a></li>
                        <li style="background:url(/public/aomenPC//img/left_4.jpg) no-repeat;height: 24px;"><a href="/?r=six/index/index&rtype=NO"><span style="font-size: 12px;margin-left: 60px;">正码1-6</span></a></li>
                        <li style="background:url(/public/aomenPC//img/left_4.jpg) no-repeat;height: 24px;"><a href="/?r=six/index/index&rtype=NAP"><span style="font-size: 12px;margin-left: 60px;">正码过关</span></a></li>
                        <li style="background:url(/public/aomenPC//img/left_4.jpg) no-repeat;height: 24px;"><a href="/?r=six/index/index&rtype=CH"><span style="font-size: 12px;margin-left: 60px;">连码</span></a></li>
                        <li style="background:url(/public/aomenPC//img/left_4.jpg) no-repeat;height: 24px;"><a href="/?r=six/index/index&rtype=LX"><span style="font-size: 12px;margin-left: 60px;">连肖</span></a></li>
                        <li style="background:url(/public/aomenPC//img/left_4.jpg) no-repeat;height: 24px;"><a href="/?r=six/index/index&rtype=LX"><span style="font-size: 12px;margin-left: 60px;">连尾</span></a></li>
                        <li style="background:url(/public/aomenPC//img/left_4.jpg) no-repeat;height: 24px;"><a href="/?r=six/index/index&rtype=NI"><span style="font-size: 12px;margin-left: 60px;">自选不中</span></a></li>
                        <li style="background:url(/public/aomenPC//img/left_4.jpg) no-repeat;height: 24px;"><a href="/?r=six/index/index&rtype=SPA&showTableN=1"><span style="font-size: 12px;margin-left: 60px;">特码生肖</span></a></li>
                        <li style="background:url(/public/aomenPC//img/left_4.jpg) no-repeat;height: 24px;"><a href="/?r=six/index/index&rtype=C7&showTableN=1"><span style="font-size: 12px;margin-left: 60px;">正肖</span></a></li>
                        <li style="background:url(/public/aomenPC//img/left_4.jpg) no-repeat;height: 24px;"><a href="/?r=six/index/index&rtype=SPB&showTableN=1"><span style="font-size: 12px;margin-left: 60px;">一肖</span></a></li>
                        <li style="background:url(/public/aomenPC//img/left_4.jpg) no-repeat;height: 24px;"><a href="/?r=six/index/index&rtype=NX"><span style="font-size: 12px;margin-left: 60px;">合肖</span></a></li>
                        <li style="background:url(/public/aomenPC//img/left_4.jpg) no-repeat;height: 24px;"><a href="/?r=six/index/index&rtype=SPB&showTableN=3"><span style="font-size: 12px;margin-left: 60px;">总肖</span></a></li>
                        <li style="background:url(/public/aomenPC//img/left_4.jpg) no-repeat;height: 24px;"><a href="/?r=six/index/index&rtype=SPA&amp;showTableN=2"><span style="font-size: 12px;margin-left: 60px;">色波</span></a></li>
                        <li style="background:url(/public/aomenPC//img/left_4.jpg) no-repeat;height: 24px;"><a href="/?r=six/index/index&rtype=HB&showTableN=1"><span style="font-size: 12px;margin-left: 60px;">半波</span></a></li>
                        <li style="background:url(/public/aomenPC//img/left_4.jpg) no-repeat;height: 24px;"><a href="/?r=six/index/index&rtype=HB&showTableN=2"><span style="font-size: 12px;margin-left: 60px;">半半波</span></a></li>
                        <li style="background:url(/public/aomenPC//img/left_4.jpg) no-repeat;height: 24px;"><a href="/?r=six/index/index&rtype=C7&showTableN=2"><span style="font-size: 12px;margin-left: 60px;">七色波</span></a></li>
                        <li style="background:url(/public/aomenPC//img/left_4.jpg) no-repeat;height: 24px;"><a href="/?r=six/index/index&rtype=SPA&showTableN=3"><span style="font-size: 12px;margin-left: 60px;">头尾数</span></a></li>
                        <li style="background:url(/public/aomenPC//img/left_4.jpg) no-repeat;height: 24px;"><a href="/?r=six/index/index&rtype=SPB&showTableN=2"><span style="font-size: 12px;margin-left: 60px;">平特尾数</span></a></li>
                    </ul>
                </div>
            </div>
            <div id="content_six">
                <h2>
                    <b></b>
                    <span>六合彩</span>
                </h2>
                <div id="content_inner">
                    <div style="display: none;" id="c_rtype"></div>
                    <div>
                        <div id="game_info">
                            期数: <span style="font-weight:bold;" id="gNumber"><?=$qishu!=-1 ? $qishu:'';?></span> &nbsp;&nbsp;
                            <b>封盘时间:</b><span id="gametime">&nbsp;</span>&nbsp;&nbsp;&nbsp;
                            <span id="ui-countdown">
                                <span id="FCDH" style="font-weight:bold;"></span>
                                <span id="close_msg" style="display:none;">&nbsp;</span>
                            </span>
                        </div>


						<input type="hidden" id="gold_gmin" value="<?=$lowestMoney ?>" />
                        <input type="hidden" id="gold_gmax" value="<?=$maxMoney ?>" />
<?php
if ($rType == 'SP') {//特别号A面
    ?>
    <div id="wager_groups" class="LT">
        <a href="#NAVPLAY" id="allplay">玩法</a>
        <a href="/?r=six/index/index&rtype=OEOU">两面</a>
        <a class="NowPlay" href="#NAVSP">特别号</a>
        <a href="#NAVNA">正码</a>
        <a href="#NAVCH">连码</a>
        <a href="#NAVSPA">生肖</a>
        <a href="#NAVSPC">色波</a>
        <a href="#NAVHF">头尾数</a>
        <dl id="NAVPLAY" style="height: 312px;">
            <dd><a href="/?r=six/index/index&rtype=OEOU">两面12</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=C7&showTableN=1">正肖</a> </dd>
            <dd><a class="NowPlay" href="/?r=six/index/index&rtype=SP">特别号A面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPbside">特别号B面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=1">一肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NA">正码</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NX">合肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NAS&amp;rtypeN=N1">正码特</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=3">总肖 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NO">正码1-6</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&amp;showTableN=2">色波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NAP">正码过关</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=HB&showTableN=1">半波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=CH">连码</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=HB&showTableN=2">半半波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=LX">连肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=C7&showTableN=2">七色波</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=LX">连尾</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&showTableN=3">头尾数 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NI">自选不中</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=2">平特尾数 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&showTableN=1">特码生肖 </a> </dd>
        </dl>
        <nav id="NAVSP">
            <a href="/?r=six/index/index&rtype=SP">特别号A面</a>
            <a href="/?r=six/index/index&rtype=SPbside">特别号B面</a>
        </nav>
        <nav id="NAVNA" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=NA">正码</a>
            <a href="/?r=six/index/index&rtype=NAS&amp;rtypeN=N1">正码特</a>
            <a href="/?r=six/index/index&rtype=NO">正码1-6</a>
            <a href="/?r=six/index/index&rtype=NAP">正码过关</a>
        </nav>
        <nav id="NAVCH" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=CH">连码</a>
            <a href="/?r=six/index/index&rtype=LX">连肖</a>
            <a href="/?r=six/index/index&rtype=LX">连尾</a>
            <a href="/?r=six/index/index&rtype=NI">自选不中</a>
        </nav>
        <nav id="NAVSPA" style="height: 150px;">
            <a href="/?r=six/index/index&rtype=SPA&showTableN=1">特码生肖</a>
            <a href="/?r=six/index/index&rtype=C7&showTableN=1">正肖</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=1">一肖</a>
            <a href="/?r=six/index/index&rtype=NX">合肖</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=3">总肖</a>
        </nav>
       <nav id="NAVSPC" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=SPA&showTableN=1">色波</a>
            <a href="/?r=six/index/index&rtype=HB&showTableN=2">半波</a>
            <a href="/?r=six/index/index&rtype=HB&showTableN=2">半半波</a>
            <a href="/?r=six/index/index&rtype=C7&showTableN=2">七色波</a>
        </nav>
        <nav id="NAVHF">
            <a href="/?r=six/index/index&rtype=SPA&showTableN=3">头尾数</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=2">平特尾数</a>
        </nav>
    </div>
    <?php
} elseif ($rType == 'SPbside') {//特别号B面
    ?>
    <div id="wager_groups" class="LT">
        <a href="#NAVPLAY" id="allplay">玩法</a>
        <a href="/?r=six/index/index&rtype=OEOU">两面</a>
        <a class="NowPlay" href="#NAVSP">特别号</a>
        <a href="#NAVNA">正码</a>
        <a href="#NAVCH">连码</a>
        <a href="#NAVSPA">生肖</a>
        <a href="#NAVSPC">色波</a>
        <a href="#NAVHF">头尾数</a>
        <dl id="NAVPLAY" style="height: 312px;">
            <dd><a href="/?r=six/index/index&rtype=OEOU">两面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=C7&showTableN=1">正肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SP">特别号A面</a> </dd>
            <dd><a class="NowPlay" href="/?r=six/index/index&rtype=SPbside">特别号B面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=1">一肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NA">正码</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NX">合肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NAS&amp;rtypeN=N1">正码特</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=3">总肖 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NO">正码1-6</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&amp;showTableN=2">色波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NAP">正码过关</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=HB&showTableN=1">半波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=CH">连码</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=HB&showTableN=2">半半波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=LX">连肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=C7&showTableN=2">七色波</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=LX">连尾</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&showTableN=3">头尾数 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NI">自选不中</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=2">平特尾数 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&showTableN=1">特码生肖 </a> </dd>
        </dl>
        <nav id="NAVSP">
            <a href="/?r=six/index/index&rtype=SP">特别号A面</a>
            <a href="/?r=six/index/index&rtype=SPbside">特别号B面</a>
        </nav>
        <nav id="NAVNA" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=NA">正码</a>
            <a href="/?r=six/index/index&rtype=NAS&amp;rtypeN=N1">正码特</a>
            <a href="/?r=six/index/index&rtype=NO">正码1-6</a>
            <a href="/?r=six/index/index&rtype=NAP">正码过关</a>
        </nav>
        <nav id="NAVCH" style="height: 120px;" >
            <a href="/?r=six/index/index&rtype=CH">连码</a>
            <a href="/?r=six/index/index&rtype=LX">连肖</a>
            <a href="/?r=six/index/index&rtype=LX">连尾</a>
            <a href="/?r=six/index/index&rtype=NI">自选不中</a>
        </nav>
        <nav id="NAVSPA" style="height: 150px;">
            <a href="/?r=six/index/index&rtype=SPA&showTableN=1">特码生肖</a>
            <a href="/?r=six/index/index&rtype=C7&showTableN=1">正肖</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=1">一肖</a>
            <a href="/?r=six/index/index&rtype=NX">合肖</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=3">总肖</a>
        </nav>
       <nav id="NAVSPC" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=SPA&amp;showTableN=2">色波</a>
            <a href="/?r=six/index/index&rtype=HB&showTableN=1">半波</a>
            <a href="/?r=six/index/index&rtype=HB&showTableN=2">半半波</a>
            <a href="/?r=six/index/index&rtype=C7&showTableN=2">七色波</a>
        </nav>
        <nav id="NAVHF">
            <a href="/?r=six/index/index&rtype=SPA&showTableN=3">头尾数</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=2">平特尾数</a>
        </nav>
    </div>
    <?php
} elseif ($rType == "OEOU") {//两面
    ?>
    <div id="wager_groups" class="LT">
        <a href="#NAVPLAY" id="allplay">玩法</a>
        <a class="NowPlay" href="/?r=six/index/index&rtype=OEOU">两面</a>
        <a href="#NAVSP">特别号</a>
        <a href="#NAVNA">正码</a>
        <a href="#NAVCH">连码</a>
        <a href="#NAVSPA">生肖</a>
        <a href="#NAVSPC">色波</a>
        <a href="#NAVHF">头尾数</a>
        <dl id="NAVPLAY" style="height: 312px;">
            <dd><a class="NowPlay" href="/?r=six/index/index&rtype=OEOU">两面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=C7&showTableN=1">正肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SP">特别号A面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPbside">特别号B面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=1">一肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NA">正码</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NX">合肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NAS&amp;rtypeN=N1">正码特</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=3">总肖 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NO">正码1-6</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&amp;showTableN=2">色波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NAP">正码过关</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=HB&showTableN=1">半波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=CH">连码</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=HB&showTableN=2">半半波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=LX">连肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=C7&showTableN=2">七色波</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=LX">连尾</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&showTableN=3">头尾数 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NI">自选不中</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=2">平特尾数 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&showTableN=1">特码生肖 </a> </dd>
        </dl>
        <nav id="NAVSP">
            <a href="/?r=six/index/index&rtype=SP">特别号A面</a>
            <a href="/?r=six/index/index&rtype=SPbside">特别号B面</a>
        </nav>
        <nav id="NAVNA" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=NA">正码</a>
            <a href="/?r=six/index/index&rtype=NAS&amp;rtypeN=N1">正码特</a>
            <a href="/?r=six/index/index&rtype=NO">正码1-6</a>
            <a href="/?r=six/index/index&rtype=NAP">正码过关</a>
        </nav>
        <nav id="NAVCH" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=CH">连码</a>
            <a href="/?r=six/index/index&rtype=LX">连肖</a>
            <a href="/?r=six/index/index&rtype=LX">连尾</a>
            <a href="/?r=six/index/index&rtype=NI">自选不中</a>
        </nav>
        <nav id="NAVSPA" style="height: 150px;">
            <a href="/?r=six/index/index&rtype=SPA&showTableN=1">特码生肖</a>
            <a href="/?r=six/index/index&rtype=C7&showTableN=1">正肖</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=1">一肖</a>
            <a href="/?r=six/index/index&rtype=NX">合肖</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=3">总肖</a>
        </nav>
       <nav id="NAVSPC" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=SPA&amp;showTableN=2">色波</a>
            <a href="/?r=six/index/index&rtype=HB&showTableN=1">半波</a>
            <a href="/?r=six/index/index&rtype=HB&showTableN=2">半半波</a>
            <a href="/?r=six/index/index&rtype=C7&showTableN=2">七色波</a>
        </nav>
        <nav id="NAVHF">
            <a href="/?r=six/index/index&rtype=SPA&showTableN=3">头尾数</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=2">平特尾数</a>
        </nav>
    </div>
    <?php
} elseif ($rType == "NA") {//正码
    ?>
    <div id="wager_groups" class="LT">
        <a href="#NAVPLAY" id="allplay">玩法</a>
        <a href="/?r=six/index/index&rtype=OEOU">两面</a>
        <a href="#NAVSP">特别号</a>
        <a href="#NAVNA" class="NowPlay">正码</a>
        <a href="#NAVCH">连码</a>
        <a href="#NAVSPA">生肖</a>
        <a href="#NAVSPC">色波</a>
        <a href="#NAVHF">头尾数</a>
        <dl id="NAVPLAY" style="height: 312px;">
            <dd><a href="/?r=six/index/index&rtype=OEOU">两面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=C7&showTableN=1">正肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SP">特别号A面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPbside">特别号B面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=1">一肖</a> </dd>
            <dd><a class="NowPlay" href="/?r=six/index/index&rtype=NA">正码</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NX">合肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NAS&amp;rtypeN=N1">正码特</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=3">总肖 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NO">正码1-6</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&amp;showTableN=2">色波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NAP">正码过关</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=HB&showTableN=1">半波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=CH">连码</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=HB&showTableN=2">半半波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=LX">连肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=C7&showTableN=2">七色波</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=LX">连尾</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&showTableN=3">头尾数 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NI">自选不中</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=2">平特尾数 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&showTableN=1">特码生肖 </a> </dd>
        </dl>
        <nav id="NAVSP">
            <a href="/?r=six/index/index&rtype=SP">特别号A面</a>
            <a href="/?r=six/index/index&rtype=SPbside">特别号B面</a>
        </nav>
        <nav id="NAVNA" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=NA">正码</a>
            <a href="/?r=six/index/index&rtype=NAS&amp;rtypeN=N1">正码特</a>
            <a href="/?r=six/index/index&rtype=NO">正码1-6</a>
            <a href="/?r=six/index/index&rtype=NAP">正码过关</a>
        </nav>
        <nav id="NAVCH" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=CH">连码</a>
            <a href="/?r=six/index/index&rtype=LX">连肖</a>
            <a href="/?r=six/index/index&rtype=LX">连尾</a>
            <a href="/?r=six/index/index&rtype=NI">自选不中</a>
        </nav>
        <nav id="NAVSPA" style="height: 150px;">
            <a href="/?r=six/index/index&rtype=SPA&showTableN=1">特码生肖</a>
            <a href="/?r=six/index/index&rtype=C7&showTableN=1">正肖</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=1">一肖</a>
            <a href="/?r=six/index/index&rtype=NX">合肖</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=3">总肖</a>
        </nav>
       <nav id="NAVSPC" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=SPA&amp;showTableN=2">色波</a>
            <a href="/?r=six/index/index&rtype=HB&showTableN=1">半波</a>
            <a href="/?r=six/index/index&rtype=HB&showTableN=2">半半波</a>
            <a href="/?r=six/index/index&rtype=C7&showTableN=2">七色波</a>
        </nav>
        <nav id="NAVHF">
            <a href="/?r=six/index/index&rtype=SPA&showTableN=3">头尾数</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=2">平特尾数</a>
        </nav>
    </div>
    <?php
} elseif ($rType == "NAS") {//正码特
    ?>
    <div id="wager_groups" class="LT">
        <a href="#NAVPLAY" id="allplay">玩法</a>
        <a href="/?r=six/index/index&rtype=OEOU">两面</a>
        <a href="#NAVSP">特别号</a>
        <a href="#NAVNA" class="NowPlay">正码</a>
        <a href="#NAVCH">连码</a>
        <a href="#NAVSPA">生肖</a>
        <a href="#NAVSPC">色波</a>
        <a href="#NAVHF">头尾数</a>
        <dl id="NAVPLAY" style="height: 312px;">
            <dd><a href="/?r=six/index/index&rtype=OEOU">两面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=C7&showTableN=1">正肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SP">特别号A面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPbside">特别号B面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=1">一肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NA">正码</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NX">合肖</a> </dd>
            <dd><a class="NowPlay" href="/?r=six/index/index&rtype=NAS&amp;rtypeN=N1">正码特</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=3">总肖 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NO">正码1-6</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&amp;showTableN=2">色波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NAP">正码过关</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=HB&showTableN=1">半波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=CH">连码</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=HB&showTableN=2">半半波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=LX">连肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=C7&showTableN=2">七色波</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=LX">连尾</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&showTableN=3">头尾数 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NI">自选不中</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=2">平特尾数 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&showTableN=1">特码生肖 </a> </dd>
        </dl>
        <nav id="NAVSP">
            <a href="/?r=six/index/index&rtype=SP">特别号A面</a>
            <a href="/?r=six/index/index&rtype=SPbside">特别号B面</a>
        </nav>
        <nav id="NAVNA" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=NA">正码</a>
            <a href="/?r=six/index/index&rtype=NAS&amp;rtypeN=N1">正码特</a>
            <a href="/?r=six/index/index&rtype=NO">正码1-6</a>
            <a href="/?r=six/index/index&rtype=NAP">正码过关</a>
        </nav>
        <nav id="NAVCH" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=CH">连码</a>
            <a href="/?r=six/index/index&rtype=LX">连肖</a>
            <a href="/?r=six/index/index&rtype=LX">连尾</a>
            <a href="/?r=six/index/index&rtype=NI">自选不中</a>
        </nav>
        <nav id="NAVSPA" style="height: 150px;">
            <a href="/?r=six/index/index&rtype=SPA&showTableN=1">特码生肖</a>
            <a href="/?r=six/index/index&rtype=C7&showTableN=1">正肖</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=1">一肖</a>
            <a href="/?r=six/index/index&rtype=NX">合肖</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=3">总肖</a>
        </nav>
       <nav id="NAVSPC" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=SPA&amp;showTableN=2">色波</a>
            <a href="/?r=six/index/index&rtype=HB&showTableN=1">半波</a>
            <a href="/?r=six/index/index&rtype=HB&showTableN=2">半半波</a>
            <a href="/?r=six/index/index&rtype=C7&showTableN=2">七色波</a>
        </nav>
        <nav id="NAVHF">
            <a href="/?r=six/index/index&rtype=SPA&showTableN=3">头尾数</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=2">平特尾数</a>
        </nav>
    </div>
    <?php
} elseif ($rType == "NO") {//正码1-6
    ?>
    <div id="wager_groups" class="LT">
        <a href="#NAVPLAY" id="allplay">玩法</a>
        <a href="/?r=six/index/index&rtype=OEOU">两面</a>
        <a href="#NAVSP">特别号</a>
        <a href="#NAVNA" class="NowPlay">正码</a>
        <a href="#NAVCH">连码</a>
        <a href="#NAVSPA">生肖</a>
        <a href="#NAVSPC">色波</a>
        <a href="#NAVHF">头尾数</a>
        <dl id="NAVPLAY" style="height: 312px;">
            <dd><a href="/?r=six/index/index&rtype=OEOU">两面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=C7&showTableN=1">正肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SP">特别号A面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPbside">特别号B面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=1">一肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NA">正码</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NX">合肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NAS&amp;rtypeN=N1">正码特</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=3">总肖 </a> </dd>
            <dd><a class="NowPlay" href="/?r=six/index/index&rtype=NO">正码1-6</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&amp;showTableN=2">色波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NAP">正码过关</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=HB&showTableN=1">半波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=CH">连码</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=HB&showTableN=2">半半波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=LX">连肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=C7&showTableN=2">七色波</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=LX">连尾</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&showTableN=3">头尾数 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NI">自选不中</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=2">平特尾数 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&showTableN=1">特码生肖 </a> </dd>
        </dl>
        <nav id="NAVSP">
            <a href="/?r=six/index/index&rtype=SP">特别号A面</a>
            <a href="/?r=six/index/index&rtype=SPbside">特别号B面</a>
        </nav>
        <nav id="NAVNA" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=NA">正码</a>
            <a href="/?r=six/index/index&rtype=NAS&amp;rtypeN=N1">正码特</a>
            <a href="/?r=six/index/index&rtype=NO">正码1-6</a>
            <a href="/?r=six/index/index&rtype=NAP">正码过关</a>
        </nav>
        <nav id="NAVCH" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=CH">连码</a>
            <a href="/?r=six/index/index&rtype=LX">连肖</a>
            <a href="/?r=six/index/index&rtype=LX">连尾</a>
            <a href="/?r=six/index/index&rtype=NI">自选不中</a>
        </nav>
        <nav id="NAVSPA" style="height: 150px;">
            <a href="/?r=six/index/index&rtype=SPA&showTableN=1">特码生肖</a>
            <a href="/?r=six/index/index&rtype=C7&showTableN=1">正肖</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=1">一肖</a>
            <a href="/?r=six/index/index&rtype=NX">合肖</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=3">总肖</a>
        </nav>
       <nav id="NAVSPC" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=SPA&amp;showTableN=2">色波</a>
            <a href="/?r=six/index/index&rtype=HB&showTableN=1">半波</a>
            <a href="/?r=six/index/index&rtype=HB&showTableN=2">半半波</a>
            <a href="/?r=six/index/index&rtype=C7&showTableN=2">七色波</a>
        </nav>
        <nav id="NAVHF">
            <a href="/?r=six/index/index&rtype=SPA&showTableN=3">头尾数</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=2">平特尾数</a>
        </nav>
    </div>
    <?php
} elseif ($rType == "SPA") {//特码生肖,色波,头尾数
    ?>
    <div id="wager_groups" class="LT">
        <a href="#NAVPLAY" id="allplay">玩法</a>
        <a href="/?r=six/index/index&rtype=OEOU">两面</a>
        <a href="#NAVSP">特别号</a>
        <a href="#NAVNA">正码</a>
        <a href="#NAVCH">连码</a>
        <a href="#NAVSPA">生肖</a>
        <a href="#NAVSPC">色波</a>
        <a href="#NAVHF">头尾数</a>
        <dl id="NAVPLAY" style="height: 312px;">
            <dd><a href="/?r=six/index/index&rtype=OEOU">两面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=C7&showTableN=1">正肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SP">特别号A面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPbside">特别号B面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=1">一肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NA">正码</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NX">合肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NAS&amp;rtypeN=N1">正码特</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=3">总肖 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NO">正码1-6</a> </dd>
            <dd><a class="NowPlay" href="/?r=six/index/index&rtype=SPA&amp;showTableN=2">色波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NAP">正码过关</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=HB&showTableN=1">半波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=CH">连码</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=HB&showTableN=2">半半波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=LX">连肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=C7&showTableN=2">七色波</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=LX">连尾</a> </dd>
            <dd><a class="NowPlay" href="/?r=six/index/index&rtype=SPA&showTableN=3">头尾数 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NI">自选不中</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=2">平特尾数 </a> </dd>
            <dd><a class="NowPlay" href="/?r=six/index/index&rtype=SPA&showTableN=1">特码生肖 </a> </dd>
        </dl>
        <nav id="NAVSP">
            <a href="/?r=six/index/index&rtype=SP">特别号A面</a>
            <a href="/?r=six/index/index&rtype=SPbside">特别号B面</a>
        </nav>
        <nav id="NAVNA" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=NA">正码</a>
            <a href="/?r=six/index/index&rtype=NAS&amp;rtypeN=N1">正码特</a>
            <a href="/?r=six/index/index&rtype=NO">正码1-6</a>
            <a href="/?r=six/index/index&rtype=NAP">正码过关</a>
        </nav>
        <nav id="NAVCH" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=CH">连码</a>
            <a href="/?r=six/index/index&rtype=LX">连肖</a>
            <a href="/?r=six/index/index&rtype=LX">连尾</a>
            <a href="/?r=six/index/index&rtype=NI">自选不中</a>
        </nav>
        <nav id="NAVSPA" style="height: 150px;">
            <a href="/?r=six/index/index&rtype=SPA&showTableN=1">特码生肖</a>
            <a href="/?r=six/index/index&rtype=C7&showTableN=1">正肖</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=1">一肖</a>
            <a href="/?r=six/index/index&rtype=NX">合肖</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=3">总肖</a>
        </nav>
       <nav id="NAVSPC" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=SPA&amp;showTableN=2">色波</a>
            <a href="/?r=six/index/index&rtype=HB&showTableN=1">半波</a>
            <a href="/?r=six/index/index&rtype=HB&showTableN=2">半半波</a>
            <a href="/?r=six/index/index&rtype=C7&showTableN=2">七色波</a>
        </nav>
        <nav id="NAVHF">
            <a href="/?r=six/index/index&rtype=SPA&showTableN=3">头尾数</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=2">平特尾数</a>
        </nav>
    </div>
    <?php
} elseif ($rType == "C7") {//正肖,七色波
    ?>
    <div id="wager_groups" class="LT">
        <a href="#NAVPLAY" id="allplay">玩法</a>
        <a href="/?r=six/index/index&rtype=OEOU">两面</a>
        <a href="#NAVSP">特别号</a>
        <a href="#NAVNA">正码</a>
        <a href="#NAVCH">连码</a>
        <a href="#NAVSPA">生肖</a>
        <a href="#NAVSPC">色波</a>
        <a href="#NAVHF">头尾数</a>
        <dl id="NAVPLAY" style="height: 312px;">
            <dd><a href="/?r=six/index/index&rtype=OEOU">两面</a> </dd>
            <dd><a class="NowPlay" href="/?r=six/index/index&rtype=C7&showTableN=1">正肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SP">特别号A面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPbside">特别号B面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=1">一肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NA">正码</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NX">合肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NAS&amp;rtypeN=N1">正码特</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=3">总肖 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NO">正码1-6</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&amp;showTableN=2">色波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NAP">正码过关</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=HB&showTableN=1">半波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=CH">连码</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=HB&showTableN=2">半半波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=LX">连肖</a> </dd>
            <dd><a class="NowPlay" href="/?r=six/index/index&rtype=C7&showTableN=2">七色波</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=LX">连尾</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&showTableN=3">头尾数 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NI">自选不中</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=2">平特尾数 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&showTableN=1">特码生肖 </a> </dd>
        </dl>
        <nav id="NAVSP">
            <a href="/?r=six/index/index&rtype=SP">特别号A面</a>
            <a href="/?r=six/index/index&rtype=SPbside">特别号B面</a>
        </nav>
        <nav id="NAVNA" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=NA">正码</a>
            <a href="/?r=six/index/index&rtype=NAS&amp;rtypeN=N1">正码特</a>
            <a href="/?r=six/index/index&rtype=NO">正码1-6</a>
            <a href="/?r=six/index/index&rtype=NAP">正码过关</a>
        </nav>
        <nav id="NAVCH" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=CH">连码</a>
            <a href="/?r=six/index/index&rtype=LX">连肖</a>
            <a href="/?r=six/index/index&rtype=LX">连尾</a>
            <a href="/?r=six/index/index&rtype=NI">自选不中</a>
        </nav>
        <nav id="NAVSPA" style="height: 150px;">
            <a href="/?r=six/index/index&rtype=SPA&showTableN=1">特码生肖</a>
            <a href="/?r=six/index/index&rtype=C7&showTableN=1">正肖</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=1">一肖</a>
            <a href="/?r=six/index/index&rtype=NX">合肖</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=3">总肖</a>
        </nav>
       <nav id="NAVSPC" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=SPA&amp;showTableN=2">色波</a>
            <a href="/?r=six/index/index&rtype=HB&showTableN=1">半波</a>
            <a href="/?r=six/index/index&rtype=HB&showTableN=2">半半波</a>
            <a href="/?r=six/index/index&rtype=C7&showTableN=2">七色波</a>
        </nav>
        <nav id="NAVHF">
            <a href="/?r=six/index/index&rtype=SPA&showTableN=3">头尾数</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=2">平特尾数</a>
        </nav>
    </div>
    <?php
} elseif ($rType == "SPB") {//一肖,总肖,平特尾数
    ?>
    <div id="wager_groups" class="LT">
        <a href="#NAVPLAY" id="allplay">玩法</a>
        <a href="/?r=six/index/index&rtype=OEOU">两面</a>
        <a href="#NAVSP">特别号</a>
        <a href="#NAVNA">正码</a>
        <a href="#NAVCH">连码</a>
        <a href="#NAVSPA">生肖</a>
        <a href="#NAVSPC">色波</a>
        <a href="#NAVHF">头尾数</a>
        <dl id="NAVPLAY" style="height: 312px;">
            <dd><a href="/?r=six/index/index&rtype=OEOU">两面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=C7&showTableN=1">正肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SP">特别号A面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPbside">特别号B面</a> </dd>
            <dd><a class="NowPlay" href="/?r=six/index/index&rtype=SPB&showTableN=1">一肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NA">正码</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NX">合肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NAS&amp;rtypeN=N1">正码特</a> </dd>
            <dd><a class="NowPlay" href="/?r=six/index/index&rtype=SPB&showTableN=3">总肖 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NO">正码1-6</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&amp;showTableN=2">色波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NAP">正码过关</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=HB&showTableN=1">半波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=CH">连码</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=HB&showTableN=2">半半波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=LX">连肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=C7&showTableN=2">七色波</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=LX">连尾</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&showTableN=3">头尾数 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NI">自选不中</a> </dd>
            <dd><a class="NowPlay" href="/?r=six/index/index&rtype=SPB&showTableN=2">平特尾数 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&showTableN=1">特码生肖 </a> </dd>
        </dl>
        <nav id="NAVSP">
            <a href="/?r=six/index/index&rtype=SP">特别号A面</a>
            <a href="/?r=six/index/index&rtype=SPbside">特别号B面</a>
        </nav>
        <nav id="NAVNA" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=NA">正码</a>
            <a href="/?r=six/index/index&rtype=NAS&amp;rtypeN=N1">正码特</a>
            <a href="/?r=six/index/index&rtype=NO">正码1-6</a>
            <a href="/?r=six/index/index&rtype=NAP">正码过关</a>
        </nav>
        <nav id="NAVCH" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=CH">连码</a>
            <a href="/?r=six/index/index&rtype=LX">连肖</a>
            <a href="/?r=six/index/index&rtype=LX">连尾</a>
            <a href="/?r=six/index/index&rtype=NI">自选不中</a>
        </nav>
        <nav id="NAVSPA" style="height: 150px;">
            <a href="/?r=six/index/index&rtype=SPA&showTableN=1">特码生肖</a>
            <a href="/?r=six/index/index&rtype=C7&showTableN=1">正肖</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=1">一肖</a>
            <a href="/?r=six/index/index&rtype=NX">合肖</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=3">总肖</a>
        </nav>
       <nav id="NAVSPC" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=SPA&amp;showTableN=2">色波</a>
            <a href="/?r=six/index/index&rtype=HB&showTableN=1">半波</a>
            <a href="/?r=six/index/index&rtype=HB&showTableN=2">半半波</a>
            <a href="/?r=six/index/index&rtype=C7&showTableN=2">七色波</a>
        </nav>
        <nav id="NAVHF">
            <a href="/?r=six/index/index&rtype=SPA&showTableN=3">头尾数</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=2">平特尾数</a>
        </nav>
    </div>
    <?php
} elseif ($rType == "HB") {//半波,半半波
    ?>
    <div id="wager_groups" class="LT">
        <a href="#NAVPLAY" id="allplay">玩法</a>
        <a href="/?r=six/index/index&rtype=OEOU">两面</a>
        <a href="#NAVSP">特别号</a>
        <a href="#NAVNA">正码</a>
        <a href="#NAVCH">连码</a>
        <a href="#NAVSPA">生肖</a>
        <a class="NowPlay" href="#NAVSPC">色波</a>
        <a href="#NAVHF">头尾数</a>
        <dl id="NAVPLAY" style="height: 312px;">
            <dd><a href="/?r=six/index/index&rtype=OEOU">两面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=C7&showTableN=1">正肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SP">特别号A面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPbside">特别号B面</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=1">一肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NA">正码</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NX">合肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NAS&amp;rtypeN=N1">正码特</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=3">总肖 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NO">正码1-6</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&amp;showTableN=2">色波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NAP">正码过关</a> </dd>
            <dd><a class="NowPlay" href="/?r=six/index/index&rtype=HB&showTableN=1">半波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=CH">连码</a> </dd>
            <dd><a class="NowPlay" href="/?r=six/index/index&rtype=HB&showTableN=2">半半波 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=LX">连肖</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=C7&showTableN=2">七色波</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=LX">连尾</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&showTableN=3">头尾数 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=NI">自选不中</a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPB&showTableN=2">平特尾数 </a> </dd>
            <dd><a href="/?r=six/index/index&rtype=SPA&showTableN=1">特码生肖 </a> </dd>
        </dl>
        <nav id="NAVSP">
            <a href="/?r=six/index/index&rtype=SP">特别号A面</a>
            <a href="/?r=six/index/index&rtype=SPbside">特别号B面</a>
        </nav>
        <nav id="NAVNA" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=NA">正码</a>
            <a href="/?r=six/index/index&rtype=NAS&amp;rtypeN=N1">正码特</a>
            <a href="/?r=six/index/index&rtype=NO">正码1-6</a>
            <a href="/?r=six/index/index&rtype=NAP">正码过关</a>
        </nav>
        <nav id="NAVCH" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=CH">连码</a>
            <a href="/?r=six/index/index&rtype=LX">连肖</a>
            <a href="/?r=six/index/index&rtype=LX">连尾</a>
            <a href="/?r=six/index/index&rtype=NI">自选不中</a>
        </nav>
        <nav id="NAVSPA" style="height: 150px;">
            <a href="/?r=six/index/index&rtype=SPA&showTableN=1">特码生肖</a>
            <a href="/?r=six/index/index&rtype=C7&showTableN=1">正肖</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=1">一肖</a>
            <a href="/?r=six/index/index&rtype=NX">合肖</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=3">总肖</a>
        </nav>
       <nav id="NAVSPC" style="height: 120px;">
            <a href="/?r=six/index/index&rtype=SPA&amp;showTableN=2">色波</a>
            <a href="/?r=six/index/index&rtype=HB&showTableN=1">半波</a>
            <a href="/?r=six/index/index&rtype=HB&showTableN=2">半半波</a>
            <a href="/?r=six/index/index&rtype=C7&showTableN=2">七色波</a>
        </nav>
        <nav id="NAVHF">
            <a href="/?r=six/index/index&rtype=SPA&showTableN=3">头尾数</a>
            <a href="/?r=six/index/index&rtype=SPB&showTableN=2">平特尾数</a>
        </nav>
    </div>
    <?php
}
?>
<div id="randomball" class="round-table" style="display:none">
    <table>
        <tr class="title_tr">
            <td>正码一</td>
            <td>正码二</td>
            <td>正码三</td>
            <td>正码四</td>
            <td>正码五</td>
            <td>正码六</td>
            <td>特别号</td>
        </tr>
        <tr class="BallTr">
            <td id="bal0"></td>
            <td id="bal1"></td>
            <td id="bal2"></td>
            <td id="bal3"></td>
            <td id="bal4"></td>
            <td id="bal5"></td>
            <td id="bal6"></td>
        </tr>
        <tr class="BallTr">
            <td id="bal0a"></td>
            <td id="bal1a"></td>
            <td id="bal2a"></td>
            <td id="bal3a"></td>
            <td id="bal4a"></td>
            <td id="bal5a"></td>
            <td id="bal6a"></td>
        </tr>
    </table>
</div>
<div id="GrpBtn" style="">
    <input type="hidden" name="NowBet" id="NowBet" value="SP" />
    <div id="QuickMenu">
        <p class="grp-title"><i></i>群组选项<b>▼</b></p>
        <div>
            下注金额 :
            <input type="text" min="0" id="BetGold" name="BetGold" class="GoldQQ" />
            <label><input type="checkbox" name="replaceGold" id="replaceGold" />取代金額</label>
        </div>
        <fieldset class="ball49">
            <legend>彩球号码</legend>
            <p>
                <a class="b01">01</a> <a class="b02">02</a> <a class="b03">03</a> <a class="b04">04</a> <a class="b05">05</a>
                <a class="b06">06</a> <a class="b07">07</a> <a class="b08">08</a> <a class="b09">09</a> <a class="b10">10</a>
                <a class="b11">11</a> <a class="b12">12</a> <a class="b13">13</a> <a class="b14">14</a> <a class="b15">15</a>
                <a class="b16">16</a> <a class="b17">17</a> <a class="b18">18</a> <a class="b19">19</a> <a class="b20">20</a>
            </p>
            <p>
                <a class="b21">21</a> <a class="b22">22</a> <a class="b23">23</a> <a class="b24">24</a> <a class="b25">25</a>
                <a class="b26">26</a> <a class="b27">27</a> <a class="b28">28</a> <a class="b29">29</a> <a class="b30">30</a>
                <a class="b31">31</a> <a class="b32">32</a> <a class="b33">33</a> <a class="b34">34</a> <a class="b35">35</a>
                <a class="b36">36</a> <a class="b37">37</a> <a class="b38">38</a> <a class="b39">39</a> <a class="b40">40</a>
            </p>
            <p>
                <a class="b41">41</a> <a class="b42">42</a> <a class="b43">43</a> <a class="b44">44</a> <a class="b45">45</a>
                <a class="b46">46</a> <a class="b47">47</a> <a class="b48">48</a> <a class="b49">49</a>
            </p>
        </fieldset>
        <fieldset>
            <legend>单双大小</legend>
            <p>
                <a>单</a>
                <a>双</a>
                <a>大</a>
                <a>小</a>
                <a>和单</a>
                <a>和双</a>
                <a>和大</a>
                <a>和小</a>
            </p>
        </fieldset>
        <fieldset>
            <legend>色波</legend>
            <p>
                <a class="RED">红波</a>
                <a class="BLUE">蓝波</a>
                <a class="GREEN">绿波</a>
            </p>
        </fieldset>
        <fieldset class="HB">
            <legend>半波</legend>
            <p>
                <a class="RED">红单</a>
                <a class="RED">红双</a>
                <a class="RED">红大</a>
                <a class="RED">红小</a>
                <a class="BLUE">蓝单</a>
                <a class="BLUE">蓝双</a>
                <a class="BLUE">蓝大</a>
                <a class="BLUE">蓝小</a>
                <a class="GREEN">绿单</a>
                <a class="GREEN">绿双</a>
                <a class="GREEN">绿大</a>
                <a class="GREEN">绿小</a>
            </p>
        </fieldset>
        <fieldset>
            <legend>头</legend>
            <p>
                <a>0</a>
                <a>1</a>
                <a>2</a>
                <a>3</a>
                <a>4</a>
            </p>
        </fieldset>
        <fieldset>
            <legend>尾</legend>
            <p>
                <a>0</a>
                <a>1</a>
                <a>2</a>
                <a>3</a>
                <a>4</a>
                <a>5</a>
                <a>6</a>
                <a>7</a>
                <a>8</a>
                <a>9</a>
            </p>
        </fieldset>
        <fieldset class="SPA">
            <legend>生肖</legend>
            <p>
                <a>鼠</a>
                <a>牛</a>
                <a>虎</a>
                <a>兔</a>
                <a>龙</a>
                <a>蛇</a>
                <a>马</a>
                <a>羊</a>
                <a>猴</a>
                <a>鸡</a>
                <a>狗</a>
                <a>猪</a>
            </p>
        </fieldset>
        <p style="clear:both">
            <input class="cancel" type="button" onclick="document.newForm.reset();" value="取消" />&nbsp;
            <input id="QuickSubmit" type="button" value="确定" />
        </p>
    </div>
</div>                            <!--游戏区块-->
<div id="Game">
    <form name="newForm" id="newForm" action="/?r=six/index/six-order" method="post">
        <!--正码1-6选择-->
        <div id="tab" style="display:none;">
            <ul>
                <li data-rtypeN="N1" class="onTagClick"><span><b>正码特 1</b></span></li>
                <li data-rtypeN="N2" class="unTagClick"><span><b>正码特 2</b></span></li>
                <li data-rtypeN="N3" class="unTagClick"><span><b>正码特 3</b></span></li>
                <li data-rtypeN="N4" class="unTagClick"><span><b>正码特 4</b></span></li>
                <li data-rtypeN="N5" class="unTagClick"><span><b>正码特 5</b></span></li>
                <li data-rtypeN="N6" class="unTagClick"><span><b>正码特 6</b></span></li>
                <li id="space" style="width:15px;"></li>
            </ul>
        </div>
        <div class="round-table"><table id="table1"></table></div>
        <div class="round-table"><table id="table2"></table></div>
        <div class="round-table"><table id="table3"></table></div>
        <div class="round-table"><table id="table4"></table></div>
        <div class="SendLT Send">
            <span class="credit">下注金额:<b id="total_bet">0.00</b></span>
            <input type="hidden" name="period" id="period" value="<?=isset($lastOne['qishu'])?$lastOne['qishu']:0; ?>"/>
            <input class="no" type="reset" value="取消"/>
            <input class="yes" type="button" name="btnBet" value="确定"/>
        </div>
        <input type="hidden" name="gid" id="gid" />
        <input type="hidden" name="showTableN" id="showTableN" value="2" />
        <input type="hidden" name="Line" id="Line" value="" />
    </form>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="ding"></ding></div>
<div id="ShowRule2" style="display:none;width:30px;">
    <div id="RuleText2" style="display: none;">
        <ol>
            <li><b>对碰:</b>依照二全中·二中特·特串 此3种玩法规则,依任两组`生肖`或`尾数`来组合下注的号码</li>
            <li><b>肖串尾数:</b>选择一主肖，可拖0~9尾的球，以三全中的肖串尾数为例：选择鼠(03,15,27,39)当主肖并拖9尾数，因尾数中39已在主肖内将不列入组合，因此共可组出24组(一个主肖+二个尾数)。</li>
            <li><b>交叉碰:</b><br />二星玩法：可选2柱~49柱，每柱1~48号码，使每柱串连，已选择号码不能重覆<br />三星玩法：可选3柱~48柱，每柱1~47号码，使每柱串连，已选择号码不能重覆<br />四星玩法：可选4柱~49柱，每柱1~46号码，使每柱串连，已选择号码不能重覆</li>
            <li><b>胆拖:</b>(N胆M拖)<br />选N个号码为胆，M个号码为拖。则有N*M个组合数。<br />(二星) 最多选3胆码，可拖49-(所选的胆码)个号码<br />(三星) 最多选2胆码，可拖49--(所选的胆码)个号码<br />(四星) 最多选3胆码，可拖49--(所选的胆码)个号码</li>
            <li><b>胆拖色波:</b>(N胆拖色波)<br />选N个号码为胆，可选红蓝绿波的球号为拖。则有N*色波球号个组合数。<br />(二星) 最多选3胆码，可拖(所选色波号码-所选胆码)个号码<br />(三星) 最多选2胆码，可拖(所选色波号码-所选胆码)个号码<br />(四星) 最多选3胆码，可拖(所选色波号码-所选胆码)个号码</li>
            <li><b>胆拖生肖:</b>(N胆拖生肖)<br />选N个号码为胆，可选生肖的球号为拖。则有N*生肖球号个组合数。<br />(二星) 最多选3胆码，可拖(所选生肖号码-所选胆码)个号码<br />(三星) 最多选2胆码，可拖(所选生肖号码-所选胆码)个号码<br />(四星) 最多选3胆码，可拖(所选生肖号码-所选胆码)个号码</li>
        </ol>
    </div>
    <div id="RightBar2">
        <div class="aa">+</div>
        <div class="bb">操作方法</div>
    </div>
</div>
<div id="ShowRule">
    <div id="RuleText" style="display: none;">
    </div>
    <div id="RightBar">
        <div class="aa">+</div>
        <div class="bb">规则说明</div>
    </div>
</div>
<div id="Tips" style="display:none;">
    <b class="before"></b>当用鼠标压住要下注的球号时，版面右方会出现下注的金额区块，可直接将要下注的号码拉到下注的金额上面下注<b class="after"></b>
</div>
<form action="../lt_order_tmp.php" method="post" name="BetForm" >
    <input type="hidden" name="Line" />
    <input type="hidden" name="gold" />
    <input type="hidden" name="gid" />
    <input type="hidden" name="concede" />
    <input type="hidden" name="ioradio" />
    <input type="hidden" name="is_login" value="<?=$is_login;?>">
</form>
<div id="AD" style="display:none" >
    <div id="ShowBall">
        <h2>組合窗口</h2>
        <div id="Ball">
            <p><span style="background-color:rgb(0,255,0);">&nbsp;&nbsp;&nbsp;</span></p>
        </div>
    </div>
</div>

<script>
    window.onload = function () {
        ccMarquee("marquee");
        self.zindexSort.setup();
        $("#ui-btn-games > ul").superfish();
        $("#ui-btn-games > ul > li > a:not(.sf-no-ul)").bind("click", function () {
            return false;
        });
        //  点击 触发当前页面的 选定框 开始
        var _overMenu = new pitayaMenu();
        _overMenu.init([$("#wager_groups > a"), $("#wager_groups > nav, #wager_groups > dl"), null]);
        self.ViewBox.install($("ul#ui-btn-features > li > a:not(.logout), #game_result"));
        if (document.getElementById("content") && document.getElementById("rde-contextmenu")) {
            var _opt = [];
            $("#rde-contextmenu > a").each(function (i) {
                var me = this;
                var _action = function () {
                    self.ViewBox.single(me)
                };
                var _icon = (this.getAttribute("data-icon")) ? this.getAttribute("data-icon") : "/assets/cc509719/img/pitaya/images/wi0009-16.gif";
                _opt.push({text: this.title, icon: _icon, alias: this.title, action: _action});
            });
            var _option = {width: 150, items: _opt};
            $("#content").contextmenu(_option);
        }
        //  点击 触发当前页面的 选定框 结束
        var _menu = $("#wager_groups a,.second-nav  a"), _inner = document.getElementById("content_inner"), _title = $("#c_rtype"), _ad = $("#AD"),
                _ball = $("#Ball"), _grp = $("#GrpBtn"), _rule = $("#ShowRule2");
        var _type = "text";
        var json = {
            hall: 0,
            menu: _menu,
            inner: _inner,
            title: _title,
            ad: _ad,
            ball: _ball,
            grp: _grp,
            rule: _rule,
            tips: document.getElementById("Tips").style,
            zodiac:<?= json_encode($zodiacArr)?>,
            _number: _type
        };

        var _lt = self.ShowTable.instance(json);
        _lt.init("<?php echo $rType ?>", "<?php echo $showTableN ?>");	//初始化设定 包括 设定请求ajax 地址	
        _lt.bindDisplay_closeTime(document.getElementById("FCDH"));//绑定显示关盘倒数字段
        _lt.setBetMode(1);//开启下注模式    1为可下注模式

        _lt.run();

        var _rightBar = $("#RightBar2"), _ruleText = $("#RuleText2");
        _rightBar.bind("click", function () {
            if (this.parentNode.x !== 1) {
                _ruleText.show();
                this.parentNode.style.width = "";
                this.parentNode.x = 1;
            } else {

                _ruleText.hide();
                this.parentNode.style.width = "30px";
                this.parentNode.x = 0;
            }
        });
    }
</script>