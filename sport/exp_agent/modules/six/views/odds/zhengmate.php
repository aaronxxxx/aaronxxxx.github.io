 <link href="/public/lottery/css/peilv.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" language="javascript" src="/public/six/js/odds.js"></script>

<div id="box_body" class="bg2yellow">
    <div id="box_range">
        <div id="content" class="">
            <h2>
                <b></b>
                <span style="color: white">六合彩-赔率设置</span>
            </h2>
            <div id="content_inner">
                <div style="display: none;" id="c_rtype" class="GameName">全五-多重彩派</div>
                <div>
                    <div id="wager_groups" class="CQ">
                        <a href="#/six/odds/liangmian" title="两面">两面</a>
                        <a href="#/six/odds/zmgg" title="正码过关">正码过关</a>
                        <a href="#/six/odds/zheng-ma-te" title="正码特" class="NowPlay">正码特</a>
                        <a href="#/six/odds/lian-ma" title="连码">连码</a>
                        <a href="#/six/odds/lian-xiao" title="连肖" >连肖</a>
                        <a href="#/six/odds/lian-wei" title="连尾">连尾</a>
                        <a href="#/six/odds/sheng-xiao" title="生肖">生肖</a>
                        <a href="#/six/odds/sebo" title="色波">色波</a>
                        <a href="#/six/odds/tou-wei"  title="头尾数">头尾数</a>
                    </div>
                </div>
            </div>
            <div id="tab" class="tab_type">
                <ul>
                    <li class="onTagClick"><span class="SP"><b>特别面A</b></span></li>
                    <li class="unTagClick"><span class="N1"><b>正码一</b></span></li>
                    <li class="unTagClick"><span class="N2"><b>正码二</b></span></li>
                    <li class="unTagClick"><span class="N3"><b>正码三</b></span></li>
                    <li class="unTagClick"><span class="N4"><b>正码四</b></span></li>
                    <li class="unTagClick"><span class="N5"><b>正码五</b></span></li>
                    <li class="unTagClick"><span class="N6"><b>正码六</b></span></li>
                    <li class="unTagClick"><span class="NA"><b>正码</b></span></li>
                    <li class="unTagClick"><span class="SPB"><b>特别面B</b></span></li>
                </ul>
            </div>
            <div id="game">
                <?php if($data) {
                    foreach ($data as $key => $val) {?>
                        <div id="<?=$key?>" style="display:<?php echo $key!='SP' ? 'none':"";?>" class="showT">
                            <form action="/?r=six/odds/zheng-ma-te" method="post" name="<?=$key?>">
                                <div class="round-table">
                                    <?php if($key=='SP'){?>
                                        <div style="margin: 2px 10px;">
                                            反水最小金额：<input type="number" name="fsMoney" style="margin-right: 10px;" value="<?=$fs['h1'];?>">
                                            反水比例：<input type="number" name="fsRate" style="margin-right: 10px;" value="<?=$fs['h2'];?>">
                                            最小比例为0.01，如果是更小的数值，会被系统自动调整。
                                            <div style="border:2px solid red;margin: 4px 0;">例如：用户投注六合彩600，最小反水金额为500，反水比例0.01，用户会得到反水6=600*0.01。</div>
                                        </div>
                                    <?php   }?>
                                    <table class="GameTable">
                                        <tbody>
                                        <tr class="title_line">
                                            <td>号码</td>
                                            <td>赔率</td>
                                            <td>号码</td>
                                            <td>赔率</td>
                                            <td>号码</td>
                                            <td>赔率</td>
                                            <td>号码</td>
                                            <td>赔率</td>
                                            <td>号码</td>
                                            <td>赔率</td>
                                        </tr>
                                        <?php
                                        for($i=0;$i<10;$i++){?>
                                            <tr>
                                                <?php for($j=1;$j<6;$j++) {
                                                    if ((5 * $i + $j) < 50) {
                                                        ?>
                                                        <td class="num" style="width:30px"><label for="SP-1"><?= 5 * $i + $j; ?></label></td>
                                                        <td class="odds"><input type="number" name="aOdds[<?='h'.(5 * $i + $j);?>]" value="<?= $val['h' . (5 * $i + $j)] ?>"></td>
                                                    <?php }
                                                }?>
                                            </tr>
                                        <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="SendB5">
                                    <input type="hidden" name="sub_type" value="<?=$key;?>">
                                    <input type="hidden" name="ball_type" value="<?=$val['ball_type'];?>">
                                    <button id="btn-save-odds" class="order" type="<?=$key;?>" data-herf="#/six/odds/zheng-ma-te">保存</button>
                                </div>
                            </form>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
</div>