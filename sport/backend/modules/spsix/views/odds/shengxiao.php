 <link href="/public/lottery/css/peilv.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" language="javascript" src="/public/spsix/js/odds.js"></script>

<div id="box_body" class="bg2yellow">
    <div id="box_range">
        <div id="content" class="">
            <h2>
                <b></b>
                <span style="color: white">极速六合彩-赔率设置</span>
            </h2>
            <div id="content_inner">
                <div style="display: none;" id="c_rtype" class="GameName">全五-多重彩派</div>
                <div>
                    <div id="wager_groups" class="CQ">
                        <a href="#/spsix/odds/liangmian" title="两面">两面</a>
                        <a href="#/spsix/odds/zmgg" title="正码过关">正码过关</a>
                        <a href="#/spsix/odds/zheng-ma-te" title="正码特">正码特</a>
                        <a href="#/spsix/odds/lian-ma" title="连码">连码</a>
                        <a href="#/spsix/odds/lian-xiao" title="连肖">连肖</a>
                        <a href="#/spsix/odds/lian-wei" title="连尾">连尾</a>
                        <a href="#/spsix/odds/sheng-xiao" title="生肖" class="NowPlay">生肖</a>
                        <a href="#/spsix/odds/sebo" title="色波">色波</a>
                        <a href="#/spsix/odds/tou-wei"  title="头尾数">头尾数</a>
                    </div>
                </div>
            </div>
            <div id="tab" class="tab_type">
                <ul>
                    <li class="onTagClick"><span class="SPA"><b>特码生肖</b></span></li>
                    <li class="unTagClick"><span class="C7"><b>正肖</b></span></li>
                    <li class="unTagClick"><span class="SPB"><b>一肖/总肖</b></span></li>
                    <li class="unTagClick"><span class="NX"><b>合肖</b></span></li>
                </ul>
            </div>
            <div id="game">
                <?php if($data) {
                    foreach ($data as $key => $val) {
                        if($key!='NX'){?>
                            <div id="<?=$key?>" style="display:<?php echo $key!='SPA' ? 'none':"";?>"  class="showT">
                                <form action="/?r=spsix/odds/sheng-xiao" method="post" name="<?=$key?>">
                                    <div class="round-table">
                                        <table class="GameTable">
                                            <tbody>
                                            <tr class="title_line">
                                                <td>生肖</td>
                                                <td>号码</td>
                                                <td>赔率</td>
                                                <td>生肖</td>
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
                                                    <td class="num"><label for="SP-1"><?=$zodiacArr[$i+1];?></label></td>
                                                    <td class="odds"><input type="number" name="aOdds[<?='h'.($i+2)?>]" value="<?= $val['h'.($i+2)] ?>"></td>
                                                </tr>
                                                <?php $i +=1;
                                            }?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                    if($key=='SPB'){?>
                                        <div class="round-table">
                                        <table class="GameTable">
                                            <tbody>
                                            <tr class="title_line">
                                                <td style="width:30px">总肖</td>
                                            </tr>
                                            <tr>
                                                <td class="num" style="width:30px"><label for="SPB-23">234肖</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h23]" value="<?=$val['h23'];?>"></td>
                                                <td class="num"><label for="SPB-24">5肖</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h24]" value="<?=$val['h24'];?>"></td>
                                                <td class="num"><label for="SPB-25">6肖</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h25]" value="<?=$val['h25'];?>"></td>
                                            </tr>
                                            <tr>
                                                <td class="num"><label for="SPB-26">7肖</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h26]" value="<?=$val['h26'];?>"></td>
                                                <td class="num"><label for="SPB-27">总肖单</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h27]" value="<?=$val['h27'];?>"></td>
                                                <td class="num" style="width:30px"><label for="SPB-28">总肖双</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h28]" value="<?=$val['h28'];?>"></td>
                                            </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    <?php } ?>
                                    <div id="SendB5">
                                        <input type="hidden" name="sub_type" value="<?=$key;?>">
                                        <input type="hidden" name="ball_type" value="<?=$val['ball_type'];?>">
                                        <button id="btn-save-odds" class="order" type="<?=$key;?>" data-herf="#/spsix/odds/sheng-xiao">保存</button>
                                    </div>
                                    <p>
                                    <span>请输入修改密码 : <input name="superpassword" type="password" value="" /></span>
                                    </p>
                                </form>
                            </div>
                        <?php }else{?>
                            <div id="<?=$key?>" style="display:<?php echo $key!='SPA' ? 'none':"";?>" class="showT">
                                <form action="/?r=spsix/odds/sheng-xiao" method="post" name="<?=$key?>">
                                    <div class="round-table">
                                        <table class="GameTable">
                                            <tbody>
                                            <tr class="title_line">
                                                <td>生肖</td>
                                                <td>赔率</td>
                                                <td>生肖</td>
                                                <td>赔率</td>
                                                <td>生肖</td>
                                                <td>赔率</td>
                                                <td>生肖</td>
                                                <td>赔率</td>
                                                <td>生肖</td>
                                                <td>赔率</td>
                                            </tr>
                                            <tr>
                                                <td class="num" style="width:30px"><label for="SP-1">中一</label></td>
                                                <td class="num" style="width:30px"><label for="SP-1"><input type="number" name="aOdds[h1]" value="<?= $val['h1'] ?>"></label></td>
                                                <td class="num" style="width:30px"><label for="SP-1">中二</label></td>
                                                <td class="num" style="width:30px"><label for="SP-1"><input type="number" name="aOdds[h2]" value="<?= $val['h2'] ?>"></label></td>
                                                <td class="num" style="width:30px"><label for="SP-1">中三</label></td>
                                                <td class="num" style="width:30px"><label for="SP-1"><input type="number" name="aOdds[h3]" value="<?= $val['h3'] ?>"></label></td>
                                                <td class="num" style="width:30px"><label for="SP-1">中四</label></td>
                                                <td class="num" style="width:30px"><label for="SP-1"><input type="number" name="aOdds[h4]" value="<?= $val['h4'] ?>"></label></td>
                                                <td class="num" style="width:30px"><label for="SP-1">中五</label></td>
                                                <td class="num" style="width:30px"><label for="SP-1"><input type="number" name="aOdds[h5]" value="<?= $val['h5'] ?>"></label></td>
                                            </tr>
                                            <tr>
                                                <td class="num" style="width:30px"><label for="SP-1">中六</label></td>
                                                <td class="num" style="width:30px"><label for="SP-1"><input type="number" name="aOdds[h6]" value="<?= $val['h6'] ?>"></label></td>
                                                <td class="num" style="width:30px"><label for="SP-1">中七</label></td>
                                                <td class="num" style="width:30px"><label for="SP-1"><input type="number" name="aOdds[h7]" value="<?= $val['h7'] ?>"></label></td>
                                                <td class="num" style="width:30px"><label for="SP-1">中八</label></td>
                                                <td class="num" style="width:30px"><label for="SP-1"><input type="number" name="aOdds[h8]" value="<?= $val['h8'] ?>"></label></td>
                                                <td class="num" style="width:30px"><label for="SP-1">中九</label></td>
                                                <td class="num" style="width:30px"><label for="SP-1"><input type="number" name="aOdds[h9]" value="<?= $val['h9'] ?>"></label></td>
                                                <td class="num" style="width:30px"><label for="SP-1">中十</label></td>
                                                <td class="num" style="width:30px"><label for="SP-1"><input type="number" name="aOdds[h10]" value="<?= $val['h10'] ?>"></label></td>
                                            </tr>
                                            <tr>
                                                <td class="num" style="width:30px"><label for="SP-1">中十一</label></td>
                                                <td class="num" style="width:30px"><label for="SP-1"><input type="number" name="aOdds[h11]" value="<?= $val['h11'] ?>"></label></td>
                                                <td class="num" style="width:30px;color:red;" colspan="8"><label for="SP-1" >生肖不中赔率与生肖中赔率相反，比如：中五赔率和不中七赔率相等</label></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="SendB5">
                                        <input type="hidden" name="sub_type" value="<?=$key;?>">
                                        <input type="hidden" name="ball_type" value="<?=$val['ball_type'];?>">
                                        <button id="btn-save-odds" class="order" type="<?=$key;?>" data-herf="#/spsix/odds/sheng-xiao">保存</button>
                                    </div>
                                    <p>
                                    <span>请输入修改密码 : <input name="superpassword" type="password" value="" /></span>
                                    </p>
                                </form>
                            </div>
                        <?php }?>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
</div>
