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

<div class="pro_title pd10">管理员管理：管理员操作日志</div>

<form id="gridSearchForm" action="#/admin/log/list" style="margin: 10px;" class="trinput inputct">

    管理员：<input name="manage_name" type="text" id="manage_name" value="<?=$searchModel['manage_name'] ?>" >
    &nbsp;&nbsp;
    操作内容：<input name="edlog" type="text" id="edlog" value="<?=$searchModel['edlog'] ?>">
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
    'layout' => "{items}\n<div class='clearfix'><div class='pull-left'>{summary}</div><div class='pull-right'>{pager}</div></div>",
    'tableOptions' => ['class' => 'table  table-bordered font13  skintable'],
    'filterPosition' => GridView::FILTER_POS_FOOTER,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        //['class' => 'yii\grid\CheckboxColumn'],
        [
            'label'=>'管理员',
            'attribute'=>'manage_name'
        ],
        [
            'label'=>'登陆时候产生的guid',
            'attribute'=>'session_str'
        ],
        [
            'label'=>'浏览器标识',
            'attribute'=>'run_str'
        ],
        [
            'label'=>'操作内容',
            'attribute'=>'edlog'
        ],
        [
            'label'=>'操作时间',
            'attribute'=>'edtime'
        ],
        [
            'label'=>'登陆IP',
            'attribute'=>'login_ip'
        ],
//        [
//            'attribute' => 'login_ip',
//            'value' => function($model) {
//                return IpUtils::convertIp($model->login_ip);
//            },
//        ]
    ]
]); ?>