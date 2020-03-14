<?php

use yii\widgets\LinkPager;
?>
<script type="text/javascript" language="javascript" src="/public/agent/js/agent.js"></script>

              <div class="pro_title pd10">
                    代理管理：查看代理的信息
              </div>
                <form class="trinput font14  pd10 pt10" id="gridSearchForm" action="#/agent/index/list" method="get" name="gridSearchBtn" >
                    综合类型：
                    <select id="selecttype" name="selecttype">
                        <option <?php
                        if ($getNews['selecttype'] == 'agents_name') {
                            echo 'selected';
                        };
                        ?> value="agents_name">用户名</option>
                        <option <?php
                        if ($getNews['selecttype'] == 'loginip') {
                            echo 'selected';
                        };
                        ?> value="loginip">登入IP</option>
                        <option <?php
                        if ($getNews['selecttype'] == 'tel') {
                            echo 'selected';
                        };
                        ?> value="tel">手机号码</option>
                    </select>
                    内容：<input id="news" name="news" type="text" value="<?php echo $getNews['news'] ?>" >
                    <input  id="gridSearchBtn" type="button" value="搜索" name="submit">
                </form>
             
                <form  name="form2" style="margin:0 0 0 0;" id="form2" action="">
                    <input type="hidden" name="r" value="agent/index/add-agent">
                    <table width="100%" class="trinput mgb5 font15">
                        <td width="104"><a href="#/agent/index/list-type&isonline=1" style="color: #F37605;">在线代理</a></td>
                        <td width="104"><a href="#/agent/index/list-type&is_stop=异常" style="color: #F37605">异常代理</a></td>
                        <td width="104"><a href="#/agent/index/list-type&is_stop=停用" style="color: #F37605">停用代理</a></td>
                        <td width="104"><a href="#/agent/index/list" style="color: #F37605">全部代理</a></td>
                        <td width="104"><a href="#/agent/index/list-type&remark=0" style="color: #F37605">待审核代理</a></td>
                        <td width="254" align="right"><a href="#/agent/index/add-agent&code=1" style="color: #F37605">新增代理</a></td>
                        <td width="165" align="right">
                            <span style="color: #FF0000;font-size: 12px;">相关操作：</span>
                            <select name="s_action" id="s_action">
                                <option value="0" selected="selected">选择确认</option>
                                <option value="2">启用代理</option>
                                <option value="1">停用代理</option>
                                <option value="5">修改密码</option>
                                <option value="3">审核处理</option>
                                <option value="4">删除代理</option>
                                <option value="6">添加上層代理</option>
                            </select>
                            <input type="button" onclick="agent_check()" name="submit2" value="执行"/>
                        </td>
                    </table>
                    <!--    -->
                    <table width="100%" border="0" cellpadding="3" cellspacing="1">
                        <td>
                            <table width="100%"   cellspacing="0" cellpadding="0" class="font13 dailis skintable"   id=editProduct   idth="100%" >
                                <tr  class="t-title dailitr" >
                                    <td width="5%" ><strong>代理ID</strong></td>
                                    <td width="10%" height="20" ><strong>代理名</strong></td>
                                    <td width="10%" ><strong>登陆时间/注册时间</strong></td>
                                    <td width="8%" ><strong>上層代理</strong></td>
                                    <td width="8%" ><strong>登陆 ip</strong></td>
                                    <td width="10%" ><strong>手机号码/邮箱</strong></td>
                                    <td width="5%" ><strong>代理模式</strong></td>
                                    <td width="7%" ><strong>查看下属会员</strong></td>
                                    <td width="7%" ><strong>查看结算明细</strong></td>
                                    <td width="5%" ><strong>结算代理</strong></td>
                                    <td width="5%" ><strong>状态</strong></td>
                                    <td width="4%" ><input name="checkall" type="checkbox" id="checkall" onClick="return ckall();"/></td>
                                </tr>
                                <?php
                                foreach ($agents_list as $key => $value) {
                                    ?>
                                    <tr >
                                        <td><?= $value['id'] ?></td>
                                        <td><a href="#/agent/index/agents-news&id=<?= $value['id'] ?>"><span style="color:#F37605;"><?= $value['agents_name'] ?></span></a></td>
                                        <td><?= $value['logintime'] ?><br/><?= $value['regtime'] ?></td>
                                        <td><a href="#/agent/index/list-type&agent_level=<?= $value['agent_level'] ?>"><span style="color:#F37605;"><?= $value['agent_top_name'] ?></td>
                                        <td><?= $value['loginip'] ?></td>
                                        <td><a href="#/agent/index/list-type&tel=<?= $value['tel'] ?>"><span style="color:#F37605; margin-bottom: 8px;"><?= $value['tel'] ?></span></a><?= $value['email'] ?></td>
                                        <td><?= $value['agents_type'] ?></td>
                                        <td><a href="#/agent/report/one-agent&id=<?= $value['id'] ?>"><span style="color:#F37605;">查看下属会员</span></a></td>
                                        <td><a href="#/agent/index/account&id=<?= $value['id'] ?>"><span style="color:#F37605;">查看结算明细</span></a></td>
                                        <td><a href="#/agent/index/agents-jiesuan&id=<?= $value['id'] ?>"><span style="color:#F37605;">结算代理</span></a></td>
                                        <td>
                                            <?= 0 < $value['online'] ? '<span style="color:#FF00FF;">在线</span>' : '<span style="color:#999999;">离线</span>'; ?>

                                            <?= $value['status'] == '停用' ? '<span style="color:#FF00FF;">停用</span>' : ($value['status'] == '异常' ? '<span style="color:#FF00FF;">异常</span>' : '<span style="color:#006600;">正常</span>'); ?>
                                        </td>
                                        <td><input name="uid[]" type="checkbox" id="uid[]" value="<?= $value['id'] ?>"></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </td>
                    </table>
                    <?= LinkPager::widget(['pagination' => $pages]); ?>
                </form>
    
</table>
<script>
    //全選
    function ckall(){
        for (var i=0;i<document.form2.elements.length;i++){
            var e = document.form2.elements[i];
            if (e.name != 'checkall') e.checked = document.form2.checkall.checked;
        }
    }
</script>