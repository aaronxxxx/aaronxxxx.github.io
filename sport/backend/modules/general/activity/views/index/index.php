<script type="text/javascript" language="javascript" src="/public/common/js/ckeditor/ckeditor.js"></script>

<div class="tabft13 trinput zudan spanmg0">
    <p>
        <span><strong>優惠訊息(電腦版)</strong></span>
        <input type="hidden" name="editId" id="editId">
    </p>
    <p>
        <span>状态：</span>
        <span>
            <select name="status" id="status">
                <option value="1" selected>啟用</option>
                <option value="2">停用</option>
            </select>
        </span>
    </p>
    <p>
        <span>排序：</span>
        <span><input type="text" name="sort" id="sort" value="" size="20" maxlength="16"></span>
    </p>
    <p>
        <span>标题：</span>
        <span><input type="text" name="title" id="title" value="" size="20" maxlength="100"></span>
    </p>
    <!-- <p>
        <span>副標：</span>
        <span><input type="text" name="sub_title" id="sub_title" value="" size="20" maxlength="100"></span>
    </p> -->
</div>
<p>
    <span>內容：</span>
    <textarea name="content" id="content" rows="5" cols="80"></textarea>
</p>
<div class="tabft13 trinput zudan spanmg0">
    <p>
        <span>圖片位置：</span>
        <span>
            <input type="text" name="img_url" id="img_url" value="" size="100" maxlength="100">
            图片规格宽1000px * 高148px。
        </span>
    </p>
    <p>
        <span id="new">
            <input type="button" value="确认发布" onclick="ajaxAdd()">
        </span>
        <span id="modify" style="display:none">
            <input type="button" value="确认修改" onclick="ajaxEdit()">&emsp;
            <input type="button" value="取消" onclick="cancelEdit()">
        </span>
    </p>
</div>
<table id="testing" width="100%" border="0" cellpadding="5" cellspacing="1" class="font13 skintable line35">
    <tr class="namecolor">
        <td width="10%"><strong>狀態</strong></td>
        <td width="10%"><strong>排序</strong></td>
        <td width="10%"><strong>標題</strong></td>
        <!-- <td width="10%"><strong>副標</strong></td> -->
        <td><strong>目前圖片</strong></td>
        <td width="10%"><strong>操作</strong></td>
    </tr>
    <?php
        foreach ($list as $key => $val) {
    ?>
        <tr class="namecolor">
            <td valign="middle" align="center">
            <?php
                if ($val['status'] == 1) {
                    echo '啟用';
                } else {
                    echo '停用';
                }
            ?>
            </td>
            <td valign="middle">
                <?= $val['sort'] ?>
            </td>
            <td valign="middle">
                <?= $val['title'] ?>
            </td>
            <!-- <td valign="middle">
                <?= $val['sub_title'] ?>
            </td> -->
            <td valign="middle" style="display:none" id="<?= $val['id'] ?>-<?= $val['sort'] ?>">
                <?= $val['content']?>
            </td>
            <td valign="middle">
                <img src="<?= $val['img_url'] ?>">
            </td>
            <td class="trinput">
                <input type="button" value="编辑" onclick="showData('<?= $val['id'] ?>','<?= $val['status'] ?>','<?= $val['sort'] ?>','<?= $val['title'] ?>','<?= $val['sub_title'] ?>','<?= $val['img_url'] ?>');">&nbsp;
                <input type="button" value="删除" onclick="ajaxDelete('<?= $val['id'] ?>');">
            </td>
        </tr>
    <?php
        }
    ?>
</table>

<script>
    var editor = CKEDITOR.replace("content");

    //新增
    function ajaxAdd()
    {
        var status = $("#status").val();
        var sort = $("#sort").val();
        var title = $("#title").val();
        var sub_title = $("#sub_title").val();
        var content = CKEDITOR.instances.content.getData();
        var img_url = $("#img_url").val();
        $.ajax({
            url: '/?r=activity/index/add',
            type: 'post',
            data: {
                status: status,
                sort: sort,
                title: title,
                sub_title: sub_title,
                content: content,
                img_url: img_url,
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    layer.alert(data.msg, function(index) {
                        layer.closeAll();
                        window.location.reload();
                    });
                } else {
                    layer.alert(data.msg);
                }
            }
        });
    }

    //編輯
    function showData(id, status, sort, title, sub_title, img_url)
    {
        var aid = "#" + id + "-" + sort;
        var r = $(aid).html();
        $('#new').hide();
        $('#modify').show();
        $('input[name="editId"]').val(id);
        $('#status').val(status);
        $('input[name="sort"]').val(sort);
        $('input[name="title"]').val(title);
        $('input[name="sub_title"]').val(sub_title);
        $('input[name="img_url"]').val(img_url);
        CKEDITOR.instances.content.setData(r);
    }

    //取消編輯
    function cancelEdit()
    {
        $('#new').show();
        $('#modify').hide();
        $('input[name="editId"]').val('');
        $('#status').val(1);
        $('input[name="sort"]').val('');
        $('input[name="title"]').val('');
        $('input[name="sub_title"]').val('');
        $('input[name="content"]').val('');
        $('input[name="img_url"]').val('');
        CKEDITOR.instances.content.setData('');
    }

    //確認修改
    function ajaxEdit()
    {
        var id = $('#editId').val();
        var status = $("#status").val();
        var sort = $("#sort").val();
        var title = $("#title").val();
        var sub_title = $("#sub_title").val();
        var content = CKEDITOR.instances.content.getData();
        var img_url = $("#img_url").val();
        $.ajax({
            url: '?r=activity/index/edit',
            type: 'post',
            data: {
                id: id,
                status: status,
                sort: sort,
                title: title,
                sub_title: sub_title,
                content: content,
                img_url: img_url,
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    layer.alert(data.msg, function(index) {
                        layer.closeAll();
                        window.location.reload();
                    });
                } else {
                    layer.alert(data.msg);
                }
            }
        });
    }

    //刪除
    function ajaxDelete(id)
    {
        $.ajax({
            url: '?r=activity/index/delete',
            type: 'post',
            data: {id: id},
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    layer.alert(data.msg, function(index) {
                        layer.closeAll();
                        window.location.reload();
                    });
                } else {
                    layer.alert(data.msg);
                }
            }
        });
    }
</script>
