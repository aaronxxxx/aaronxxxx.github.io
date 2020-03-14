<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:59
 */
?>



    <div class="pro_title pd10">新增會員銀行歷史信息</div>
<form id="historyBankForm" class="need_validate addhistorybank" role="form" method="post" action="?r=member/historybank/save">
    <div class="form-group">
        <label for="username">會員名稱：</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="請輸入會員名稱" data-rule-required="true" data-msg-required="請輸入會員名稱" value="<?=$historyBank['username']?>">
    </div>
    <div class="form-group">
        <label for="pay_name">開戶人：</label>
        <input type="text" class="form-control" id="pay_name" name="pay_name" placeholder="請輸入開戶人" data-rule-required="true" data-msg-required="請輸入開戶人" value="<?=$historyBank['pay_name']?>">
    </div>
    <div class="form-group">
        <label for="pay_card">開戶行：</label>
        <select class="form-control" name="pay_card" id="pay_card">
            <option value="中國工商銀行" <?=$historyBank['pay_card']=='中國工商銀行' ? 'selected' : ''?>>中國工商銀行</option>
            <option value="中國招商銀行" <?=$historyBank['pay_card']=='中國招商銀行' ? 'selected' : ''?>>中國招商銀行</option>
            <option value="中國農業銀行" <?=$historyBank['pay_card']=='中國農業銀行' ? 'selected' : ''?>>中國農業銀行</option>
            <option value="中國建設銀行" <?=$historyBank['pay_card']=='中國建設銀行' ? 'selected' : ''?>>中國建設銀行</option>
            <option value="中國民生銀行" <?=$historyBank['pay_card']=='中國民生銀行' ? 'selected' : ''?>>中國民生銀行</option>
            <option value="中國交通銀行" <?=$historyBank['pay_card']=='中國交通銀行' ? 'selected' : ''?>>中國交通銀行</option>
            <option value="中國民生銀行" <?=$historyBank['pay_card']=='中國民生銀行' ? 'selected' : ''?>>中國民生銀行</option>
            <option value="深圳發展銀行" <?=$historyBank['pay_card']=='深圳發展銀行' ? 'selected' : ''?>>深圳發展銀行</option>
            <option value="廣東發展銀行" <?=$historyBank['pay_card']=='廣東發展銀行' ? 'selected' : ''?>>廣東發展銀行</option>
            <option value="光大銀行" <?=$historyBank['pay_card']=='光大銀行' ? 'selected' : ''?>>光大銀行</option>
            <option value="平安銀行" <?=$historyBank['pay_card']=='平安銀行' ? 'selected' : ''?>>平安銀行</option>
            <option value="中國郵政" <?=$historyBank['pay_card']=='中國郵政' ? 'selected' : ''?>>中國郵政</option>
            <option value="興業銀行" <?=$historyBank['pay_card']=='興業銀行' ? 'selected' : ''?>>興業銀行</option>
            <option value="中信銀行" <?=$historyBank['pay_card']=='中信銀行' ? 'selected' : ''?>>中信銀行</option>
            <option value="中國銀行" <?=$historyBank['pay_card']=='中國銀行' ? 'selected' : ''?>>中國銀行</option>
            <option value="其他" <?=$historyBank['pay_card']=='其他' ? 'selected' : ''?>>其他</option>
        </select>
    </div>
    <div class="form-group">
        <label for="pay_num">銀行卡號：</label>
        <input type="text" class="form-control" id="pay_num" name="pay_num" data-rule-required="true" data-msg-required="請輸入銀行卡號" placeholder="請輸入銀行卡號" value="<?=$historyBank['pay_num']?>">
    </div>
    <div class="form-group">
        <label for="pay_num">開戶地址：</label>
        <input type="text" class="form-control" id="pay_address" name="pay_address" data-rule-required="true" data-msg-required="請輸入開戶地址" placeholder="請輸入開戶地址" value="<?=$historyBank['pay_address']?>">
    </div>
    <button type="button" class="btn btn-primary form_ajax_submit_btn" data-targetid="historyBankForm" data-redirect="?r=member/historybank/list">保存</button>
    <input type="hidden" id="id" name="id" value="<?=$historyBank['id']?>">
</form>