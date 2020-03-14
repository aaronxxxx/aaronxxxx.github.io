<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-close"></i> <?= Yii::$app->session->getFlash('error') ?></h4>
    </div>
<?php endif; ?>

<form class="form-horizontal" enctype="multipart/form-data" method="post" action="/?r=event/official/add">
    <div class="tabft13 trinput zudan spanmg0">
        <p>
            <span><strong>賽事資訊</strong></span>
        </p>
        <p>
            <span>状态：</span>
            <span>
                <select name="status" id="status">
                    <option value="1">未結算</option>
                    <option value="2">已結算</option>
                </select>
            </span>
        </p>
        <p>
            <span>名稱：</span>
            <span><input type="text" name="title" id="title" value="" size="20"></span>
        </p>
        <p>
            <span>類型：</span>
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
            <span>開盤時間：</span>
            <span><input type="text" name="kaipan_time" id="kaipan_time" value="" size="20" onfocus="WdatePicker({isShowClear:true, readOnly:true, dateFmt:'yyyy-MM-dd HH:mm:ss'})"></span>
        </p>
        <p>
            <span>封盤時間：</span>
            <span><input type="text" name="fenpan_time" id="fenpan_time" value="" size="20" onfocus="WdatePicker({isShowClear:true, readOnly:true, dateFmt:'yyyy-MM-dd HH:mm:ss'})"></span>
        </p>

        <p>
            <span>簡介：</span>
            <textarea name="summary" id="summary" rows="5" cols="80"></textarea>
        </p>
        <p>
            <span>備註：</span>
            <textarea name="remarks" id="remarks" rows="5" cols="80"></textarea>
        </p>
        <p>
            <span>圖片：</span>
            <span>
                <input type="file" name="img">
                建议图片规格宽 250px * 高 250px。
            </span>
        </p>
    </div>
    <div class="tabft13 trinput zudan spanmg0">
        <p>
            <span>
                <input type="submit" value="确认发布">
                <input type="button" value="取消" onclick="javascript:location.href='#/event/official'">
            </span>
        </p>
    </div>
</form>
