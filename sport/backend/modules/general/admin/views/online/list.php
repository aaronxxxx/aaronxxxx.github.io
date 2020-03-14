<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:59
 */
use app\common\helpers\IpUtils;
use yii\grid\GridView;
use yii\helpers\Html;

?>


<div class="pro_title pd10">管理员管理：在线管理员</div>
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
        ['class' => 'yii\grid\SerialColumn'],
        //['class' => 'yii\grid\CheckboxColumn'],
        [
            'attribute' => 'manage_name',
            'format' => 'raw',
            'value' => function($model){
                return Html::a($model->manage_name, '/#/admin/log/list&manage_name='.$model->manage_name);
            }
        ],
        //'session_str',
        'logintime',
        'loginbrowser',
        'loginip',
//        [
//            'attribute' => 'login_ip',
//            'value' => function($model) {
//                return iconv("GB2312","UTF-8",IpUtils::convertip($model->login_ip));
//            },
//        ]
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => '操作',
            'template' => '{update}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('踢线', 'javascript:;', ['title' => '踢线', 'class' => 'btn btn-default btn-xs', 'onclick' => 'deleteOnline(this, "'.$model->session_str.'", "'.$model->manage_name.'");']);
                },
            ],
            'headerOptions' => ['width' => '110'],
        ]
    ]
]); ?>
<script>
    function deleteOnline(obj, sessionstr, managename) {
        if(confirm('是否执行踢线操作？')) {
            $.ajax({
                type: "POST",
                url: "?r=admin/online/delete",
                data: {sessionstr: sessionstr, managename: managename}
            }).done(function(data) {
                data = $.parseJSON(data);
                if(data.status) {
                    location.href='#/admin/online/list&t='+new Date().getTime();
                }else{
                    alert(data.msg);
                }
            }).fail(function(error){
                alert(error.responseText);
            });
        }
    }
</script>
