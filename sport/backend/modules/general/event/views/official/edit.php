<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-close"></i> <?= Yii::$app->session->getFlash('error') ?></h4>
    </div>
<?php endif; ?>

<form class="form-horizontal" enctype="multipart/form-data" method="post" action="/?r=event/official/edit">
    <div class="tabft13 trinput zudan spanmg0">
        <p>
            <span><strong>赛事资讯</strong></span>
            <input type="hidden" name="editId" id="editId" value="<?= $data['id'] ?>">
        </p>
        <p>
            <span>状态：</span>
            <span>
                <select name="status" id="status">
                    <option value="1">未结算</option>
                    <option value="2" <?php if ($data['status'] == 2) { echo 'selected'; } ?>>已结算</option>
                </select>
            </span>
        </p>
        <p>
            <span>期数：</span>
            <span><input type="text" name="qishu" id="qishu" value="<?= $data['qishu'] ?>" size="20" maxlength="16"></span>
        </p>
        <p>
            <span>名称：</span>
            <span><input type="text" name="title" id="title" value="<?= $data['title'] ?>" size="20"></span>
        </p>
        <p>
            <span>类型：</span>
            <span>
                <select name="type" id="type">
                <?php
                    foreach ($type as $key => $val) {
                ?>
                        <option value="<?= $key ?>" <?php if ($data['type'] == $key) { echo 'selected'; } ?>><?= $val ?></option>
                <?php
                    }
                ?>
                </select>
            </span>
        </p>
        <p>
            <span>开盘时间：</span>
            <span><input type="text" name="kaipan_time" id="kaipan_time" value="<?= $data['kaipan_time'] ?>" size="20" onfocus="WdatePicker({isShowClear:true, readOnly:true, dateFmt:'yyyy-MM-dd HH:mm:ss'})"></span>
        </p>
        <p>
            <span>封盘时间：</span>
            <span><input type="text" name="fenpan_time" id="fenpan_time" value="<?= $data['fenpan_time'] ?>" size="20" onfocus="WdatePicker({isShowClear:true, readOnly:true, dateFmt:'yyyy-MM-dd HH:mm:ss'})"></span>
        </p>
        <p>
            <span>开奖时间：</span>
            <span><input type="text" name="kaijiang_time" id="kaijiang_time" value="<?= $data['kaijiang_time'] ?>" size="20" onfocus="WdatePicker({isShowClear:true, readOnly:true, dateFmt:'yyyy-MM-dd HH:mm:ss'})"></span>
        </p>
        <p>
            <span>简介：</span>
            <textarea name="summary" id="summary" rows="5" cols="80"><?= $data['summary'] ?></textarea>
        </p>
        <p>
            <span>备注：</span>
            <textarea name="remarks" id="remarks" rows="5" cols="80"><?= $data['remarks'] ?></textarea>
        </p>
        <p>
            <span>图片：</span>
            <span>
                <input type="file" name="img">
                建议图片规格 宽 250 px * 高 250 px。<br>如不修正无须选择任何档案。
            </span>
        </p>
        <?php
            if (!empty($data['img_url'])) {
        ?>
        <p>
            <span>预览 : </span>
            <span>
                <img src="timthumb.php?src=<?=$data['img_url']?>&w=150&h=150&zc=1">
            </span>
        </p>
        <?php
            }
        ?>
    </div>
    <div class="tabft13 trinput zudan spanmg0">
        <p>
            <span>
                <input type="submit" value="确认修改">
                <input type="button" value="取消" onclick="javascript:location.href='#/event/official'">
            </span>
        </p>
    </div>
</form>
