<?php
namespace app\modules\lottery\lotteryodds\controllers;

use app\modules\lottery\lotteryodds\model\OddsLottery;
use app\common\base\BaseController;
/*
 * 注单控制器
 */
class CqsfController extends BaseController{
	//赔率 - 重庆十分彩
	public function actionIndex(){
		$this->layout=false;
		echo $this->render('index');
	}
	//单码赔率查询
    public function actionDanma()
    {
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $rows = OddsLottery::find()
            ->select('*')
            ->from('odds_lottery')
            ->where($where)
            ->limit('8')
			->orderBy(['id'=>SORT_ASC])
            ->asArray()
            ->all();
        return $this->renderPartial('odds/danma', ['rows' => $rows]);
    }
    //单码赔率修改
    public function actionUpdanma()
    {
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        for($i=1;$i<9;$i++){
            $saveModel = new OddsLottery();
            $where['ball_type'] = 'ball_'.$i;
            $orderSub = $saveModel::findOne($where);
            for($a=1;$a<29;$a++){
                $h = 'h'.$a;
                $orderSub->$h = $_POST['ball_'.$i.'_h'.$a.''];
            }
            $orderSub->update();
        }
        if($orderSub){
            return '修改成功';
        }
    }
    //方位赔率查询
    public function actionFangwei(){
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $rows = OddsLottery::find()
            ->select('*')
            ->from('odds_lottery')
            ->where($where)
            ->limit('8')
            ->asArray()
            ->orderBy(['id'=>SORT_ASC])
            ->all();
        return $this->renderPartial('odds/fangwei', ['rows' => $rows]);
    }
    //方位赔率修改
    public function actionUpfangwei()
    {
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        for($i=1;$i<9;$i++){
            $saveModel = new OddsLottery();
            $where['ball_type'] = 'ball_'.$i;
            $orderSub = $saveModel::findOne($where);
            for($a=1;$a<8;$a++){
                $h = 'h'.$a;
                $orderSub->$h = $_POST['ball_'.$i.'_h'.$a.''];
            }
            $orderSub->update();
        }
        if($orderSub){
            return '修改成功';
        }
    }
    //总和、龙虎和查询
    public function actionZonghe(){
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $rows = OddsLottery::find()
            ->select('*')
            ->from('odds_lottery')
            ->where($where)
            ->limit('1')
            ->asArray()
            ->all();
        return $this->renderPartial('odds/zonghe', ['rows' => $rows]);
    }
    //总和、龙虎和修改
    public function actionUpzonghe()
    {
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $saveModel = new OddsLottery();
        $where['ball_type'] = 'ball_1';
        $orderSub = $saveModel::findOne($where);
        for($a=1;$a<9;$a++){
            $h = 'h'.$a;
            $orderSub->$h = $_POST['ball_1_h'.$a.''];
        }
        $orderSub->update();
        if($orderSub){
            return '修改成功';
        }
    }
}
