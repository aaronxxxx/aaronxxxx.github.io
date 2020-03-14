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
                        <a href="#/spsix/odds/zheng-ma-te"title="正码特">正码特</a>
                        <a href="#/spsix/odds/lian-ma" title="连码">连码</a>
                        <a href="#/spsix/odds/lian-xiao" title="连肖">连肖</a>
                        <a href="#/spsix/odds/lian-wei" title="连尾" class="NowPlay">连尾</a>
                        <a href="#/spsix/odds/sheng-xiao" title="生肖">生肖</a>
                        <a href="#/spsix/odds/sebo" title="色波">色波</a>
                        <a href="#/spsix/odds/tou-wei"  title="头尾数">头尾数</a>
                    </div>
                </div>
            </div>
            <div id="tab" class="tab_type">
                <ul>
                    <li class="onTagClick"><span class="LF2"><b>二尾碰</b></span></li>
                    <li class="unTagClick"><span class="LF3"><b>三尾碰</b></span></li>
                    <li class="unTagClick"><span class="LF4"><b>四尾碰</b></span></li>
                    <li class="unTagClick"><span class="LF5"><b>五尾碰</b></span></li>

                </ul>
            </div>
            <div id="game">
                <?php if($data) {
                    foreach ($data as $key => $val) { ?>
                        <div id="<?=$key?>" style="display:<?php echo $key!='LF2' ? 'none':"";?>" class="showT">
                            <form action="/?r=spsix/odds/lian-wei" method="post" name="<?=$key?>">
                                <div class="round-table">
                                    <table class="GameTable">
                                        <tbody>
                                            <tr>
                                                <?php for($i=0;$i<5;$i++){?>
                                                    <td class="num" style="width:30px"><label for="SP-1"><?='尾'.$i?></label></td>
                                                    <td class="odds"><input type="number" name="aOdds[<?='h'.($i+1)?>]" value="<?= $val['h'.($i+1)] ?>"></td>
                                                <?php } ?>
                                            </tr>
                                            <tr>
                                                <?php for($i=5;$i<10;$i++){?>
                                                    <td class="num" style="width:30px"><label for="SP-1"><?='尾'.$i?></label></td>
                                                    <td class="odds"><input type="number" name="aOdds[<?='h'.($i+1)?>]" value="<?= $val['h'.($i+1)] ?>"></td>
                                                <?php } ?>
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
                                    <button id="btn-save-odds" class="order" type="<?=$key;?>" data-herf="#/spsix/odds/lian-wei">保存</button>
                                </div>
                            </form>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
</div>