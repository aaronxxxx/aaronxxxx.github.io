<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-close"></i> <?= Yii::$app->session->getFlash('error') ?></h4>
    </div>
<?php endif; ?>

<form class="form-horizontal" enctype="multipart/form-data" method="post" action="/?r=event/player/add">
    <div class="tabft13 trinput zudan spanmg0">
        <p>
            <span><strong>选手资讯</strong></span>
            <input type="hidden" name="editId" id="editId" value="1">
        </p>
        <p>
            <span>状态：</span>
            <span>
                <select name="status" id="status">
                    <option value="1" selected>启用</option>
                    <option value="2">停用</option>
                </select>
            </span>
        </p>
        <p>
            <span>名称：</span>
            <span><input type="text" name="title" id="title" value="" size="20" maxlength="100"></span>
        </p>
        <p>
            <span>类型：</span>
            <span>
                <select name="type" id="type">
                <?php
                    foreach ($type as $key => $val) {
                ?>
                        <option value="<?= $key ?>"><?= $val ?></option>
                <?php
                    }
                ?>
                </select>
            </span>
        </p>
        <p>
            <span>简介：</span>
            <textarea name="summary" id="summary" rows="5" cols="80"></textarea>
        </p>
        <p>
            <span>连结1：</span>
            <input type="text" name="link1" id="link1" value="" size="80">
        </p>
        <p>
            <span>连结2：</span>
            <input type="text" name="link2" id="link2" value="" size="80">
        </p>
        <p>
            <span>连结3：</span>
            <input type="text" name="link3" id="link3" value="" size="80">
        </p>
        <p>
            <span>图片：</span>
            <span>
                <input type="file" name="img">
                建议图片规格宽 250px * 高 250px。
            </span>
        </p>
    </div>
    <div class="tabft13 trinput zudan spanmg0">
        <p>
            <span style="margin-left: 33px;">
                <input type="submit" value="确认发布">
                <input type="button" value="取消" onclick="javascript:location.href='#/event/player'">
            </span>
        </p>
    </div>
</form>
