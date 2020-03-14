<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-close"></i> <?= Yii::$app->session->getFlash('error') ?></h4>
    </div>
<?php endif; ?>

<form class="form-horizontal" enctype="multipart/form-data" method="post" action="/?r=event/multiple/add">
    <div class="tabft13 trinput zudan spanmg0">
        <p>
            <span><strong>多项目</strong></span>
        </p>
        <p>
            <span>状态：</span>
            <span>
                <select name="status" id="status">
                    <option value="1">启用</option>
                    <option value="2">停用</option>
                </select>
            </span>
        </p>
        <p>
            <span>期数：</span>
            <span><input type="text" name="qishu" id="qishu" value="" size="20" maxlength="16"></span>
        </p>
        <p>
            <span>赛事：</span>
            <span>
                <select name="official_id" id="official_id">
                <?php
                    foreach ($official as $key => $val) {
                ?>
                        <option value="<?= $val['id'] ?>" <?php if ($val['id'] == $oid ) { echo 'selected'; } ?> ><?= $val['title'] ?></option>
                <?php
                    }
                ?>
                </select>
            </span>
        </p>
        <p>
            <span>标题：</span>
            <span><input type="text" name="title" id="title" value="" size="20" maxlength="16"></span>
        </p>
        <p>
            <span>反水：</span>
            <span><input type="text" name="fs" id="fs" value="" size="20" maxlength="16"></span>
        </p>
        <p>
            <span>简介：</span>
            <textarea name="summary" id="summary" rows="5" cols="80"></textarea>
        </p>
        <p>
            <span>备注：</span>
            <textarea name="remarks" id="remarks" rows="5" cols="80"></textarea>
        </p>
        <p>
            <span>图片：</span>
            <span>
                <input type="file" name="img">
                建议图片规格宽 250px * 高 250px。
            </span>
        </p>
        <hr>
        <p>
            <button type="button" class="btn btn-sm btn-primary pull-right addItem" style="margin-bottom: 10px;">增加项目</button>
            <table class="table table-bordered table-hover table-striped tablesorter" id="expand">
                <tr>
                    <th>状态</th>
                    <th>名称</th>
                    <th>胜率</th>
                    <th>赔率</th>
                    <th>刪除</th>
                </tr>
                <tr>
                    <td>
                        <select name="newMulItem[status][]">
                            <option value="1">正常下注</option>
                            <option value="2">暂停下注</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="newMulItem[title][]" value="">
                    </td>
                    <td>
                        <input type="text" name="newMulItem[win_rate][]" value="" class="setOdds"> %
                    </td>
                    <td>
                        <input type="text" name="newMulItem[odds][]" value="" readonly>
                    </td>
                    <td>
                        <button type="button" class="btn btn-default unit-delete deleteItem"><i class="fa fa-times"></i></button>
                    </td>
                </tr>
            </table>
        </p>
    </div>
    <div class="tabft13 trinput zudan spanmg0">
        <p>
            <span>
                <input type="submit" value="确认发布">
                <input type="button" value="取消" onclick="javascript:history.back()">
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
                        '<option value="1">正常下注</option>'+
                        '<option value="2" selected>暂停下注</option>'+
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
        var target = $(this).closest("tr").find('input[name="newMulItem[odds][]"]');
        var fs = $('#fs').val();
        var win_rate = $(this).val() * 0.01;
        var odds = (1 / win_rate) * (1 - fs);
        odds = odds.toFixed(2);
        target.val(odds);
    });
});
</script>
