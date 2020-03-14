<script>
      window.onload = function(){
        //self.zindexSort.test();
        // ccMarquee("marquee");
        self.zindexSort.setup();

        $("#ui-btn-games > ul > li > a:not(.sf-no-ul)").bind("click", function () {return false;});
        //self.group_menu.install($("#wager_groups"));
        var _overMenu = new pitayaMenu();
        _overMenu.init([$("#wager_groups > a"),$("#wager_groups > nav, #wager_groups > dl"),null]);
        //ViewBox
        self.ViewBox.install($("ul#ui-btn-features > li > a:not(.logout), #game_result"));
        if (document.getElementById("content") && document.getElementById("rde-contextmenu")) {
            var _opt = [];
            $("#rde-contextmenu > a").each(function (i) {
                var me = this;
                var _action = function () {self.ViewBox.single(me)};
                var _icon = (this.getAttribute("data-icon")) ? this.getAttribute("data-icon") : "/TPL/pitaya/images/wi0009-16.gif";
                _opt.push({text: this.title, icon : _icon, alias: this.title, action : _action });
            });
            var _option = { width : 150, items : _opt };
            $("#content").contextmenu(_option);
        }
        var nx_array = {};
        var ary = { "LX2_1":"{$odds_LX2['h1']}","LX2_2":"{$odds_LX2['h2']}","LX2_3":"{$odds_LX2['h3']}","LX2_4":"{$odds_LX2['h4']}","LX2_5":"{$odds_LX2['h5']}","LX2_6":"{$odds_LX2['h6']}","LX2_7":"{$odds_LX2['h7']}","LX2_8":"{$odds_LX2['h8']}","LX2_9":"{$odds_LX2['h9']}","LX2_A":"{$odds_LX2['h10']}","LX2_B":"{$odds_LX2['h11']}","LX2_C":"{$odds_LX2['h12']}",
            "LF20":"{$odds_LF2['h1']}","LF21":"{$odds_LF2['h2']}","LF22":"{$odds_LF2['h3']}","LF23":"{$odds_LF2['h4']}","LF24":"{$odds_LF2['h5']}","LF25":"{$odds_LF2['h6']}","LF26":"{$odds_LF2['h7']}","LF27":"{$odds_LF2['h8']}","LF28":"{$odds_LF2['h9']}","LF29":"{$odds_LF2['h10']}",
            "LX3_1":"{$odds_LX3['h1']}","LX3_2":"{$odds_LX3['h2']}","LX3_3":"{$odds_LX3['h3']}","LX3_4":"{$odds_LX3['h4']}","LX3_5":"{$odds_LX3['h5']}","LX3_6":"{$odds_LX3['h6']}","LX3_7":"{$odds_LX3['h7']}","LX3_8":"{$odds_LX3['h8']}","LX3_9":"{$odds_LX3['h9']}","LX3_A":"{$odds_LX3['h10']}","LX3_B":"{$odds_LX3['h11']}","LX3_C":"{$odds_LX3['h12']}",
            "LF30":"{$odds_LF3['h1']}","LF31":"{$odds_LF3['h2']}","LF32":"{$odds_LF3['h3']}","LF33":"{$odds_LF3['h4']}","LF34":"{$odds_LF3['h5']}","LF35":"{$odds_LF3['h6']}","LF36":"{$odds_LF3['h7']}","LF37":"{$odds_LF3['h8']}","LF38":"{$odds_LF3['h9']}","LF39":"{$odds_LF3['h10']}",
            "LX4_1":"{$odds_LX4['h1']}","LX4_2":"{$odds_LX4['h2']}","LX4_3":"{$odds_LX4['h3']}","LX4_4":"{$odds_LX4['h4']}","LX4_5":"{$odds_LX4['h5']}","LX4_6":"{$odds_LX4['h6']}","LX4_7":"{$odds_LX4['h7']}","LX4_8":"{$odds_LX4['h8']}","LX4_9":"{$odds_LX4['h9']}","LX4_A":"{$odds_LX4['h10']}","LX4_B":"{$odds_LX4['h11']}","LX4_C":"{$odds_LX4['h12']}",
            "LF40":"{$odds_LF4['h1']}","LF41":"{$odds_LF4['h2']}","LF42":"{$odds_LF4['h3']}","LF43":"{$odds_LF4['h4']}","LF44":"{$odds_LF4['h5']}","LF45":"{$odds_LF4['h6']}","LF46":"{$odds_LF4['h7']}","LF47":"{$odds_LF4['h8']}","LF48":"{$odds_LF4['h9']}","LF49":"{$odds_LF4['h10']}",
            "LX5_1":"{$odds_LX5['h1']}","LX5_2":"{$odds_LX5['h2']}","LX5_3":"{$odds_LX5['h3']}","LX5_4":"{$odds_LX5['h4']}","LX5_5":"{$odds_LX5['h5']}","LX5_6":"{$odds_LX5['h6']}","LX5_7":"{$odds_LX5['h7']}","LX5_8":"{$odds_LX5['h8']}","LX5_9":"{$odds_LX5['h9']}","LX5_A":"{$odds_LX5['h10']}","LX5_B":"{$odds_LX5['h11']}","LX5_C":"{$odds_LX5['h12']}",
            "LF50":"{$odds_LF5['h1']}","LF51":"{$odds_LF5['h2']}","LF52":"{$odds_LF5['h3']}","LF53":"{$odds_LF5['h4']}","LF54":"{$odds_LF5['h5']}","LF55":"{$odds_LF5['h6']}","LF56":"{$odds_LF5['h7']}","LF57":"{$odds_LF5['h8']}","LF58":"{$odds_LF5['h9']}","LF59":"{$odds_LF5['h10']}"};
        var _menu = null, _inner = document.getElementById("content_inner"), _title = $("#c_rtype"), _ad = $("#AD"), _ball = $("#Ball"), _grp = $("#GrpBtn"), _rule = $("#ShowRule2");
        var _type = "text";
        var json = {
            hall:0,
            menu:_menu,
            inner:_inner,
            title:_title,
            ad:_ad,
            ball:_ball,
            grp:_grp,
            rule:_rule ,
            //tips : document.getElementById("Tips").style,
            zodiac :<?=json_encode($zodiacArr)?>,
            _number : _type
        };
        var _lt = self.ShowTable.instance(json);
        _lt.init("LX","0");
        _lt.bindDisplay_closeTime(document.getElementById("FCDH"));//綁定顯示關盤倒數欄位
        _lt.setBetMode(1);
        _lt.run();

        // _lt.displayLFX(ary);

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
        //self.GoldUI.installDrag("betMove", self.betSpace.bet.onDragBet);
        // self.timeclock.install(document.getElementById("HKTime"), document.getElementById("iTime"));

    }
