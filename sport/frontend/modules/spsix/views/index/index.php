<?php
use yii\helpers\Html;
?>
<?php include_once 'left.php' ?>
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
    <form name="newForm" id="newForm" action="/?r=spsix/index/six-order" method="post">
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
<div id="ding"></div>
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
        $(".GoldQQ").click(function () {
            $(this).val($("#chipVal").val());
        });
        ccMarquee("marquee");
        // self.zindexSort.setup();
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