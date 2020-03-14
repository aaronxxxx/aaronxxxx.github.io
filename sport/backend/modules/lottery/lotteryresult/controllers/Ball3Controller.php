<?php
namespace app\modules\lottery\lotteryresult\controllers;
use Yii;
use app\modules\general\admin\models\ManageLog;
use app\modules\lottery\lotteryresult\model\LotteryResultT3;
use app\modules\lottery\lotteryresult\model\LotteryResultD3;
use app\modules\lottery\lotteryresult\model\LotteryResultP3;
use app\common\data\Pagination;
use app\common\base\BaseController;
/*
 * 注单控制器
 */
class Ball3Controller extends BaseController
{
    public $layout = false;
    private $pagesize = 20;
    private $pagecount = 200;

    //lottery - result -ball -3 上海时时乐、3D彩、排列三
    public function actionList()
    {
        $id = $this->getParam('id', 0);
        $time = $this->getParam('s_time');
        $qishu = trim($this->getParam('qishu_query'));
        $lottery_type = $_GET['type'];//彩票类型、3D彩、排列三、上海时时乐
        if ($lottery_type == "上海时时乐") {
            $cqsfc = LotteryResultT3::T3List($time, $qishu);
        } elseif ($lottery_type == "3D彩") {
            $cqsfc = LotteryResultD3::D3List($time, $qishu);
        } elseif ($lottery_type == "排列三") {
            $cqsfc = LotteryResultP3::P3List($time, $qishu);
        }
        $count = $cqsfc->count() < $this->pagecount ? $cqsfc->count() : $this->pagecount;
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => $this->pagesize]);
        $lists = $cqsfc->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('ball3', ['id' => $id, 'lottery_type' => $lottery_type, 'qishu_query' => $qishu, 'query_time' => $time, 'rows' => $lists, 'pages' => $pages]);
    }
    //新增修改操作
    public function actionOperation(){
        $superpassword = isset($_POST["superpassword"]) ? $_POST["superpassword"] : "";
        $spc = trim( file_get_contents(Yii::$app->basePath."/config/supperpassword") );
        if($superpassword!=$spc){
            return $this->out(false,'修改权限密码错误');
        }
        $id	= $_GET['id'];
        $lottery_type = $_GET['type'];//彩票类型、3D彩、排列三、上海时时乐
        if ($lottery_type == "上海时时乐") {
            $saveModel = new LotteryResultT3();
        } elseif ($lottery_type == "3D彩") {
            $saveModel = new LotteryResultD3();
        } elseif ($lottery_type == "排列三") {
            $saveModel = new LotteryResultP3();
        }
        if($id==0){
            $qishu = $_POST["qishu"];
            $where_cqsfc['qishu'] = $qishu;
            if ($lottery_type == "上海时时乐") {
                $cqsfc_qihao = LotteryResultT3::Qishi($where_cqsfc);
            } elseif ($lottery_type == "3D彩") {
                $cqsfc_qihao = LotteryResultD3::Qishi($where_cqsfc);
            } elseif ($lottery_type == "排列三") {
                $cqsfc_qihao = LotteryResultP3::Qishi($where_cqsfc);
            }
            if($cqsfc_qihao && $cqsfc_qihao['0']["id"] > 0){
                return $this->out('false','该期彩票结果已存在，请查询后编辑。');
            }else{
                $saveModel->qishu = $qishu;
                $saveModel->create_time = date("Y-m-d H:i:s",time());;
                $saveModel->datetime = $_POST["datetime"];
                $saveModel->ball_1 = $_POST["ball_1"];
                $saveModel->ball_2 = $_POST["ball_2"];
                $saveModel->ball_3 = $_POST["ball_3"];
                $saveModel->save();
                $str = $lottery_type.'新增期數:'.$qishu.'號碼:'.$_POST["ball_1"].','.$_POST["ball_2"].','.$_POST["ball_3"];
                ManageLog::saveLog(Yii::$app->getSession()->get('S_USER_NAME'),$str);
                return $this->out(true, "添加成功!");
            }
        }elseif($id>0){
            $where['id'] = $id;
            if ($lottery_type == "上海时时乐") {
                $lists = LotteryResultT3::Up($where);
            } elseif ($lottery_type == "3D彩") {
                $lists = LotteryResultD3::Up($where);
            } elseif ($lottery_type == "排列三") {
                $lists = LotteryResultP3::Up($where);
            }
            $orderSub = $saveModel::findOne($id);
            if($orderSub){
                $create_time = date("Y-m-d H:i:s",time());
                $orderSub->prev_text = "修改时间：".(date("Y-m-d H:i:s",time()))."。<br />修改前内容：".$lists['0']["ball_1"].",".$lists['0']["ball_2"].",".$lists['0']["ball_3"]."。<br />修改后内容：".$_POST["ball_1"].",".$_POST["ball_2"].",".$_POST["ball_3"]."。".'<br /><br />'.$lists['0']["prev_text"];$orderSub->prev_text = "修改时间：".(date("Y-m-d H:i:s",time()))."。<br />修改前内容：".$lists['0']["ball_1"].",".$lists['0']["ball_2"].",".$lists['0']["ball_3"]."。<br />修改后内容：".$_POST["ball_1"].",".$_POST["ball_2"].",".$_POST["ball_3"]."。".'<br /><br />'.$lists['0']["prev_text"];
                $orderSub->qishu = $_POST["qishu"];
                $orderSub->create_time = $create_time;
                $orderSub->datetime = $_POST["datetime"];
                $orderSub->ball_1 = $_POST["ball_1"];
                $orderSub->ball_2 = $_POST["ball_2"];
                $orderSub->ball_3 = $_POST["ball_3"];
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
        $lottery_type = $_GET['type'];//彩票类型、3D彩、排列三、上海时时乐
        if ($lottery_type == "上海时时乐") {
            $resule_id = LotteryResultT3::Edit($id);
        } elseif ($lottery_type == "3D彩") {
            $resule_id = LotteryResultD3::Edit($id);
        } elseif ($lottery_type == "排列三") {
            $resule_id = LotteryResultP3::Edit($id);
        }
        $pages = new Pagination(['totalCount' =>'0', 'pageSize' => '20']);
        $lists = $resule_id->limit('1')->asArray()->all();
        return $this->render('ball3',['id'=>$id, 'lottery_type' => $lottery_type,'qishu_query'=>$qishu_query,'query_time'=>$query_time,'lists'=>$lists,'pages'=>$pages]);
    }

}
