<?php
use yii\helpers\Html;
use app\modules\spsix\models\CommonFc\CommonFc;
?>
<script>
    window.onload = function () {
        $(".GoldQQ").click(function () {
            $(this).val($("#chipVal").val());
        });
        ccMarquee("marquee");
        self.zindexSort.setup();
        $("#ui-btn-games > ul").superfish();
        $("#ui-btn-games > ul > li > a:not(.sf-no-ul)").bind("click", function () {
            return false;
        });
        //self.group_menu.install($("#wager_groups"));
        var _overMenu = new pitayaMenu();
        _overMenu.init([$("#wager_groups > a"), $("#wager_groups > nav, #wager_groups > dl"), null]);
        //ViewBox
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
        var nx_array = {};
        var ary = {};
        var _menu = $("#wager_groups a,.second-nav  a"), _inner = document.getElementById("content_inner"), _title = $("#c_rtype"),
                _ad = $("#AD"), _ball = $("#Ball"), _grp = $("#GrpBtn"), _rule = $("#ShowRule2");
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
            zodiac:<?=json_encode($zodiacArr)?>,
            _number: _type
        };
        var _lt = self.ShowTable.instance(json);
        _lt.init("CH", "0");
        _lt.bindDisplay_closeTime(document.getElementById("FCDH"));//綁定顯示關盤倒數欄位
        _lt.setBetMode(1);
        _lt.run();
        _lt.displayCH();
        var _rightBar = $("#RightBar2"), _ruleText = $("#RuleText2");
        _rightBar.bind("click", function () {
            if (this.parentNode.x != 1) {
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
<div id="box_body" class="bg2yellow">
    <div id="box_range">
        <div id="header">
            <div class="game-nav">
                <div id="ui-btn-games">
                    <ul class="layer1 sf-menu bg2yellow">
                        <li style="display: none;" class="layer1-li">
                            <a class="layer1-a sf-no-ul" href="/member/lt/">
                                <b></b>
                                极速六合彩
                            </a>
                        </li>
                    </ul>
                    <nav id="NORMAL">
                        <a data-gtype="LT_Content" href="/member/lt/">极速六合彩</a>
                    </nav>
                    <nav id="S5"></nav>
                </div>
                <div id="game_info">
                    <div class="logoImg"><img src="/public/aomenPC/img/spsix.png" alt=""></div>
                    <div style="padding: 50px 0 0 15px;width:300px">
                        <h3>极速六合彩</h3>
                        <br>
                        <p>第 <span id="gNumber" style="color:red;"><?=$qishu!=-1 ? $qishu:'';?></span>期</p>
                    </div>
                    <div class="time" id="gametime">
                        <span id="ui-countdown">
                            <span id="FCDH" style="font-weight:bold;"></span>
                            <span id="close_msg" style="display:none;">&nbsp;</span>
                        </span>
                    </div>
                    <div class="result">
                        <div class="text-center d-flex">
                            <div class="resultSound"></div>
                            <p>极速六合彩&nbsp;&nbsp; 第 <span id="openNumber" style="color:red;"><?=$qishu!=-1 ? $qishu:'';?></span>期</p>
                        </div>
                        <div  class="resultBox">
                            <ul class="d-flex">
                                <li id="open-ball-1" class="resultItem"></li>
                                <li id="open-ball-2" class="resultItem"></li>
                                <li id="open-ball-3" class="resultItem"></li>
                                <li id="open-ball-4" class="resultItem"></li>
                                <li id="open-ball-5" class="resultItem"></li>
                                <li id="open-ball-6" class="resultItem"></li>
                                <li id="open-ball-7" class="resultItem"></li>
                            </ul>
                            <ul class="d-flex justify-content-around">
                                <li><?= $Animal[0] ?></li>
                                <li><?= $Animal[1] ?></li>
                                <li><?= $Animal[2] ?></li>
                                <li><?= $Animal[3] ?></li>
                                <li><?= $Animal[4] ?></li>
                                <li><?= $Animal[5] ?></li>
                                <li style="color: #F00;"><?= $Animal[6] ?></li> 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <ul id="ui-btn-features">
                <li>功能:</li>
                <li>
                    <a style="padding-top: 4px;" data-callback="self.memberCenter.historyCount" title="帐户历史"
                       data-url="/?r=member/lottery/lottery">
                        <span style="color:black;">下注历史</span>
                    </a>
                </li>
                <li>
                    <a style="padding-top: 4px;" data-callback="self.memberCenter.rule" title="规则说明"
                       data-url="/?r=spsix/rule/rule&gtype=LT">
                        <span style="color:black;">规则</span>
                    </a>
                </li>
                <li>
                    <a style="padding-top: 4px;" data-callback="self.memberCenter.gameResult" title="开奖结果"
                       data-url="/?r=spsix/sixtop/kaijiang&gtype=LT">
                        <span style="color:black;">开奖</span>
                    </a>
                </li>
                <!-- <li>
                    <a style="padding-top: 4px;" title="系统公告" data-url="/?r=spsix/sixtop/news&gtype=LT">
                        <span style="color:black;">公告</span>
                    </a>
                </li>
                <li>
                    <a style="padding-top: 4px;" data-callback="self.memberCenter.quickGold" title="快选金额"
                       data-url="/?r=spsix/sixtop/quick&gtype=LT">
                        <span style="color:black;font-weight: normal;">快选金额</span>
                    </a>
                </li> -->
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
                        <li class="leftNavItem"> <a href="/?r=spsix/index/index&rtype=SPbside"><div class="leftNavText">特别号B面</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=spsix/index/index&rtype=OEOU"><div class="leftNavText">两面</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=spsix/index/index&rtype=NA"><div class="leftNavText">正码</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=spsix/index/index&rtype=NAS&amp;rtypeN=N1"><div class="leftNavText">正码特</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=spsix/index/index&rtype=NO"><div class="leftNavText">正码1-6</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=spsix/index/index&rtype=NAP"><div class="leftNavText">正码过关</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=spsix/index/index&rtype=CH"><div class="leftNavText leftNavItemActive">连码</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=spsix/index/index&rtype=LX"><div class="leftNavText">连肖／连尾</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=spsix/index/index&rtype=NI"><div class="leftNavText">自选不中</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=spsix/index/index&rtype=SPA&showTableN=1"><div class="leftNavText">特码生肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=spsix/index/index&rtype=C7&showTableN=1"><div class="leftNavText">正肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=spsix/index/index&rtype=SPB&showTableN=1"><div class="leftNavText">一肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=spsix/index/index&rtype=NX"><div class="leftNavText">合肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=spsix/index/index&rtype=SPB&showTableN=3"><div class="leftNavText">总肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=spsix/index/index&rtype=SPA&amp;showTableN=2"><div class="leftNavText">色波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=spsix/index/index&rtype=HB&showTableN=1"><div class="leftNavText">半波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=spsix/index/index&rtype=HB&showTableN=2"><div class="leftNavText">半半波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=spsix/index/index&rtype=C7&showTableN=2"><div class="leftNavText">七色波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=spsix/index/index&rtype=SPA&showTableN=3"><div class="leftNavText">头尾数</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=spsix/index/index&rtype=SPB&showTableN=2"><div class="leftNavText">平特尾数</div></a></li>
                    </ul>
                </div>
            </div>
            <div id="content_six">
                <!-- <div class="chip d-flex">
                    <div class="chipLeft d-flex">
                        <form action="">
                            <label>预设金额</label>
                            <input type="text" id="chipVal" onkeyup="value=value.replace(/[^\d]/g,'')">
                            <button disabled="disabled">确定</button>
                            <button  type="reset">重置</button>
                        </form>
                    </div>
                    <div class="chipRight d-flex">
                        <div id="chipChangeBtn">
                            <p>筹码设置</p>
                            <ul id="chipChangeBox" class="d-flex" style="display:none;">
                                <li>
                                    <select data-num="chip1" >
                                        <option value ="1">1</option>
                                        <option value ="2">2</option>
                                        <option value="5">5</option>
                                        <option value="8">8</option>
                                    </select>
                                </li>
                                <li>
                                    <select data-num="chip2" >
                                        <option value ="10">10</option>
                                        <option value ="20">20</option>
                                        <option value="50">50</option>
                                        <option value="80">80</option>
                                    </select>
                                </li>
                                <li>
                                    <select data-num="chip3">
                                        <option value ="100">1百</option>
                                        <option value ="200">2百</option>
                                        <option value="500">5百</option>
                                        <option value="800">8百</option>
                                    </select>
                                </li>
                                <li>
                                    <select data-num="chip4">
                                        <option value ="1000">1千</option>
                                        <option value ="2000">2千</option>
                                        <option value="5000">5千</option>
                                        <option value="8000">8千</option>
                                    </select>
                                </li>
                                <li>
                                    <select data-num="chip5">
                                        <option value ="10000">1万</option>
                                        <option value ="20000">2万</option>
                                        <option value="50000">5万</option>
                                        <option value="80000">8万</option>
                                    </select>
                                </li>
                            </ul>
                        </div>
                        <ul class="d-flex">
                            <li id="chip1" class="chipItem"> <input value="1"  readonly> <span>1</span></li>
                            <li id="chip2" class="chipItem"> <input value="10"  readonly> <span>10</span></li>
                            <li id="chip3" class="chipItem"> <input value="100"  readonly> <span>1百</span></li>
                            <li id="chip4" class="chipItem"> <input value="1000"  readonly> <span>1千</span></li>
                            <li id="chip5" class="chipItem"> <input value="10000"  readonly> <span>1万</span></li>
                        </ul>
                    </div>
                </div> -->
                <script src="/public/aomenPC/js/spsix.js"></script>
                <div id="content_inner">
                    <div style="display: none;" id="c_rtype"></div>
                </div>
                        <?php if(!empty($lastOne)){?>
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
                            <!-- 游戏区块 -->
                            <div id="Game">
                                <form name="lt_form" id="lt_form" method="post" action="/?r=spsix/ch/bet-view" onsubmit="return false;" class="Aside">
                                    <input type="hidden" id="gid" name="gid" value="372892" />
                                    <input type="hidden" name="period" id="period" value="<?=$qishu;?>"/>
                                    <input type="hidden" name="rs_r" value="" />
                                    <div id="showTable">
                                        <!--连码类别-->
                                        <div class="round-table">
                                            <table id="table1" style="bakcground-color:white; width: 100%" class="MobileTable">
                                                <tr class="title_tr">
                                                    <td>类别</td>
                                                    <td>
                                                        <label class="padding_label"><input name="rtype" type="radio" value="CH_4" />四全中</label>
                                                    </td>
                                                    <td>
                                                        <label class="padding_label"><input name="rtype" type="radio" value="CH_3" />三全中</label>
                                                    </td>
                                                    <td>
                                                        <label class="padding_label"><input name="rtype" type="radio" value="CH_32" />三中二</label>
                                                    </td>
                                                    <td>
                                                        <label class="padding_label"><input name="rtype" type="radio" value="CH_2" />二全中</label>
                                                    </td>
                                                    <td>
                                                        <label class="padding_label"><input name="rtype" type="radio" value="CH_2S" />二中特</label>
                                                    </td>
                                                    <td>
                                                        <label class="padding_label"><input name="rtype" type="radio" value="CH_2SP" />特串</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        赔率
                                                    </td>
                                                    <td>
                                                        四全中 <span style="color:red;font-weight:bold"><?= $odds_CH['h1'] ?></span>
                                                    </td>
                                                    <td>
                                                        三全中 <span style="color:red;font-weight:bold"><?= $odds_CH['h2'] ?></span>
                                                    </td>
                                                    <td>
                                                        中二 <span style="color:red;font-weight:bold"><?= $odds_CH['h3'] ?></span>
                                                        <br/>
                                                        中三 <span style="color:red;font-weight:bold"><?= $odds_CH['h4'] ?></span>
                                                    </td>
                                                    <td>
                                                        二全中 <span style="color:red;font-weight:bold"><?= $odds_CH['h5'] ?></span>
                                                    </td>
                                                    <td>
                                                        中特 <span style="color:red;font-weight:bold"><?= $odds_CH['h6'] ?></span>
                                                        <br/>
                                                        中二 <span style="color:red;font-weight:bold"><?= $odds_CH['h7'] ?></span>
                                                    </td>
                                                    <td>
                                                        特串 <span style="color:red;font-weight:bold"><?= $odds_CH['h8'] ?></span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div id="SPA_Box" class="round-table">
                                            <!--生肖对碰--><label><input name="OfTouch" disabled="disabled" id="OfTouch" type="checkbox" value="Y" />生肖对碰</label>
                                            <!--尾数对碰--><label><input name="OfTouch2" disabled="disabled" id="OfTouch2" type="checkbox" value="Y" />尾数对碰</label>
                                            <!--肖串尾数--><label><input name="OfTouch3" disabled="disabled" id="OfTouch3" type="checkbox" value="Y" />肖串尾数</label>
                                            <!--交差碰--><label style="display:none"><input name="OfTouch4" disabled="disabled" id="OfTouch4" type="checkbox" value="Y" />交叉碰</label>
                                            <!--胆拖--><label><input name="OfTouch5" disabled="disabled" id="OfTouch5" type="checkbox" value="Y" />胆拖</label>
                                            <!--胆拖色波--><label style="display:none"><input name="OfTouch6" disabled="disabled" id="OfTouch6" type="checkbox" value="Y" />胆拖色波</label>
                                            <!--胆拖生肖--><label style="display:none"><input name="OfTouch7" disabled="disabled" id="OfTouch7" type="checkbox" value="Y" />胆拖生肖</label>
                                        </div>
                                        <!--正/副号-->
                                        <div class="round-table">
                                            <table id="RSTable" style="display:none;background-color:white;width:100%;" class="MobileTable">
                                                <tr class="title_tr">
                                                    <td id="RS" colspan="2">
                                                        <input type="checkbox" name="RS" value="R" />正/副号
                                                    </td>
                                                    <td id="RNumT"> 正号 </td>
                                                    <td id="RNumB"> </td>
                                                    <td id="SNumT"> 副号 </td>
                                                    <td id="SNumB"> </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <!--连码table-->
                                        <div class="round-table">
                                            <table id="table2" style="text-align:center;" class="MobileTable">
                                                <tr class="title_tr">
                                                    <td width="48px"> 号码 </td>
                                                    <td> 勾选 </td>
                                                    <td width="48px"> 号码 </td>
                                                    <td> 勾选 </td>
                                                    <td width="48px"> 号码 </td>
                                                    <td> 勾选 </td>
                                                    <td width="48px"> 号码 </td>
                                                    <td> 勾选 </td>
                                                    <td width="48px"> 号码 </td>
                                                    <td style="width:10%"> 勾选 </td>
                                                </tr>
                                                <?php for($i=1;$i<=10;$i++){
                                                    echo "<tr>";
                                                    for($j=0;$j<5;$j++){
                                                        if($j==0){?>
                                                            <td class="<?php echo CommonFc::sebo($i)==1 ? 'bColorR':(CommonFc::sebo($i)==2? 'bColorB':'bColorG')?>"><span><?php echo $i<10 ?'0'.$i:$i;?></span></td>
                                                            <td><label class="padding_label"><input type="checkbox" name="num[]" value="<?php echo $i<10 ?'0'.$i:$i;?>" disabled="disabled" /></label></td>
                                                        <?php }else if($i+$j*10!=50){?>
                                                            <td class="<?php echo CommonFc::sebo($i+$j*10)==1 ? 'bColorR':(CommonFc::sebo($i+$j*10)==2? 'bColorB':'bColorG')?>"><span><?php echo $i+$j*10;?></span></td>
                                                            <td><label class="padding_label"><input type="checkbox" name="num[]" value="<?=$i+$j*10;?>" disabled="disabled" /></label></td>
                                                        <?php }else{?>

                                                            <td colspan="2" class="Send">

                                                                <input type="button" name="btnReset" value="取消" class="no_min" style="padding:0px;"/>
                                                                <input type="button" name="btnSubmit" value="确定" class="yes_min" style="padding:0px;" />
                                                            </td>
                                                        <?php   }
                                                    }
                                                    echo "</tr>";
                                                }?>
                                            </table>
                                        </div>
                                        <div class="round-table">
                                            <table id="table3" style="text-align:center;background-color:white;display:none;" class="MobileTable">
                                                <tr class="title_tr">
                                                    <td>&nbsp;</td><td>号码</td><td>勾选</td><td>&nbsp;</td><td>&nbsp;</td><td>号码</td><td>勾选</td><td>&nbsp;</td>
                                                </tr>
                                                <?php $z=array('鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗','猪');?>
                                                <?php
                                                $count = count($zodiacArr);
                                                for($i=0;$i<$count;$i++){?>
                                                    <tr style="text-align:center;">
                                                        <td class="title_td2"><?=$z[$i];?></td>
                                                        <td style="background-color:#e5eaee;text-align:left"><?= $zodiacArr[$i];?></td>
                                                        <td width="40px">
                                                            <label class="padding_label">
                                                                <input type="checkbox" name="spa[]" value="<?=$zodiacArr[$i];?>" />
                                                            </label>
                                                        </td>
                                                        <td style="color:#cc0000;font-weight:bold;font-size:12px;width:9%;" id="A<?=($i>8)?chr($i+56):$i+1;?>"></td>
                                                        <td class="title_td2"><?=$z[$i+1]?></td>
                                                        <td style="background-color:#e5eaee;text-align:left"><?= $zodiacArr[$i+1];?></td>
                                                        <td width="40px"><label class="padding_label"><input type="checkbox" name="spa[]" value="<?=$zodiacArr[$i+1];?>" /></label></td>
                                                        <td style="color:#cc0000;font-weight:bold;font-size:12px;width:9%;" id="A<?=($i>7)?chr($i+57):$i+2;?>"></td>
                                                    </tr>
                                                    <?php $i = $i+1;
                                                } ?>
                                                <tr>
                                                    <td colspan="6" class="Send">
                                                        <input class="no" type="button" name="btnSpaReset" value="取消" />
                                                        <input class="yes" type="button" name="btnSpaSend" value="送出" />
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="round-table">
                                            <table id="table4" style="border: 0pt none ; border-collapse: collapse; display:none;" class="MobileTable">
                                                <tr style="text-align: center;">
                                                    <td class="title_td2 BorderLine" width="30px">
                                                        0
                                                    </td>
                                                    <td class="BorderLine">
                                                        <label class="padding_label"><input type="checkbox" name="nf[]" value="10, 20, 30, 40"/></label>
                                                    </td>
                                                    <td class="title_td2 BorderLine" width="30px">
                                                        1
                                                    </td>
                                                    <td class="BorderLine">
                                                        <label class="padding_label"><input type="checkbox" name="nf[]" value="01, 11, 21, 31, 41"/></label>
                                                    </td>
                                                    <td class="title_td2 BorderLine" width="30px">
                                                        2
                                                    </td>
                                                    <td class="BorderLine">
                                                        <label class="padding_label"><input type="checkbox" name="nf[]" value="02, 12, 22, 32, 42"/></label>
                                                    </td>
                                                    <td class="title_td2 BorderLine" width="30px">
                                                        3
                                                    </td>
                                                    <td class="BorderLine">
                                                        <label class="padding_label"><input type="checkbox" name="nf[]" value="03, 13, 23, 33, 43"/></label>
                                                    </td>
                                                    <td class="title_td2 BorderLine" width="30px">
                                                        4
                                                    </td>
                                                    <td class="BorderLine">
                                                        <label class="padding_label"><input type="checkbox" name="nf[]" value="04, 14, 24, 34, 44"/></label>
                                                    </td>
                                                </tr>
                                                <tr style="text-align: center;">
                                                    <td class="title_td2 BorderLine" width="30px">
                                                        5
                                                    </td>
                                                    <td class="BorderLine">
                                                        <label class="padding_label"><input type="checkbox" name="nf[]" value="05, 15, 25, 35, 45"/></label>
                                                    </td>
                                                    <td class="title_td2 BorderLine" width="30px">
                                                        6
                                                    </td>
                                                    <td class="BorderLine">
                                                        <label class="padding_label"><input type="checkbox" name="nf[]" value="06, 16, 26, 36, 46"/></label>
                                                    </td>
                                                    <td class="title_td2 BorderLine" width="30px">
                                                        7
                                                    </td>
                                                    <td class="BorderLine">
                                                        <label class="padding_label"><input type="checkbox" name="nf[]" value="07, 17, 27, 37, 47"/></label>
                                                    </td>
                                                    <td class="title_td2 BorderLine" width="30px">
                                                        8
                                                    </td>
                                                    <td class="BorderLine">
                                                        <label class="padding_label"><input type="checkbox" name="nf[]" value="08, 18, 28, 38, 48"/></label>
                                                    </td>
                                                    <td class="title_td2 BorderLine" width="30px">
                                                        9
                                                    </td>
                                                    <td class="BorderLine">
                                                        <label class="padding_label"><input type="checkbox" name="nf[]" value="09, 19, 29, 39, 49"/></label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="10" class="BorderLine Send" >

                                                        <input class="no" type="button" name="btnFinReset" value="取消" />
                                                        <input class="yes" type="button" name="btnFinSend" value="送出" />
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div id="XF" style="clear:both;">
                                            <div>
                                                <table id="table5" style="display:none;margin-top: 12px;width:45%;float:left; " class="MobileTable">
                                                </table>
                                            </div>
                                            <div>
                                                <table id="table6" style="display:none;margin-top: 12px;margin-left: 24px;width:45%;float:left; " class="MobileTable">
                                                </table>
                                            </div>
                                            <div style="float:left;width:100%;text-align:center;clear:both;display:none;" id="XF_Send">

                                                <input type="button" class="no" name="btnXfReset" value="取消" /><input name="btnXfSend" class="yes" type="button" value="送出" />
                                            </div>
                                        </div>
                                        <div id="CrossOverHit" style="display: none;">
                                            <div id="HitZone">
                                                <div id="AddCross">
                                                    <input type="button" value="新增柱列" />
                                                </div>
                                            </div>
                                            <div id="CrossSend">

                                                <input type="button" class="no" name="OverCancel" value="取消"/><input class="yes" name="OverSend" type="button" value="送出" />
                                                <span id="Warn"></span>
                                            </div>
                                            <div id="NumBtn">

                                                <!--快选区块-->
                                                <div id="QuickCross">
                                                    <a style="color:red;">红波</a>&nbsp;<a style="color:blue;">蓝波</a>&nbsp;<a style="color:green;">绿波</a>&nbsp;
                                                    <br/>
                                                    <a>鼠</a>&nbsp;<a>牛</a>
                                                    <a>虎</a>&nbsp;<a>兔</a>
                                                    <a>龙</a>&nbsp;<a>蛇</a>
                                                    <br/>
                                                    <a>马</a>&nbsp;<a>羊</a>
                                                    <a>猴</a>&nbsp;<a>鸡</a>
                                                    <a>狗</a>&nbsp;<a>猪</a>
                                                    <br />
                                                    <a>尾0</a>&nbsp;<a>尾1</a>&nbsp;<a>尾2</a>&nbsp;<a>尾3</a>&nbsp;<a>尾4</a>&nbsp;
                                                    <br/>
                                                    <a>尾5</a>&nbsp;<a>尾6</a>&nbsp;<a>尾7</a>&nbsp;<a>尾8</a>&nbsp;<a>尾9</a>&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                        <div id="Dantuo">
                                            <div class="l">
                                                <h3>胆码</h3>

                                            </div>
                                            <div class="l">
                                                <h3>拖码</h3>

                                            </div>
                                            <div class="SubmitSend">

                                                <input name="DantuoCancel" class="no" type="button" value="取消" /><input name="DantuoSend" class="yes"  disabled="disabled" type="button" value="送出" />
                                                <span id="Warn1"></span>
                                            </div>
                                        </div>
                                        <div id="DantuoC">
                                            <div class="l">
                                                <h3>胆码</h3>

                                            </div>
                                            <div class="l c">
                                                <h3>色波</h3>

                                            </div>
                                            <div class="SubmitSend">

                                                <input name="DantuoCCancel" class="no" type="button" value="取消" /><input name="DantuoCSend" class="yes" disabled="disabled" type="button" value="送出" />
                                                <span id="Warn2"></span>
                                            </div>
                                        </div>
                                        <div id="DantuoSpa">
                                            <div class="l">
                                                <h3>胆码</h3>

                                            </div>
                                            <div class="l">
                                                <h3>生肖</h3>

                                            </div>
                                            <div class="SubmitSend">

                                                <input name="DantuoSpaCancel" class="no" type="button" value="取消" /><input name="DantuoSpaSend" class="yes" disabled="disabled" type="button" value="送出" />
                                                <span id="Warn3"></span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="AD" style="top:325px;" >
                                <div id="ShowBall">
                                    <h2>組合窗口</h2>
                                    <div id="Ball">
                                        <p><span style="background-color:rgb(0,255,0);">&nbsp;&nbsp;&nbsp;</span></p>
                                    </div>
                                </div>
                            </div>
                        <?php }else{?>
                            <div id="isCloseSpan" style="border: 2px red solid;padding: 5px;text-align: center;"> 极速六合彩目前休盘，请等待下一期开盘。</div>
                        <?php }?>
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
    <input type="hidden" name="period" id="period" value="<?=$qishu;?>"/>
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
