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
                <a href="#/six/odds/lian-xiao" title="连肖">连肖</a>
                <a href="#/six/odds/lian-wei" title="连尾">连尾</a>
                <a href="#/six/odds/sheng-xiao" title="生肖">生肖</a>
                <a href="#/six/odds/sebo" title="色波">色波</a>
                <a href="#/six/odds/tou-wei" class="NowPlay" title="头尾数">头尾数</a>
            </div>
        </div>
    </div>
    <div id="tab" style="display: block;" class="tab_type">
        <ul>
            <li class="onTagClick"><span class="SPA"><b>头尾数</b></span></li>
            <li class="unTagClick"><span class="SPB"><b>平特尾数</b></span></li>
            <li id="space"></li>
        </ul>
    </div>
    <div id="Game">
        <div id="SPA" class="showT" style="width: 120%;">
            <form id="formLhc" name="D3_018" action="/?r=six/odds/tou-wei" method="post">
                <div class="round-table">
                    <table class="GameTable">
                        <tbody>
                        <tr class="title_line">
                            <td style="width:30px">特码头数</td>
                        </tr>
                        <tr>
                            <td class="num" style="width:30px"><label for="SPA-13">头0</label></td>
                            <td class="odds"><input type="number" name="aOdds[h13]" value="<?=$data['SPA']['h13'];?>"></td>
                            <td class="num"><label for="SPA-14">头1</label></td>
                            <td class="odds"><input type="number" name="aOdds[h14]" value="<?=$data['SPA']['h14'];?>"></td>
                            <td class="num"><label for="SPA-15">头2</label></td>
                            <td class="odds"><input type="number" name="aOdds[h15]" value="<?=$data['SPA']['h15'];?>"></td>
                            <td class="num"><label for="SPA-16">头3</label></td>
                            <td class="odds"><input type="number" name="aOdds[h16]" value="<?=$data['SPA']['h16'];?>"></td>
                            <td class="num"><label for="SPA-17">头4</label></td>
                            <td class="odds"><input type="number" name="aOdds[h17]" value="<?=$data['SPA']['h17'];?>"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="round-table" >
                    <table class="GameTable">
                        <tbody>
                        <tr class="title_line">
                            <td style="width:30px">特码尾数</td>
                        </tr>
                        <tr>
                            <td class="num" style="width:30px"><label for="SPA-18">尾0</label></td>
                            <td class="odds"><input type="number" name="aOdds[h18]" value="<?=$data['SPA']['h18'];?>"></td>
                            <td class="num"><label for="SPA-19">尾1</label></td>
                            <td class="odds"><input type="number" name="aOdds[h19]" value="<?=$data['SPA']['h19'];?>"></td>
                            <td class="num"><label for="SPA-20">尾2</label></td>
                            <td class="odds"><input type="number" name="aOdds[h20]" value="<?=$data['SPA']['h20'];?>"></td>
                            <td class="num"><label for="SPA-21">尾3</label></td>
                            <td class="odds"><input type="number" name="aOdds[h21]" value="<?=$data['SPA']['h21'];?>"></td>
                            <td class="num"><label for="SPA-22">尾4</label></td>
                            <td class="odds"><input type="number" name="aOdds[h22]" value="<?=$data['SPA']['h22'];?>"></td>
                        </tr>
                        <tr>
                            <td class="num" style="width:30px"><label for="SPA-23">尾5</label></td>
                            <td class="odds"><input type="number" name="aOdds[h23]" value="<?=$data['SPA']['h23'];?>"></td>
                            <td class="num"><label for="SPA-24">尾6</label></td>
                            <td class="odds"><input type="number" name="aOdds[h24]" value="<?=$data['SPA']['h24'];?>"></td>
                            <td class="num"><label for="SPA-25">尾7</label></td>
                            <td class="odds"><input type="number" name="aOdds[h25]" value="<?=$data['SPA']['h25'];?>"></td>
                            <td class="num"><label for="SPA-26">尾8</label></td>
                            <td class="odds"><input type="number" name="aOdds[h26]" value="<?=$data['SPA']['h26'];?>"></td>
                            <td class="num"><label for="SPA-27">尾9</label></td>
                            <td class="odds"><input type="number" name="aOdds[h27]" value="<?=$data['SPA']['h27'];?>"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div id="SendB5">
                    <input type="hidden" name="sub_type" value="SPA">
                    <button id="btn-save-odds" class="order" data-herf="#/six/odds/tou-wei">保存</button>
                </div>
            </form>
        </div>
        <div id="SPB" style="display:none;width: 120%" class="showT">
            <form id="formLhc" name="D3_018" action="/?r=six/odds/tou-wei" method="post">
                <div class="round-table">
                <table class="GameTable">
                    <tbody>
                    <tr class="title_line">
                        <td style="width:30px">平特尾数</td>
                    </tr>
                    <tr>
                        <td class="num" style="width:30px"><label for="SPB-13">尾0</label></td>
                        <td class="odds"><input type="number" name="aOdds[h13]" value="<?=$data['SPB']['h13'];?>"></td>
                        <td class="num"><label for="SPB-14">尾1</label></td>
                        <td class="odds"><input type="number" name="aOdds[h14]" value="<?=$data['SPB']['h14'];?>"></td>
                        <td class="num"><label for="SPB-15">尾2</label></td>
                        <td class="odds"><input type="number" name="aOdds[h15]" value="<?=$data['SPB']['h15'];?>"></td>
                        <td class="num"><label for="SPB-16">尾3</label></td>
                        <td class="odds"><input type="number" name="aOdds[h16]" value="<?=$data['SPB']['h16'];?>"></td>
                        <td class="num"><label for="SPB-17">尾4</label></td>
                        <td class="odds"><input type="number" name="aOdds[h17]" value="<?=$data['SPB']['h17'];?>"></td>
                    </tr>
                    <tr>
                        <td class="num" style="width:30px"><label for="SPB-18">尾5</label></td>
                        <td class="odds"><input type="number" name="aOdds[h18]" value="<?=$data['SPB']['h18'];?>"></td>
                        <td class="num"><label for="SPB-19">尾6</label></td>
                        <td class="odds"><input type="number" name="aOdds[h19]" value="<?=$data['SPB']['h19'];?>"></td>
                        <td class="num"><label for="SPB-20">尾7</label></td>
                        <td class="odds"><input type="number" name="aOdds[h20]" value="<?=$data['SPB']['h20'];?>"></td>
                        <td class="num"><label for="SPB-21">尾8</label></td>
                        <td class="odds"><input type="number" name="aOdds[h21]" value="<?=$data['SPB']['h21'];?>"></td>
                        <td class="num"><label for="SPB-22">尾9</label></td>
                        <td class="odds"><input type="number" name="aOdds[h22]" value="<?=$data['SPB']['h22'];?>"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
                <div id="SendB5">
                    <input type="hidden" name="sub_type" value="SPB">
                    <button id="btn-save-odds" class="order" data-herf="#/six/odds/tou-wei">保存</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>
</div>