<?php
namespace app\modules\lottery\lotteryodds\controllers;

use app\modules\lottery\lotteryodds\model\OddsLottery;
use app\common\base\BaseController;
/*
 * 注单控制器
 */
class GxsfController extends BaseController{
    //广西十分彩赔率
	public function actionIndex(){
		$this->layout=false;
		echo $this->render('index');
	}
	//特别号赔率查询
    public function actionTebiehao(){
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $where['ball_type'] = 'ball_5';
        $rows = OddsLottery::find()
            ->select('*')
            ->from('odds_lottery')
            ->where($where)
            ->limit('1')
            ->asArray()
            ->all();
        return $this->renderPartial('odds/tebiehao',['rows'=>$rows]);
    }
    //特别号赔率更新
    public function actionUpTebiehao()
    {
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $where['ball_type'] = 'ball_5';
        $saveModel = new OddsLottery();

        $orderSub = $saveModel::findOne($where);
        for($a=1;$a<26;$a++){
            $h = 'h'.$a;
            $orderSub->$h = $_POST['ball_1_h'.$a.''];
        }
        $orderSub->update();
        if($orderSub){
            return '修改成功';
        }
    }
    //正码特赔率查询
    public function actionZhengma(){
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $rows = OddsLottery::find()
            ->select('*')
            ->from('odds_lottery')
            ->where($where)
            ->limit('4')
            ->orderBy('ball_type')
            ->asArray()
            ->all();
        return $this->renderPartial('odds/zhengma',['rows'=>$rows]);
    }
    //正码特赔率更新
    public function actionUpZhengmate()
    {
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $saveModel = new OddsLottery();
        $orderSub = $saveModel::findOne($where);
        for($i=1;$i<5;$i++)	{
            $saveModel = new OddsLottery();
            $where['ball_type'] = 'ball_'.$i;
            $orderSub = $saveModel::findOne($where);
            for ($a = 1;$a<26;$a++)	{
                $h = 'h'.$a;
                $orderSub->$h = $_POST['ball_'.$i.'_h'.$a.''];
            }
            $orderSub->update();
        }
        if($orderSub){
            return '修改成功';
        }
    }
    //总和赔率查询
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
        return $this->renderPartial('odds/zonghe',['rows'=>$rows]);
    }
    //总和赔率更新
    public function actionUpZonghe()
    {
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $saveModel = new OddsLottery();
        $orderSub = $saveModel::findOne($where);
        for ($a = 1;$a<8;$a++)	{
            $h = 'h'.$a;
            $orderSub->$h = $_POST['ball_1_h'.$a.''];
        }
        $orderSub->update();

        if($orderSub){
            return '修改成功';
        }
    }
    //顺子赔率查询
    public function actionShunzi(){
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $rows = OddsLottery::find()
            ->select(['h1','h2','h3','h4','h5'])
            ->from('odds_lottery')
            ->where($where)
            ->limit('3')
            ->orderBy(['id'=>SORT_ASC])
            ->asArray()
            ->all();
        return $this->renderPartial('odds/shunzi',['rows'=>$rows]);
    }
    //顺子赔率更新
    public function actionUpShunzi()
    {
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $saveModel = new OddsLottery();
        for($i=1;$i<4;$i++){
            $where['ball_type'] = 'ball_'.$i;
            $orderSub = $saveModel::findOne($where);
            for ($a = 1;$a<6;$a++)	{
                $h = 'h'.$a;
                $orderSub->$h = $_POST['ball_'.$i.'_h'.$a.''];
            }
            $orderSub->update();
        }
        if($orderSub){
            return '修改成功';
        }
    }
}
