<?php

namespace app\modules\general\sysmng\controllers;
use Yii;
use app\common\base\BaseController;
use app\modules\general\sysmng\models\ar\UserLevel;
use app\modules\lottery\lotteryodds\model\WebClose;

/**
 * Default controller for the `123` module
 */
class LevelSetController extends BaseController
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
        $params = Yii::$app->request->get();
        $group = UserLevel::find()->orderBy(['level_id'=>SORT_ASC])->asArray()->all();
        $save = Yii::$app->request->post();

        if(isset($save['level_id'])){
            $updateData = array();
            foreach($save as $key=>$val){

                for($i=0;$i<count($val);$i++){
                    $updateData[$i][$key] = $val[$i];

                }

            }

            $update = UserLevel::updateLevel($updateData);
            if($update){
                echo "修改成功";exit;
            }
            echo "修改失败";exit;
        }
        return $this->render('index',array(
            'group'=>$group
        ));
    }

}
