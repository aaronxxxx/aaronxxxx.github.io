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
&nbsp;<span class="pro_title ">用戶日誌：</span>

<form id="gridSearchForm" style="margin: 10px;" class="trinput inputct font14" action="?r=member/user-log/list">
    用戶名：
    <input type="text" name="user_name" value="<?=$searchModel['user_name']?>"/>
    操作內容：
    <input type="text" name="edlog" value="<?=$searchModel['edlog']?>"/>
    <input id="gridSearchBtn" type="button" value="查詢" />
</form>
<?=
GridView::widget([
    'summary' => '顯示第 {begin} 至 {end} 項結果，共 {totalCount} 項',
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
            'label'=>'會員名稱',
            'attribute'=>'user_name',
            'format'=>'raw',
            'value' => function($model) {
                return Html::a($model->user_name, '?r=member/user&uid='.$model->user_id);
            },
        ],
        [
            'label'=>'操作內容',
            'attribute'=>'edlog'
        ],
        [
            'label'=>'IP地址',
            'attribute'=>'login_ip'
        ],
        [
            'label'=>'登錄時間',
            'attribute'=>'edtime'
        ],
        [
            'label'=>'登錄網址',
            'attribute'=>'login_url'
        ],
    ]
]); ?>