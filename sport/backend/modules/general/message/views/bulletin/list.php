<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:59
 */
use app\modules\general\member\models\UserMsg;
use yii\grid\GridView;
use yii\helpers\Html;

?>

<div class="pro_title pd10 pull-left">查看公告消息</div>
<button class="btn btn-sm btn-primary pull-right" style="margin-bottom: 10px;" onclick="delAll()">批量删除</button>

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
    'options' => ['id' => 'gridview'],
    'filterPosition' => GridView::FILTER_POS_FOOTER,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            'headerOptions' => ['width' => '20'],
        ],
        [
            'class' => 'yii\grid\CheckboxColumn',
            'headerOptions' => ['width' => '20'],
        ],
        [
            'header' => '创建时间',
            'attribute' => 'create_date',
            'headerOptions' => ['width' => '200']
        ],
        [
            'header' => '结束时间',
            'attribute' => 'end_time',
            'headerOptions' => ['width' => '200']
        ],
        [
            'header' => '公告内容',
            'attribute' => 'content',
        ],
//        'content',
        [
            'header' => '是否显示',
            'attribute' => 'is_show',
            'value' => function($model) {
                if($model->is_show == 1) {
                    return "显示";
                } else {
                    return "不显示";
                }
            },
            'headerOptions' => ['width' => '100'],
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => '操作',
            'template' => '{edit} {delete}',
            'buttons' => [
                'edit' => function ($url, $model, $key) {
                    return Html::a('<span>编辑</span>', "/#/message/bulletin/index&id=".$key, ['title' => '编辑', 'class' => 'btn btn-default btn-xs']);
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('删除', 'javascript:;', ['title' => '删除', 'class' => 'btn btn-default btn-xs', 'onclick' => 'deleteBulletin(this, '.$key.');']);
                },
            ],
            'headerOptions' => ['width' => '110'],
        ]
    ]
]); ?>
<script>
    var type = '<?=$type ?>';
 function deleteBulletin(obj, id) {
     $.dialog.confirm("是否删除该条记录？", function (flag) {
         if(flag){
             $.post('?r=message/bulletin/delete', {id:id}, function (data) {
                 data = $.parseJSON(data);
                 if(data.status) {
                     if(type=='0') {
                         location.href = "#/message/bulletin/list&type=0&t="+new Date().getTime();
                     } else {
                         location.href = "#/message/bulletin/list&t="+new Date().getTime();
                     }
                 }else{
                     $.dialog.notify(data.msg);
                 }
             });
         }
     });
 }
 function delAll() {
     var ids = [];
     $("input[type='checkbox'][name='selection[]']:checked").each(function () {
         ids.push($(this).val());
     });
     if(ids.length == 0) {
         $.dialog.notify('请选择要删除的记录');
         return;
     }
     $.dialog.confirm("是否删除选中的记录？", function (flag) {
         if(flag){
             $.ajax({
                 url:'?r=message/bulletin/all-delete',
                 data:{ids:ids.join(',')},
                 dataType:'json',
                 complete:function (xhr, status) {
                     if(xhr.status == 200) {
                         if(type=='0') {
                             location.href = "#/message/bulletin/list&type=0&t="+new Date().getTime();
                         } else {
                             location.href = "#/message/bulletin/list&t="+new Date().getTime();
                         }
                     } else {
                         $.dialog.notify(xhr.responseJSON.msg);
                     }
                 }
             });
         }
     });
 }
</script>
