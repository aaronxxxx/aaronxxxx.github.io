<?php

namespace app\modules\lottery\lotteryodds\controllers;
use Yii;
use app\common\base\BaseController;
use app\modules\core\common\models\UserGroup;
use app\modules\lottery\lotteryodds\model\WebClose;

/**
 * Default controller for the `123` module
 */
class DefaultController extends BaseController
{
    /**
     * 时时彩程序设置
     * @return string
     * 彩票期数校准
     * 功能暂时没期作用
     */
    public function actionIndex()
    {
        $this->layout = false;
        $Lottery_set = WebClose::find()->where("is_jiaodui != 1 ")->orderBy(['id'=>SORT_ASC])->asArray()->all();
        $qishuJiaodui =  WebClose::find()->where(array('is_jiaodui'=>1))->asArray()->all();
        return $this->render('index',array(
            'Lottery_set'=>$Lottery_set,
            'qishuJiaodui'=>$qishuJiaodui
            ));
    }
    //修改开关
    public function actionUpclose(){
        $params = Yii::$app->request->post();
        if(isset($params['save']) && $params['save']=='ok'){
            foreach ($params as $key=>$val){
                if(is_array($val) && !empty($val)){
                    $webClose = WebClose::findOne(array('id'=>$key));
                    if($webClose){
                        if($webClose->is_jiaodui==1){
                            $val['qishu'] = $val['qishu'] ? intval($val['qishu']) :'';
                            $webClose->qishu = $val['qishu'];
                            $webClose->kaijiang_time = $val['kaijiang_time'];
                            $webClose->save();
                        }else{
                            $close = 0;
                            $des = '';
                            if(isset($val['close']) && $val['close']) $close = 1;
                            if(isset($val['des']) && $val['des']) $des = trim($val['des']);
                            if($webClose){
                                $webClose->close = $close;
                                $webClose->des = $des;
                                $webClose->save();
                            }
                        }
                    }
                }
            }
            return $this->out(true, "修改成功!");
        }
    }
    /*
     * 彩票金额设置
     */
    public function actionMoneySet(){
        $this->layout = false;
        $params = Yii::$app->request->get();
        $userGroup = UserGroup::getAllGroup();
        $lastGroup = UserGroup::find()->limit(1)->asArray()->one();
        $groupId = isset($params['group_id']) && $params['group_id'] ? $params['group_id'] : $lastGroup['group_id'];
        $group = UserGroup::find()->where(array('group_id'=>$groupId))->limit(1)->asArray()->one();
        $save = Yii::$app->request->post();
        if(isset($save['group_id']) && $save['group_id'] && isset($save['bet']) && $save['bet']){
            $update = UserGroup::updateBetMonney($save['group_id'],$save['bet']);
            if($update){
                echo "修改成功";exit;
            }
            echo "修改失败";exit;
        }
        return $this->render('moneyset',array(
            'userGroup'=>$userGroup,
            'groupId'=>$groupId,
            'group'=>$group
        ));
    }
}
