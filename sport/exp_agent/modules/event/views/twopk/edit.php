<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-close"></i> <?= Yii::$app->session->getFlash('error') ?></h4>
    </div>
<?php endif; ?>

<form class="form-horizontal" enctype="multipart/form-data" method="post" action="/?r=event/twopk/edit">
    <div class="tabft13 trinput zudan spanmg0">
        <p>
            <span><strong>兩方比賽</strong></span>
            <input type="hidden" name="editId" id="editId" value="<?= $data['id'] ?>">
        </p>
        <p>
            <span>状态：</span>
            <span>
                <select name="status" id="status">
                    <option value="1">啟用</option>
                    <option value="2" <?php if ($data['status'] == 2) { echo 'selected'; } ?>>停用</option>
                </select>
            </span>
        </p>
        <p>
            <span>期數：</span>
            <span><input type="text" name="qishu" id="qishu" value="<?= $data['qishu'] ?>" size="20" maxlength="16"></span>
        </p>
        <p>
            <span>賽事：</span>
            <span>
                <select name="official_id" id="official_id">
                <?php
                    foreach ($official as $key => $val) {
                ?>
                        <option value="<?= $val['id'] ?>" <?php if ($data['official_id'] == $val['id']) { echo 'selected'; } ?>><?= $val['title'] ?></option>
                <?php
                    }
                ?>
                </select>
            </span>
        </p>
        <p>
            <span>選手一状态：</span>
            <span>
                <select name="player1_status" id="player1_status">
                    <option value="1">正常下注</option>
                    <option value="2" <?php if ($data['player1_status'] == 2) { echo 'selected'; } ?>>暫停下注</option>
                </select>
            </span>
        </p>
        <p>
            <span>選手一：</span>
            <span>
                <select name="player1" id="player1">
                <?php
                    foreach ($player as $key => $val) {
                ?>
                        <option value="<?= $val['id'] ?>" <?php if ($data['player1'] == $val['id']) { echo 'selected'; } ?>><?= $val['title'] ?></option>
                <?php
                    }
                ?>
                </select>
            </span>
        </p>
        <p>
            <span>選手一讓分：</span>
            <span><input type="text" name="player1_handicap" id="player1_handicap" value="<?= $data['player1_handicap'] ?>" size="20" maxlength="100"></span>
        </p>
        <p>
            <span>選手二状态：</span>
            <span>
                <select name="player2_status" id="player2_status">
                    <option value="1">正常下注</option>
                    <option value="2" <?php if ($data['player2_status'] == 2) { echo 'selected'; } ?>>暫停下注</option>
                </select>
            </span>
        </p>
        <p>
            <span>選手二：</span>
            <span>
                <select name="player2" id="player2">
                <?php
                    foreach ($player as $key => $val) {
                ?>
                        <option value="<?= $val['id'] ?>" <?php if ($data['player2'] == $val['id']) { echo 'selected'; } ?>><?= $val['title'] ?></option>
                <?php
                    }
                ?>
                </select>
            </span>
        </p>
        <p>
            <span>選手二讓分：</span>
            <span><input type="text" name="player2_handicap" id="player2_handicap" value="<?= $data['player2_handicap'] ?>" size="20" maxlength="100"></span>
        </p>
        <p>
            <span>簡介：</span>
            <textarea name="summary" id="summary" rows="5" cols="80"><?= $data['summary'] ?></textarea>
        </p>
        <p>
            <span>備註：</span>
            <textarea name="remarks" id="remarks" rows="5" cols="80"><?= $data['remarks'] ?></textarea>
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
        <hr>
        <p>
            <span>主方賠率：</span>
            <span><input type="text" name="player1_odds" id="player1_odds" value="<?= $odds['player1_odds'] ?>" size="20" maxlength="100"></span>
        </p>
        <p>
            <span>客方賠率：</span>
            <span><input type="text" name="player2_odds" id="player2_odds" value="<?= $odds['player2_odds'] ?>" size="20" maxlength="100"></span>
        </p>
        <p>
            <span>調整基值：</span>
            <span><input type="text" name="adj_basic" id="adj_basic" value="<?= $odds['adj_basic'] ?>" size="20" maxlength="100"></span>
        </p>
        <p>
            <span>啟動額：</span>
            <span><input type="text" name="start_amount" id="start_amount" value="<?= $odds['start_amount'] ?>" size="20" maxlength="100"></span>
        </p>
    </div>
    <div class="tabft13 trinput zudan spanmg0">
        <p>
            <span>
                <input type="submit" value="确认修改">
                <input type="button" value="取消" onclick="javascript:location.href='#/event/twopk/index&oid=<?= $data['official_id'] ?>'">
            </span>
        </p>
    </div>
</form>
