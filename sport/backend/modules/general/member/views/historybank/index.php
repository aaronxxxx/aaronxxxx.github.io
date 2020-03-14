<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:59
 */
?>



    <div class="pro_title pd10">新增会员银行历史信息</div>
<form id="historyBankForm" class="need_validate addhistorybank" role="form" method="post" action="?r=member/historybank/save">
    <div class="form-group">
        <label for="username">会员名称：</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="请输入会员名称" data-rule-required="true" data-msg-required="请输入会员名称" value="<?=$historyBank['username']?>">
    </div>
    <div class="form-group">
        <label for="pay_name">开户人：</label>
        <input type="text" class="form-control" id="pay_name" name="pay_name" placeholder="请输入开户人" data-rule-required="true" data-msg-required="请输入开户人" value="<?=$historyBank['pay_name']?>">
    </div>
    <div class="form-group">
        <label for="pay_card">开户行：</label>
        <select class="form-control" name="pay_card" id="pay_card">
            <option value="中国工商银行" <?=$historyBank['pay_card']=='中国工商银行' ? 'selected' : ''?>>中国工商银行</option>
            <option value="中国招商银行" <?=$historyBank['pay_card']=='中国招商银行' ? 'selected' : ''?>>中国招商银行</option>
            <option value="中国农业银行" <?=$historyBank['pay_card']=='中国农业银行' ? 'selected' : ''?>>中国农业银行</option>
            <option value="中国建设银行" <?=$historyBank['pay_card']=='中国建设银行' ? 'selected' : ''?>>中国建设银行</option>
            <option value="中国民生银行" <?=$historyBank['pay_card']=='中国民生银行' ? 'selected' : ''?>>中国民生银行</option>
            <option value="中国交通银行" <?=$historyBank['pay_card']=='中国交通银行' ? 'selected' : ''?>>中国交通银行</option>
            <option value="中国民生银行" <?=$historyBank['pay_card']=='中国民生银行' ? 'selected' : ''?>>中国民生银行</option>
            <option value="深圳发展银行" <?=$historyBank['pay_card']=='深圳发展银行' ? 'selected' : ''?>>深圳发展银行</option>
            <option value="广东发展银行" <?=$historyBank['pay_card']=='广东发展银行' ? 'selected' : ''?>>广东发展银行</option>
            <option value="光大银行" <?=$historyBank['pay_card']=='光大银行' ? 'selected' : ''?>>光大银行</option>
            <option value="平安银行" <?=$historyBank['pay_card']=='平安银行' ? 'selected' : ''?>>平安银行</option>
            <option value="中国邮政" <?=$historyBank['pay_card']=='中国邮政' ? 'selected' : ''?>>中国邮政</option>
            <option value="兴业银行" <?=$historyBank['pay_card']=='兴业银行' ? 'selected' : ''?>>兴业银行</option>
            <option value="中信银行" <?=$historyBank['pay_card']=='中信银行' ? 'selected' : ''?>>中信银行</option>
            <option value="中国银行" <?=$historyBank['pay_card']=='中国银行' ? 'selected' : ''?>>中国银行</option>
            <option value="其他" <?=$historyBank['pay_card']=='其他' ? 'selected' : ''?>>其他</option>
        </select>
    </div>
    <div class="form-group">
        <label for="pay_num">银行卡号：</label>
        <input type="text" class="form-control" id="pay_num" name="pay_num" data-rule-required="true" data-msg-required="请输入银行卡号" placeholder="请输入银行卡号" value="<?=$historyBank['pay_num']?>">
    </div>
    <div class="form-group">
        <label for="pay_num">开户地址：</label>
        <input type="text" class="form-control" id="pay_address" name="pay_address" data-rule-required="true" data-msg-required="请输入开户地址" placeholder="请输入开户地址" value="<?=$historyBank['pay_address']?>">
    </div>
    <button type="button" class="btn btn-primary form_ajax_submit_btn" data-targetid="historyBankForm" data-redirect="/#/member/historybank/list">保存</button>
    <input type="hidden" id="id" name="id" value="<?=$historyBank['id']?>">
</form>