<script>
    window.onload = function () {
        var nx_array = {};
        var ary = {};
        // var _menu = $("#wager_groups a,.second-nav  a"), _inner = document.getElementById("content_inner"), _title = $("#c_rtype"), _ad = $("#AD"), _ball = $("#Ball"), _grp = $("#GrpBtn"), _rule = $("#ShowRule2");
        //var _menu = null, _inner = document.getElementById("content_inner"), _title = $("#c_rtype"), _ad = $("#AD"), _ball = $("#Ball"), _grp = $("#GrpBtn"), _rule = $("#ShowRule2");
        var _type = "text";
        var json = {
            hall: 0,
            menu: '',
            inner: '',
            title: '',
            ad: '',
            ball: '',
            grp: '',
            rule: '',
            tips: '',
            zodiac:<?=json_encode($zodiacArr)?>,
            _number: _type
        };
        var _lt = self.ShowTable.instance(json);
        //  _lt.init({$rType},{$showTableN});//初始化设定 包括 设定请求ajax 地址 
        _lt.init("NAP", "0"); //初始化设定 包括 设定请求ajax 地址
        _lt.bindDisplay_closeTime(document.getElementById("FCDH"));//绑定显示关盘倒数字段
        _lt.setBetMode(1);//开启下注模式    1为可下注模式
        _lt.run();
        _lt.displayNAP();
    }
</script>
<section class="back f15em"><a href="/?r=spsix/disp/index" class="go-back">&lt;</a> 极速六合彩
    <span style="float: right"><a href="/?r=mobile/lottery/lottery">下注状况</a>&nbsp;&nbsp;&nbsp;余额:<span id="user_money"><?=$userMoney;?></span></span>
