<?php
namespace app\modules\lottery\lotteryresult\controllers;

use app\modules\lottery\lotteryresult\model\LotteryResultGdsf;
use app\common\data\Pagination;
use app\common\base\BaseController;
/*
 * 注单控制器
 */
class GdsfcController extends BaseController{
    public $layout=false;
    private $pagecount = 200;
	private $pagesize = 20;
	//lottery - result -广东十分彩
    //查询和默认开奖结果首页
	public function actionList(){
        $id	= $this->getParam('id',0);
        $time = $this->getParam('s_time');
        $qishu = trim($this->getParam('qishu_query'));
        $gdsfc = LotteryResultGdsf::GdsfList($time,$qishu);
        $count = $gdsfc->count()<$this->pagecount?$gdsfc->count():$this->pagecount;
        $pages = new Pagination(['totalCount' =>$count, 'pageSize' => $this->pagesize]);
        $lists = $gdsfc->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('gdsfc',['id'=>$id,'qishu_query'=>$qishu,'query_time'=>$time,'rows'=>$lists,'pages'=>$pages]);
	}
	//新增修改操作
    public function actionOperation(){
        $id	= $_GET['id'];
        $query_time = $this->getParam('s_time');
        $qishu_query = trim($this->getParam('qishu_query'));
        $pages = new Pagination(['totalCount' =>'0', 'pageSize' => '20']);
        if($id==0){
            $qishu = $_POST["qishu"];
            $where_gdsfc['qishu'] = $qishu;
            $gdsfc_qihao = LotteryResultGdsf::Qishi($where_gdsfc);
            if($gdsfc_qihao && $gdsfc_qihao['0']["id"] > 0){
                return $this->out('false','该期彩票结果已存在，请查询后编辑。');
            }else{
                $saveModel = new LotteryResultGdsf();
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
                return $this->out(true, "添加成功!");
            }
        }elseif($id>0){
            $where['id'] = $id;
            $lists = LotteryResultGdsf::Up($where);
            $saveModel = new LotteryResultGdsf();
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
        return $this->render('gdsfc',['id'=>$id,'qishu_query'=>$qishu_query,'query_time'=>$query_time,'lists'=>$lists,'pages'=>$pages]);
    }
    //编辑返回视图
    public function actionEdit(){
        $id = $this->getParam('id');
        $query_time = $this->getParam('s_time');
        $qishu_query = trim($this->getParam('qishu_query'));
        $resule_id = LotteryResultGdsf::Edit($id);
        $pages = new Pagination(['totalCount' =>'0', 'pageSize' => '20']);
        $lists = $resule_id->limit('1')->asArray()->all();
        return $this->render('gdsfc',['id'=>$id,'qishu_query'=>$qishu_query,'query_time'=>$query_time,'lists'=>$lists,'pages'=>$pages]);
    }
}
