<?php
namespace app\modules\lottery\lotteryodds\controllers;

use app\modules\lottery\lotteryodds\model\OddsLottery;
use app\common\base\BaseController;
/*
 * 注单控制器
 */
class Kl8Controller extends BaseController{
    //北京快乐8赔率
	public function actionIndex(){
		$this->layout=false;
		return $this->render('index');
	}
	//选号赔率查询
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
    //选号赔率更新
    public function actionUpXuanhao()
    {
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $saveModel = new OddsLottery();
        $orderSub = $saveModel::findOne($where);
        for($a=1;$a<11;$a++){
            $h = 'h'.$a;
            $orderSub->$h = $_POST['ball_1_h'.$a.''];
        }
        $orderSub->update();

        if($orderSub){
            return '修改成功';
        }
    }
    //其他赔率查询
    public function actionQita(){
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $rows = OddsLottery::find()
            ->select('*')
            ->from('odds_lottery')
            ->where($where)
            ->limit('1')
            ->asArray()
            ->all();
        return $this->renderPartial('odds/qita',['rows'=>$rows]);
    }
    //其他赔率更新
    public function actionUpQita()
    {
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $saveModel = new OddsLottery();
        $orderSub = $saveModel::findOne($where);
        for($a=1;$a<12;$a++){
            $h = 'h'.$a;
            $orderSub->$h = $_POST['ball_1_h'.$a.''];
        }
        $orderSub->update();

        if($orderSub){
            return '修改成功';
        }
    }
}