</section>
<div class="pdcenter" id="left">
    <div id="clock" style="display: none">
        <b></b><span id="HKTime"></span>
    </div>
    <section class="name">正码过关</section>
    <?php if($lastOne){?>
    <section class="g-info spg-info" id="game_info">
        <p>
            当前期数：第<span style="font-weight: bold;" id="gNumber"></span>期
        </p>
        <p>
            封盘时间：<span id="gametime">&nbsp;</span>
        </p>
        <p>
            剩余时间：<span id="ui-countdown" class="f00">
                <span id="FCDH" style="font-weight: bold;"></span>
                <span id="close_msg" style="display: none;">&nbsp;</span></span>
                <p>
                    <span>開獎結果：</span>
                    <span id="sp_lottery_result"></span>
                </p>
        </p>
    </section>
    <script>
    
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
    <div id="Game">
        <div id="table1">
            <form name="lt_form" id="lt_form" action="/?r=spsix/nap/mobile-bet-view" method="post">
                <section class="pk-list">
                    <div class="qiu_one">
                        <div class="qiu qiu_six">
                            <ul>
                                <li class="act">正码一</li>
                                <li>正码二</li>
                                <li>正码三</li>
                                <li>正码四</li>
                                <li>正码五</li>
                                <li>正码六</li>
                            </ul>
                        </div>
                        <div class="zmgg" style="display: block;">
                            <p class="tit">赔率</p>
                            <ul>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP1_ODD" name="game1" />
                                            <em>单</em>  <em class="red" id="NAP1_1"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP1_EVEN" name="game1" />
                                            <em>双</em> <em class="red" id="NAP1_2"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP1_OVER" name="game1" />
                                            <em>大 </em><em class="red" id="NAP1_3"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP1_UNDER" name="game1"/>
                                            <em>小</em> <em class="red" id="NAP1_4"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP1_SODD" name="game1"/>
                                            <em>和单</em>  <em class="red" id="NAP1_5"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP1_SEVEN" name="game1"/>
                                            <em>和双</em> <em class="red" id="NAP1_6"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP1_SOVER" name="game1"/>
                                            <em>和大</em>  <em class="red" id="NAP1_7"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP1_SUNDER" name="game1"/>
                                            <em>和小</em> <em class="red" id="NAP1_8"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP1_FOVER" name="game1"/>
                                            <em>尾大</em>  <em class="red" id="NAP1_9"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP1_FUNDER" name="game1"/>
                                            <em>尾小</em> <em class="red" id="NAP1_10"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP1_R" name="game1"/>
                                            <em>红</em>  <em class="red" id="NAP1_11"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP1_G" name="game1"/>
                                            <em>绿</em> <em class="red" id="NAP1_12"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP1_B" name="game1"/>
                                            <em>蓝</em> <em class="red" id="NAP1_13"></em></label>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="zmgg">
                            <p class="tit">赔率</p>
                            <ul>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP2_ODD" name="game2" />
                                            <em>单</em>  <em class="red" id="NAP2_1"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP2_EVEN" name="game2" />
                                            <em>双</em> <em class="red" id="NAP2_2"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP2_OVER" name="game2" />
                                            <em>大 </em><em class="red" id="NAP2_3"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP2_UNDER" name="game2"/>
                                            <em>小</em> <em class="red" id="NAP2_4"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP2_SODD" name="game2"/>
                                            <em>和单</em>  <em class="red" id="NAP2_5"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP2_SEVEN" name="game2"/>
                                            <em>和双</em> <em class="red" id="NAP2_6"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP2_SOVER" name="game2"/>
                                            <em>和大</em>  <em class="red" id="NAP2_7"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP2_SUNDER" name="game2"/>
                                            <em>和小</em> <em class="red" id="NAP2_8"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP2_FOVER" name="game2"/>
                                            <em>尾大</em>  <em class="red" id="NAP2_9"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP2_FUNDER" name="game2"/>
                                            <em>尾小</em> <em class="red" id="NAP2_10"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP2_R" name="game2"/>
                                            <em>红</em>  <em class="red" id="NAP2_11"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP2_G" name="game2"/>
                                            <em>绿</em> <em class="red" id="NAP2_12"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP2_B" name="game2"/>
                                            <em>蓝</em> <em class="red" id="NAP2_13"></em></label>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="zmgg">
                            <p class="tit">赔率</p>
                            <ul>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP3_ODD" name="game3" />
                                            <em>单</em>  <em class="red" id="NAP3_1">(11.93)</em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP3_EVEN" name="game3" />
                                            <em>双</em> <em class="red" id="NAP3_2"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP3_OVER" name="game3" />
                                            <em>大 </em><em class="red" id="NAP3_3"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP3_UNDER" name="game3"/>
                                            <em>小</em> <em class="red" id="NAP3_4"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP3_SODD" name="game3"/>
                                            <em>和单</em>  <em class="red" id="NAP3_5"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP3_SEVEN" name="game3"/>
                                            <em>和双</em> <em class="red" id="NAP3_6"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP3_SOVER" name="game3"/>
                                            <em>和大</em>  <em class="red" id="NAP3_7"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP3_SUNDER" name="game3"/>
                                            <em>和小</em> <em class="red" id="NAP3_8"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP3_FOVER" name="game3"/>
                                            <em>尾大</em>  <em class="red" id="NAP3_9"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP3_FUNDER" name="game3"/>
                                            <em>尾小</em> <em class="red" id="NAP3_10"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP3_R" name="game3"/>
                                            <em>红</em>  <em class="red" id="NAP3_11"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP3_G" name="game3"/>
                                            <em>绿</em> <em class="red" id="NAP3_12"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP3_B" name="game3"/>
                                            <em>蓝</em> <em class="red" id="NAP3_13"></em></label>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="zmgg">
                            <p class="tit">赔率</p>
                            <ul>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP4_ODD" name="game4" />
                                            <em>单</em>  <em class="red" id="NAP4_1">(11.93)</em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP4_EVEN" name="game4" />
                                            <em>双</em> <em class="red" id="NAP4_2"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP4_OVER" name="game4" />
                                            <em>大 </em><em class="red" id="NAP4_3"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP4_UNDER" name="game4"/>
                                            <em>小</em> <em class="red" id="NAP4_4"></em></label></span>
                                    <span></span>

                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP4_SODD" name="game4"/>
                                            <em>和单</em>  <em class="red" id="NAP4_5"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP4_SEVEN" name="game4"/>
                                            <em>和双</em> <em class="red" id="NAP4_6"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP4_SOVER" name="game4"/>
                                            <em>和大</em>  <em class="red" id="NAP4_7"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP4_SUNDER" name="game4"/>
                                            <em>和小</em> <em class="red" id="NAP4_8"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP4_FOVER" name="game4"/>
                                            <em>尾大</em>  <em class="red" id="NAP4_9"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP4_FUNDER" name="game4"/>
                                            <em>尾小</em> <em class="red" id="NAP4_10"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP4_R" name="game4"/>
                                            <em>红</em>  <em class="red" id="NAP4_11"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP4_G" name="game4"/>
                                            <em>绿</em> <em class="red" id="NAP4_12"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP4_B" name="game4"/>
                                            <em>蓝</em> <em class="red" id="NAP4_13"></em></label>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="zmgg">
                            <p class="tit">赔率</p>
                            <ul>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP5_ODD" name="game5" />
                                            <em>单</em>  <em class="red" id="NAP5_1">(11.93)</em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP5_EVEN" name="game5" />
                                            <em>双</em> <em class="red" id="NAP5_2"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP5_OVER" name="game5" />
                                            <em>大 </em><em class="red" id="NAP5_3"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP5_UNDER" name="game5"/>
                                            <em>小</em> <em class="red" id="NAP5_4"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP5_SODD" name="game5"/>
                                            <em>和单</em>  <em class="red" id="NAP5_5"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP5_SEVEN" name="game5"/>
                                            <em>和双</em> <em class="red" id="NAP5_6"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP5_SOVER" name="game5"/>
                                            <em>和大</em>  <em class="red" id="NAP5_7"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP5_SUNDER" name="game5"/>
                                            <em>和小</em> <em class="red" id="NAP5_8"></em></label></span>
                                    <span></span>

                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP5_FOVER" name="game5"/>
                                            <em>尾大</em>  <em class="red" id="NAP5_9"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP5_FUNDER" name="game5"/>
                                            <em>尾小</em> <em class="red" id="NAP5_10"></em></label></span>
                                    <span></span>
                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP5_R" name="game5"/>
                                            <em>红</em>  <em class="red" id="NAP5_11"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP5_G" name="game5"/>
                                            <em>绿</em> <em class="red" id="NAP5_12"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP5_B" name="game5"/>
                                            <em>蓝</em> <em class="red" id="NAP5_13"></em></label>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="zmgg">
                            <p class="tit">赔率</p>
                            <ul>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP6_ODD" name="game6" />
                                            <em>单</em>  <em class="red" id="NAP6_1">(11.93)</em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP6_EVEN" name="game6" />
                                            <em>双</em> <em class="red" id="NAP6_2"></em></label></span>
                                    <span></span>

                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP6_OVER" name="game6" />
                                            <em>大 </em><em class="red" id="NAP6_3"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP6_UNDER" name="game6"/>
                                            <em>小</em> <em class="red" id="NAP6_4"></em></label></span>
                                    <span></span>

                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP6_SODD" name="game6"/>
                                            <em>和单</em>  <em class="red" id="NAP6_5"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP6_SEVEN" name="game6"/>
                                            <em>和双</em> <em class="red" id="NAP6_6"></em></label></span>
                                    <span></span>

                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP6_SOVER" name="game6"/>
                                            <em>和大</em>  <em class="red" id="NAP6_7"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP6_SUNDER" name="game6"/>
                                            <em>和小</em> <em class="red" id="NAP6_8"></em></label></span>
                                    <span></span>

                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP6_FOVER" name="game6"/>
                                            <em>尾大</em>  <em class="red" id="NAP6_9"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP6_FUNDER" name="game6"/>
                                            <em>尾小</em> <em class="red" id="NAP6_10"></em></label></span>
                                    <span></span>

                                </li>
                                <li>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP6_R" name="game6"/>
                                            <em>红</em>  <em class="red" id="NAP6_11"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP6_G" name="game6"/>
                                            <em>绿</em> <em class="red" id="NAP6_12"></em></label></span>
                                    <span>
                                        <label>
                                            <input type="radio" value="NAP6_B" name="game6"/>
                                            <em>蓝</em> <em class="red" id="NAP6_13"></em></label>
                                    </span>

                                </li>
                            </ul>
                        </div>
                    </div>
                    <p class="p-btn">
                    <input type="button" class="yes" name="btnSubmit" value="确定" onclick="xiaZhu('NAP','lt_form','form2')"/>&nbsp;&nbsp;&nbsp;
                        <input type="button" class="no" name="btnReset" value="取消" />
                    </p>
                </section>
                <input type="hidden" name="gid" id="gid" />
                <input type="hidden" name="Line" id="Line" value="" />
            </form>
        </div>
    </div>
    <?php } else{?>
    <section class="g-info spg-info" id="game_info">
        <p>当前期数：期</p>
        <p>封盘时间：</p>
        <p>
			剩余时间：<span id="ui-countdown" class="f00">
                <span id="FCDH" style="font-weight: bold;"></span>
                <span id="close_msg" style="display: none;">&nbsp;</span></span>
		</p>
        <div id="isCloseSpan" style="border: 2px red solid;padding: 5px;text-align: center;"> 极速六合彩目前休盘，请等待下一期开盘。</div>
    </section>
    <?php }?>
