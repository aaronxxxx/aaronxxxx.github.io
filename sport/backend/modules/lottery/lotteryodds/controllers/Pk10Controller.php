<?php
namespace app\modules\lottery\lotteryodds\controllers;
use Yii;
use app\modules\lottery\lotteryodds\model\OddsLottery;
use app\common\base\BaseController;
/*
 * 注单控制器
 */
class Pk10Controller extends BaseController{
    //北京PK拾赔率
	public function actionIndex(){
		$this->layout=false;
		echo $this->render('index');
	}
	//主盘势赔率查询
    public function actionZhupanshi(){
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        for($i=1;$i<11;$i++){
            $where['ball_type'] = 'ball_'.$i;
            $row = OddsLottery::find()
                ->select('*')
                ->from('odds_lottery')
                ->where($where)
                ->limit('1')
                ->asArray()
                ->all();
            $rows[] = $row;
        }
        return $this->renderPartial('odds/zhupanshi',['rows'=>$rows]);
    }
    //主盘势赔率更新
    public function actionUpZhupanshi()
    {
        $superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        $spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
        if($superpassword!=$spc){
            return '修改权限密码错误';
        }
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        for($i=1;$i<11;$i++){
            $saveModel = new OddsLottery();
            $where['ball_type'] = 'ball_'.$i;
            $orderSub = $saveModel::findOne($where);
            if($i<6){
                for($a=1;$a<7;$a++){
                    $h = 'h'.$a;
                    $orderSub->$h = $_POST['ball_'.$i.'_h'.$a.''];
                }
            }else{
                for($a=1;$a<5;$a++){
                    $h = 'h'.$a;
                    $orderSub->$h = $_POST['ball_'.$i.'_h'.$a.''];
                }
            }
            $orderSub->update();
        }
        if($orderSub){
            return '修改成功';
        }
    }
    //定位赔率查询
    public function actionDingwei(){
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        for($i=1;$i<11;$i++){
            $where['ball_type'] = 'ball_'.$i;
            $rows[] = OddsLottery::find()
                ->select('*')
                ->from('odds_lottery')
                ->where($where)
                ->limit('1')
                ->asArray()
                ->all();
        }
        return $this->renderPartial('odds/dingwei',['rows'=>$rows]);
    }
    //定位赔率更新
    public function actionUpDingwei()
    {
        $superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        $spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
        if($superpassword!=$spc){
            return '修改权限密码错误';
        }
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        for($i=1;$i<11;$i++){
            $saveModel = new OddsLottery();
            $where['ball_type'] = 'ball_'.$i;
            $orderSub = $saveModel::findOne($where);
            for($a=1;$a<11;$a++){
                $h = 'h'.$a;
                $orderSub->$h = $_POST['ball_'.$i.'_h'.$a.''];
            }
            $orderSub->update();
        }
        if($orderSub){
            return '修改成功';
        }
    }
    //冠亚和赔率查询 - 删除
    public function actionGuanyahe(){
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $rows = OddsLottery::find()
            ->select('*')
            ->from('odds_lottery')
            ->where($where)
            ->limit('1')
            ->asArray()
            ->all();
        return $this->renderPartial('odds/guanya',['rows'=>$rows]);
    }
    //冠亚和赔率更新 - 删除
    public function actionUpGuanyahe()
    {
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $saveModel = new OddsLottery();
        $orderSub = $saveModel::findOne($where);
        for($a=1;$a<10;$a++){
            $h = 'h'.$a;
            $orderSub->$h = $_POST['ball_1_h'.$a.''];

            $orderSub->update();
        }
        if($orderSub){
            return '修改成功';
        }
    }
    //快选赔率查询
    public function actionKuaisu(){
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $rows = OddsLottery::find()
            ->select('*')
            ->from('odds_lottery')
            ->where($where)
            ->limit('1')
            ->asArray()
            ->all();
        return $this->renderPartial('odds/kuaisu',['rows'=>$rows]);
    }
    //快选赔率更新
    public function actionUpKuaisu()
    {
        $superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        $spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
        if($superpassword!=$spc){
            return '修改权限密码错误';
        }
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $saveModel = new OddsLottery();
        $orderSub = $saveModel::findOne($where);
        for($a=1;$a<22;$a++){
            $h = 'h'.$a;
            $orderSub->$h = $_POST['ball_1_h'.$a.''];

            $orderSub->update();
        }
        if($orderSub){
            return '修改成功';
        }
    }
    //选号赔率查询 - 删除
    public function actionXuanhao(){
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $rows = OddsLottery::find()
            ->select('*')
            ->from('odds_lottery')
            ->where($where)
            ->limit('1')
            ->asArray()
            ->all();
        return $this->renderPartial('odds/xuanhao',['rows'=>$rows]);
    }
    //删除
    public function actionUpXuanhao()
    {
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $saveModel = new OddsLottery();
        $orderSub = $saveModel::findOne($where);
        for($a=1;$a<8;$a++){
            $h = 'h'.$a;
            $orderSub->$h = $_POST['ball_1_h'.$a.''];

            $orderSub->update();
        }
        if($orderSub){
            return '修改成功';
        }
    }
}
