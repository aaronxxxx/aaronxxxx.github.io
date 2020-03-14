<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-close"></i> <?= Yii::$app->session->getFlash('error') ?></h4>
    </div>
<?php endif; ?>

<form class="form-horizontal" enctype="multipart/form-data" method="post" action="/?r=event/multiple/edit">
    <div class="tabft13 trinput zudan spanmg0">
        <p>
            <span><strong>多項目</strong></span>
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
            <span>標題：</span>
            <span><input type="text" name="title" id="title" value="<?= $data['title'] ?>" size="20" maxlength="16"></span>
        </p>
        <p>
            <span>反水：</span>
            <span><input type="text" name="fs" id="fs" value="<?= $data['fs'] ?>" size="20" maxlength="16"></span>
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
            <button type="button" class="btn btn-sm btn-primary pull-right addItem" style="margin-bottom: 10px;">增加項目</button>
            <table class="table table-bordered table-hover table-striped tablesorter" id="expand">
                <tr>
                    <th>狀態</th>
                    <th>名稱</th>
                    <th>勝率</th>
                    <th>賠率</th>
                    <th>刪除</th>
                </tr>
            <?php
                foreach ($mulItem as $key => $val) {
            ?>
                <tr>
                    <td>
                        <select name="mulItem[<?= $val['id'] ?>][status]">
                            <option value="1">啟用</option>
                            <option value="2" <?php if ($val['status'] == 2) { echo 'selected'; } ?>>停用</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="mulItem[<?= $val['id'] ?>][title]" value="<?= $val['title'] ?>">
                    </td>
                    <td>
                        <input type="text" name="mulItem[<?= $val['id'] ?>][win_rate]" value="<?= $val['win_rate'] ?>" class="setOdds" data-id="<?= $val['id'] ?>"> %
                    </td>
                    <td>
                        <input type="text" name="mulItem[<?= $val['id'] ?>][odds]" id="mulItem<?= $val['id'] ?>" value="<?= $val['odds'] ?>" readonly>
                    </td>
                    <td>
                        <button type="button" class="btn btn-default deleteItem"><i class="fa fa-times"></i></button>
                    </td>
                </tr>
            <?php
                }
            ?>
            </table>
        </p>
    </div>
    <div class="tabft13 trinput zudan spanmg0">
        <p>
            <span>
                <input type="submit" value="确认修改">
                <input type="button" value="取消" onclick="javascript:location.href='#/event/multiple/index&oid=<?= $data['official_id'] ?>'">
            </span>
        </p>
    </div>
</form>

<script>
function bindDeleteItem() {
    $('.deleteItem').click(function() {
        $(this).parent().parent().remove();
    });
}

function bindSetOdds() {
    $('.newSetOdds').blur(function() {
        var target = $(this).closest("tr").find('input[name="newMulItem[odds][]"]');
        var fs = $('#fs').val();
        var win_rate = $(this).val() * 0.01;
        var odds = (1 / win_rate) * (1 - fs);
        odds = odds.toFixed(2);
        target.val(odds);
    });
}

$(document).ready(function () {
    $('.addItem').click(function() {
        var appendHtml = "";
        appendHtml +=
            '<tr>'+
                '<td class="form-group">'+
                    '<select name="newMulItem[status][]">'+
                        '<option value="1">啟用</option>'+
                        '<option value="2" selected>停用</option>'+
                    '</select>'+
                '</td>'+
                '<td>'+
                    '<input type="text" name="newMulItem[title][]">'+
                '</td>'+
                '<td>'+
                    '<input type="text" name="newMulItem[win_rate][]" class="newSetOdds"> %'+
                '</td>'+
                '<td>'+
                    '<input type="text" name="newMulItem[odds][]" readonly>'+
                '</td>'+
                '<td>'+
                    '<button class="btn btn-default deleteItem" type="button"><i class="fa fa-times"></i></button>'+
                '</td>'+
            '</tr>';
        $('#expand').append(appendHtml);
        bindDeleteItem();
        bindSetOdds();
    });

    $('.deleteItem').click(function() {
        $(this).parent().parent().remove();
    });

    $('.setOdds').blur(function() {
        var id = $(this).attr('data-id');
        var fs = $('#fs').val();
        var win_rate = $(this).val() * 0.01;
        var odds = (1 / win_rate) * (1 - fs);
        odds = odds.toFixed(2);
        $('#mulItem' + id).val(odds);
    });
});
</script>