</div>

</div>
</div>
<script src="/public/aomen/js/LianMaVerify.js"></script>
<script type="text/javascript">
    $(function () {
        $('.qiu li').click(function () {
            $(this).addClass('act').siblings().removeClass('act');
            $(this).parents(".qiu_one").find(".zmgg").eq($(this).index()).show().siblings('.zmgg').hide();
        })

    })
</script>
<style>
    #message_box02 {
        background: rgba(0, 0, 0, 0) url("/Public/images/block_bg.jpg") repeat-y scroll left center;
        font-size: 12px;
        margin-bottom: 4px;
        margin-left: 3px;
        width: 215px;
    }
    #message_box .inner {
        background: rgba(0, 0, 0, 0) url("/Public/images/block_header.jpg") no-repeat scroll center top;
        line-height: 18px;
        min-height: 250px;
    }
    #message_box .inner span.err {
        background: rgba(0, 0, 0, 0) url("/Public/images/icon_err.gif") no-repeat scroll left center;
        display: inline-block;
        height: 28px;
        margin-right: 0.5em;
        vertical-align: middle;
        width: 28px;
    }
    #message_box .footer {
        background: rgba(0, 0, 0, 0) url("/Public/images/block_footer.jpg") no-repeat scroll left center;
        height: 6px;
        line-height: 0;
    }
</style>