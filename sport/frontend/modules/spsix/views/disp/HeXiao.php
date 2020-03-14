<script>
 window.onload = function(){
    //self.zindexSort.test();
    // ccMarquee("marquee");
    self.zindexSort.setup();
    //self.group_menu.install($("#wager_groups"));
    var _overMenu = new pitayaMenu();
    _overMenu.init([$("#wager_groups > a"),$("#wager_groups > nav, #wager_groups > dl"),null]);
    //ViewBox
    // self.ViewBox.install($("ul#ui-btn-features > li > a:not(.logout), #game_result"));
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
    var nx_array = {"SELECT_1":"{$odds_NX['h1']}","SELECT_2":"{$odds_NX['h2']}","SELECT_3":"{$odds_NX['h3']}","SELECT_4":"{$odds_NX['h4']}","SELECT_5":"{$odds_NX['h5']}","SELECT_6":"{$odds_NX['h6']}","SELECT_7":"{$odds_NX['h7']}","SELECT_8":"{$odds_NX['h8']}","SELECT_9":"{$odds_NX['h9']}","SELECT_10":"{$odds_NX['h10']}","SELECT_11":"{$odds_NX['h11']}"};;
                  var ary = {};
            var _menu = $("#wager_groups a,.second-nav  a"), _inner = document.getElementById("content_inner"), _title = $("#c_rtype"), _ad = $("#AD"), _ball = $("#Ball"), _grp = $("#GrpBtn"), _rule = $("#ShowRule2");
      //var _menu = null, _inner = document.getElementById("content_inner"), _title = $("#c_rtype"), _ad = $("#AD"), _ball = $("#Ball"), _grp = $("#GrpBtn"), _rule = $("#ShowRule2");
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
          
          zodiac :<?=json_encode($zodiacArr)?>,
          _number : _type
      };
      var _lt = self.ShowTable.instance(json);
      _lt.init("NX");
      _lt.bindDisplay_closeTime(document.getElementById("FCDH"));//綁定顯示關盤倒數欄位
            _lt.setBetMode(1);
            _lt.run();
                              
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
    //   self.timeclock.install(document.getElementById("HKTime"), document.getElementById("iTime"));
//      $.ajax({
//          url : "/member/select_lt.php",
//          type : "GET",
//          dataType : "script"
//      });
  }
</script>
<script src="/public/aomen/js/LianMaVerify.js"></script>
<main class="sixMain">
    <input id="lotteryName" type="hidden" value="極速六合彩 合肖">
    <?php include 'header.php';?>
    <!-- <?php include 'fast_bet_lhai.php';?> -->
    <?php if($lastOne){?>
        <form name="lt_form" id="lt_form" method="post" action="/?r=spsix/nx/mobile-bet-view" onSubmit="return false;" class="Aside">
        <section class="pk-list">
            <div class="pr-4 pl-4 qiu_four2" id="table1">
                <ul class="tab d-flex justify-content-end mt-2">
                    <h3>请选择购买方式:</h3>
                    <li class="item mb-2 mr-2" style="height:50px; margin-left: auto;">
                        <a class="six_tab"><input id="NX_IN" type="radio" value="NX_IN" name="rtype">中</a>
                    </li>
                    <li class="item mb-2" style="height:50px;">
                        <a class="six_tab"><input id="NX_OUT" type="radio" value="NX_OUT" name="rtype">不中 </a>
                    </li>
                </ul>
            </div>
			    <div class="SPA pl-4 pr-4" id="NxGroup">
                    <nav class="d-flex justify-content-between">
                        <b>野兽</b>
                        <b>家禽</b>
                        <b>单</b>
                        <b>双</b>
                        <b>前肖</b>
                        <b>后肖</b>
                        <b>天肖</b>
                        <b>地肖</b>
                    </nav>
			    </div>
            <span class="pl-4">赔率:<em id="show_fix_ratio" style="color:red;"></em></span>
            <div class="lianma-info pb-4">
                <div class="p-info tabinner " style="display: block;">
                    <div class="infos" id="table2">
                        <p class="tit d-flex justify-content-between"><span class="sx-1">选项</span><span  class="sx-2">号码</span><span class="sx-3">勾选</span></p>
                        <ul class="sixTable">
                            <?php $z=array('鼠','牛','虎','兔','龙','蛇','马','羊','猴','鸡','狗','猪');?>
                            <?php foreach($z as $k=>$v){?>
                                <li class="d-flex">
                                    <span class="sx-1"><?=$z[$k];?></span>
                                    <span id="sxcode" class="sx-2"></span>
                                    <span class="sx-3">
                                        <label>
                                            <input type="checkbox" name="lt_nx[]" value="NX_A<?=($k>8)?chr($k+56):$k+1;?>"/>
                                        </label>
                                    </span>
                                </li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
            <p class="p-btn btns pt-5 pb-5">
            <input class="yes submit mr-2" name="xxxxbtnSubmit" type="button" value="确定" onclick="xiaZhu('NX','lt_form','form2')"/>
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
