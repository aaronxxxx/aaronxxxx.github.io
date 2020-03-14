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
<style>
    .grid-view .pagination {
        margin: 0;
    }
</style>
&nbsp;<span class="pro_title ">用户日志：</span>

<form id="gridSearchForm" style="margin: 10px;" class="trinput inputct font14" action="#/member/user-log/list">
    用户名：
    <input type="text" name="user_name" value="<?=$searchModel['user_name']?>"/>
    操作内容：
    <input type="text" name="edlog" value="<?=$searchModel['edlog']?>"/>
    <input id="gridSearchBtn" type="button" value="查询" />
</form>
<?=
GridView::widget([
    'summary' => '显示第 {begin} 至 {end} 项结果，共 {totalCount} 项',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'showHeader' => true,
    'showFooter' => false,
    'layout' => "{items}\n<div class='clearfix'><div class='pull-left'>{summary}</div><div class='pull-right'>{pager}</div></div>",
    'tableOptions' => ['class' => 'table  table-bordered skintable font14 line35'],
    'filterPosition' => GridView::FILTER_POS_FOOTER,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label'=>'会员名称',
            'attribute'=>'user_name',
            'format'=>'raw',
            'value' => function($model) {
                return Html::a($model->user_name, '/#/member/user&uid='.$model->user_id);
            },
        ],
        [
            'label'=>'操作内容',
            'attribute'=>'edlog'
        ],
        [
            'label'=>'IP地址',
            'attribute'=>'login_ip'
        ],
        [
            'label'=>'登录时间',
            'attribute'=>'edtime'
        ],
        [
            'label'=>'登录网址',
            'attribute'=>'login_url'
        ],
    ]
]); ?>