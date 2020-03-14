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


<div class="pro_title pd10">查看系统发送的短消息</div>
<form id="gridSearchForm" name="gridSearchForm" method="get" action="#/message/user/list" class="trinput inputct mgb10">

    会员名：<input name="user_name" type="text" id="user_name" value="<?=$searchModel['user_name'] ?>" >
    &nbsp;&nbsp;
    标题：<input name="msg_title" type="text" id="msg_title" value="<?=$searchModel['msg_title'] ?>">
    &nbsp;&nbsp;
    <input type="button" value="搜索" id="gridSearchBtn"></td>
</form>
<?=
GridView::widget([
    //'summary' => '{begin}-{end}，共{totalCount}条数据，共{pageCount}页'
    'summary' => '显示第 {begin} 至 {end} 项结果，共 {totalCount} 项',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'showHeader' => true,
    'showFooter' => false,
    'layout' => "{items}\n<div class='clearfix'><div style='float: left;'>{summary}</div><div  style='float: right;'{pager}</div></div>",
    'tableOptions' => ['class' => 'table  table-bordered font13  skintable'],
    'filterPosition' => GridView::FILTER_POS_FOOTER,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        //['class' => 'yii\grid\CheckboxColumn'],
        [
            'label' => '用户名',
            'headerOptions' => ['width' => '150'],
            'value' => function($model) {
                return $model->user['user_name'];
            },
        ],
        [
            'label'=>'标题',
            'attribute'=>'msg_title'
        ],
        [
            'label'=>'发送时间',
            'attribute'=>'msg_time'
        ],
        [
            'attribute' => 'islook',
            'format' => 'raw',
            'value' => function($model) {
                if($model->islook == 1) {
                    return Html::label("已查看");
                } else {
                    return Html::label("未查看", null, ['class' => 'text-danger']);
                }
                //return UserMsg::getLookName($model->islook);
            },
        ]
    ]
]); ?>
