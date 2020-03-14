<?php
namespace app\modules\lottery\lotteryodds\controllers;
use Yii;
use app\modules\lottery\lotteryodds\model\OddsLotteryNormal;
use app\common\base\BaseController;
/*
 * 注单控制器
 */
class ShsslController extends BaseController{
    //上海时时乐赔率
    public function actionIndex(){
        $this->layout=false;
        echo $this->render('index');
    }
    //两面赔率查询
    public function actionLiangmian(){
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $rows = OddsLotteryNormal::find()
            ->select('*')
            ->where($where)
            ->limit('1')
            ->asArray()
            ->all();
        return $this->renderPartial('odds/liangmian',['rows'=>$rows]);
    }
    //两面赔率更新
    public function actionUpLiangmian()
    {
        $superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        $spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
        if($superpassword!=$spc){
            return '修改权限密码错误';
        }
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $saveModel = new OddsLotteryNormal();
        $orderSub = $saveModel::findOne($where);
        if ($orderSub) {
            for($i=0;$i<12;$i++){
                $h = 'h'.$i;
                $orderSub->$h = $_POST['aOdds'][$i];
            }
            $orderSub->update();
        }
        if($orderSub){
            return '修改成功';
        }
    }
    //一字赔率更新
    public function actionUpYizi()
    {
        $superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        $spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
        if($superpassword!=$spc){
            return '修改权限密码错误';
        }
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $saveModel = new OddsLotteryNormal();
        $orderSub = $saveModel::findOne($where);
        if ($orderSub){
            for($i=0;$i<10;$i++){
                $h = 'h'.$i;
                $orderSub->$h = $_POST['aOdds'][$i];
            }
            $orderSub->update();
        }
        if($orderSub){
            return '修改成功';
        }
    }
    //一字佰赔率查询
    public function actionYiziBai(){
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $rows = OddsLotteryNormal::find()
            ->select('*')
            ->where($where)
            ->limit('1')
            ->asArray()
            ->all();
        return $this->renderPartial('odds/yizi_bai',['rows'=>$rows]);
    }
    //一字拾赔率查询
    public function actionYiziShi(){
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $rows = OddsLotteryNormal::find()
            ->select('*')
            ->where($where)
            ->limit('1')
            ->asArray()
            ->all();
        return $this->renderPartial('odds/yizi_shi',['rows'=>$rows]);
    }
    //一字个赔率查询
    public function actionYiziGe(){
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $rows = OddsLotteryNormal::find()
            ->select('*')
            ->where($where)
            ->limit('1')
            ->asArray()
            ->all();
        return $this->renderPartial('odds/yizi_ge',['rows'=>$rows]);
    }
    //跨度赔率查询
    public function actionKuadu(){
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $rows = OddsLotteryNormal::find()
            ->select('*')
            ->where($where)
            ->limit('1')
            ->asArray()
            ->all();
        return $this->renderPartial('odds/kuadu',['rows'=>$rows]);
    }
    //龙虎和赔率查询
    public function actionLonghuhe(){
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $rows = OddsLotteryNormal::find()
            ->select(['h0','h1','h2','h3','h4','h5','h6'])
            ->where($where)
            ->limit('1')
            ->asArray()
            ->all();
        return $this->renderPartial('odds/longhuhe',['rows'=>$rows]);
    }
    //龙虎和赔率更新
    public function actionUpLonghuhe()
    {
        $superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        $spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
        if($superpassword!=$spc){
            return '修改权限密码错误';
        }
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $saveModel = new OddsLotteryNormal();
        $orderSub = $saveModel::findOne($where);
        if ($orderSub) {
            for($i=0;$i<7;$i++){
                $h = 'h'.$i;
                $orderSub->$h = $_POST['aOdds'][$i];
            }
            $orderSub->update();
        }
        if($orderSub){
            return '修改成功';
        }
    }
    //豹子赔率查询
    public function actionBaozi(){
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $rows = OddsLotteryNormal::find()
            ->select(['h0','h1','h2','h3','h4'])
            ->where($where)
            ->limit('1')
            ->asArray()
            ->all();
        return $this->renderPartial('odds/baozi',['rows'=>$rows]);
    }
    //豹子赔率更新
    public function actionUpBaozi()
    {
        $superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        $spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
        if($superpassword!=$spc){
            return '修改权限密码错误';
        }
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $saveModel = new OddsLotteryNormal();
        $orderSub = $saveModel::findOne($where);
        if ($orderSub) {
            for($i=0;$i<5;$i++){
                $h = 'h'.$i;
                $orderSub->$h = $_POST['aOdds'][$i];
            }
            $orderSub->update();
        }
        if($orderSub){
            return '修改成功';
        }
    }
}
