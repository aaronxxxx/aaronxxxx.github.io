<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-close"></i> <?=Yii::$app->session->getFlash('error')?></h4>
    </div>
<?php endif;?>

<form class="form-horizontal" enctype="multipart/form-data" method="post" action="/?r=event/player/edit">
    <div class="tabft13 trinput zudan spanmg0">
        <p>
            <span><strong>選手資訊</strong></span>
            <input type="hidden" name="editId" id="editId" value="<?=$data['id']?>">
        </p>
        <p>
            <span>状态：</span>
            <span>
                <select name="status" id="status">
                    <option value="1">啟用</option>
                    <option value="2" <?php if ($data['status'] == 2) {echo 'selected';}?>>停用</option>
                </select>
            </span>
        </p>
        <p>
            <span>名稱：</span>
            <span><input type="text" name="title" id="title" value="<?=$data['title']?>" size="20" maxlength="100"></span>
        </p>
        <p>
            <span>類型：</span>
            <span>
                <select name="type" id="type">
                <?php
                    foreach ($type as $key => $val) {
                ?>
                        <option value="<?=$key?>" <?php if ($data['type'] == $key) {echo 'selected';}?>><?=$val?></option>
                <?php
                    }
                ?>
                </select>
            </span>
        </p>
        <p>
            <span>簡介：</span>
            <textarea name="summary" id="summary" rows="5" cols="80"><?=$data['summary']?></textarea>
        </p>
        <p>
            <span>連結1：</span>
            <input type="text" name="link1" id="link1" value="<?= $data['link1'] ?>" size="80">
        </p>
        <p>
            <span>連結2：</span>
            <input type="text" name="link2" id="link2" value="<?= $data['link2'] ?>" size="80">
        </p>
        <p>
            <span>連結3：</span>
            <input type="text" name="link3" id="link3" value="<?= $data['link3'] ?>" size="80">
        </p>
        <p>
            <span>圖片：</span>
            <span>
                <input type="file" name="img">
                建议图片规格 宽 250 px * 高 250 px。<br>如不修正无须选择任何档案。
            </span>
        </p>
        <?php
            if (!empty($data['img_url'])) {
        ?>
        <p>
            <span>預覽 : </span>
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
            <span style="margin-left: 33px;">
                <input type="submit" value="确认修改">
                <input type="button" value="取消" onclick="javascript:location.href='#/event/player'">
            </span>
        </p>
    </div>
</form>
