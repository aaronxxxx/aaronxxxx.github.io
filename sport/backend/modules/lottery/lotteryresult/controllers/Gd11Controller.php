<?php
namespace app\modules\lottery\lotteryresult\controllers;
use Yii;
use app\modules\general\admin\models\ManageLog;
use app\modules\lottery\lotteryresult\model\LotteryResultGd11;
use app\common\data\Pagination;
use app\common\base\BaseController;
/*
 * 注单控制器
 */
class Gd11Controller extends BaseController{
    public $layout=false;
	private $pagesize = 20;
    private $pagecount = 200;
    //查询和默认开奖结果首页
    public function actionList(){
        $id	= $this->getParam('id',0);
        $time = $this->getParam('s_time');
        $qishu = trim($this->getParam('qishu_query'));
        $cqsfc = LotteryResultGd11::Gd11List($time,$qishu);
        $count = $cqsfc->count()<$this->pagecount?$cqsfc->count():$this->pagecount;
        $pages = new Pagination(['totalCount' =>$count, 'pageSize' => $this->pagesize]);
        $lists = $cqsfc->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('gd11x5',['id'=>$id,'qishu_query'=>$qishu,'query_time'=>$time,'rows'=>$lists,'pages'=>$pages]);
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
            $cqsfc_qihao = LotteryResultGd11::Qishi($where_cqsfc);
            if($cqsfc_qihao && $cqsfc_qihao['0']["id"] > 0){
                return $this->out('false','该期彩票结果已存在，请查询后编辑。');
            }else{
                $saveModel = new LotteryResultGd11();
                $saveModel->qishu = $qishu;
                $saveModel->create_time = date("Y-m-d H:i:s",time());;
                $saveModel->datetime = $_POST["datetime"];
                $saveModel->ball_1 = $_POST["ball_1"];
                $saveModel->ball_2 = $_POST["ball_2"];
                $saveModel->ball_3 = $_POST["ball_3"];
                $saveModel->ball_4 = $_POST["ball_4"];
                $saveModel->ball_5 = $_POST["ball_5"];
                $saveModel->save();
                $str = 'gd11x5'.'新增期數:'.$qishu.'號碼:'.$_POST["ball_1"].','.$_POST["ball_2"].','.$_POST["ball_3"].','.$_POST["ball_4"].','.$_POST["ball_5"];
                ManageLog::saveLog(Yii::$app->getSession()->get('S_USER_NAME'),$str);
                return $this->out(true, "添加成功!");
            }
        }elseif($id>0){
            $where['id'] = $id;
            $lists = LotteryResultGd11::Up($where);
            $saveModel = new LotteryResultGd11();
            $orderSub = $saveModel::findOne($id);
            if($orderSub){
                $create_time = date("Y-m-d H:i:s",time());
                $orderSub->prev_text = "修改时间：".(date("Y-m-d H:i:s",time()))."。<br />修改前内容：".$lists['0']["ball_1"].",".$lists['0']["ball_2"].",".$lists['0']["ball_3"].",".$lists['0']["ball_4"].",".$lists['0']["ball_5"]."。<br />修改后内容：".$_POST["ball_1"].",".$_POST["ball_2"].",".$_POST["ball_3"].",".$_POST["ball_4"].",".$_POST["ball_5"]."。".'<br /><br />'.$lists['0']["prev_text"];
                $orderSub->qishu = $_POST["qishu"];
                $orderSub->create_time = $create_time;
                $orderSub->datetime = $_POST["datetime"];
                $orderSub->ball_1 = $_POST["ball_1"];
                $orderSub->ball_2 = $_POST["ball_2"];
                $orderSub->ball_3 = $_POST["ball_3"];
                $orderSub->ball_4 = $_POST["ball_4"];
                $orderSub->ball_5 = $_POST["ball_5"];
                $orderSub->update();
                return $this->out(true, "修改成功!");
            }
        }
    }
    //编辑返回视图
    public function actionEdit(){
        $id = $this->getParam('id');
        $query_time = $this->getParam('s_time');
        $qishu_query = trim($this->getParam('qishu_query'));
        $resule_id = LotteryResultGd11::Edit($id);
        $pages = new Pagination(['totalCount' =>'0', 'pageSize' => '20']);
        $lists = $resule_id->limit('1')->asArray()->all();
        return $this->render('gd11x5',['id'=>$id,'qishu_query'=>$qishu_query,'query_time'=>$query_time,'lists'=>$lists,'pages'=>$pages]);
    }
}
