
             <div class="pro_title pd10">代理管理：新增代理信息</div>
                <form class="trinput font14 " action="#/agent/index/add-agent" method="post">
                    <div class="trinput font15 addgents ">
                        <div class="item">
                            <span class="name">请选择總代理</span>
                            <select class="agent_level" id="agent_level" name="agent_level" onchange="ajaxGetAgentsType()">
                                <option value=''>请选择</option>
                                <?php foreach($agent_level as $key => $top_agents){
                                    ?>
                                    <option value='<?php echo $top_agents['id']; ?>'><?php echo $top_agents['agents_name'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="item">
                            <span class="name">用户名</span>
                            <input name="agents_name" id="agents_name" value="">
                        </div>
                        <div class="item">
                            <span class="name">密码</span>
                            <input name="agents_pass" id="agents_pass" value="">
                        </div>
                        <div class="item">
                            <span class="name">代理域名</span>
                            <input name="agent_url" id="agent_url" value="" size="50">
                            可以设置多个代理域名，用英文逗号隔开。
                        </div>
                        <div class="item">
                            <span class="name">生日</span>
                            <input class="laydate-icon" name="birthday" id="birthday" value="<?= date('Y-m-d H:i:s') ?>" onfocus="WdatePicker({isShowClear:true, readOnly:true, dateFmt: 'yyyy-MM-dd HH:mm:ss'})" readonly="readonly"><span class="gs"> * 格式：0000-00-00 00:00:00</span>
                        </div>
                        <div class="item">
                            <span class="name">手机</span>
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
                            <span class="name">其他联系信息</span>
                            <input type="text" name="othercon"  id="othercon" value="">
                        </div>
                        <div class="item">
                            <span class="name">理代类型</span>
                            <input type="text" name="agents_type"  size="10" id="agents_type" value="" readonly>
<!--                            <select name="agents_type" id="agents_type">-->
<!--                                <option value="流水分成">流水分成</option>-->
<!--                                <option value="赢利分成">赢利分成</option>-->
<!--                            </select>-->
                            <span class="namp">※不可更動，跟隨總代</span>
                        </div>
                        <div class="item">
                            <span class="name">代理等级1</span>
                            <input type="text" name="total_1_1" id="total_1_1" value="0" size="10" readonly><span class="ji">~</span><input type="text" name="total_1_2" id="total_1_2" value="9999" size="10" readonly>
                            <span class="gs">代理等级1结算比例(百分比):</span><input type="text" name="total_1_scale" id="total_1_scale" value="5" size="10">
                        </div>
                        <div class="item">
                            <span class="name">代理等级2</span>
                            <input type="text" name="total_2_1" id="total_2_1" value="10000" size="10" readonly><span class="ji">~</span><input type="text" name="total_2_2" id="total_2_2" value="99999" size="10" readonly>
                            <span class="gs">代理等级2结算比例(百分比):</span><input type="text" name="total_2_scale"  id="total_2_scale" value="10" size="10">
                        </div>
                        <div class="item">
                            <span class="name">代理等级3</span>
                            <input type="text" name="total_3_1" id="total_3_1" value="100000" size="10" readonly><span class="ji">~</span><input type="text" name="total_3_2" id="total_3_2" value="999999" size="10" readonly>
                            <span class="gs">代理等级3结算比例(百分比):</span><input type="text" name="total_3_scale" id="total_3_scale" value="20" size="10">
                        </div>
                        <div class="item">
                            <span class="name">代理等级4</span>
                            <input type="text" name="total_4_1" id="total_4_1" value="1000000" size="10" readonly><span class="ji">~</span><input type="text" name="total_4_2" id="total_4_2" value="9999999" size="10" readonly>
                            <span class="gs">代理等级4结算比例(百分比):</span><input type="text" name="total_4_scale" id="total_4_scale" value="30" size="10">
                        </div>
<!--                        <div class="item">-->
<!--                            <span class="name">代理等级5</span>-->
<!--                            <input type="text" name="total_5_1" id="total_5_1" value="10000000" size="10"><span class="ji">~</span><input type="text" name="total_5_2" id="total_5_2" value="99999999" size="10">-->
<!--                            <span class="gs">代理等级5结算比例(百分比):</span><input type="text" name="total_5_scale" id="total_5_scale" value="40" size="10">-->
<!--                        </div>-->
                        <div class ="item">
                            <span class="gs">退水比例(百分比):</span><input type="text" name="refunded_scale" id="refunded_scale" value="12" size="10">
                        </div>
                        <div class="item">
                            <span class="name">代理链接</span>
                            <input readonly="" type="text" size="100" value="如果你的网址是www.888.com，代理链接为：www.888.com/?r=passport/site&intr=ID  ID需要换成生成后的代理ID。">
                        </div>
                        <div class="item">
                            <span class="name">备注</span>
                            <textarea name="remark" cols="80" rows="5" id="remark" disabled="disabled"></textarea>
                        </div>
                        <div class="item  agenbtnct">
                            <div class="ct">
                            <input name="id" type="hidden" value="">
                            <input id="add_button" type="button" value="确认提交">
                            <input type="button" value="取 消" onclick="javascript: history.go(-1)">
                            </div>
                        </div>
                    </div>
                </form>

<script language='javascript' src='/public/agent/js/agent.js'></script>
 <script>
     function ajaxGetAgentsType()
     {
         var agent_id = $('#agent_level').val();
         $.ajax({
             url: '?r=agent/index/getagentstype',
             type: 'post',
             data: {
                 agent_id: agent_id
             },
             success: function(data) {
                 if (data) {
                     $('#agents_type').val(data);
                 }
             }
         });
     }
 </script>