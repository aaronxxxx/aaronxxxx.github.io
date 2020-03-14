<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>代理详细信息展示</title>

        <script language='javascript' src='/public/agent/js/agent.js'></script>
    </head>
    <body>
        <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
            <tbody>
                <tr>
                    <td height="24" nowrap=""><font>&nbsp;<span class="STYLE2">代理管理：编辑代理信息</span></font></td>
                </tr>
                <tr>
                    <td height="24" align="center" nowrap="" bgcolor="#FFFFFF"><br>
                        <form class="trinput font14 "  method="post" name="form1" id="form1">
                            <div class="trinput font15 addgents ">
                                <div class="item">
                                    <span class="name">用户名</span>
                                    <input name="agents_name" id="agents_name" value="<?= $agents_list['agents_name'] ?>">
                                </div>
                                <div class="item">
                                    <span class="name">密码</span>
                                    <input name="agents_pass" readonly="" id="agents_pass" value="<?= $agents_list['agents_pass'] ?>">
                                    <span class="gs">*此处显示为加密之后的密码</span>
                                </div>
                                <div class="item">
                                    <span class="name">代理域名</span>
                                    <input name="agent_url" id="agent_url" value="<?= $agents_list['agent_url'] ?>" size="50">
                                    可以设置多个代理域名，用英文逗号隔开。
                                </div>
                                <div class="item">
                                    <span class="name">生日</span>
                                    <input class="laydate-icon" name="birthday" id="birthday" value="<?= $agents_list['birthday'] ?>" onfocus="WdatePicker({isShowClear:true, readOnly:true, dateFmt: 'yyyy-MM-dd HH:mm:ss'})" readonly="readonly">
                                </div>
                                <div class="item">
                                    <span class="name">手机</span>
                                    <input type="text" name="tel"id="tel" value="<?= $agents_list['tel'] ?>" maxlength="11"> </div>
                                <div class="item">
                                    <span class="name">email</span>
                                    <input type="text" name="email" id="email" value="<?= $agents_list['email'] ?>"> </div>
                                <div class="item">
                                    <span class="name">QQ</span>
                                    <input type="text" name="qq" id="qq" value="<?= $agents_list['qq'] ?>"> </div>
                                <div class="item">
                                    <span class="name">其他联系信息</span>
                                    <input type="text" name="othercon" id="othercon" value="<?= $agents_list['othercon'] ?>"> </div>
                                <div class="item">
                                    <span class="name">上級代理</span>
                                    <input type="text" name="othercon" id="othercon" value="<?= $agents_list['agent_top_name'] ?>" readonly> </div>
                                <div class="item">
                                    <span class="name">注册时间</span>
                                    <span class="namp">  <?= $agents_list['regtime'] ?></span> </div>
                                <div class="item">
                                    <span class="name">最后登录时间</span>
                                    <span class="namp">  <?= $agents_list['logintime'] ?></span> </div>
                                <div class="item">
                                    <span class="name">最后登录IP</span>
                                    <span class="namp">  <?= $agents_list['loginip'] ?></span> </div>
                                <div class="item">
                                    <span class="name">总登录次数</span>
                                    <span class="namp">  <?= $agents_list['lognum'] ?></span>
                                </div>
                                <div class="item">
                                    <span class="name">代理类型</span>
                                    <select name="agents_type" id="agents_type" disabled><!-- 不可修改跟著總代  -->
                                        <option value="<?= $agents_list['agents_type']; ?>"><?= $agents_list['agents_type']; ?></option>
