<?php
use yii\helpers\Html;
?>
<script>
    window.onload = function () {
        //self.zindexSort.test();
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
        var ary = {"LX2_1": "<?= $odds_LX2['h1']?>", "LX2_2": "<?= $odds_LX2['h2']?>", "LX2_3": "<?= $odds_LX2['h3']?>", "LX2_4": "<?= $odds_LX2['h4']?>", "LX2_5": "<?= $odds_LX2['h5']?>",
            "LX2_6": "<?= $odds_LX2['h6']?>","LX2_7": "<?= $odds_LX2['h7']?>", "LX2_8": "<?= $odds_LX2['h8']?>", "LX2_9": "<?= $odds_LX2['h9']?>", "LX2_A": "<?= $odds_LX2['h10']?>",
            "LX2_B": "<?= $odds_LX2['h11']?>", "LX2_C": "<?= $odds_LX2['h12']?>",
            "LF20": "<?= $odds_LF2['h1']?>", "LF21": "<?= $odds_LF2['h2']?>", "LF22": "<?= $odds_LF2['h3']?>", "LF23": "<?= $odds_LF2['h4']?>", "LF24": "<?= $odds_LF2['h5']?>",
            "LF25": "<?= $odds_LF2['h6']?>", "LF26": "<?= $odds_LF2['h7']?>", "LF27": "<?= $odds_LF2['h8']?>", "LF28": "<?= $odds_LF2['h9']?>", "LF29": "<?= $odds_LF2['h10']?>",
            "LX3_1": "<?= $odds_LX3['h1']?>", "LX3_2": "<?= $odds_LX3['h2']?>", "LX3_3": "<?= $odds_LX3['h3']?>", "LX3_4": "<?= $odds_LX3['h4']?>", "LX3_5": "<?= $odds_LX3['h5']?>",
            "LX3_6": "<?= $odds_LX3['h6']?>", "LX3_7": "<?= $odds_LX3['h7']?>", "LX3_8": "<?= $odds_LX3['h8']?>", "LX3_9": "<?= $odds_LX3['h9']?>", "LX3_A": "<?= $odds_LX3['h10']?>",
            "LX3_B": "<?= $odds_LX3['h11']?>", "LX3_C": "<?= $odds_LX3['h12']?>",
            "LF30": "<?= $odds_LF3['h1']?>", "LF31": "<?= $odds_LF3['h2']?>", "LF32": "<?= $odds_LF3['h3']?>", "LF33": "<?= $odds_LF3['h4']?>", "LF34": "<?= $odds_LF3['h5']?>",
            "LF35": "<?= $odds_LF3['h6']?>", "LF36": "<?= $odds_LF3['h7']?>", "LF37": "<?= $odds_LF3['h8']?>", "LF38": "<?= $odds_LF3['h9']?>", "LF39": "<?= $odds_LF3['h10']?>",
            "LX4_1": "<?= $odds_LX4['h1']?>", "LX4_2": "<?= $odds_LX4['h2']?>", "LX4_3": "<?= $odds_LX4['h3']?>", "LX4_4": "<?= $odds_LX4['h4']?>", "LX4_5": "<?= $odds_LX4['h5']?>",
            "LX4_6": "<?= $odds_LX4['h6']?>",  "LX4_7": "<?= $odds_LX4['h7']?>", "LX4_8": "<?= $odds_LX4['h8']?>", "LX4_9": "<?= $odds_LX4['h9']?>", "LX4_A": "<?= $odds_LX4['h10']?>",
            "LX4_B": "<?= $odds_LX4['h11']?>", "LX4_C": "<?= $odds_LX4['h12']?>",
            "LF40": "<?= $odds_LF4['h1']?>", "LF41": "<?= $odds_LF4['h2']?>", "LF42": "<?= $odds_LF4['h3']?>", "LF43": "<?= $odds_LF4['h4']?>", "LF44": "<?= $odds_LF4['h5']?>",
            "LF45": "<?= $odds_LF4['h6']?>", "LF46": "<?= $odds_LF4['h7']?>", "LF47": "<?= $odds_LF4['h8']?>", "LF48": "<?= $odds_LF4['h9']?>", "LF49": "<?= $odds_LF4['h10']?>",
            "LX5_1": "<?= $odds_LX5['h1']?>", "LX5_2": "<?= $odds_LX5['h2']?>", "LX5_3": "<?= $odds_LX5['h3']?>", "LX5_4": "<?= $odds_LX5['h4']?>", "LX5_5": "<?= $odds_LX5['h5']?>",
            "LX5_6": "<?= $odds_LX5['h6']?>",  "LX5_7": "<?= $odds_LX5['h7']?>", "LX5_8": "<?= $odds_LX5['h8']?>", "LX5_9": "<?= $odds_LX5['h9']?>", "LX5_A": "<?= $odds_LX5['h10']?>",
            "LX5_B": "<?= $odds_LX5['h11']?>", "LX5_C": "<?= $odds_LX5['h12']?>",
            "LF50": "<?= $odds_LF5['h1']?>", "LF51": "<?= $odds_LF5['h2']?>", "LF52": "<?= $odds_LF5['h3']?>", "LF53": "<?= $odds_LF5['h4']?>", "LF54": "<?= $odds_LF5['h5']?>",
            "LF55": "<?= $odds_LF5['h6']?>","LF56": "<?= $odds_LF5['h7']?>", "LF57": "<?= $odds_LF5['h8']?>", "LF58": "<?= $odds_LF5['h9']?>", "LF59": "<?= $odds_LF5['h10']?>"}
        var _menu = $("#wager_groups a,.second-nav  a"), _inner = document.getElementById("content_inner"), _title = $("#c_rtype"), _ad = $("#AD"), _ball = $("#Ball"), _grp = $("#GrpBtn"), _rule = $("#ShowRule2");
        //var _menu = null, _inner = document.getElementById("content_inner"), _title = $("#c_rtype"), _ad = $("#AD"), _ball = $("#Ball"), _grp = $("#GrpBtn"), _rule = $("#ShowRule2");
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
        _lt.init("LX", "0");
        _lt.bindDisplay_closeTime(document.getElementById("FCDH"));//綁定顯示關盤倒數欄位
        _lt.setBetMode(1);
        _lt.run();
        _lt.displayLFX(ary);
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
                        <li class="leftNavItem"> <a href="/?r=spsix/index/index&rtype=CH"><div class="leftNavText">连码</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=spsix/index/index&rtype=LX"><div class="leftNavText leftNavItemActive">连肖／连尾</div></a></li>
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
                <div class="chip d-flex">
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
                </div>
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
                                </table>              </div>
                            <div id="GrpBtn" style="display:none">
                                <input type="hidden" name="NowBet" id="NowBet" value="LX" />
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
                            </div>
                            <!-- 游戏区块 -->
                            <div id="Game">
                                <form name="lt_form" id="lt_form" method="post" action="/?r=spsix/lx/bet-view"  class="Aside">
                                    <input type="hidden" name="period" id="period" value="<?=$qishu;?>"/>
                                    <input type="hidden" name="gid" id="gid" value="372892" />
                                    <div id="showTable">
                                        <!--連肖类别-->
                                        <div class="round-table">
                                            <table id="table1" style="background-color:white" class="MobileTable">
                                                <tr class="title_tr">
                                                    <td><label class="padding_label"><input name="rtype" type="radio" value="LX2" />二肖连</label></td>
                                                    <td><label class="padding_label"><input name="rtype" type="radio" value="LX3" />三肖连</label></td>
                                                    <td><label class="padding_label"><input name="rtype" type="radio" value="LX4" />四肖连</label></td>
                                                    <td><label class="padding_label"><input name="rtype" type="radio" value="LX5" />五肖连</label></td>
                                                </tr>
                                                <tr class="title_tr">
                                                    <td><label class="padding_label"><input name="rtype" type="radio" value="LF2" />二尾碰</label></td>
                                                    <td><label class="padding_label"><input name="rtype" type="radio" value="LF3" />三尾碰</label></td>
                                                    <td><label class="padding_label"><input name="rtype" type="radio" value="LF4" />四尾碰</label></td>
                                                    <td><label class="padding_label"><input name="rtype" type="radio" value="LF5" />五尾碰</label></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <!--連肖table-->
                                        <div class="round-table">
                                            <table id="table2" style="text-align:center;background-color:white;">
                                                <tr class="title_tr">
                                                    <td style="width:10%;">连肖</td>
                                                    <td style="width:22%;">号码</td>
                                                    <td colspan="2" style="width:18%;">勾选</td>
                                                    <td style="width:10%;">连肖</td>
                                                    <td style="width:22%;">号码</td>
                                                    <td colspan="2" style="width:18%;">勾选</td>
                                                </tr>
                                                <?php $z=array('鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗','猪');?>
                                                <?php
                                                $count = count($zodiacArr);
                                                for($i=0;$i<$count-1;$i++){?>
                                                    <tr style="text-align:center;">
                                                        <td class="title_td2"><?=$z[$i];?></td>
                                                        <td style="background-color:#e5eaee;text-align:left"><?= $zodiacArr[$i];?></td>
                                                        <td width="40px"><label class="padding_label"><input type="checkbox" name="lx[]" value="A<?=($i>8)?chr($i+56):$i+1;?>" /></label></td>
                                                        <td style="color:#cc0000;font-weight:bold;font-size:12px;width:9%;" id="A<?=($i>8)?chr($i+56):$i+1;?>"></td>
                                                        <td class="title_td2"><?=$z[$i+1]?></td>
                                                        <td style="background-color:#e5eaee;text-align:left"><?= $zodiacArr[$i+1];?></td>
                                                        <td width="40px"><label class="padding_label"><input type="checkbox" name="lx[]" value="A<?=($i>7)?chr($i+57):$i+2;?>" /></label></td>
                                                        <td style="color:#cc0000;font-weight:bold;font-size:12px;width:9%;" id="A<?=($i>7)?chr($i+57):$i+2;?>"></td>
                                                    </tr>
                                                    <?php
                                                    $i = $i+1;
                                                }?>
                                            </table>
                                        </div>
                                        <div class="round-table">
                                            <table id="table3" style="text-align:center;background-color:white;">
                                                <tr class="title_tr">
                                                    <td style="width:10%;">尾数</td>
                                                    <td style="width:22%;">号码</td>
                                                    <td nowrap="nowrap" colspan="2" style="width:18%;">勾选</td>
                                                    <td style="width:10%;">尾数</td>
                                                    <td style="width:22%;">号码</td>
                                                    <td nowrap="nowrap" colspan="2" style="width:18%;">勾选</td>
                                                </tr>
                                                <?php
                                                for($i=0;$i<10;$i++){?>
                                                    <tr style="text-align:center;">
                                                        <td class="title_td2"><?= $i;?></td>
                                                        <td style="background-color:#e5eaee;text-align:left"><?php $z='';for($j=0;$j<5;$j++){ if($j!=0 || $i!=0){$z .= ','.$j.$i;}} echo substr($z,1);?></td>
                                                        <td><label class="padding_label">&nbsp;<input type="checkbox" name="lf[]" value="<?= $i;?>" />&nbsp;</label></td>
                                                        <td style="color:#cc0000;font-weight:bold;font-size:12px;width:9%;" id="Fn<?= $i;?>"></td>
                                                        <td class="title_td2"><?= $i+1;?></td>
                                                        <td style="background-color:#e5eaee;text-align:left"><?php $z=''; for($j=0;$j<5;$j++){ $z .= ','.$j.($i+1);} echo substr($z,1);?></td>
                                                        <td><label class="padding_label">&nbsp;<input type="checkbox" name="lf[]" value="<?= $i+1;?>" />&nbsp;</label></td>
                                                        <td style="color:#cc0000;font-weight:bold;font-size:12px;width:9%;" id="Fn<?= $i+1;?>"></td>
                                                    </tr>
                                                    <?php $i +=1;
                                                }?>
                                            </table>
                                        </div>
                                        <div class="round-table">
                                            <table id="table4" style="text-align:center;">
                                                <tr>
                                                    <td class="Send">
                                                        <input class="no" name="btnReset" type="button" value="取消" />
                                                        <input class="yes" name="btnSubmit" type="button" value="送出" />
                                                    </td>
                                                </tr>
                                            </table>
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
<input type="hidden" name="is_login" value="<?=$is_login;?>">
<div id="AD" style="display:none" >
    <div id="ShowBall">
        <h2>組合窗口</h2>
        <div id="Ball">
            <p><span style="background-color:rgb(0,255,0);">&nbsp;&nbsp;&nbsp;</span></p>
        </div>
    </div>
</div>