</script>
<main class="sixMain">
    <input id="lotteryName" type="hidden" value="極速六合彩 连尾">
    <?php include 'header.php';?>
    <!-- <?php include 'fast_bet_lhai.php';?> -->
    <?php if($lastOne){?>
    
    <form name="lt_form" id="lt_form" method="post" action="/?r=spsix/lx/mobile-bet-view" onSubmit="return false;" class="Aside">
        <section class="pk-list" id="content_inner">
            <div class="round-table" id="table1">
                <!-- <div class="qiu_four pb-2 mb-2">
                    <ul class="tab d-flex justify-content-between pl-4 pr-4">
                        <li class="item"><a class="six_tab"><input name="rtype" type="radio" value="LX2" />二肖连</a></li>
                        <li class="item"><a class="six_tab"><input name="rtype" type="radio" value="LX3" />三肖连</a></li>
                        <li class="item"><a class="six_tab"><input name="rtype" type="radio" value="LX4" />四肖连</a></li>
                        <li class="item"><a class="six_tab"><input name="rtype" type="radio" value="LX5" />五肖连</a></li>
                    </ul>
                </div> -->
               
                <div class="qiu_four pb-2 mb-2 pt-2">
                    <ul class="tab d-flex justify-content-between pl-4 pr-4">
                        <li class="item"><a class="six_tab"><input type="radio" value="LF2" name="rtype">二尾碰</a></li>
                        <li class="item"><a class="six_tab"><input type="radio" value="LF3" name="rtype">三尾碰</a></li>
                        <li class="item"><a class="six_tab"><input type="radio" value="LF4" name="rtype">四尾碰</a></li>
                        <li class="item"><a class="six_tab"><input type="radio" value="LF5" name="rtype">五尾碰</a></li>
                    </ul>
                </div>
                <input type="button" id="checkzh" class="checkzh ml-4" value="查看组合" onClick="displayAD()" />
            </div>
           
            <!-- <div class="qiu_one">
                <div class="lianma-info pb-2" id="table2">
                    <div class="p-info tabinner">
                        <p class="tit d-flex justify-content-between"><span class="sx-1">选项</span><span class="sx-2">号码</span><span class="sx-3">勾选</span></p>
                        <ul id="sx" class="sixTable">
                            <?php $z=array('鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗','猪');
                            foreach ($z as $key=>$val){?>
                                <li>
                                    <span class="sx-1"><?=$val;?></span>
                                    <span class="sx-2"></span>
                                    <span class="sx-3">
                                        <label><input type="checkbox" name="lx[]" value="A<?=($key>8)?chr($key+56):$key+1;?>"/></label>
                                        <label id="A<?=($key>8)?chr($key+56):$key+1;?>"></label>
                                    </span>
                                </li>
                            <?php    } ?>
                        </ul>
                    </div>
                </div>
            </div> -->
            <!--尾碰-->
            <div class="qiu_one">
                <div class="lianma-info pb-2" id="table3">
                    <div class="p-info tabinner">
                        <div class="infos">
                            <p class="tit d-flex justify-content-between"><span class="sx-1">尾数</span><span  class="sx-2">号码</span><span class="sx-3">勾选</span></p>
                            <ul class="sixTable">
                                <?php for($i=0;$i<10;$i++){?>
                                    <li class="d-flex">
                                        <span class="sx-1"><?= $i;?></span>
                                        <span class="sx-2"><?php $z='';for($j=0;$j<5;$j++){ if($j!=0 || $i!=0){$z .= ','.$j.$i;}} echo substr($z,1);?></span>
                                        <span class="sx-3">
                                            <label>
                                                <input type="checkbox" name="lf[]" value="<?=$i;?>"/></label><label id="Fn<?=$i;?>">
                                            </label>
                                        </span>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <p class="p-btn btns pt-5 pb-5">
                <input class="yes submit mr-2" name="btnSubmit" type="button" value="确定" onclick="xiaZhu('LX','lt_form','form2')"/>
                <input class="no cancel" name="btnReset" type="button" value="取消" />
            </p>
        </section>
    </form>
    <?php } else {?>
        <section class="g-info spg-info" id="game_info">
            <div id="isCloseSpan" style="border: 2px red solid;padding: 5px;text-align: center;"> 极速六合彩目前休盘，请等待下一期开盘。</div>
        </section>
    <?php }?>
</div>
<div id="AD" style="display:none;" >
    <div id="ShowBall">
        <label></label>
        <div id="Ball">
            <p><span style="background-color:rgb(0,255,0);">&nbsp;&nbsp;&nbsp;</span></p>
        </div>
    </div>
</div>
<script src="/public/aomen/js/LianMaVerify.js"></script>
<script>
    $(document).ready(function () {
        $('.six_tab input').click(function () {
            $(this).attr('checked',true);
            $(this).parents('.item').siblings().removeClass('act');
            $(this).parents('.item').addClass('act');
        });
    });
    var tag1="";
    function displayAD(){
        if(tag1==""){
            var ad=document.getElementById('AD');
            ad.style.display="block";
            tag1="block";
            document.getElementById("checkzh").value="隐藏组合";
            return;

        }
        if(tag1=="block"){
            var ad=document.getElementById('AD');
            ad.style.display="none";
            tag1="";
            document.getElementById("checkzh").value="查看组合";
            return;
        }
        //$('#AD').;

    }
</script>