<!--                                        <option value="流水分成" --><?php //if ($agents_list['agents_type'] == '流水分成') echo 'selected'; ?><!-->流水分成</option>-->
<!--                                        <option value="赢利分成" --><?php //if ($agents_list['agents_type'] == '赢利分成') echo 'selected'; ?><!-->赢利分成</option>-->
                                    </select>
                                    <span class="namp">※不可更動，跟隨總代</span>
                                </div>
                                <div class="item">
                                    <span class="name">代理等级1</span>

                                    <input type="text" name="total_1_1" id='total_1_1' value="<?= $agents_list['total_1_1'] ?>" size="10" readonly="">
                                    <span class="ji">~</span><input type="text" name="total_1_2" id='total_1_2' value="<?= $agents_list['total_1_2'] ?>" size="10" readonly>
                                    <span class="gs"> 代理等级1结算比例(百分比):</span><input type="text" name="total_1_scale" id='total_1_scale' value="<?= $agents_list['total_1_scale'] ?>" size="10">
                                </div>

                                <div class="item">
                                    <span class="name">代理等级2</span>

                                    <input type="text" name="total_2_1" id='total_2_1' value="<?= $agents_list['total_2_1'] ?>" size="10" readonly>
                                    <span class="ji">~</span><input type="text" name="total_2_2" id='total_2_2' value="<?= $agents_list['total_2_2'] ?>" size="10" readonly>
                                    <span class="gs"> 代理等级2结算比例(百分比):</span><input type="text" name="total_2_scale" id='total_2_scale' value="<?= $agents_list['total_2_scale'] ?>" size="10">
                                </div>
                                <div class="item">
                                    <span class="name">代理等级3</span>

                                    <input type="text" name="total_3_1"id='total_3_1' value="<?= $agents_list['total_3_1'] ?>" size="10" readonly>
                                    <span class="ji">~</span><input type="text" name="total_3_2"id='total_3_2' value="<?= $agents_list['total_3_2'] ?>" size="10" readonly>
                                    <span class="gs">代理等级3结算比例(百分比):</span><input type="text" name="total_3_scale"id='total_3_scale' value="<?= $agents_list['total_3_scale'] ?>" size="10">
                                </div>

                                <div class="item">
                                    <span class="name">代理等级4</span>

                                    <input type="text" name="total_4_1" id='total_4_1' value="<?= $agents_list['total_4_1'] ?>" size="10" readonly>
                                    <span class="ji">~</span><input type="text" name="total_4_2"id='total_4_2' value="<?= $agents_list['total_4_2'] ?>" size="10" readonly>
                                    <span class="gs">代理等级4结算比例(百分比):</span><input type="text" name="total_4_scale"id='total_4_scale' value="<?= $agents_list['total_4_scale'] ?>" size="10">
                                </div>
                                <div class ="item">
                                    <span class="name">退水比例(百分比)</span>
                                    <input type="text" name="refunded_scale" id="refunded_scale" value="<?= $agents_list['refunded_scale'] ?>" size="10">
                                </div>
<!--                                <div class="item">-->
<!--                                    <span class="name">代理等级5</span>-->
<!---->
<!--                                    <input type="text" name="total_5_1"id="total_5_1" value="--><?//= $agents_list['total_5_1'] ?><!--" size="10">-->
<!--                                    <span class="ji">~</span><input type="text" name="total_5_2"id='total_5_2' value="--><?//= $agents_list['total_5_2'] ?><!--" size="10">-->
<!--                                    <span class="gs">代理等级5结算比例(百分比):</span><input type="text" name="total_5_scale"id='total_5_scale' value="--><?//= $agents_list['total_5_scale'] ?><!--" size="10">-->
<!--                                </div>-->

                                <div class="item">
                                    <span class="name">代理链接</span>
                                    <input readonly="" type="text" size="100" value="如果你的网址是www.888.com，代理链接为：www.888.com/?r=passport/site&intr=ID  ID需要换成生成后的代理ID。">
                                </div>
                                <div class="item">
                                    <span class="name">备注：</span>
                                    <textarea name="remark" cols="80" rows="5" id="remark" <?php if(empty($agents_list['remark'])){
                                        echo "readonly='readonly'";
                                    }?>><?= $agents_list['remark'] ?></textarea>
                                </div>


                                <div class="item  agenbtnct">
                                    <div class="ct">
                                        <input id='agents_id' type="hidden" value="<?= $agents_list['id']; ?>">
                                        <input id='agent_level' type="hidden" value="<?= $agents_list['agent_level']; ?>">
                                        <input type="button" value="确认提交" id="update_button"> 　
                                        <input type="button" value="返 回" onclick="location.href='#/agent/index/list'">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>