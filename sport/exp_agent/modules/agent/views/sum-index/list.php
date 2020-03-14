<?php

use yii\widgets\LinkPager;
?>
<script type="text/javascript" language="javascript" src="/public/agent/js/sum_agent.js"></script>

              <div class="pro_title pd10">
                    總代理管理：查看總代理的信息
              </div>
                <form class="trinput font14  pd10 pt10" id="gridSearchForm" action="?r=agent/sum-index/list" method="get" name="gridSearchBtn" >
                    綜合類型：
                    <select id="selecttype" name="selecttype">
                        <option <?php
                        if ($getNews['selecttype'] == 'agents_name') {
                            echo 'selected';
                        };
                        ?> value="agents_name">用戶名</option>
                        <option <?php
                        if ($getNews['selecttype'] == 'loginip') {
                            echo 'selected';
                        };
                        ?> value="loginip">登入IP</option>
                        <option <?php
                        if ($getNews['selecttype'] == 'tel') {
                            echo 'selected';
                        };
                        ?> value="tel">手機號碼</option>
                    </select>
                    內容：<input id="news" name="news" type="text" value="<?php echo $getNews['news'] ?>" >
                    <input  id="gridSearchBtn" type="button" value="搜索" name="submit">
                </form>
             
                <form  name="form2" style="margin:0 0 0 0;" id="form2" action="">
                    <input type="hidden" name="r" value="agent/index/add-agent">
                    <table width="100%" class="trinput mgb5 font15">
                        <td width="104"><a href="?r=agent/sum-index/list-type&isonline=1" style="color: #F37605;">在線總代理</a></td>
                        <td width="104"><a href="?r=agent/sum-index/list-type&is_stop=異常" style="color: #F37605">異常總代理</a></td>
                        <td width="104"><a href="?r=agent/sum-index/list-type&is_stop=停用" style="color: #F37605">停用總代理</a></td>
                        <td width="104"><a href="?r=agent/sum-index/list" style="color: #F37605">全部總代理</a></td>
                        <td width="104"><a href="?r=agent/sum-index/list-type&remark=0" style="color: #F37605">待審核總代理</a></td>
                        <td width="254" align="right"><a href="?r=agent/sum-index/add-agent&code=1" style="color: #F37605">新增總代理</a></td>
                        <td width="165" align="right">
                            <span style="color: #FF0000;font-size: 12px;">相關操作：</span>
                            <select name="s_action" id="s_action">
                                <option value="0" selected="selected">選擇確認</option>
                                <option value="2">啟用總代理</option>
                                <option value="1">停用總代理</option>
                                <option value="5">修改密碼</option>
                                <option value="3">審核處理</option>
                                <!--
                                <option value="4">刪除總代理</option>
                                -->
                            </select>
                            <input type="button" onclick="agent_check()" name="submit2" value="執行"/>
                        </td>
                    </table>
                    <!--    -->
                    <table width="100%" border="0" cellpadding="3" cellspacing="1">
                        <td>
                            <table width="100%"   cellspacing="0" cellpadding="0" class="font13 dailis skintable"   id=editProduct   idth="100%" >
                                <tr  class="t-title dailitr" >
                                    <td width="5%" ><strong>總代理ID</strong></td>
                                    <td width="10%" height="20" ><strong>總代理名</strong></td>
                                    <td width="15%" ><strong>登錄時間/註冊時間</strong></td>
                                    <td width="10%" ><strong>限額/當前餘額</strong></td>
                                    <td width="10%" ><strong>手機號碼/郵箱</strong></td>
                                    <td width="10%" ><strong>總代理模式</strong></td>
                                    <td width="10%" ><strong>查看下屬代理</strong></td>
                                    <td width="10%" ><strong>查看結算明細</strong></td>
                                    <td width="10%" ><strong>結算總代理</strong></td>
                                    <td width="6%" ><strong>狀態</strong></td>
                                    <td width="4%" ><input name="checkall" type="checkbox" id="checkall" onClick="return ckall();"/></td>
                                </tr>
                                <?php
                                foreach ($agents_list as $key => $value) {
                                    ?>
                                    <tr >
                                        <td><?= $value['id'] ?></td>
                                        <td><a href="?r=agent/sum-index/agents-news&id=<?= $value['id'] ?>"><span style="color:#F37605;"><?= $value['agents_name'] ?></span></a></td>
                                        <td><?= $value['logintime'] ?><br/><?= $value['regtime'] ?></td>
                                        <td>
                                            <?= $value['limit_money'] ?>/<?= $value['money'] ?><br/>
                                            <a onclick="add_limit_money(<?= $value['id'] ?>);">增加</a>/<a onclick="reduce_limit_money(<?= $value['id'] ?>);">減少</a>
                                        </td>
                                        <td><a href="?r=agent/sum-index/list-type&tel=<?= $value['tel'] ?>"><span style="color:#F37605; margin-bottom: 8px;"><?= $value['tel'] ?></span></a><?= $value['email'] ?></td>
                                        <td><?= $value['agents_type'] ?></td>
                                        <td><a href="?r=agent/report/index&agent_level=<?= $value['id'] ?>"><span style="color:#F37605;">查看下屬代理</span></a></td>
                                        <td><a href="?r=agent/sum-index/account&id=<?= $value['id'] ?>"><span style="color:#F37605;">查看結算明細</span></a></td>
                                        <td><a href="?r=agent/sum-index/agents-jiesuan&id=<?= $value['id'] ?>"><span style="color:#F37605;">結算總代理</span></a></td>
                                        <td>
                                            <?= 0 < $value['online'] ? '<span style="color:#FF00FF;">在線</span>' : '<span style="color:#999999;">離線</span>'; ?>

                                            <?= $value['status'] == '停用' ? '<span style="color:#FF00FF;">停用</span>' : ($value['status'] == '異常' ? '<span style="color:#FF00FF;">異常</span>' : '<span style="color:#006600;">正常</span>'); ?>
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
function add_limit_money(id)
{
    var money=prompt("請輸入欲新增限額(新增後,限額餘額皆會增加)");
    $.ajax({
			url:"/?r=agent/sum-index/do-add-money",
			type:'POST',
			data:{
                'id':id,
                'money':money
            },
			error: function($e){
				alert('服務器未響應！');
			},
			success:function($html){
                $result = JSON.parse($html);
				alert($result['msg']);
                window.location.reload();
			}
    });
}
function reduce_limit_money(id)
{
    var money=prompt("請輸入欲新增限額(新增後,限額餘額皆會增加)");
    $.ajax({
			url:"/?r=agent/sum-index/do-reduce-money",
			type:'POST',
			data:{
                'id':id,
                'money':money
            },
			error: function($e){
				alert('服務器未響應！');
			},
			success:function($html){
				alert("操作成功了！");
                window.location.reload();
			}
    });
}
</script>
