<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-close"></i> <?= Yii::$app->session->getFlash('error') ?></h4>
    </div>
<?php endif; ?>

<div class="pro_title pd10">請款申請: 新增請款信息</div>
<form class="trinput font14 " action="#/agent/cash/add" method="post">
    <div class="trinput font15 addgents ">
        <div class="item">
            <span class="name">用戶名稱</span>
            <input name="agents_name" id="agents_name" value="<?= Yii::$app->session['S_USER_NAME']; ?>" readonly>
        </div>
        <div class="item">
            <span class="name">當前餘額</span>
            <input name="ori_money" id="ori_money" value="<?= $agent['money'] ?>" readonly>
        </div>
        <div class="item">
            <span class="name">交易方式</span>
            <select name="type" id="type">
            <?php
                foreach ($type as $key => $val) {
            ?>
                <option value="<?= $key ?>"><?= $val ?></option>
            <?php
                }
            ?>
            </select>
        </div>
        <div class="item">
            <span class="name">交易帳號/地址</span>
            <input name="account" id="account" value="">
        </div>
        <div class="item">
            <span class="name">交易金額</span>
            <input name="money" id="money" value="">
        </div>
        <div class="item agenbtnct">
            <div class="ct">
                <input type="submit" value="確認提交">
                <input type="button" value="取 消" onclick="javascript:location.href='/?r=agent/cash'">
            </div>
        </div>
    </div>
</form>
