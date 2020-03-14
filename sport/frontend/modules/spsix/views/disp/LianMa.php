<?php
use app\modules\spsix\models\CommonFc\CommonFc;
?>
<script>
window.onload = function(){
    //self.zindexSort.test();
     var nx_array = {};
                  var ary = {};
            var   _ad = $("#AD"),_ball = $("#Ball");
      //var _menu = null, _inner = document.getElementById("content_inner"), _title = $("#c_rtype"), _ad = $("#AD"), _ball = $("#Ball"), _grp = $("#GrpBtn"), _rule = $("#ShowRule2");
      var _type = "text";
      var json = {
          hall:0,
          ad:_ad,
          ball:_ball,
          zodiac :<?=json_encode($zodiacArr)?>,
          _number : _type
      };
      var _lt = self.ShowTable.instance(json);
     
      _lt.init("CH","0");//初始化绑定点选 
     
      _lt.bindDisplay_closeTime(document.getElementById("FCDH"));//綁定顯示關盤倒數欄位
            _lt.setBetMode(1);//设置为可下注状态 
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
  <main class="sixMain">
    <input id="lotteryName" type="hidden" value="極速六合彩 连码">
        <?php include 'header.php';?>
        <!-- <?php include 'fast_bet_lhai.php';?> -->
      <?php  if($lastOne){?>
        <input type="hidden" value="CH" name="gid">
        <input type="hidden" value="1" name="total_count">
        <input type="hidden" id="ch_name" value="三全中" name="ch_name">
        <input type="button" id="checkzh" class="checkzh ml-4" value="查看组合" onClick="displayAD()" />
        <div id="Game">
            <form name="lt_form" id="lt_form" method="post" action="/?r=spsix/ch/mobile-bet-view" onSubmit="return false;" class="Aside">
                <section class="pk-list ft13">
                    <div class="lianma" id="table1">
                        <h1 class="mb-1">请选择购买方式:</h1>
                        <ul>
                            <li class="item">
                                <label><input type="radio" value="CH_4" name="rtype" nums="4">&nbsp;<span>四全中 </span>&emsp;<span>赔率:&nbsp;<span class="colorRed" id="chodds_1"></span></span></label>
                            </li>
                            <li class="item">
                                <label><input type="radio" value="CH_3" name="rtype" nums="3">&nbsp;<span>三全中 </span>&emsp;<span>赔率:&nbsp;<span class="colorRed" id="chodds_2"></span></span></label>
                            </li>
                            <li class="item">
                                <label><input type="radio" value="CH_32" name="rtype" nums="3">&nbsp;<span>三中二 </span>&emsp;<span>中二赔率:&nbsp;<span class="colorRed" id="chodds_3"></span></span>&emsp;<span>中三赔率:&nbsp;<span class="colorRed" id="chodds_4"></span></span></label>
                            </li>
                            <li class="item">
                                <label><input type="radio" value="CH_2" name="rtype" nums="2">&nbsp;<span>二全中 </span>&emsp;<span>赔率:&nbsp;<span class="colorRed" id="chodds_5"></span></span></label>
                            </li>
                            <li class="item">
                                <label><input type="radio" value="CH_2S" name="rtype" nums="2">&nbsp;<span>二中特 </span>&emsp;<span>中特赔率:&nbsp;<span class="colorRed" id="chodds_6"></span></span>&emsp;<span>中二赔率:&nbsp;<span class="colorRed" id="chodds_7"></span></span></label>
                            </li>
                            <li class="item">
                                <label><input type="radio" value="CH_2SP" name="rtype" nums="2">&nbsp;<span>特串 </span>&emsp;<span>赔率:&nbsp;<span class="colorRed" id="chodds_8"></span></span></label>
                            </li>
                        </ul>
                    </div>
                    <div class="lianma-info" id="table2">
                        <div class="infos pl-4 pr-4 pt-4 pb-4">
                            <p class="tit d-flex justify-content-between"><span>号码</span><span>勾选</span><span>号码</span><span>勾选</span></p>
                            <ul>
                                    <?php for($i=1;$i<= 49;$i++){
                                        if($i<10){
                                            $i = '0'.$i;
                                        }?>
                                    <li class="item d-flex justify-content-between">
                                    <span class="<?php echo CommonFc::sebo($i)==1 ? 'bColorR':(CommonFc::sebo($i)==2? 'bColorB':'bColorG')?>"><?=$i;?></span>
                                    <span>
                                        <input type="checkbox"  name="num[]" value="<?=$i;?>" disabled="disabled"/></span>
                                    <?php if($i<49){
                                        if($i+1<10){
                                            $j = '0'.($i+1);
                                        }else{$j = $i+1;}?>
                                    <span class="<?php echo CommonFc::sebo($i+1)==1 ? 'bColorR':(CommonFc::sebo($i+1)==2? 'bColorB':'bColorG')?>"><?=$j;?></span>
                                    <span>
                                        <input type="checkbox"  name="num[]" value="<?=$j;?>" disabled="disabled"/></span>
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
                    <p class="p-btn btns pt-5 pb-5">
                        <input type="button" class="yes submit mr-2" name="xxxxbtnSubmit" value="确认" onclick="xiaZhu('CH','lt_form','form2')"/>
                        <input type="button" class="no cancel" name="btnReset" value="取消" />	               
                    </p>
                </section>
            </form>
        </div>
        <?php } else {?>
            <section class="g-info spg-info" id="game_info">
                <div id="isCloseSpan" style="border: 2px red solid;padding: 5px;text-align: center;"> 极速六合彩目前休盘，请等待下一期开盘。</div>
            </section>
        <?php }?>
        <div id="AD" style="display:none;" >
            <div id="ShowBall">
                <label></label>
                <div id="Ball">
                    <p><span style="background-color:rgb(0,255,0);">&nbsp;&nbsp;&nbsp;</span></p>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
<script src="/public/aomen/js/LianMaVerify.js"></script>
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
