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
                        <a href="#/spsix/odds/zmgg" title="正码过关" class="NowPlay">正码过关</a>
                        <a href="#/spsix/odds/zheng-ma-te" title="正码特">正码特</a>
                        <a href="#/spsix/odds/lian-ma" title="连码">连码</a>
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
                    <li class="onTagClick"><span class="NAP1"><b>正码一</b></span></li>
                    <li class="unTagClick"><span class="NAP2"><b>正码二</b></span></li>
                    <li class="unTagClick"><span class="NAP3"><b>正码三</b></span></li>
                    <li class="unTagClick"><span class="NAP4"><b>正码四</b></span></li>
                    <li class="unTagClick"><span class="NAP5"><b>正码五</b></span></li>
                    <li class="unTagClick"><span class="NAP6"><b>正码六</b></span></li>
                </ul>
            </div>
            <div id="game">
                <?php if($data) {
                    foreach ($data as $key => $val) { ?>
                        <div id="<?=$key?>" style="display:<?php echo $key!='NAP1' ? 'none':"";?>" class="showT">
                            <form action="/?r=spsix/odds/zmgg" method="post" name="<?=$key?>">
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
                                            <td>号码</td>
                                            <td>赔率</td>
                                        </tr>
                                        <tr>
                                            <td class="num" style="width:30px"><label for="SP-1">单</label></td>
                                            <td class="odds"><input type="number" name="aOdds[h1]" value="<?= $val['h1'] ?>"></td>
                                            <td class="num" style="width:30px"><label for="SP-2">双</label></td>
                                            <td class="odds"><input type="number" name="aOdds[h2]" value="<?= $val['h2'] ?>"></td>
                                            <td class="num" style="width:30px"><label for="SP-3">大</label></td>
                                            <td class="odds"><input type="number" name="aOdds[h3]" value="<?= $val['h3'] ?>"></td>
                                            <td class="num" style="width:30px"><label for="SP-4">小</label></td>
                                            <td class="odds"><input type="number" name="aOdds[h4]" value="<?= $val['h4'] ?>"></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                        <tr>
                                            <td class="num" style="width:30px"><label for="SP-6">和单</label></td>
                                            <td class="odds"><input type="number" name="aOdds[h5]" value="<?= $val['h5'] ?>"></td>
                                            <td class="num" style="width:30px"><label for="SP-7">和双</label></td>
                                            <td class="odds"><input type="number" name="aOdds[h6]" value="<?= $val['h6'] ?>"></td>
                                            <td class="num" style="width:30px"><label for="SP-8">和大</label></td>
                                            <td class="odds"><input type="number" name="aOdds[h7]" value="<?= $val['h7'] ?>"></td>
                                            <td class="num" style="width:30px"><label for="SP-9">和小</label></td>
                                            <td class="odds"><input type="number" name="aOdds[h8]" value="<?= $val['h8'] ?>"></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="num" style="width:30px"><label for="SP-6">尾大</label></td>
                                            <td class="odds"><input type="number" name="aOdds[h9]" value="<?= $val['h9'] ?>"></td>
                                            <td class="num" style="width:30px"><label for="SP-7">尾小</label></td>
                                            <td class="odds"><input type="number" name="aOdds[h10]" value="<?= $val['h10'] ?>"></td>
                                            <td class="num" style="width:30px"><label for="SP-9">红</label></td>
                                            <td class="odds"><input type="number" name="aOdds[h11]" value="<?= $val['h11'] ?>"></td>
                                            <td class="num" style="width:30px"><label for="SP-8">绿</label></td>
                                            <td class="odds"><input type="number" name="aOdds[h12]" value="<?= $val['h12'] ?>"></td>
                                            <td class="num" style="width:30px"><label for="SP-9">蓝</label></td>
                                            <td class="odds"><input type="number" name="aOdds[h13]" value="<?= $val['h13'] ?>"></td>
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
                                    <button id="btn-save-odds" class="order" type="<?=$key;?>" data-herf="#/spsix/odds/zmgg">保存</button>
                                </div>
                            </form>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
</div>
