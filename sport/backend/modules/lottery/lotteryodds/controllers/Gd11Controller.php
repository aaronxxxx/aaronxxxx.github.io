<?php
namespace app\modules\lottery\lotteryodds\controllers;
use Yii;
use app\modules\lottery\lotteryodds\model\OddsLottery;
use app\common\base\BaseController;
/*
 * 注单控制器
 */
class Gd11Controller extends BaseController{
    //赔率 - 广东11选5
	public function actionIndex(){
		$this->layout=false;
		echo $this->render('index');
	}
	//正码特赔率查询
    public function actionZhengma(){
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $rows = OddsLottery::find()
            ->select('*')
            ->from('odds_lottery')
            ->where($where)
            ->limit('5')
            ->orderBy('ball_type')
            ->asArray()
            ->all();
        return $this->renderPartial('odds/zhengma',['rows'=>$rows]);
    }
    //正码特赔率更新
    public function actionUpZhengma()
    {
        $superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        $spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
        if($superpassword!=$spc){
            return '修改权限密码错误';
        }
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        for($i=1;$i<6;$i++){
            $saveModel = new OddsLottery();
            $where['ball_type'] = 'ball_'.$i;
            $orderSub = $saveModel::findOne($where);
            for($a=1;$a<16;$a++){
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
        $superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        $spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
        if($superpassword!=$spc){
            return '修改权限密码错误';
        }
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
            ->select(['h1','h2','h3'])
            ->from('odds_lottery')
            ->where($where)
            ->limit('3')
			->orderBy(['id' => SORT_ASC])
            ->asArray()
            ->all();
       return $this->renderPartial('odds/shunzi',['rows'=>$rows]);
    }
    //顺子赔率更新
    public function actionUpShunzi()
    {
        $superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        $spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
        if($superpassword!=$spc){
            return '修改权限密码错误';
        }
        $where['lottery_type'] = $this->getParam('lottery_type');
        $where['sub_type'] = $this->getParam('sub_type');
        $saveModel = new OddsLottery();
        for($i=1;$i<4;$i++){
            $where['ball_type'] = 'ball_'.$i;
            $orderSub = $saveModel::findOne($where);
            for ($a = 1;$a<4;$a++)	{
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
