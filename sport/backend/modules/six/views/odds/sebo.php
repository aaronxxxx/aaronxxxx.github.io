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
                        <a href="#/six/odds/lian-xiao" title="连肖" >连肖</a>
                        <a href="#/six/odds/lian-wei" title="连尾">连尾</a>
                        <a href="#/six/odds/sheng-xiao" title="生肖">生肖</a>
                        <a href="#/six/odds/sebo" title="色波" class="NowPlay">色波</a>
                        <a href="#/six/odds/tou-wei"  title="头尾数">头尾数</a>
                    </div>
                </div>
            </div>
            <div id="tab" class="tab_type">
                <ul>
                    <li class="onTagClick"><span class="SP"><b>色波</b></span></li>
                    <li class="unTagClick"><span class="HB"><b>半波/半半波</b></span></li>
                    <li class="unTagClick"><span class="C7"><b>七色波</b></span></li>
                </ul>
            </div>
            <div id="game">
                <?php if($data) {
                    foreach ($data as $key => $val) {
                        if ($key == 'SP') {
                            ?>
                            <div id="<?= $key ?>" class="showT">
                                <form action="/?r=six/odds/sebo" method="post" name="<?= $key ?>">
                                    <div class="round-table">
                                        <table class="GameTable">
                                            <tbody>
                                            <tr class="title_line">
                                                <td style="width:30px">色波</td>
<!--                                                <td colspan="5"></td>-->
                                            </tr>
                                            <tr>
                                                <td class="num" ><label for="SP-1">红波</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h11]" value="<?= $val['h11'] ?>"></td>
                                                <td class="num"><label for="SP-1">绿波</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h12]" value="<?= $val['h12'] ?>"></td>
                                                <td class="num"><label for="SP-1">蓝波</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h13]" value="<?= $val['h13'] ?>"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="SendB5">
                                        <input type="hidden" name="sub_type" value="<?= $key; ?>">
                                        <input type="hidden" name="ball_type" value="<?=$val['ball_type'];?>">
                                        <button id="btn-save-odds" class="order" type="<?= $key; ?>"  data-herf="#/six/odds/sebo">保存</button>
                                    </div>
                                    <p>
                                    <span>请输入修改密码 : <input name="superpassword" type="password" value="" /></span>
                                    </p>
                                </form>
                            </div>
                        <?php } else if ($key == 'C7') { ?>
                            <div id="<?= $key ?>" class="showT" style="display: none;">
                                <form action="/?r=six/odds/sebo" method="post" name="<?= $key ?>">
                                    <div class="round-table">
                                        <table class="GameTable">
                                            <tbody>
                                            <tr class="title_line">
                                                <td style="width:30px">七色波</td>
<!--                                                <td colspan="7"></td>-->
                                            </tr>
                                            <tr>
                                                <td class="num" style="width:30px"><label for="SP-1">红波</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h13]" value="<?= $val['h13'] ?>"></td>
                                                <td class="num" style="width:30px"><label for="SP-1">绿波</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h14]" value="<?= $val['h14'] ?>"></td>
                                                <td class="num" style="width:30px"><label for="SP-1">蓝波</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h15]" value="<?= $val['h15'] ?>"></td>
                                                <td class="num" style="width:30px"><label for="SP-1">和局</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h16]" value="<?= $val['h16'] ?>"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="SendB5">
                                        <input type="hidden" name="sub_type" value="<?= $key; ?>">
                                        <input type="hidden" name="ball_type" value="<?=$val['ball_type'];?>">
                                        <button id="btn-save-odds" class="order" type="<?= $key; ?>" data-herf="#/six/odds/sebo">保存</button>
                                    </div>
                                    <p>
                                    <span>请输入修改密码 : <input name="superpassword" type="password" value="" /></span>
                                    </p>
                                </form>
                            </div>
                        <?php } else { ?>
                            <div id="<?= $key ?>" class="showT" style="display: none;">
                                <form id="formLhc" name="<?= $key; ?>" action="/?r=six/odds/sebo" method="post">
                                    <div class="round-table">
                                        <table class="GameTable">
                                            <tbody>
                                            <tr class="title_line">
                                                <td>半波</td>
                                                <td>号码</td>
                                                <td>赔率</td>
                                                <td>半波</td>
                                                <td>号码</td>
                                                <td>赔率</td>
                                            </tr>
                                            <tr>
                                                <td class="num" style="width:80px"><label for="HB-1">红单</label></td>
                                                <td class="num" style="width:30px"><label for="HB-1">01,07,13,19,23,29,35,45</label>
                                                </td>
                                                <td class="odds"><input type="number" name="aOdds[h1]" value="<?= $val['h1']; ?>">
                                                </td>
                                                <td class="num" style="width:80px"><label for="HB-2">红双</label></td>
                                                <td class="num" style="width:30px"><label for="HB-2">02,08,12,18,24,30,34,40,46</label>
                                                </td>
                                                <td class="odds"><input type="number" name="aOdds[h2]" value="<?= $val['h2']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="num" style="width:30px"><label for="HB-3">红大</label></td>
                                                <td class="num" style="width:160px"><label for="HB-3">29,30,34,35,40,45,46</label>
                                                </td>
                                                <td class="odds" style="width:80px"><input type="number" name="aOdds[h3]"
                                                                                           value="<?= $val['h3']; ?>">
                                                </td>
                                                <td class="num" style="width:30px"><label for="HB-4">红小</label></td>
                                                <td class="num" style="width:30px"><label for="HB-4">01,02,07,08,12,13,18,19,23,24</label>
                                                </td>
                                                <td class="odds"><input type="number" name="aOdds[h4]" value="<?= $val['h4']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="num" style="width:30px"><label for="HB-5">绿单</label></td>
                                                <td class="num" style="width:30px"><label for="HB-5">05,11,17,21,27,33,39,43</label>
                                                </td>
                                                <td class="odds"><input type="number" name="aOdds[h5]" value="<?= $val['h5']; ?>">
                                                </td>
                                                <td class="num" style="width:30px"><label for="HB-6">绿双</label></td>
                                                <td class="num" style="width:30px"><label for="HB-6">06,16,22,28,32,38,44</label>
                                                </td>
                                                <td class="odds"><input type="number" name="aOdds[h6]" value="<?= $val['h6']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="num" style="width:30px"><label for="HB-7">绿大</label></td>
                                                <td class="num" style="width:30px"><label for="HB-7">27,28,32,33,38,39,43,44</label>
                                                </td>
                                                <td class="odds"><input type="number" name="aOdds[h7]" value="<?= $val['h7']; ?>">
                                                </td>
                                                <td class="num" style="width:30px"><label for="HB-8">绿小</label></td>
                                                <td class="num" style="width:30px"><label for="HB-8">05,06,11,16,17,21,22</label>
                                                </td>
                                                <td class="odds"><input type="number" name="aOdds[h8]" value="<?= $val['h8']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="num" style="width:30px"><label for="HB-9">蓝单</label></td>
                                                <td class="num" style="width:30px"><label for="HB-9">03,09,15,25,31,37,41,47</label>
                                                </td>
                                                <td class="odds" style="width:80px"><input type="number" name="aOdds[h9]"
                                                                                           value="<?= $val['h9']; ?>">
                                                </td>
                                                <td class="num" style="width:30px"><label for="HB-10">蓝双</label></td>
                                                <td class="num" style="width:30px"><label for="HB-10">04,10,14,20,26,36,42,48</label>
                                                </td>
                                                <td class="odds"><input type="number" name="aOdds[h10]" value="<?= $val['h10']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="num" style="width:30px"><label for="HB-11">蓝大</label></td>
                                                <td class="num" style="width:30px"><label for="HB-11">25,26,31,36,37,41,42,47,48</label>
                                                </td>
                                                <td class="odds"><input type="number" name="aOdds[h11]" value="<?= $val['h11']; ?>">
                                                </td>
                                                <td class="num" style="width:30px"><label for="HB-12">蓝小</label></td>
                                                <td class="num" style="width:160px"><label for="HB-12">03,04,09,10,14,15,20</label>
                                                </td>
                                                <td class="odds" style="width:80px"><input type="number" name="aOdds[h12]" value="<?= $val['h12']; ?>">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="round-table">
                                        <table class="GameTable">
                                            <tbody>
                                            <tr class="title_line">
                                                <td>半半波</td>
                                                <td>号码</td>
                                                <td>赔率</td>
                                                <td>半半波</td>
                                                <td>号码</td>
                                                <td>赔率</td>
                                            </tr>
                                            <tr>
                                                <td class="num" style="width:30px"><label for="HB-13">红大单</label></td>
                                                <td class="num" style="width:30px"><label for="HB-13">29,35,45</label>
                                                </td>
                                                <td class="odds"><input type="number" name="aOdds[h13]" value="<?= $val['h13']; ?>">
                                                </td>
                                                <td class="num" style="width:30px"><label for="HB-14">红大双</label></td>
                                                <td class="num" style="width:30px"><label
                                                        for="HB-14">30,34,40,46</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h14]" value="<?= $val['h14']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="num" style="width:30px"><label for="HB-15">红小单</label></td>
                                                <td class="num" style="width:160px"><label
                                                        for="HB-15">01,07,13,19,23</label></td>
                                                <td class="odds" style="width:80px"><input type="number" name="aOdds[h15]"
                                                                                           value="<?= $val['h15']; ?>">
                                                </td>
                                                <td class="num" style="width:30px"><label for="HB-16">红小双</label></td>
                                                <td class="num" style="width:30px"><label
                                                        for="HB-16">02,08,12,18,24</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h16]" value="<?= $val['h16']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="num" style="width:30px"><label for="HB-17">绿大单</label></td>
                                                <td class="num" style="width:30px"><label
                                                        for="HB-17">27,33,39,43</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h17]" value="<?= $val['h17']; ?>">
                                                </td>
                                                <td class="num" style="width:30px"><label for="HB-18">绿大双</label></td>
                                                <td class="num" style="width:30px"><label
                                                        for="HB-18">28,32,38,44</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h18]" value="<?= $val['h18']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="num" style="width:30px"><label for="HB-19">绿小单</label></td>
                                                <td class="num" style="width:30px"><label
                                                        for="HB-19">05,11,17,21</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h19]" value="<?= $val['h19']; ?>">
                                                </td>
                                                <td class="num" style="width:30px"><label for="HB-20">绿小双</label></td>
                                                <td class="num" style="width:30px"><label for="HB-20">06,16,22</label>
                                                </td>
                                                <td class="odds"><input type="number" name="aOdds[h20]" value="<?= $val['h20']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="num" style="width:30px"><label for="HB-21">蓝大单</label></td>
                                                <td class="num" style="width:30px"><label
                                                        for="HB-21">25,31,37,41,47</label></td>
                                                <td class="odds" style="width:80px"><input type="number" name="aOdds[h21]"
                                                                                           value="<?= $val['h21']; ?>">
                                                </td>
                                                <td class="num" style="width:30px"><label for="HB-22">蓝大双</label></td>
                                                <td class="num" style="width:30px"><label
                                                        for="HB-22">26,36,42,48</label></td>
                                                <td class="odds"><input type="number" name="aOdds[h22]" value="<?= $val['h22']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="num" style="width:30px"><label for="HB-23">蓝小单</label></td>
                                                <td class="num" style="width:30px"><label for="HB-23">03,09,15</label>
                                                </td>
                                                <td class="odds"><input type="number" name="aOdds[h23]" value="<?= $val['h23']; ?>">
                                                </td>
                                                <td class="num" style="width:30px"><label for="HB-24">蓝小双</label></td>
                                                <td class="num" style="width:160px"><label
                                                        for="HB-24">04,10,14,20</label></td>
                                                <td class="odds" style="width:80px"><input type="number" name="aOdds[h24]"
                                                                                           value="<?= $val['h24']; ?>">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                   
                                    <div id="SendB5">
                                        <input type="hidden" name="sub_type" value="<?= $key; ?>">
                                        <input type="hidden" name="ball_type" value="<?=$val['ball_type'];?>">
                                        <button id="btn-save-odds" class="order" data-herf="#/six/odds/sebo">保存</button>
                                    </div>
                                    <p>
                                    <span>请输入修改密码 : <input name="superpassword" type="password" value="" /></span>
                                    </p>
                                </form>
                            </div>
                        <?php }
                    }
                }?>
            </div>
        </div>
    </div>
</div>