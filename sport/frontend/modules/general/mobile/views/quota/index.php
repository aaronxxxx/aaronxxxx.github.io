<!-- <script src="/public/layer/layer.js"></script> -->
<script src="/public/aomen/js/live_exchange.js"></script>
<main>
    <div class="quota">
        <h3 class="title text-center">快速额度转换</h3>
        <div class="content pb-4">
            <div class="nowMoney">
                <h4 class="text-center pt-2 pb-4">目前额度</h4>
                <p class="quotaText">BB体育需额度转转入 AG_BBIN娱乐场；AG体育、AG捕鱼、AG电子及YOPLAY街机额度转入AG国际厅</p>
                <table class="MMain text-center" cellspacing="0">
                    <thead>
                    <tr>
                        <th width="22%">类型</th>
                        <th width="31%">帐户</th>
                        <th width="28%">余额一键操作</th>
                        <th width="19%">更新时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>主账户</td>
                        <td><?= $data['user']['name'] ?></td>
                        <td>
                            <span id="credit">
                                <?= $data['user']['money'] ?>
                            </span>
                        </td>
                        <td>
                            <?= date("Y-m-d H:i", time()) ?>
                        </td>
                    </tr>
                    <!--  VG棋牌-->
                    <tr>
                        <td >VG棋牌</td>
                        <td >
                            <span id="name_kg">
                                正在同步中...
                            </span>
                        </td>
                        <td >
                            <span id="credit_kg">
                                正在同步中...
                            </span>
                            </br>
                            <button class="btn" onclick="return confirmChangeAllMoney('in','15','<?= (int)$data['user']['money'] ?>')">转入</button>
                            <button class="btn" onclick="return confirmChangeAllMoney('out','16','credit_kg')">转出</button>
                        </td>
                        <td >
                            <span id="time_kg">
                                正在同步中...
                            </span>
                    </tr>
                    <!-- VR彩票 -->
                    <tr>
                        <td >VR彩票</td>
                        <td >
                            <span id="name_vr">
                                正在同步中...
                            </span>
                        </td>
                        <td >
                            <span id="credit_vr">
                                正在同步中...
                            </span>
                            </br>
                            <button class="btn" onclick="return confirmChangeAllMoney('in','19','<?= (int)$data['user']['money'] ?>')">转入</button>
                            <button class="btn" onclick="return confirmChangeAllMoney('out','20','credit_vr')">转出</button>
                        </td>
                        <td >
                            <span id="time_vr">
                                正在同步中...
                            </span>
                    </tr>
                    <!-- AGIN国际厅 -->
                    <tr>
                        <td >AGIN国际厅</td>
                        <td >
                            <span id="name_agin">
                                正在同步中...
                            </span>
                        </td>
                        <td >
                            <span id="credit_agin">
                                正在同步中...
                            </span>
                            </br>
                            <button class="btn" onclick="return confirmChangeAllMoney('in','3','<?= (int)$data['user']['money'] ?>')">转入</button>
                            <button class="btn" onclick="return confirmChangeAllMoney('out','4','credit_agin')">转出</button>
                        </td>
                        <td >
                            <span id="time_agin">
                                正在同步中...
                            </span>
                        </td>
                    </tr>
                    <!-- BBIN波音厅 -->
                    <tr>
                        <td >BBIN波音厅</td>
                        <td >
                            <span id="name_ag_bbin">
                                正在同步中...
                            </span>
                        </td>
                        <td >
                            <span id="credit_ag_bbin">
                                正在同步中...
                            </span>
                            </br>
                            <button class="btn" onclick="return confirmChangeAllMoney('in','5','<?= (int)$data['user']['money'] ?>')">转入</button>
                            <button class="btn" onclick="return confirmChangeAllMoney('out','6','credit_ag_bbin')">转出</button>
                        </td>
                        <td >
                            <span id="time_ag_bbin">
                                正在同步中...
                            </span>
                        </td>
                    </tr>
                    <!--DS贵宾厅  -->
                    <tr>
                        <td >DS贵宾厅</td>
                        <td >
                            <span id="name_ds">
                                正在同步中...
                            </span>
                        </td>
                        <td >
                            <span id="credit_ds">
                                正在同步中...
                            </span>
                            </br>
                            <button class="btn" onclick="return confirmChangeAllMoney('in','7','<?= (int)$data['user']['money'] ?>')">转入</button>
                            <button class="btn" onclick="return confirmChangeAllMoney('out','8','credit_ds')">转出</button>
                        </td>
                        <td >
                            <span id="time_ds">
                                正在同步中...
                            </span>
                        </td>
                    </tr>
                    <!--OG东方厅-->
                    <tr>
                        <td >OG东方厅</td>
                        <td >
                            <span id="name_og">
                                正在同步中...
                            </span>
                        </td>
                        <td >
                            <span id="credit_og">
                                正在同步中...
                            </span>
                            </br>
                            <button class="btn" onclick="return confirmChangeAllMoney('in','13','<?= (int)$data['user']['money'] ?>')">转入</button>
                            <button class="btn" onclick="return confirmChangeAllMoney('out','14','credit_og')">转出</button>
                        </td>
                        <td >
                            <span id="time_og">
                                正在同步中...
                            </span>
                    </tr>
                    <!-- pt电子 -->
                    <tr>
                        <td >PT厅</td>
                        <td >
                            <span id="name_pt">
                                正在同步中...
                            </span>
                        </td>
                        <td >
                            <span id="credit_pt">
                                正在同步中...
                            </span>
                            </br>
                            <button class="btn" onclick="return confirmChangeAllMoney('in','17','<?= (int)$data['user']['money'] ?>')">转入</button>
                            <button class="btn" onclick="return confirmChangeAllMoney('out','18','credit_pt')">转出</button>
                        </td>
                        <td >
                            <span id="time_og">
                                正在同步中...
                            </span>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="inputTab text-center pt-2 pb-2">
                <h3>手动输入转换</h3>
                <ul id="inputTab" class="d-flex justify-content-center pt-3">
                    <li class="tab pt-1 pb-1 pl-4 pr-4 act"><a href="#money_in"> 转入</a></li>
                    <li class="tab pt-1 pb-1 pl-4 pr-4"><a href="#money_out">转出</a> </li>
                </ul>
            </div>
            <div class="tabinner">
                <div id="money_in" class="tabItem">
                    <section class="moneyItem d-flex justify-content-between pb-2">
                        <p class="myMoney pt-2 pb-2 text-center">我的钱包</p> 
                        <span class="arrow">&#8594;</span>
                        <select name="zz_type_in" id="zz_type_in">
                            <option value="15">VG棋牌</option>
                            <option value="19">VR彩票</option>
                            <option value="3">AGIN国际厅</option>
                            <option value="5">BBIN波音厅</option>
                            <option value="7">DS贵宾厅</option>
                            <option value="13">OG东方厅</option>
                            <option value="17">PT厅</option>
                        </select>
                    </section>
                    <section class="moneyItem d-flex justify-content-between">
                        <p class="pt-2 pb-2 ">转帐金额</p>
                        <input class="inputMoney pt-2 pb-2 pl-1" type="text" name="zz_money_in" id="zz_money_in" onkeyup="if (isNaN(this.value)) execCommand('undo')"  placeholder="最低金额:$<?= $data['min_limit'] ?>">
                        <input class="inputMoneyBtn pt-2 pb-2 "  type="button" id="btn_int" onclick="return confirmChangeMoney('in');" value="确认转账">
                    </section>
                </div>
                <div id="money_out" class="tabItem" style="display:none;">
                    <section class="moneyItem d-flex justify-content-between pb-2">
                        <select name="zz_type_out" id="zz_type_out">
                            <option value="16">VG棋牌</option>
                            <option value="20">VR彩票</option>
                            <option value="4">AGIN国际厅</option>
                            <option value="6">BBIN波音厅</option>
                            <option value="8">DS贵宾厅</option>
                            <option value="14">OG东方厅</option>
                            <option value="18">PT厅</option>
                        </select>
                        <span class="arrow">&#8594;</span>
                        <p class="myMoney pt-2 pb-2 text-center">我的钱包</p> 
                    </section>
                    <section class="moneyItem d-flex justify-content-between">
                        <p class="pt-2 pb-2 ">转帐金额</p>
                        <input class="inputMoney pt-2 pb-2 pl-1" name="zz_money_out" id="zz_money_out" onkeyup="if (isNaN(this.value)) execCommand('undo')"  placeholder="最低金额:$<?= $data['min_limit'] ?>">
                        <input class="inputMoneyBtn pt-2 pb-2 " type="button" id="btn_out" onclick="return confirmChangeMoney('out');"value="确认转账" >
                    </section>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
$(document).ready(function () {
    $('#inputTab .tab').click(function () {
        var tabinner = $(this).find('a').attr('href');
        $(this).addClass('act').siblings().removeClass('act');
        $('.tabinner').find(tabinner).show().siblings().hide();
    })
})
</script>