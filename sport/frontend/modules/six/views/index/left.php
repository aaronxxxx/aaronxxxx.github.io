<div id="box_body" class="bg2yellow">
    <div id="box_range">
        <div id="header">
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
                <div id="game_info">
                    <div class="logoImg"><img src="/public/aomenPC/img/six.png" alt=""></div>
                    <div style="padding: 50px 0 0 15px;width:300px">
                        <h3>六合彩</h3>
                        <br>
                        <p>第 <span id="gNumber" style="color:red;"><?=$qishu!=-1 ? $qishu:'';?></span>期</p>
                    </div>
                    <div class="time" id="gametime" >
                        <span id="ui-countdown">
                            <span id="FCDH" style="font-weight:bold;"></span>
                            <span id="close_msg" style="display:none;">&nbsp;</span>
                        </span>
                    </div>
                    <div class="result">
                        <div class="text-center d-flex">
                            <div class="resultSound"></div>                            
                            <p>六合彩&nbsp;&nbsp; 第 <span id="openNumber" style="color:red;"><?=$qishu!=-1 ? $qishu:'';?></span>期</p>
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
                       data-url="/?r=six/rule/rule&gtype=LT">
                        <span style="color:black;">规则</span>
                    </a>
                </li>
                <li>
                    <a style="padding-top: 4px;" data-callback="self.memberCenter.gameResult" title="开奖结果"
                       data-url="/?r=six/sixtop/kaijiang&gtype=LT">
                        <span style="color:black;">开奖</span>
                    </a>
                </li>
                <!-- <li>
                    <a style="padding-top: 4px;" title="系统公告" data-url="/?r=six/sixtop/news&gtype=LT">
                        <span style="color:black;">公告</span>
                    </a>
                </li>
                <li>
                    <a style="padding-top: 4px;" data-callback="self.memberCenter.quickGold" title="快选金额"
                       data-url="/?r=six/sixtop/quick&gtype=LT">
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
                <?php
                if ($rType == 'SPbside') {
                    ?>
                    <ul>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPbside"><div class="leftNavText leftNavItemActive">特别号B面</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=OEOU"><div class="leftNavText">两面</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NA"><div class="leftNavText">正码</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NAS&rtypeN=N1"><div class="leftNavText">正码特</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NO"><div class="leftNavText">正码1-6</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NAP"><div class="leftNavText">正码过关</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=CH"><div class="leftNavText">连码</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=LX"><div class="leftNavText">连肖／连尾</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NI"><div class="leftNavText">自选不中</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=1"><div class="leftNavText">特码生肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=C7&showTableN=1"><div class="leftNavText">正肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=1"><div class="leftNavText">一肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NX"><div class="leftNavText">合肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=3"><div class="leftNavText">总肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=2"><div class="leftNavText">色波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=HB&showTableN=1"><div class="leftNavText">半波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=HB&showTableN=2"><div class="leftNavText">半半波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=C7&showTableN=2"><div class="leftNavText">七色波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=3"><div class="leftNavText">头尾数</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=2"><div class="leftNavText">平特尾数</div></a></li>
                    </ul>
                    <?php
                   } elseif ($rType == 'OEOU') {
                        ?>
                  <ul>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPbside"><div class="leftNavText">特别号B面</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=OEOU"><div class="leftNavText leftNavItemActive">两面</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NA"><div class="leftNavText">正码</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NAS&rtypeN=N1"><div class="leftNavText">正码特</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NO"><div class="leftNavText">正码1-6</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NAP"><div class="leftNavText">正码过关</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=CH"><div class="leftNavText">连码</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=LX"><div class="leftNavText">连肖／连尾</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NI"><div class="leftNavText">自选不中</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=1"><div class="leftNavText">特码生肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=C7&showTableN=1"><div class="leftNavText">正肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=1"><div class="leftNavText">一肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NX"><div class="leftNavText">合肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=3"><div class="leftNavText">总肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=2"><div class="leftNavText">色波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=HB&showTableN=1"><div class="leftNavText">半波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=HB&showTableN=2"><div class="leftNavText">半半波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=C7&showTableN=2"><div class="leftNavText">七色波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=3"><div class="leftNavText">头尾数</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=2"><div class="leftNavText">平特尾数</div></a></li>
                    </ul>
                    <?php
                       } elseif ($rType == "NA") {//正码
                            ?>
                    <ul>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPbside"><div class="leftNavText">特别号B面</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=OEOU"><div class="leftNavText">两面</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NA"><div class="leftNavText leftNavItemActive">正码</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NAS&rtypeN=N1"><div class="leftNavText ">正码特</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NO"><div class="leftNavText">正码1-6</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NAP"><div class="leftNavText">正码过关</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=CH"><div class="leftNavText">连码</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=LX"><div class="leftNavText">连肖／连尾</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NI"><div class="leftNavText">自选不中</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=1"><div class="leftNavText">特码生肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=C7&showTableN=1"><div class="leftNavText">正肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=1"><div class="leftNavText">一肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NX"><div class="leftNavText">合肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=3"><div class="leftNavText">总肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=2"><div class="leftNavText">色波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=HB&showTableN=1"><div class="leftNavText">半波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=HB&showTableN=2"><div class="leftNavText">半半波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=C7&showTableN=2"><div class="leftNavText">七色波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=3"><div class="leftNavText">头尾数</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=2"><div class="leftNavText">平特尾数</div></a></li>
                    </ul>
                            <?php
                       } elseif ($rType == "NAS") {//正码特
                            ?>
                             <ul>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPbside"><div class="leftNavText">特别号B面</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=OEOU"><div class="leftNavText cwpsleftNavItemActive">两面</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NA"><div class="leftNavText">正码</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NAS&rtypeN=N1"><div class="leftNavText leftNavItemActive">正码特</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NO"><div class="leftNavText">正码1-6</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NAP"><div class="leftNavText">正码过关</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=CH"><div class="leftNavText">连码</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=LX"><div class="leftNavText">连肖／连尾</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NI"><div class="leftNavText">自选不中</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=1"><div class="leftNavText">特码生肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=C7&showTableN=1"><div class="leftNavText">正肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=1"><div class="leftNavText">一肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NX"><div class="leftNavText">合肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=3"><div class="leftNavText">总肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=2"><div class="leftNavText">色波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=HB&showTableN=1"><div class="leftNavText">半波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=HB&showTableN=2"><div class="leftNavText">半半波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=C7&showTableN=2"><div class="leftNavText">七色波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=3"><div class="leftNavText">头尾数</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=2"><div class="leftNavText">平特尾数</div></a></li>
                    </ul>
                            <?php
                       } elseif ($rType == "NO") {//正码1-6
                            ?>
                             <ul>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPbside"><div class="leftNavText">特别号B面</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=OEOU"><div class="leftNavText">两面</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NA"><div class="leftNavText">正码</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NAS&rtypeN=N1"><div class="leftNavText">正码特</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NO"><div class="leftNavText leftNavItemActive">正码1-6</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NAP"><div class="leftNavText">正码过关</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=CH"><div class="leftNavText">连码／连肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=LX"><div class="leftNavText">连尾</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NI"><div class="leftNavText">自选不中</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=1"><div class="leftNavText">特码生肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=C7&showTableN=1"><div class="leftNavText">正肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=1"><div class="leftNavText">一肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NX"><div class="leftNavText">合肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=3"><div class="leftNavText">总肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=2"><div class="leftNavText">色波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=HB&showTableN=1"><div class="leftNavText">半波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=HB&showTableN=2"><div class="leftNavText">半半波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=C7&showTableN=2"><div class="leftNavText">七色波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=3"><div class="leftNavText">头尾数</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=2"><div class="leftNavText">平特尾数</div></a></li>
                    </ul>
                            <?php
                       } elseif ($rType == "SPA") {//特码生肖,色波,头尾数
                            ?>
                             <ul>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPbside"><div class="leftNavText">特别号B面</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=OEOU"><div class="leftNavText">两面</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NA"><div class="leftNavText">正码</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NAS&rtypeN=N1"><div class="leftNavText ">正码特</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NO"><div class="leftNavText">正码1-6</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NAP"><div class="leftNavText">正码过关</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=CH"><div class="leftNavText">连码</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=LX"><div class="leftNavText">连肖／连尾</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NI"><div class="leftNavText">自选不中</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=1"><div class="leftNavText <?php if($showTableN=='1'){echo 'leftNavItemActive';} ?> ">特码生肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=C7&showTableN=1"><div class="leftNavText">正肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=1"><div class="leftNavText">一肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NX"><div class="leftNavText">合肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=3"><div class="leftNavText">总肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=2"><div class="leftNavText <?php if($showTableN=='2'){echo 'leftNavItemActive';} ?> ">色波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=HB&showTableN=1"><div class="leftNavText">半波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=HB&showTableN=2"><div class="leftNavText">半半波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=C7&showTableN=2"><div class="leftNavText">七色波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=3"><div class="leftNavText <?php if($showTableN=='3'){echo 'leftNavItemActive';} ?> ">头尾数</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=2"><div class="leftNavText">平特尾数</div></a></li>
                    </ul>
                            <?php
                       } elseif ($rType == "C7") {//正肖,七色波
                            ?>
                         <ul>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPbside"><div class="leftNavText">特别号B面</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=OEOU"><div class="leftNavText">两面</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NA"><div class="leftNavText">正码</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NAS&rtypeN=N1"><div class="leftNavText">正码特</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NO"><div class="leftNavText">正码1-6</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NAP"><div class="leftNavText">正码过关</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=CH"><div class="leftNavText">连码</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=LX"><div class="leftNavText">连肖／连尾</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NI"><div class="leftNavText">自选不中</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=1"><div class="leftNavText">特码生肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=C7&showTableN=1"><div class="leftNavText <?php if($showTableN=='1'){echo 'leftNavItemActive';} ?>">正肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=1"><div class="leftNavText">一肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NX"><div class="leftNavText">合肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=3"><div class="leftNavText">总肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=2"><div class="leftNavText">色波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=HB&showTableN=1"><div class="leftNavText">半波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=HB&showTableN=2"><div class="leftNavText">半半波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=C7&showTableN=2"><div class="leftNavText <?php if($showTableN=='2'){echo 'leftNavItemActive';} ?>" >七色波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=3"><div class="leftNavText">头尾数</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=2"><div class="leftNavText">平特尾数</div></a></li>
                    </ul>
                            <?php
                       } elseif ($rType == "SPB") {//一肖,总肖,平特尾数
                            ?>
                         <ul>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPbside"><div class="leftNavText">特别号B面</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=OEOU"><div class="leftNavText">两面</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NA"><div class="leftNavText">正码</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NAS&rtypeN=N1"><div class="leftNavText">正码特</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NO"><div class="leftNavText">正码1-6</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NAP"><div class="leftNavText">正码过关</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=CH"><div class="leftNavText">连码</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=LX"><div class="leftNavText">连肖／连尾</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NI"><div class="leftNavText">自选不中</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=1"><div class="leftNavText">特码生肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=C7&showTableN=1"><div class="leftNavText">正肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=1"><div class="leftNavText <?php if($showTableN=='1'){echo 'leftNavItemActive';} ?> ">一肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NX"><div class="leftNavText">合肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=3"><div class="leftNavText <?php if($showTableN=='3'){echo 'leftNavItemActive';} ?> ">总肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=2"><div class="leftNavText">色波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=HB&showTableN=1"><div class="leftNavText">半波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=HB&showTableN=2"><div class="leftNavText">半半波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=C7&showTableN=2"><div class="leftNavText">七色波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=3"><div class="leftNavText">头尾数</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=2"><div class="leftNavText <?php if($showTableN=='2'){echo 'leftNavItemActive';} ?> ">平特尾数</div></a></li>
                    </ul>
                            <?php
                       } elseif ($rType == "HB") {//半波,半半波
                            ?>
                         <ul>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPbside"><div class="leftNavText">特别号B面</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=OEOU"><div class="leftNavText">两面</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NA"><div class="leftNavText">正码</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NAS&rtypeN=N1"><div class="leftNavText">正码特</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NO"><div class="leftNavText">正码1-6</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NAP"><div class="leftNavText">正码过关</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=CH"><div class="leftNavText">连码</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=LX"><div class="leftNavText">连尾／连尾</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NI"><div class="leftNavText">自选不中</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=1"><div class="leftNavText">特码生肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=C7&showTableN=1"><div class="leftNavText">正肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=1"><div class="leftNavText">一肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NX"><div class="leftNavText">合肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=3"><div class="leftNavText">总肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=2"><div class="leftNavText">色波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=HB&showTableN=1"><div class="leftNavText <?php if($showTableN=='1'){echo 'leftNavItemActive';} ?> ">半波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=HB&showTableN=2"><div class="leftNavText <?php if($showTableN=='2'){echo 'leftNavItemActive';} ?> ">半半波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=C7&showTableN=2"><div class="leftNavText">七色波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=3"><div class="leftNavText">头尾数</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=2"><div class="leftNavText">平特尾数</div></a></li>
                    </ul>

                                <?php
                       } elseif ($rType == "LX") {//LX
                            ?>
                         <ul>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPbside"><div class="leftNavText">特别号B面</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=OEOU"><div class="leftNavText">两面</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NA"><div class="leftNavText">正码</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NAS&rtypeN=N1"><div class="leftNavText leftNavItemActive">正码特</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NO"><div class="leftNavText">正码1-6</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NAP"><div class="leftNavText">正码过关</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=CH"><div class="leftNavText">连码</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=LX"><div class="leftNavText leftNavItemActive">连肖／连尾</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NI"><div class="leftNavText">自选不中</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=1"><div class="leftNavText">特码生肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=C7&showTableN=1"><div class="leftNavText">正肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=1"><div class="leftNavText">一肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=NX"><div class="leftNavText">合肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=3"><div class="leftNavText">总肖</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=2"><div class="leftNavText">色波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=HB&showTableN=1"><div class="leftNavText">半波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=HB&showTableN=2"><div class="leftNavText">半半波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=C7&showTableN=2"><div class="leftNavText">七色波</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPA&showTableN=3"><div class="leftNavText">头尾数</div></a></li>
                        <li class="leftNavItem"> <a href="/?r=six/index/index&rtype=SPB&showTableN=2"><div class="leftNavText">平特尾数</div></a></li>
                    </ul>
                            <?php
                       }
                        ?> 
                </div>
            </div>
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
            <script src="/public/aomenPC/js/six.js"></script>
            <div id="content_six">
                <!-- <h2>
                    <b></b>
                    <span>六合彩</span>
                </h2> -->
                <div id="content_inner">
                    <div style="display: none;" id="c_rtype"></div>
                </div>
				<input type="hidden" id="gold_gmin" value="<?=$lowestMoney ?>" />
                <input type="hidden" id="gold_gmax" value="<?=$maxMoney ?>" />

<!-- <div id="randomball" class="round-table" style="display:none">
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
</div> -->