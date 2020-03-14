<?php
namespace app\modules\lottery\lotteryresult\controllers;
use Yii;
use app\modules\general\admin\models\ManageLog;
use app\common\base\BaseController;
use app\modules\lottery\lotteryresult\model\LotteryResultCqsf;
use app\common\data\Pagination;


/*
 * 注单控制器
 */
class CqsfcController extends BaseController{
    public $layout=false;
    private $pagecount = 200;
	private $pagesize = 20;
	//lottery - result -重庆十分彩
    //查询和默认开奖结果首页
	public function actionList(){
        $id	= $this->getParam('id',0);
        $time = $this->getParam('s_time');
        $qishu = trim($this->getParam('qishu_query'));
        $cqsfc = LotteryResultCqsf::CqsfList($time,$qishu);
        $count = $cqsfc->count()<$this->pagecount?$cqsfc->count():$this->pagecount;
        $pages = new Pagination(['totalCount' =>$count, 'pageSize' => $this->pagesize]);
        $lists = $cqsfc->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('cqsfc',['id'=>$id,'qishu_query'=>$qishu,'query_time'=>$time,'rows'=>$lists,'pages'=>$pages]);
	}
	//新增修改操作
    public function actionOperation(){
        $superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        $spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
        if($superpassword!=$spc){
            return $this->out(false,'修改权限密码错误');
        }
        $id	= $_GET['id'];
        $query_time = $this->getParam('s_time');
        $qishu_query = trim($this->getParam('qishu_query'));
        $pages = new Pagination(['totalCount' =>'0', 'pageSize' => '20']);
        if($id==0){
            $qishu = $_POST["qishu"];
            $where_cqsfc['qishu'] = $qishu;
            $cqsfc_qihao = LotteryResultCqsf::Qishi($where_cqsfc);
            if($cqsfc_qihao && $cqsfc_qihao['0']["id"] > 0){
                return $this->out('false','该期彩票结果已存在，请查询后编辑。');
            }else{
                $saveModel = new LotteryResultCqsf();
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
                $saveModel->save();
                $str = '重庆十分彩'.'新增期數:'.$qishu.'號碼:'.$_POST["ball_1"].','.$_POST["ball_2"].','.$_POST["ball_3"].','.$_POST["ball_4"].','.$_POST["ball_5"].','.$_POST["ball_6"].','.$_POST["ball_7"].','.$_POST["ball_8"];
                ManageLog::saveLog(Yii::$app->getSession()->get('S_USER_NAME'),$str);
                return $this->out(true, "添加成功!");
            }
        }elseif($id>0){
            $where['id'] = $id;
            $lists = LotteryResultCqsf::Up($where);
            $saveModel = new LotteryResultCqsf();
            $orderSub = $saveModel::findOne($id);
            if($orderSub){
                $create_time = date("Y-m-d H:i:s",time());
                $orderSub->prev_text = "修改时间：".(date("Y-m-d H:i:s",time()))."。<br />修改前内容：".$lists['0']["ball_1"].",".$lists['0']["ball_2"].",".$lists['0']["ball_3"].",".$lists['0']["ball_4"].",".$lists['0']["ball_5"].",".$lists['0']["ball_6"].",".$lists['0']["ball_7"].",".$lists['0']["ball_8"]."。<br />修改后内容：".$_POST["ball_1"].",".$_POST["ball_2"].",".$_POST["ball_3"].",".$_POST["ball_4"].",".$_POST["ball_5"].",".$_POST["ball_6"].",".$_POST["ball_7"].",".$_POST["ball_8"]."。".'<br /><br />'.$lists['0']["prev_text"];
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
                $orderSub->update();
                return $this->out(true, "修改成功!");
            }
        }
        return $this->render('cqsfc',['id'=>$id,'qishu_query'=>$qishu_query,'query_time'=>$query_time,'lists'=>$lists,'pages'=>$pages]);
    }
    //编辑返回视图
    public function actionEdit(){
        $id = $this->getParam('id');
        $query_time = $this->getParam('s_time');
        $qishu_query = trim($this->getParam('qishu_query'));
        $resule_id = LotteryResultCqsf::Edit($id);
        $pages = new Pagination(['totalCount' =>'0', 'pageSize' => '20']);
        $lists = $resule_id->limit('1')->asArray()->all();
        return $this->render('cqsfc',['id'=>$id,'qishu_query'=>$qishu_query,'query_time'=>$query_time,'lists'=>$lists,'pages'=>$pages]);
    }
}
