 <link href="/public/lottery/css/peilv.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" language="javascript" src="/public/six/js/odds.js"></script>

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
                        <a href="#/six/odds/liangmian" title="两面" class="NowPlay">两面</a>
                        <a href="#/six/odds/zmgg" title="正码过关" >正码过关</a>
                        <a href="#/six/odds/zheng-ma-te" title="正码特">正码特</a>
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
                    <li class="onTagClick"><span class="N1"><b>正码(1-6)一</b></span></li>
                    <li class="unTagClick"><span class="N2"><b>正码(1-6)二</b></span></li>
                    <li class="unTagClick"><span class="N3"><b>正码(1-6)三</b></span></li>
                    <li class="unTagClick"><span class="N4"><b>正码(1-6)四</b></span></li>
                    <li class="unTagClick"><span class="N5"><b>正码(1-6)五</b></span></li>
                    <li class="unTagClick"><span class="N6"><b>正码(1-6)六</b></span></li>
                    <li class="unTagClick"><span class="SP"><b>特别码</b></span></li>
                    <li class="unTagClick"><span class="NA"><b>正码（所有）</b></span></li>
                </ul>
            </div>
            <div id="game">
                <?php if($zhengMa) {
                    foreach ($zhengMa as $key => $val) { ?>
                        <div id="<?=$key?>" style="display:<?php echo $key!='N1' ? 'none':"";?>" class="showT">
                            <form action="/?r=six/odds/liangmian" method="post" name="<?=$key?>">
                                <div class="round-table">
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
                                        </tr>
                                        <tr>
                                            <td class="num" style="width:30px"><label for="SP-1"><?php echo $key=='SP'? "特":($key=='NA'? "总":'');?>单</label></td>
                                            <td class="odds"><input type="number" name="aOdds[h1]" value="<?= $val['h1'] ?>"></td>
                                            <td class="num" style="width:30px"><label for="SP-2"><?php echo $key=='SP'? "特":"";?>双</label></td>
                                            <td class="odds"><input type="number" name="aOdds[h2]" value="<?= $val['h2'] ?>"></td>
                                            <td class="num" style="width:30px"><label for="SP-3"><?php echo $key=='SP'? "特":"";?>大</label></td>
                                            <td class="odds"><input type="number" name="aOdds[h3]" value="<?= $val['h3'] ?>"></td>
                                            <td class="num" style="width:30px"><label for="SP-4"><?php echo $key=='SP'? "特":"";?>小</label></td>
                                            <td class="odds"><input type="number" name="aOdds[h4]" value="<?= $val['h4'] ?>"></td>
                                        </tr>
                                        <?php if($key!='NA'){ ?>
                                            <tr>
                                                <td class="num" style="width:30px"><label for="SP-6">和单</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h5]" value="<?= $val['h5'] ?>"></td>
                                                <td class="num" style="width:30px"><label for="SP-7">和双</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h6]" value="<?= $val['h6'] ?>"></td>
                                                <td class="num" style="width:30px"><label for="SP-8">和大</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h7]" value="<?= $val['h7'] ?>"></td>
                                                <td class="num" style="width:30px"><label for="SP-9">和小</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h8]" value="<?= $val['h8'] ?>"></td>
                                            </tr>
                                        <?php } ?>
                                        <?php if(in_array($key,array('N1','N2','N3','N4','N5','N6'))){ ?>
                                            <tr>
                                                <td class="num" style="width:30px"><label for="SP-9">尾大</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h9]" value="<?= $val['h9'] ?>"></td>
                                                <td class="num" style="width:30px"><label for="SP-10">尾小</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h10]" value="<?= $val['h10'] ?>"></td>
                                                <td class="num" style="width:30px"><label for="SP-11">红波</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h11]" value="<?= $val['h11'] ?>"></td>
                                                <td class="num" style="width:30px"><label for="SP-12">绿波</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h12]" value="<?= $val['h12'] ?>"></td>
                                            </tr>
                                            <tr>
                                                <td class="num" style="width:30px"><label for="SP-13">蓝波</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h13]" value="<?= $val['h13'] ?>"></td>
                                            </tr>
                                        <?php } ?>
                                        <?php if($key=='SP'){ ?>
                                            <tr>
                                                <td class="num" style="width:30px"><label for="SP-6">大双</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h16]" value="<?= $val['h16'] ?>"></td>
                                                <td class="num" style="width:30px"><label for="SP-7">小双</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h17]" value="<?= $val['h17'] ?>"></td>
                                                <td class="num" style="width:30px"><label for="SP-8">大单</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h14]" value="<?= $val['h14'] ?>"></td>
                                                <td class="num" style="width:30px"><label for="SP-9">小单</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h15]" value="<?= $val['h15'] ?>"></td>
                                            </tr>
                                            <tr>
                                            <td class="num" style="width:30px"><label for="SP-8">尾大</label></td>
                                            <td class="odds"><input type="number" name="aOdds[h9]" value="<?= $val['h9'] ?>"></td>
                                            <td class="num" style="width:30px"><label for="SP-9">尾小</label></td>
                                            <td class="odds"><input type="number" name="aOdds[h10]" value="<?= $val['h10'] ?>"></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="SendB5">
                                    <input type="hidden" name="sub_type" value="<?=$key;?>">
                                    <input type="hidden" name="ball_type" value="<?=$val['ball_type'];?>">
                                    <button id="btn-save-odds" class="order" type="<?=$key;?>" data-herf="#/six/odds/liangmian">保存</button>
                                </div>
                            </form>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
</div>

