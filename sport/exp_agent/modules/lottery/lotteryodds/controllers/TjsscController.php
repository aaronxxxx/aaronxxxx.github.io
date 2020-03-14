<?php
namespace app\modules\lottery\lotteryodds\controllers;

use app\modules\lottery\lotteryodds\model\OddsLotteryNormal;
use app\common\base\BaseController;
/*
 * 注单控制器
 */
class TjsscController extends BaseController{
	//赔率 - 极速时时彩
	public function actionIndex(){
		$this->layout=false;
		echo $this->render('index');
	}
    //两面赔率查询
    public function actionLiangmian(){
        $lottery_type = $this->getParam('lottery_type');
        $sub_type = $this->getParam('sub_type');
        $where['lottery_type'] = $lottery_type;
        $where['sub_type'] = $sub_type;
        $rows = OddsLotteryNormal::find()
            ->select('*')
            ->where($where)
            ->limit('1')
            ->asArray()
            ->all();
        return $this->renderPartial('odds/liangmian',['rows'=>$rows]);
    }
    //两面赔率修改
    public function actionUpLiangmian()
    {
        $lottery_type = $this->getParam('lottery_type');
        $sub_type = $this->getParam('sub_type');
        $where['lottery_type'] = $lottery_type;
        $where['sub_type'] = $sub_type;
        $saveModel = new OddsLotteryNormal();
        $orderSub = $saveModel::findOne($where);
        if ($orderSub) {
            for($i=0;$i<20;$i++){
                $h = 'h'.$i;
                $orderSub->$h = $_POST['aOdds'][$i];
            }
            $orderSub->update();
        }
        if($orderSub){
            return '修改成功';
        }
    }
    //一字定位赔率查询
    public function actionYizidingwei(){
        $lottery_type = $this->getParam('lottery_type');
        $sub_type = $this->getParam('sub_type');
        $where['lottery_type'] = $lottery_type;
        $where['sub_type'] = $sub_type;
        $rows = OddsLotteryNormal::find()
            ->select('*')
            ->from('odds_lottery_normal')
            ->where($where)
            ->limit('1')
            ->asArray()
            ->all();
        return $this->renderPartial('odds/yizidingwei',['rows'=>$rows]);
    }
    //一字定位赔更新
    public function actionUpYizidingwei()
    {
        $lottery_type = $this->getParam('lottery_type');
        $sub_type = $this->getParam('sub_type');
        $where['lottery_type'] = $lottery_type;
        $where['sub_type'] = $sub_type;
        if($lottery_type = '极速时时彩'){
            $saveModel = new OddsLotteryNormal();
        }
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
    //龙虎和赔率查询
    public function actionLonghuhe(){
        $lottery_type = $this->getParam('lottery_type');
        $sub_type = $this->getParam('sub_type');
        $where['lottery_type'] = $lottery_type;
        $where['sub_type'] = $sub_type;
        $rows = OddsLotteryNormal::find()
            ->select(['h0','h1','h2','h3','h4','h5','h6'])
            ->from('odds_lottery_normal')
            ->where($where)
            ->limit('1')
            ->asArray()
            ->all();
        return $this->renderPartial('odds/longhuhe',['rows'=>$rows]);
    }
    //龙虎和赔率更新
    public function actionUpLonghuhe()
    {
        $lottery_type = $this->getParam('lottery_type');
        $sub_type = $this->getParam('sub_type');
        $where['lottery_type'] = $lottery_type;
        $where['sub_type'] = $sub_type;
        if($lottery_type = '极速时时彩'){
            $saveModel = new OddsLotteryNormal();
        }
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
    //豹子顺子查询
    public function actionBaozishunzi(){
        $lottery_type = $this->getParam('lottery_type');
        $sub_type = $this->getParam('sub_type');
        $where['lottery_type'] = $lottery_type;
        $where['sub_type'] = $sub_type;
        $rows = OddsLotteryNormal::find()
            ->select(['h0','h1','h2','h3','h4'])
            ->from('odds_lottery_normal')
            ->where($where)
            ->limit('1')
            ->asArray()
            ->all();
        return $this->renderPartial('odds/baozishunzi',['rows'=>$rows]);
    }
    //豹子顺子更新
    public function actionUpBaozishunzi()
    {
        $lottery_type = $this->getParam('lottery_type');
        $sub_type = $this->getParam('sub_type');
        $where['lottery_type'] = $lottery_type;
        $where['sub_type'] = $sub_type;
        if($lottery_type = '极速时时彩'){
            $saveModel = new OddsLotteryNormal();
        }
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
    //牛牛赔率查询
    public function actionNiuniu(){
        $lottery_type = $this->getParam('lottery_type');
        $sub_type = $this->getParam('sub_type');
        $where['lottery_type'] = $lottery_type;
        $where['sub_type'] = $sub_type;
        $rows = OddsLotteryNormal::find()
            ->select(['h0','h1','h2','h3','h4','h5','h6','h7','h8','h9','h10','h11','h12','h13','h14'])
            ->from('odds_lottery_normal')
            ->where($where)
            ->limit('1')
            ->asArray()
            ->all();
        return $this->renderPartial('odds/niuniu',['rows'=>$rows]);
    }
    //牛牛赔率修改
    public function actionUpNiuniu()
    {
        $lottery_type = $this->getParam('lottery_type');
        $sub_type = $this->getParam('sub_type');
        $where['lottery_type'] = $lottery_type;
        $where['sub_type'] = $sub_type;
        $saveModel = new OddsLotteryNormal();
        $orderSub = $saveModel::findOne($where);
        if ($orderSub) {
            for($i=0;$i<15;$i++){
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
