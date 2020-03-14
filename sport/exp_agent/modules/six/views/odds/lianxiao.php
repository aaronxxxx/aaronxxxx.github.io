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
                        <a href="#/six/odds/zheng-ma-te" title="正码特">正码特</a>
                        <a href="#/six/odds/lian-ma" title="连码">连码</a>
                        <a href="#/six/odds/lian-xiao" title="连肖"  class="NowPlay">连肖</a>
                        <a href="#/six/odds/lian-wei" title="连尾">连尾</a>
                        <a href="#/six/odds/sheng-xiao" title="生肖">生肖</a>
                        <a href="#/six/odds/sebo" title="色波">色波</a>
                        <a href="#/six/odds/tou-wei"  title="头尾数">头尾数</a>
                    </div>
                </div>
            </div>
            <div id="tab" class="tab_type">
                <ul>
                    <li class="onTagClick"><span class="LX2"><b>二连肖</b></span></li>
                    <li class="unTagClick"><span class="LX3"><b>三连肖</b></span></li>
                    <li class="unTagClick"><span class="LX4"><b>四连肖</b></span></li>
                    <li class="unTagClick"><span class="LX5"><b>五连肖</b></span></li>

                </ul>
            </div>
            <div id="game">
                <?php if($data) {
                    foreach ($data as $key => $val) { ?>
                        <div id="<?=$key?>" style="display:<?php echo $key!='LX2' ? 'none':"";?>" class="showT">
                            <form action="/?r=six/odds/lian-xiao" method="post" name="<?=$key?>">
                                <div class="round-table">
                                    <table class="GameTable">
                                        <tbody>
                                        <tr class="title_line">
                                            <td>十二生肖</td>
                                            <td>号码</td>
                                            <td>赔率</td>
                                            <td>十二生肖</td>
                                            <td>号码</td>
                                            <td>赔率</td>
                                        </tr>
                                        <?php
                                        for($i=0;$i<count($zodiacArr);$i++){?>
                                            <tr>
                                                <td class="num" ><label for="SP-1"><?=$animal[$i]?></label></td>
                                                <td class="num" ><label for="SP-1"><?=$zodiacArr[$i];?></label></td>
                                                <td class="odds"><input type="number" name="aOdds[<?='h'.($i+1)?>]" value="<?= $val['h'.($i+1)] ?>"></td>
                                                <td class="num" ><label for="SP-1"><?=$animal[$i+1]?></label></td>
                                                <td class="num" ><label for="SP-1"><?=$zodiacArr[$i+1];?></label></td>
                                                <td class="odds"><input type="number" name="aOdds[<?='h'.($i+2)?>]" value="<?= $val['h'.($i+2)] ?>"></td>
                                            </tr>
                                            <?php $i +=1;
                                        }?>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="SendB5">
                                    <input type="hidden" name="sub_type" value="<?=$key;?>">
                                    <input type="hidden" name="ball_type" value="<?=$val['ball_type'];?>">
                                    <button id="btn-save-odds" class="order" type="<?=$key;?>" data-herf="#/six/odds/lian-xiao">保存</button>
                                </div>
                            </form>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
</div>