<?php
namespace app\modules\lottery\lotteryresult\controllers;
use Yii;
use app\modules\general\admin\models\ManageLog;
use app\modules\lottery\lotteryresult\model\LotteryResultBjkl8;
use app\common\data\Pagination;
use app\common\base\BaseController;
/*
 * 注单控制器
 */
class Bjkl8Controller extends BaseController{
    public $layout = false;
	private $pagesize = 20;
    private $pagecount = 200;
    //查询和默认开奖结果首页
    public function actionList(){
        $id	= $this->getParam('id',0);
        $time = $this->getParam('s_time');
        $qishu = trim($this->getParam('qishu_query'));
        $cqsfc = LotteryResultBjkl8::Pkkl8List($time,$qishu);
        $count = $cqsfc->count()<$this->pagecount?$cqsfc->count():$this->pagecount;
        $pages = new Pagination(['totalCount' =>$count, 'pageSize' => $this->pagesize]);
        $lists = $cqsfc->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('bjkl8',['id'=>$id,'qishu_query'=>$qishu,'query_time'=>$time,'rows'=>$lists,'pages'=>$pages]);
    }
    //新增修改操作
    public function actionOperation(){
        $superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        $spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
        if($superpassword!=$spc){
            return $this->out(false,'修改权限密码错误');
        }
        $id	= $_GET['id'];
        if($id==0){
            $qishu = $_POST["qishu"];
            $where_cqsfc['qishu'] = $qishu;
            $cqsfc_qihao = LotteryResultBjkl8::Qishi($where_cqsfc);
            if($cqsfc_qihao && $cqsfc_qihao['0']["id"] > 0){
                return $this->out('false','该期彩票结果已存在，请查询后编辑。');
            }else{
                $saveModel = new LotteryResultBjkl8();
                $saveModel->qishu = $qishu;
                $saveModel->create_time = date("Y-m-d H:i:s",time());;
                $saveModel->datetime = $_POST["datetime"];
                $saveModel->ball_1 = $_POST["ball_1"];
                $saveModel->ball_2 = $_POST["ball_2"];
                $saveModel->ball_3 = $_POST["ball_3"];
                $saveModel->ball_4 = $_POST["ball_4"];
                $saveModel->ball_5 = $_POST["ball_5"];
                $saveModel->ball_6 = $_POST["ball_6"];
                $saveModel->ball_7 = $_POST["ball_7"];
                $saveModel->ball_8 = $_POST["ball_8"];
                $saveModel->ball_9 = $_POST["ball_9"];
                $saveModel->ball_10 = $_POST["ball_10"];
                $saveModel->ball_11 = $_POST["ball_11"];
                $saveModel->ball_12 = $_POST["ball_12"];
                $saveModel->ball_13 = $_POST["ball_13"];
                $saveModel->ball_14 = $_POST["ball_14"];
                $saveModel->ball_15 = $_POST["ball_15"];
                $saveModel->ball_16 = $_POST["ball_16"];
                $saveModel->ball_17 = $_POST["ball_17"];
                $saveModel->ball_18 = $_POST["ball_18"];
                $saveModel->ball_19 = $_POST["ball_19"];
                $saveModel->ball_20 = $_POST["ball_20"];
                $saveModel->save();
                $str = 'bjkl8'.'新增期數:'.$qishu.'號碼:'.$_POST["ball_1"].','.$_POST["ball_2"].','.$_POST["ball_3"].$_POST["ball_4"].','.$_POST["ball_5"].','.$_POST["ball_6"].','.$_POST["ball_7"].','.$_POST["ball_8"].','.$_POST["ball_9"].','.$_POST["ball_10"].','.$_POST["ball_11"].','.$_POST["ball_12"].','.$_POST["ball_13"].','.$_POST["ball_14"].','.$_POST["ball_15"].','.$_POST["ball_16"].','.$_POST["ball_17"].','.$_POST["ball_18"].','.$_POST["ball_19"].','.$_POST["ball_20"];
                ManageLog::saveLog(Yii::$app->getSession()->get('S_USER_NAME'),$str);
                return $this->out(true, "添加成功!");

            }
        }elseif($id>0){
            $where['id'] = $id;
            $lists = LotteryResultBjkl8::Up($where);
            $saveModel = new LotteryResultBjkl8();
            $orderSub = $saveModel::findOne($id);
            if($orderSub){
                $create_time = date("Y-m-d H:i:s",time());
                $orderSub->prev_text = "修改时间：".(date("Y-m-d H:i:s",time()))."。<br />修改前内容：".$lists['0']["ball_1"].",".$lists['0']["ball_2"].",".$lists['0']["ball_3"].",".$lists['0']["ball_4"].",".$lists['0']["ball_5"].",".$lists['0']["ball_6"].",".$lists['0']["ball_7"].",".$lists['0']["ball_8"].",".$lists['0']["ball_9"].",".$lists['0']["ball_10"].",".$lists['0']["ball_11"].",".$lists['0']["ball_12"].",".$lists['0']["ball_13"].",".$lists['0']["ball_14"].",".$lists['0']["ball_15"].",".$lists['0']["ball_16"].",".$lists['0']["ball_17"].",".$lists['0']["ball_18"].",".$lists['0']["ball_19"].",".$lists['0']["ball_20"]."。<br />修改后内容：".$_POST["ball_1"].",".$_POST["ball_2"].",".$_POST["ball_3"].",".$_POST["ball_4"].",".$_POST["ball_5"].",".$_POST["ball_6"].",".$_POST["ball_7"].",".$_POST["ball_8"].",".$_POST["ball_9"].",".$_POST["ball_10"].",".$_POST["ball_11"].",".$_POST["ball_12"].",".$_POST["ball_13"].",".$_POST["ball_14"].",".$_POST["ball_15"].",".$_POST["ball_16"].",".$_POST["ball_17"].",".$_POST["ball_18"].",".$_POST["ball_19"].",".$_POST["ball_20"]."。".'<br /><br />'.$lists['0']["prev_text"];
                $orderSub->qishu = $_POST["qishu"];
                $orderSub->create_time = $create_time;
                $orderSub->datetime = $_POST["datetime"];
                $orderSub->ball_1 = $_POST["ball_1"];
                $orderSub->ball_2 = $_POST["ball_2"];
                $orderSub->ball_3 = $_POST["ball_3"];
                $orderSub->ball_4 = $_POST["ball_4"];
                $orderSub->ball_5 = $_POST["ball_5"];
                $orderSub->ball_6 = $_POST["ball_6"];
                $orderSub->ball_7 = $_POST["ball_7"];
                $orderSub->ball_8 = $_POST["ball_8"];
                $orderSub->ball_9 = $_POST["ball_9"];
                $orderSub->ball_10 = $_POST["ball_10"];
                $orderSub->ball_11 = $_POST["ball_11"];
                $orderSub->ball_12 = $_POST["ball_12"];
                $orderSub->ball_13 = $_POST["ball_13"];
                $orderSub->ball_14 = $_POST["ball_14"];
                $orderSub->ball_15 = $_POST["ball_15"];
                $orderSub->ball_16 = $_POST["ball_16"];
                $orderSub->ball_17 = $_POST["ball_17"];
                $orderSub->ball_18 = $_POST["ball_18"];
                $orderSub->ball_19 = $_POST["ball_19"];
                $orderSub->ball_20 = $_POST["ball_20"];
                $orderSub->update();
                return $this->out(true, "修改成功!");
            }
        }
    }
    //编辑view
    public function actionEdit(){
        $id = $this->getParam('id');
        $query_time = $this->getParam('s_time');
        $qishu_query = trim($this->getParam('qishu_query'));
        $resule_id = LotteryResultBjkl8::Edit($id);
        $pages = new Pagination(['totalCount' =>'0', 'pageSize' => '20']);
        $lists = $resule_id->limit('1')->asArray()->all();
        return $this->render('bjkl8',['id'=>$id,'qishu_query'=>$qishu_query,'query_time'=>$query_time,'lists'=>$lists,'pages'=>$pages]);
    }
}
