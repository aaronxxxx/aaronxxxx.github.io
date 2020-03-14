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
                        <a href="#/spsix/odds/lian-ma" title="连码" class="NowPlay">连码</a>
                        <a href="#/spsix/odds/lian-xiao" title="连肖" >连肖</a>
                        <a href="#/spsix/odds/lian-wei" title="连尾">连尾</a>
                        <a href="#/spsix/odds/sheng-xiao" title="生肖">生肖</a>
                        <a href="#/spsix/odds/sebo" title="色波">色波</a>
                        <a href="#/spsix/odds/tou-wei"  title="头尾数">头尾数</a>
                    </div>
                </div>
            </div>
            <div id="tab" class="tab_type">
                <ul>
                    <li class="onTagClick"><span class="CH"><b>连码</b></span></li>
                    <li class="unTagClick"><span class="NI"><b>自选不中</b></span></li>
                </ul>
            </div>
            <div id="game">
                <?php if($data) {
                    foreach ($data as $key => $val) { ?>
                        <div id="<?=$key?>" style="display:<?php echo $key!='CH' ? 'none':"";?>" class="showT">
                            <form action="/?r=spsix/odds/lian-ma" method="post" name="<?=$key?>">
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
                                            <td class="num" style="width:30px"><label for="SP-1"><?php echo $key=='CH' ? '四全中':'五不中';?></label></td>
                                            <td class="odds"><input type="number" name="aOdds[h1]" value="<?= $val['h1'] ?>"></td>
                                            <td class="num" style="width:30px"><label for="SP-1"><?php echo $key=='CH' ? '三全中':'六不中';?></label></td>
                                            <td class="odds"><input type="number" name="aOdds[h2]" value="<?= $val['h2'] ?>"></td>
                                            <td class="num" style="width:30px"><label for="SP-1"><?php echo $key=='CH' ? '三中二':'七不中';?></label></td>
                                            <td class="odds"><input type="number" name="aOdds[h3]" value="<?= $val['h3'] ?>"></td>
                                            <td class="num" style="width:30px"><label for="SP-1"><?php echo $key=='CH' ? '三中三':'八不中';?></label></td>
                                            <td class="odds"><input type="number" name="aOdds[h4]" value="<?= $val['h4'] ?>"></td>
                                        </tr>

                                        <tr>
                                            <td class="num" style="width:30px"><label for="SP-1"><?php echo $key=='CH' ? '二全中':'九不中';?></label></td>
                                            <td class="odds"><input type="number" name="aOdds[h5]" value="<?= $val['h5'] ?>"></td>
                                            <td class="num" style="width:30px"><label for="SP-1"><?php echo $key=='CH' ? '二中特':'十不中';?></label></td>
                                            <td class="odds"><input type="number" name="aOdds[h6]" value="<?= $val['h6'] ?>"></td>
                                            <td class="num" style="width:30px"><label for="SP-1"><?php echo $key=='CH' ? '二中二':'十一不中';?></label></td>
                                            <td class="odds"><input type="number" name="aOdds[h7]" value="<?= $val['h7'] ?>"></td>
                                            <td class="num" style="width:30px"><label for="SP-1"><?php echo $key=='CH' ? '特串':'十二不中';?></label></td>
                                            <td class="odds"><input type="number" name="aOdds[h8]" value="<?= $val['h8'] ?>"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p>
                                    <span>请输入修改密码 : <input name="superpassword" type="password" value="" /></span>
                                </p>
                                <div id="SendB5">
                                    <input type="hidden" name="sub_type" value="<?=$key;?>">
                                    <input type="hidden" name="ball_type" value="<?=$val['ball_type'];?>">
                                    <button id="btn-save-odds" class="order" type="<?=$key;?>" data-herf="#/spsix/odds/lian-ma">保存</button>
                                </div>
                            </form>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
</div>