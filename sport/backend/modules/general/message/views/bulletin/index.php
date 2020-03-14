<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 9:59
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="pro_title pd10">公告管理：管理网站公告信息</div>
<form id="bulletinForm" class="need_validate addhistorybank" role="form" method="post" action="?r=message/bulletin/add">
        <div class="form-group">
            <label for="content">公告内容</label>
            <textarea class="form-control" id="content" name="content" placeholder="请输入公告内容" data-rule-required="true" data-msg-required="请输入公告内容"><?=$model->content ?></textarea>
        </div>
        <div class="form-group">
            <label for="end_time">结束时间</label>
            <input type="text" class="form-control date_day_time" id="end_time" name="end_time" value="<?=$model->end_time ?>" placeholder="请输入结束时间" data-rule-required="true" data-msg-required="请输入结束时间">
        </div>
        <div class="form-group">
            <label for="sort">排序</label>
            <input type="text" class="form-control" id="sort" name="sort" value="<?=$model->sort ?>" placeholder="请输入排序" data-rule-required="true" data-msg-required="请输入排序" data-rule-digits="true">
        </div>
        <div class="form-group">
            <label>是否显示</label>
            <div>
                <input name="is_show" type="radio" value="1" <?php if($model->is_show){echo 'checked';} ?>>显示
                <input name="is_show" type="radio" value="0" <?php if(!$model->is_show){echo 'checked';} ?>>不显示
            </div>
        </div>
        <?php
            if($model['type']==null) {
        ?>
                <button type="button" class="btn btn-primary form_ajax_submit_btn" data-targetid="bulletinForm" data-redirect="#/message/bulletin/list">保存</button>
        <?php
            } else {
        ?>
                <button type="button" class="btn btn-primary form_ajax_submit_btn" data-targetid="bulletinForm" data-redirect="#/message/bulletin/list&type=0">保存</button>
        <?php
            }
        ?>
        <input type="hidden" id="id" name="id" value="<?=$model->id ?>">
</form>