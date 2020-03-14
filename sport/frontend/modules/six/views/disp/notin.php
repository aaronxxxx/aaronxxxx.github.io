<?php
use app\modules\six\models\CommonFc\CommonFc;
?>
<script>
  <!--
window.onload = function(){
    //self.zindexSort.test();
    ccMarquee("marquee");
    self.zindexSort.setup();
   
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
      _lt.init("NI","0");
      _lt.bindDisplay_closeTime(document.getElementById("FCDH"));//綁定顯示關盤倒數欄位
            _lt.setBetMode(1);
            _lt.run();
            
            _lt.displayNI();
                  
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
      self.timeclock.install(document.getElementById("HKTime"), document.getElementById("iTime"));
//      $.ajax({
//          url : "/member/select_lt.php",
//          type : "GET",
//          dataType : "script"
//      });
  }
  //-->
  </script>
    <section class="back f15em"><a href="/?r=six/disp/index" class="go-back">&lt;</a> 六合彩
        <span style="float: right"><a href="/?r=mobile/lottery/lottery">下注状况</a>&nbsp;&nbsp;&nbsp;余额:<span id="user_money"><?=$userMoney;?></span></span>
    </section>
    <div class="pdcenter" id="left">


        <div id="clock" style="display: none">
			<b></b><span id="HKTime"></span>
		</div>
		 <section class="name">自选不中</section>
        <?php if($lastOne){?>
		<section class="g-info spg-info" id="game_info">
			<p>
				当前期数：第<span style="font-weight: bold;" id="gNumber"></span>期
			</p>
			<p>
                封盘时间：<span id="gametime">&nbsp;</span>
			</p>
			<p>
                剩余时间：
                <span id="ui-countdown" class="f00">
                    <span id="FCDH" style="font-weight: bold;"></span> 
                    <span id="close_msg" style="display: none;">&nbsp;</span></span>
                <p>
                    <span>開獎結果：</span>
                    <span id="sp_lottery_result"></span>
                </p>
			</p>

        </section>
        <script>
        $.get("/?r=six/index/ajax&rtype=home", function(data,hm){
            var result = data;
            var result2 = JSON.parse(result);
            var sp_result = result2.kjresult[0];
            var str =sp_result.ball_1 +',' +sp_result.ball_2 +','+sp_result.ball_3 +','+sp_result.ball_4 +','+sp_result.ball_5+', '+sp_result.ball_6 +','+sp_result.ball_7;
            $('#sp_lottery_result').append(str);              
        });
        </script>
		<div style="display: none;" id="user_info">
            <dl class="block">
              <dt><span class="icon"></span>会员资料</dt>
              <dd>帐号 <span id="login-username"></span></dd>
                            <dd>额度 <span id="bet-credit"></span></dd>
                <input type="hidden" id="gold_gmin" value="<?=$lowestMoney;?>" />
                <input type="hidden" id="gold_gmax" value="<?=$maxMoney;?>" />
                            <dd class="footer"></dd>
            </dl>
          </div>
		<div id="message_box" style="display:none">
            <div class="inner"></div>
            <div class="footer"></div>
          </div>
		
		 <input type="button" id="checkzh" value="查看组合" onClick="displayAD()" />
		<form name="lt_form" id="lt_form" method="post" action="/?r=six/ni/mobile-bet-view" onSubmit="return false;" class="Aside">
        <section class="pk-list">
            <div class="lianma" id="table1">
                <h1>请选择购买方式:</h1>
                <ul>
                    <li>
                        <label>
                            <input type="radio" value="NI5" name="rtype" num="5">五不中 <span>赔率:<em id="NI1"></em></span></label>
                    </li>
                    <li>
                        <label>
                            <input name="rtype" type="radio" value="NI6" num="6"/>六不中 <span>赔率:<em id="NI2"></em></span></label>
                    </li>
                    <li>
                        <label>
                            <input name="rtype" type="radio" value="NI7" num="7"/>七不中 <span>赔率:<em id="NI3"></em></span></label>
                    </li>
                    <li>

                        <label>
                            <input name="rtype" type="radio" value="NI8" num="8"/>八不中 <span>赔率:<em id="NI4"></em></span></label>
                    </li>
                    <li>
                        <label>
                            <input name="rtype" type="radio" value="NI9" num="9"/>九不中 <span>中特赔率:<em id="NI5"></em></span></label>
                    </li>
                    <li>
                        <label>
                            <input name="rtype" type="radio" value="NIA" num="10"/>十不中 <span>赔率:<em id="NI6"></em></span></label>
                    </li>
                     <li>
                        <label>
                            <input name="rtype" type="radio" value="NIB" num="11"/>十一不中 <span>赔率:<em id="NI7"></em></span></label>
                    </li>
                     <li>
                        <label>
                            <input name="rtype" type="radio" value="NIC" num="12"/>十二不中 <span>赔率:<em id="NI8"></em></span></label>
                    </li>
                </ul>
            </div>

            <div class="lianma-info">
                <div class="infos" id="table2">
                    <p class="tit"><span>号码</span><span>勾选</span><span>号码</span><span>勾选</span></p>
                    <!-- <p class="tit"><span style="width:25%;">号码</span><span style="width:25%;">勾选</span><span style="width:25%;">号码</span><span style="width:25%;">勾选</span></p> -->
                    <ul>
                        <?php for($i=1;$i<= 49;$i++){
                            if($i<10){
                                $i = '0'.$i;
                            }?>
                            <li>
                                <span style="background-color: #FFF;" class="<?php echo CommonFc::sebo($i)==1 ? 'bColorR':(CommonFc::sebo($i)==2? 'bColorB':'bColorG')?>"><?=$i;?></span>
                            <span>
                                <input type="checkbox"  name="num[]" value="<?=$i;?>" /></span>
                                <?php if($i<49){
                                    if($i+1<10){
                                        $j = '0'.($i+1);
                                    }else{$j = $i+1;}
                                    ?>
                                    <span style="background-color: #FFF;" class="<?php echo CommonFc::sebo($i+1)==1 ? 'bColorR':(CommonFc::sebo($i+1)==2? 'bColorB':'bColorG')?>"><?=$j;?></span>
                                    <span><input type="checkbox"  name="num[]" value="<?=$j;?>" /></span>
                                <?php }else{?>
                                    <span></span><span></span>
                                <?php }?>
                            </li>
                            <?php
                            $i = $i+1;
                        }?>
                    </ul>
                </div>
            </div>
            <p class="p-btn">
                <input class="yes" name="btnSubmit" type="button" value="确定"/>
                <input class="no" name="btnReset" type="button" value="取消" />
            </p>
        </section>
    	</form>
        <?php } else {?>
            <section class="g-info spg-info" id="game_info">
                <p>当前期数：期</p>
                <p>封盘时间：</p>
                <p>
                    剩余时间：<span id="ui-countdown" class="f00">
                        <span id="FCDH" style="font-weight: bold;"></span>
                        <span id="close_msg" style="display: none;">&nbsp;</span></span>
                </p>
                <div id="isCloseSpan" style="border: 2px red solid;padding: 5px;text-align: center;"> 六合彩目前休盘，请等待下一期开盘。</div>
            </section>
        <?php }?>
    </div>
    <div id="AD" style="display:none;" >
    <div id="ShowBall">
      <h2>組合窗口</h2>
      <div id="Ball">
        <p><span style="background-color:rgb(0,255,0);">&nbsp;&nbsp;&nbsp;</span></p>
      </div>
    </div>
    </div>
<script>
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

 <style>
   .p-info li span:nth-child(2){
   font-size: 12px;
   }
   .p-info li span:nth-child(3){
   border-right:0px;}
   .p-info li span:nth-child(3)  label {
   float: left;
   padding: 0 0 0 12px;
   }

   #AD {
   height: 317px;
   margin: 0;
   padding: 0;
   position: absolute;
   top: 44px;
   right: 15px;
   width: 171px;z-index: 2;
   }

   #ShowBall {
   background-color: #000;
   border: 3px solid #cccccc;
   border-radius: 8px;
   box-shadow: 0 0 5px 5px #333;
   height: 311px;
   overflow: auto;
   margin: 15px 0 0;
   width: 171px;
   color:#ffffff
   }

   .pcolor{
   color: white;
   }
   .message_box02 {
   background: rgba(0, 0, 0, 0) url("/Public/images/block_bg.jpg") repeat-y scroll left center;
   font-size: 12px;
   margin-bottom: 4px;
   margin-left: 3px;
   position: absolute;
   right: 195px;
   top: 62px;
   width: 215px;
   }
 </style>