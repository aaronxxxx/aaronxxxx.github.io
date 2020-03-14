<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:59
 */
use yii\grid\GridView;
use yii\helpers\Html;

?>


<div class="pro_title pd10">管理员管理：管理员列表</div>
<table width="100%">
    <tr>
        <td width="104" align="center"><a href="/#/admin/manage/index">添加管理员</a></td>
    </tr>
</table>
<?=
GridView::widget([
    //'summary' => '{begin}-{end}，共{totalCount}条数据，共{pageCount}页'
    'summary' => '显示第 {begin} 至 {end} 项结果，共 {totalCount} 项',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'showHeader' => true,
    'showFooter' => false,
    'layout' => "{items}\n<div class='clearfix'><div class='pull-left'>{summary}</div><div class='pull-right'>{pager}</div></div>",
    'tableOptions' => ['class' => 'table  table-bordered font13  skintable'],
    'filterPosition' => GridView::FILTER_POS_FOOTER,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn',
            'headerOptions' => ['width' => '60'],],

        //['class' => 'yii\grid\CheckboxColumn'],
        [
            'attribute' => 'manage_name',
            'headerOptions' => ['width' => '150'],
        ],
        [
            'attribute' => 'login_one',
            'headerOptions' => ['width' => '100'],
            'value' => function($model) {
                if($model->login_one == 1) {
                    return "否";
                } else {
                    return "是";
                }
            },
        ],
        'purview',
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => '操作',
            'template' => '{edit} {delete}',
            'buttons' => [
                'edit' => function ($url, $model, $key) {
                    return Html::a('编辑', "/#/admin/manage/index&id=".$key, ['title' => '编辑', 'class' => 'btn btn-default btn-xs']);
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('删除', 'javascript:;', ['title' => '删除', 'class' => 'btn btn-default btn-xs', 'onclick' => 'deleteAdmin(this, '.$key.', "'.$model["manage_name"].'");']);
                },
            ],
            'headerOptions' => ['width' => '110'],
        ]
    ]
]); ?>
<script>
    function deleteAdmin(obj, id , manage_name) {
        var user_name = '<?php echo $username;?>';
        if(confirm('是否删除该条记录？')) {
            $.ajax({
                type: "POST",
                url: "?r=admin/manage/delete",
                data: {user_name: user_name, manage_name:manage_name, id: id}
            }).done(function(data) {
                data = $.parseJSON(data);
                if(data.status) {
                    location.href = "#/admin/manage/list&t="+new Date().getTime();
                }else{
                    $.dialog.notify(data.msg);
                }
            }).fail(function(error){
                $.dialog.notify(error.responseText);
            });
        }
    }
</script>
<!-- <p> QRcode </p>
<input type="radio" name="qrcode" value="1" <?php if($qrswitch == 1) {echo 'CHECKED';}?>/>開
<input type="radio" name="qrcode" value="0" <?php if($qrswitch != 1) {echo 'CHECKED';}?>/>關
<br>
<button class="btn btn-default btn-xs" onclick="updateqrcode();">修改</button>
<button class="btn btn-default btn-xs" onclick="resetqrcode();">刷新密鑰</button>
<script>
    function updateqrcode() {
        if(confirm('是否登入用qrcode？')) {
            $.ajax({
                type: "POST",
                url: "?r=admin/manage/updateqrcode",
                data: {switch:$('input[name=qrcode]:checked').val()}
            }).done(function(data) {
                data = $.parseJSON(data);
                if(data.status) {
                    location.href = "#/admin/manage/list&t="+new Date().getTime();
                }else{
                    $.dialog.notify(data.msg);
                }
            }).fail(function(error){
                $.dialog.notify(error.responseText);
            });
        }
    }
    function resetqrcode() {
        if(confirm('是否刷新qrcode？(将造成全部会员安全码失效)')) {
            $.ajax({
                type: "POST",
                url: "?r=admin/manage/resetqrcode",
                data: {}
            }).done(function(data) {
                data = $.parseJSON(data);
                if(data.status) {
                    location.href = "#/admin/manage/list&t="+new Date().getTime();
                }else{
                    $.dialog.notify(data.msg);
                }
            }).fail(function(error){
                $.dialog.notify(error.responseText);
            });
        }
    }
</script> -->

