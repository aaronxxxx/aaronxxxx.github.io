
             <div class="pro_title pd10">代理管理：新增代理信息</div>
                <form class="trinput font14 " action="#/agent/index/add-agent" method="post">
                    <div class="trinput font15 addgents ">
                        <div class="item">
                            <span class="name">總代理</span>
                            <input name="agent_level" id="agent_level" value="<?= Yii::$app->session['S_USER_NAME']; ?>" readonly>
                        </div>
                        <div class="item">
                            <span class="name">用戶名</span>
                            <input name="agents_name" id="agents_name" value="">
                        </div>
                        <div class="item">
                            <span class="name">密碼</span>
                            <input name="agents_pass" id="agents_pass" value="">
                        </div>
                        <div class="item" style="display:none;">
                            <span class="name">代理域名</span>
                            <input name="agent_url" id="agent_url" value="" size="50">
                            設置多個域名","間隔。
                        </div>
                        <div class="item">
                            <span class="name">生日</span>
                            <input class="laydate-icon" name="birthday" id="birthday" value="<?= date('Y-m-d H:i:s') ?>" onfocus="WdatePicker({isShowClear:true, readOnly:true, dateFmt: 'yyyy-MM-dd HH:mm:ss'})" readonly="readonly"><span class="gs"> * 格式：0000-00-00 00:00:00</span>
                        </div>
                        <div class="item">
                            <span class="name">手機</span>
                            <input type="text" name="tel" id="tel" value="" maxlength="11">
                        </div>
                        <div class="item">
                            <span class="name">email</span>
                            <input type="text" name="email" id="email" value="">
                        </div>
                        <div class="item">
                            <span class="name">QQ</span>
                            <input type="text" name="qq" id="qq" value="">
                        </div>
                        <div class="item">
                            <span class="name">其他聯繫信息</span>
                            <input type="text" name="othercon"  id="othercon" value="">
                        </div>
                        <div class="item">
                            <span class="name">代理類型</span>
                            <select name="agents_type" id="agents_type" disabled>
                                <option value="<?= Yii::$app->session['S_AGENT_TYPE']; ?>"><?= Yii::$app->session['S_AGENT_TYPE']; ?></option>
                            </select>
                            <span class="namp">※不可更動，跟隨總代</span>
                        </div>
                        <div class="item">
                            <span class="name">業績等級1</span>
                            <input type="text" name="total_1_1" id="total_1_1" value="0" size="10"><span class="ji">~</span><input type="text" name="total_1_2" id="total_1_2" value="9999" size="10">
                            <span class="gs">業績等級1結算比例(百分比):</span><input type="text" name="total_1_scale" id="total_1_scale" value="5" size="10">
                        </div>
                        <div class="item">
                            <span class="name">業績等級2</span>
                            <input type="text" name="total_2_1" id="total_2_1" value="10000" size="10"><span class="ji">~</span><input type="text" name="total_2_2" id="total_2_2" value="99999" size="10">
                            <span class="gs">業績等級2結算比例(百分比):</span><input type="text" name="total_2_scale"  id="total_2_scale" value="10" size="10">
                        </div>
                        <div class="item">
                            <span class="name">業績等級3</span>
                            <input type="text" name="total_3_1" id="total_3_1" value="100000" size="10"><span class="ji">~</span><input type="text" name="total_3_2" id="total_3_2" value="999999" size="10">
                            <span class="gs">業績等級3結算比例(百分比):</span><input type="text" name="total_3_scale" id="total_3_scale" value="20" size="10">
                        </div>
                        <div class="item">
                            <span class="name">業績等級4</span>
                            <input type="text" name="total_4_1" id="total_4_1" value="1000000" size="10"><span class="ji">~</span><input type="text" name="total_4_2" id="total_4_2" value="9999999" size="10">
                            <span class="gs">業績等級4結算比例(百分比):</span><input type="text" name="total_4_scale" id="total_4_scale" value="30" size="10">
                        </div>
                        <div class ="item">
                            <span class="gs">退水比例(百分比):</span><input type="text" name="refunded_scale" id="refunded_scale" value="12" size="10">
                        </div>
<!--                        <div class ="item">-->
<!--                            <span class="gs">PK10退水比例(0.009=0.9%):</span><input type="text" name="PK10_return_water" id="PK10_return_water" value="0.009" size="10">-->
<!--                        </div>-->
                        <!-- <div class="item">
                            <span class="name">業績等級5</span>
                            <input type="text" name="total_5_1" id="total_5_1" value="10000000" size="10"><span class="ji">~</span><input type="text" name="total_5_2" id="total_5_2" value="99999999" size="10">
                            <span class="gs">業績等級5結算比例(百分比):</span><input type="text" name="total_5_scale" id="total_5_scale" value="40" size="10">
                        </div> -->
                        <!--
                        <div class="item">
                            <span class="name">代理鏈接</span>
                            <input readonly="" type="text" size="100" value="如果你的網址是www.888.com，代理鏈接為：www.888.com/?r=passport/site&intr=ID  ID需要換成生成後的代理ID。">
                        </div>
                        -->
                        <div class="item">
                            <span class="name">備註</span>
                            <textarea name="remark" cols="80" rows="5" id="remark" disabled="disabled"></textarea>
                        </div>
                        <div class="item  agenbtnct">
                            <div class="ct">
                            <input name="id" type="hidden" value="">
                            <input id="add_button" type="button" value="確認提交">
                            <input type="button" value="取 消" onclick="javascript: history.go(-1)">
                            </div>
                        </div>
                    </div>
                </form>

<!-- <script language='javascript' src='/public/agent/js/agent.js'></script> -->